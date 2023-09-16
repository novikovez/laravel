<?php

namespace App\Console\Commands;

use App\Http\Services\Rabbit\Subscribe\CreateBookConsumer;
use Illuminate\Console\Command;

class RabbitSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:book-create-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CreateBookConsumer $createBookConsumer)
    {
        $createBookConsumer->handle();
    }
}
