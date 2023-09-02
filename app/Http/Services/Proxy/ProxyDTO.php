<?php

namespace App\Http\Services\Proxy;

use JsonSerializable;

class ProxyDTO implements JsonSerializable
{

    public function __construct(
        protected string $username,
        protected string $password,
        protected string $ip,
        protected int $port,
    )
    {
    }

    public function getData(): string
    {
        return 'http://' . $this->username . ':' . $this->password . '@' . $this->ip . ':' . $this->port;

    }
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function jsonSerialize(): array
    {
        return [
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "ip" => $this->getIp(),
            "port" => $this->getPort(),
        ];
    }
}
