<?php

namespace App\Http\Services\User;

use Laravel\Passport\PersonalAccessTokenResult;

class UserIterator {

    protected int $id;
    protected string $email;
    protected PersonalAccessTokenResult $token;

    public function __construct(object $data)
    {
        $this->id = $data['token']->token->user_id;
        $this->email = $data['email'];
        $this->token = $data['token'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return PersonalAccessTokenResult
     */
    public function getToken(): PersonalAccessTokenResult
    {
        return $this->token;
    }
}
