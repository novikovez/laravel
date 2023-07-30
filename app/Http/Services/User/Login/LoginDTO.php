<?php

namespace App\Http\Services\User\Login;

use App\Http\Services\User\UserIterator;
use Laravel\Passport\PersonalAccessTokenResult;

class LoginDTO
{
    protected ?UserIterator $userId = null;
    protected PersonalAccessTokenResult $token;

    public function __construct(
        protected string $email,
        protected string $password
    )
    {
    }

    /**
     * @return PersonalAccessTokenResult
     */
    public function getToken(): PersonalAccessTokenResult
    {
        return $this->token;
    }

    /**
     * @param PersonalAccessTokenResult $token
     */
    public function setToken(PersonalAccessTokenResult $token): void
    {
        $this->token = $token;
    }

    /**
     * @return UserIterator|null
     */
    public function getUserId(): UserIterator|null
    {
        return $this->userId;
    }

    /**
     * @param UserIterator $userId
     */
    public function setUserId(UserIterator $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
