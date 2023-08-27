<?php

namespace App\Http\Services\Proxy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redis;

class WebProxyService
{
    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * @throws GuzzleException
     */
    public function getProxyList(): void
    {
        $response = $this->client->get('https://proxy.webshare.io/api/v2/proxy/list', [
            "query" => [
                "mode" => "direct",
                "page" => 1,
                "page_size" => 10,
            ],
            "headers" => [
                "Authorization" => config('proxy.key')
            ]
        ]);
        $data = $response->getBody()->getContents();

        foreach (json_decode($data)->results as $item) {
            $proxy = [
                "username" => $item->username,
                "password" => $item->password,
                "ip" => $item->proxy_address,
                "port" => $item->port,
            ];
            Redis::lpush('proxies', json_encode($proxy));
        }
    }
}
