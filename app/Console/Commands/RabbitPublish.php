<?php

namespace App\Console\Commands;

use App\Http\Services\Rabbit\Publish\SendCreateBookService;
use Illuminate\Console\Command;

class RabbitPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SendCreateBookService $sendCreateBookService)
    {

        $sendCreateBookService->handle();
    }
}
