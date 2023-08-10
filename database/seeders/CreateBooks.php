<?php

namespace Database\Seeders;
ini_set('memory_limit', '256M');

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
        $categories = DB::table('categories')->pluck('id')->toArray();
        $categoryCount = count($categories);
        $categoryIndex = 0;
        $arrays = array_chunk(range(1, 200000), 1000);
        foreach ($arrays as $items) {
            $books = [];
            foreach ($items as $item) {
                $books[] = [
                    'name' => $faker->slug(1),
                    'year' => $faker->year,
                    'lang' => $faker->randomElement(LangEnum::getValues()),
                    'pages' => rand(1,1000),
                    'created_at' => now(),
                    'category_id' => $categories[$categoryIndex],
                ];
                $categoryIndex = ($categoryIndex + 1) % $categoryCount;

            }
            DB::table('books')->insert($books);
            unset($books);
        }
        DB::enableQueryLog();
        DB::connection()->setEventDispatcher($dispatcher);
    }

}
