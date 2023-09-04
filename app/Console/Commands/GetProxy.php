<?php

namespace App\Console\Commands;

use App\Exceptions\WebshareStatusCode;
use App\Http\Services\Proxy\WebProxyService;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        try {
            $webProxy->getProxyList();
            Log::info('Список проксі оновлено');

        } catch (WebshareStatusCode|ConnectException $exception) {
            $this->info($exception->getMessage());
        }
    }
}
