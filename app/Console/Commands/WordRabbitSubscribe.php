<?php

namespace App\Console\Commands;

use App\Exceptions\OffsetOnValue;
use App\Exceptions\WebshareStatusCode;
use App\Http\Services\Rabbit\Subscribe\WordConsumer;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class WordRabbitSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:word-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(WordConsumer $wordConsumer): void
    {
        try {
            $wordConsumer->handle();

        } catch (OffsetOnValue|ConnectException|RequestException|WebshareStatusCode|GuzzleException $exception) {
            Log::info($exception->getMessage());
        }
    }
}
