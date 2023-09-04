<?php

namespace App\Console\Commands;

use App\Http\Services\Supervisor\SupervisorDTO;
use App\Http\Services\Supervisor\SupervisorService;
use Illuminate\Console\Command;

class SupervisorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:supervisor-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SupervisorService $supervisorService)
    {
        $user_data['step'] = $this->choice('Дія з процессами',
            [
                'Створити', 'Оновити', 'Видалити', 'Список', 'Завершити', 'Запустити'
            ], 3);

        if($user_data['step'] === 'Список')
        {
            $process = $supervisorService->getAllProcesses();
            $this->warn('Назва | Группа | Статус');
            foreach ($process as $process) {
                $this->info($process['name'] . ' - ' . $process['group'] . ' - ' . $process['statename']);
            }
        }

        if($user_data['step'] === 'Завершити')
        {
            $process = $supervisorService->getAllProcesses();
            $this->warn('Группа | Статус');
            $data = [];
            foreach ($process as $process) {
                $data[] = $process['group'];
            }
            $user_data['step'] = $this->choice('Вибірє', $data);
            $process = $supervisorService->stopProcesses($user_data['step']);

        }

        if($user_data['step'] === 'Запустити')
        {
            $process = $supervisorService->getAllProcesses();
            $this->warn('Группа | Статус');
            $data = [];
            foreach ($process as $process) {
                $data[] = $process['group'];
            }
            $user_data['step'] = $this->choice('Вибірє', $data);
            $process = $supervisorService->startProcesses($user_data['step']);

        }
        if($user_data['step'] === 'Створити')
        {
            $user_data['name'] = $this->ask("Назва процессу?");
            $user_data['command'] = $this->ask("Комманда?");
            $user_data['number'] = $this->ask("Кількість процессів?");

            $supervisorService->addProcesses(new SupervisorDTO($user_data));
            exec('supervisorctl reread');
            exec('supervisorctl update');
            $this->info('Додано!');
        }


        if($user_data['step'] === 'Видалити')
        {
            $process = $supervisorService->getAllProcesses();
            $this->warn('Группа | Статус');
            $data = [];
            foreach ($process as $process) {
                $data[] = $process['group'];
            }
            $user_data['step'] = $this->choice('Вибірє', $data);
            $supervisorService->delete($user_data['step']);
            exec('supervisorctl reread');
            exec('supervisorctl update');
        }

        if($user_data['step'] === 'Оновити')
        {
            $process = $supervisorService->getAllProcesses();
            $this->warn('Группа | Статус');
            $data = [];
            foreach ($process as $process) {
                $data[] = $process['group'];
            }

            $user_data['name'] = $this->choice('Вибірє', $data);
            $user_data['command'] = $this->ask('Комманда?');
            $user_data['number'] = $this->ask('Процессів?');
            $supervisorService->updateProcesses(new SupervisorDTO($user_data));
            exec('supervisorctl reread');
            exec('supervisorctl update');
        }


    }
}
