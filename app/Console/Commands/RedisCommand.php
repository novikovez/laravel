<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Predis\Command\Redis\EXPIRE;

class RedisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->ask("Яка назва ключа?");
        $keyValue = $this->ask("Значення ключа?");
        $time = $this->ask("Час життя кешу?");

        Redis::set($key, $keyValue, 'EX', $time);

        $action = $this->choice('Виберіть дію', [
            'Вивід значення',
            'Видалити ключ',
            'Increment',
            'Decrement',
        ], 0);

        if($action == 'Вивід значення')
        {
            $this->info('Значення: '.$key. '=' .Redis::get($key));
            return;
        }

        if($action == 'Видалити ключ')
        {
            Redis::del($key);
            $this->info('Значення: '.$key. '=' .Redis::get($key));
            return;
        }

        if($action == 'Increment' AND intval($keyValue))
        {
            $actionSub1 = $this->choice('Виберіть дію', [
                'Increment на 1',
                'Increment на ваше число',
            ], 0);

            if($actionSub1 == 'Increment на 1')
            {
                Redis::incr($key);
                $this->info('Значення: '.$key. '=' .Redis::get($key));
                return;
            }

            if($actionSub1 == 'Increment на ваше число')
            {
                $value = $this->ask("Число?");
                if(intval($value))
                {
                    Redis::incrby($key, $value);
                    $this->info('Значення: '.$key. '=' .Redis::get($key));
                }


            }
        }

        if($action == 'Decrement' AND intval($keyValue))
        {
            $actionSub1 = $this->choice('Виберіть дію', [
                'Decrement на 1',
                'Decrement на ваше число',
            ], 0);

            if($actionSub1 == 'Decrement на 1')
            {
                Redis::decr($key);
                $this->info('Значення: '.$key. '=' .Redis::get($key));
                return;
            }

            if($actionSub1 == 'Decrement на ваше число')
            {
                $value = $this->ask("Число?");
                if(intval($value))
                {
                    Redis::decrby($key, $value);
                    $this->info('Значення: '.$key. '=' .Redis::get($key));
                }


            }
        }
//        Redis::incr('lastName', 2); // Увеличение на 5
//        echo $lastName = Redis::get('lastName'); /// отримати Імя
    }
}
