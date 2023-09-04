<?php

namespace App\Http\Services\Proxy;

use App\Exceptions\WebshareStatusCode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Redis;

class WebProxyService
{
    public function __construct(
        protected Client $client,
        protected ProxyStorage $proxyStorage
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws WebshareStatusCode
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

        if($response->getStatusCode() !== 200)
        {
            throw new WebshareStatusCode('Webshare Bad Status');
        }

        $data = $response->getBody()->getContents();
        $this->proxyStorage->del();

        foreach (json_decode($data)->results as $item) {
            $proxy = [
                "username" => $item->username,
                "password" => $item->password,
                "ip" => $item->proxy_address,
                "port" => $item->port,
            ];
            $this->proxyStorage->lpush(new ProxyDTO(...$proxy));
        }
    }
}
