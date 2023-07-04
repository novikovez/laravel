<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FirstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-command {name?}';

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
        $user_data['name'] = $this->argument('name');

        if (empty($user_data['name'])) {
            $this->error('Вкажіть ваше імя при визові комманди!');
            return;
        }

        if ($this->ask("Скільки тобі років {$user_data['name']}?") < 18) {
            if ($this->confirm("Ви бажаете продовжити?") === false) {
                $this->error("Бай бай!");
                return;
            }
        }

        $action = $this->choice('Виберіть дію', ['Читання', 'Запис'], 0);

        if ($action == 'Запис') {
            $user_data['gender'] = $this->choice('Ваша стать?', ['Жінка', 'Чоловік'], 1);
            $user_data['city'] = $this->ask("Ваше місто?");
            $user_data['phone'] = $this->ask("Ваше номер телефону?");
            $write = file_put_contents('./file.txt', json_encode($user_data, JSON_UNESCAPED_UNICODE));
            if($write !== false) {
                $this->info("Файл успішно збережено!");
                return;
            }
            $this->info("Помилка запису файлу!");


        } elseif ($action == 'Читання') {
            if (file_exists('./file.txt')) {
                $this->info(file_get_contents('./file.txt'));
            } else {
                $this->error("Файлу не існує! ");
            }
        }


    }
}
