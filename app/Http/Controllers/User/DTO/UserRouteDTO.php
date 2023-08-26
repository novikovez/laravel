<?php

namespace App\Http\Controllers\User\DTO;

use App\Enum\UserMethodEnum;
use JsonSerializable;

class UserRouteDTO implements JsonSerializable
{
    public function __construct(
        protected int $userId,
        protected string $route,
        protected UserMethodEnum $userMethodEnum,
        protected int $views = 0
    )
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getUserRouteEnum(): UserMethodEnum
    {
        return $this->userMethodEnum;
    }

    public function jsonSerialize(): array
    {
        return [
            "userId" => $this->userId,
            "route" => $this->route,
            "views" => $this->views,
        ];
    }
}
