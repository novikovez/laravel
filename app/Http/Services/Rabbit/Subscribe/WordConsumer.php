<?php

namespace App\Http\Services\Rabbit\Subscribe;

use App\Exceptions\OffsetOnValue;
use App\Exceptions\WebshareStatusCode;
use App\Http\Repositories\Word\WordRepository;
use App\Http\Services\Proxy\ProxyDTO;
use App\Http\Services\Proxy\ProxyStorage;
use App\Http\Services\Rabbit\Messages\WordCreateDTO;
use App\Http\Services\Rabbit\Publish\SendCreateWordService;
use App\Http\Services\Supervisor\SupervisorDTO;
use App\Http\Services\Supervisor\SupervisorService;
use Bschmitt\Amqp\Facades\Amqp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PhpAmqpLib\Message\AMQPMessage;
use App\Http\Services\Proxy\WebProxyService;

class WordConsumer
{

    protected const API_URL = 'https://api.duckduckgo.com/?q=';
    protected const FORMAT = '&format=json';
    protected const COMMAND_SUPERVISOR = "app:word-subscribe";
    protected const COMMAND_SUPERVISOR_NAME = "consumer_add";
    protected const MAX_MESSAGE = 1000;
    protected const MAX_CONSUMER = 5;

    public function __construct(
        protected Client $client,
        protected WebProxyService $webProxyService,
        protected ProxyStorage $proxyStorage,
        protected WordRepository $wordRepository,
        protected SupervisorService $supervisorService
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws WebshareStatusCode
     * @throws OffsetOnValue
     */
    public function handle(): void
    {
        $this->checkProxyList();

        Amqp::consume(SendCreateWordService::QUEUE_NAME, function (AMQPMessage $message) {
            $proxy = $this->proxyStorage->lpop();
            $this->proxyStorage->rpush($proxy);
            $response = $this->getResponse($message, $proxy);
            $this->wordRepository->store(new WordCreateDTO($message->getBody(), $response));
            $message->ack();
            $this->getCountsRabbit($message);
        });
    }

    /**
     * @throws GuzzleException
     * @throws WebshareStatusCode
     */
    private function checkProxyList(): void
    {
        // check proxy list, and create
        if ($this->proxyStorage->llen() < 1) {
            $this->webProxyService->getProxyList();
        }
    }

    /**
     * @throws GuzzleException
     */
    private function getResponse(AMQPMessage $message, ProxyDTO $proxy): string
    {
        // get response api duckduckgo
        $response = $this->client->get(self::API_URL . $message->getBody() . self::FORMAT,
            [
                "proxy" => $proxy->getData(),
            ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response['AbstractSource'];
    }


    private function getCountsRabbit(AMQPMessage $message): void
    {
        // count messages
        $countMessage = $this->countMessages($message);
        // count consumer
        $countConsumer = $message->getChannel()->queue_declare(SendCreateWordService::QUEUE_NAME, true)[2];
        // check - add consumer
        if ($this->checkMessageCount($countMessage) === true and $this->checkConsumerCount($countConsumer) === true) {
            $this->addConsumer();
        }
        // check - remove consumer
        if ($this->checkMessageCount($countMessage) === false and $this->checkConsumerCount($countConsumer) === false) {
            $this->delConsumers();
        }
    }

    private function countMessages(AMQPMessage $message): int
    {
        // get count message and check for not null
        if ($message->getChannel()->basic_get() !== null) {
            return $message->getChannel()->basic_get()->getMessageCount();
        }
        return 0;
    }

    private function checkMessageCount(int $countMessage): bool
    {
        // checking the count of messages is not equal null
        if ($countMessage > self::MAX_MESSAGE) {
            return true;
        }
        return false;
    }

    private function checkConsumerCount(int $countConsumer): bool
    {
        // checking the count of consumer is less 2
        if ($countConsumer < 2) {
            return true;
        }
        return false;
    }


    private function addConsumer(): void
    {
        // add new consumer
        $this->supervisorService->addProcesses(new SupervisorDTO([
            "name" => self::COMMAND_SUPERVISOR_NAME,
            "command" => "/usr/local/bin/php /var/www/html/laravel/artisan " . self::COMMAND_SUPERVISOR,
            "number" => self::MAX_CONSUMER,
        ]));
        exec('supervisorctl reread');
        exec('supervisorctl update');
    }

    private function delConsumers(): void
    {
        // remove consumer
        $this->supervisorService->delete(self::COMMAND_SUPERVISOR_NAME);
        exec('supervisorctl reread');
        exec('supervisorctl update');
    }
}
