<?php

namespace App\Console\Commands;

use App\Http\Services\Proxy\CheckIpService;
use Illuminate\Console\Command;

class CheckMyIP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-my-ip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CheckIpService $checkIpService)
    {
        while (true) {
            $this->info($checkIpService->getMyIp());
            sleep(1);
        }

    }
}
