<?php

namespace App\Console\Commands;

use App\Console\Commands\DTO\RedisTestDTO;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

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
        Redis::subscribe(['test'], function (string $message) {
            $data = json_decode($message);
            $dto = new RedisTestDTO(
                $data[0]->name,
                $data[0]->year
            );
           $this->info('Імя: '. $dto->getName());
           $this->info('Вік: '. $dto->getYear());
        });
    }
}
