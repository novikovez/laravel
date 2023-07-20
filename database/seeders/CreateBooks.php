<?php

namespace Database\Seeders;

use App\Enum\LangEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CreateBooks extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();
        $dispatcher = DB::connection()->getEventDispatcher();
        DB::connection()->unsetEventDispatcher();

        $faker = Faker::create();

        $arrays = array_chunk(range(1, 100000), 5000);
        foreach ($arrays as $items) {
            $books = [];
            foreach ($items as $item) {
                $books[] = [
                    'name' => $faker->slug(1),
                    'year' => $faker->year,
                    'lang' => $faker->randomElement(LangEnum::getValues()),
                    'pages' => rand(1,1000),
                    'created_at' => now(),
                    'category_id' => rand(1,200),
                ];
            }
            DB::table('books')->insert($books);
            unset($books);
        }
        DB::enableQueryLog();
        DB::connection()->setEventDispatcher($dispatcher);
    }

}
