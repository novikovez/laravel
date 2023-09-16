<?php

namespace App\Console\Commands;

use App\Http\Services\Rabbit\Publish\SendCreateWordService;
use Illuminate\Console\Command;

class WordRabbitPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:word_rabbit-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SendCreateWordService $sendCreateWordService): void
    {
        $sendCreateWordService->handle();

    }
}
