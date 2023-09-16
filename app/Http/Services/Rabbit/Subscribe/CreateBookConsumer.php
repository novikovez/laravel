<?php

namespace App\Http\Services\Rabbit\Subscribe;

use App\Http\Repositories\Book\BookRepository;
use App\Http\Repositories\Book\BookStoreDTO;
use App\Http\Services\Rabbit\Messages\BookCreateDTO;
use App\Http\Services\Rabbit\Publish\SendCreateBookService;
use Bschmitt\Amqp\Facades\Amqp;
use PhpAmqpLib\Message\AMQPMessage;

class CreateBookConsumer
{

    public function __construct(
        protected BookRepository $bookRepository
    ) {
    }

    public function handle()
    {
        Amqp::consume(SendCreateBookService::QUEUE_NAME, function (AMQPMessage $message) {
            $messageDTO = new BookStoreDTO(
                ...json_decode(
                    $message->getBody(),
                    true
                )
            );
            $this->bookRepository->store($messageDTO);
            $message->ack();
        });
    }
}
