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
        if ($this->ask("Скільки тобі років?") < 18) {
            if ($this->confirm("Ви бажаете продовжити?") === false) {
                $this->error("Бай бай!");
                return;
            }
        }

        $name = $this->choice(
            'Виберіть дію',
            ['Читання', 'Запис'],
            0
        );

        $this->info($name);



    }
}
