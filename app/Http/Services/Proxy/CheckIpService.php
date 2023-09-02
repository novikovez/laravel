<?php

namespace App\Http\Services\Proxy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redis;

class CheckIpService
{

    protected const PROXY_COUNT_NEW_LIST = 5;
    protected const PROXY_MAX_EX_TIME = 1;
    protected const PROXY_API_URL = 'https://api.myip.com/';
    public function  __construct(
        protected Client $client,
        protected WebProxyService $webProxyService,
        protected ProxyStorage $proxyStorage
    )
    {
    }

    /**
     * @throws GuzzleException
     */
    public function getMyIp(): string
    {
        $proxy = $this->proxyStorage->lpop();
        $start = microtime(true);
        $response = $this->client->get(self::PROXY_API_URL,
            [
                "proxy" => $proxy->getData(),
            ]);

        $count = $this->checkResultTime($start, $proxy);
        if($count < self::PROXY_COUNT_NEW_LIST)
        {
            $this->newListProxy();
        }
        return $response->getBody()->getContents();
    }

    private function checkResultTime($start, $proxy): int
    {
       $result = microtime(true) - $start;
       if($result < self::PROXY_MAX_EX_TIME)
       {
           $this->proxyStorage->rpush($proxy);
       }
       return $this->proxyStorage->llen();
    }

    /**
     * @throws GuzzleException
     */
    private function newListProxy(): void
    {
        $this->proxyStorage->del();
        $this->webProxyService->getProxyList();
    }

}
