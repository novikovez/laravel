<?php

namespace App\Console\Commands;

use App\Http\Services\Proxy\WebProxyService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class GetProxy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-proxy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle(WebProxyService $webProxy): void
    {
        $webProxy->getProxyList();
    }
}
