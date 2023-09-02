<?php

namespace App\Http\Services\Proxy;

use Illuminate\Support\Facades\Redis;

class ProxyStorage
{
    protected const KEY = 'proxies';

    public function lpop(): ProxyDTO
    {
        $cache = json_decode(Redis::lpop(self::KEY), true);
        return new ProxyDTO(...$cache);
    }

    public function rpop(): ProxyDTO
    {
        $cache = json_decode(Redis::rpop(self::KEY), true);
        return new ProxyDTO(...$cache);
    }

    public function lpush(ProxyDTO $proxyDTO): void
    {
        Redis::lpush(self::KEY, json_encode($proxyDTO));

    }

    public function rpush(ProxyDTO $proxyDTO): void
    {
        Redis::rpush(self::KEY, json_encode($proxyDTO));

    }

    public function llen(): int
    {
        return Redis::llen(self::KEY);
    }

    public function del(): void
    {
        Redis::del(self::KEY);
    }
}

