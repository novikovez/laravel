<?php

namespace App\Console\Commands;

use App\Console\Commands\DTO\RedisTestDTO;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $dto = new RedisTestDTO(
            $this->ask("Як Вас звати?"),
            $this->ask("Скільки вам років?")
        );
        Redis::publish('test', json_encode($dto));
    }
}
