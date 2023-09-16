<?php

namespace App\Http\Services\Rabbit\Publish;

use App\Http\Repositories\Book\BookStoreDTO;
use Bschmitt\Amqp\Facades\Amqp;

class SendCreateBookService
{

    public const QUEUE_NAME = 'create_book';
    private const EX_TIME = 5;

    public function handle()
    {
        $start_time = time();
        while ($this->checkTime($start_time) === true) {
            $dto = new BookStoreDTO(
                "bookName_" . rand(1, 1000000),
                '' . rand(1970, 2023),
                'ua',
                '' . rand(1970, 2023),
                '' . rand(1, 200),
                '' . rand(1, 5000),
            );
            Amqp::publish(self::QUEUE_NAME, json_encode($dto), [
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
