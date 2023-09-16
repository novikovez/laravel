<?php

namespace App\Http\Services\Rabbit\Publish;

use Bschmitt\Amqp\Facades\Amqp;
use Faker\Factory as Faker;


class SendCreateWordService
{

    public const QUEUE_NAME = 'words';
    private const EX_TIME = 5;

    public function handle()
    {
        $faker = Faker::create();
        $start_time = time();
        while ($this->checkTime($start_time) === true) {
            Amqp::publish(self::QUEUE_NAME, $faker->word(), [
                'queue' => self::QUEUE_NAME
            ]);
        }
    }

    private function checkTime($start): bool
    {
        $secondWork = time() - $start;
        if ($secondWork < self::EX_TIME * 60) {
            return true;
        }
        return false;
    }
}
