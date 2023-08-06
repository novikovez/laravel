<?php

namespace App\Http\Services\Payments\Module\Stripe;

use App\Http\Services\Payments\DTO\CreateTokenDTO;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;


class CreateTokenStripeService
{
    public function __construct(
        protected StripeClient $stripe,
    ) {
    }

    /**
     * @throws ApiErrorException
     */
    public function createToken(CreateTokenDTO $createTokenDTO)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $createTokenDTO->getCardNumber(),
                    'exp_month' => $createTokenDTO->getExpMonth(),
                    'exp_year' => $createTokenDTO->getExpYear(),
                    'cvc' => $createTokenDTO->getCvc()
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }


}
