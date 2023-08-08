<?php

namespace database\seeders;

use App\Enum\LangEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CreateAuthorBook extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::disableQueryLog();
        $dispatcher = DB::connection()->getEventDispatcher();
        DB::connection()->unsetEventDispatcher();

        $faker = Faker::create();

        $arrays = array_chunk(range(1, 200000), 1000);
        foreach ($arrays as $items) {
            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'author_id' => rand(1, 5000),
                    'book_id' => rand(1, 200000),
                ];
            }
            DB::table('author_book')->insert($data);
            unset($data);
        }
        DB::enableQueryLog();
        DB::connection()->setEventDispatcher($dispatcher);

    }
}
