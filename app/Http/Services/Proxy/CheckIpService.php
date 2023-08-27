<?php

namespace App\Http\Services\Proxy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redis;

class CheckIpService
{
    public function  __construct(
        protected Client $client,
        protected WebProxyService $webProxyService
    )
    {
    }

    /**
     * @throws GuzzleException
     */
    public function getMyIp(): string
    {
        $proxy = json_decode($this->checkRedisProxies(), true);
        $authData = $proxy['username'] . ':' . $proxy['password'];
        $start = microtime(true);
        $response = $this->client->get('https://api.myip.com/',
            [
                "proxy" => "http://" . $authData . '@' . $proxy['ip'] . ":" . $proxy['port'],
            ]);

        $count = $this->checkResultTime($start, $proxy);
        if($count < 5)
        {
            $this->newListProxy();
        }
        return $response->getBody()->getContents();
    }

    private function checkResultTime($start, $proxy): int
    {
       $result = microtime(true) - $start;
       if($result < 1)
       {
           return Redis::rpush('proxies', json_encode($proxy));
       }
       return Redis::llen('proxies');
    }

    /**
     * @throws GuzzleException
     */
    private function newListProxy(): void
    {
        Redis::del('proxies');
        $this->webProxyService->getProxyList();
    }

    /**
     * @throws GuzzleException
     */
    private function checkRedisProxies(): string
    {
        $cache = Redis::lpop('proxies');
        if($cache === null)
        {
            $this->webProxyService->getProxyList();
            return Redis::lpop('proxies');
        }
        return $cache;
    }
}
