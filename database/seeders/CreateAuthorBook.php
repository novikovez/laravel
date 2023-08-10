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
        $authors = DB::table('authors')->pluck('id')->toArray();

        $books = DB::table('books')->pluck('id')->toArray();
        $booksCount = count($books);
        $booksIndex = 0;
        $arrays = array_chunk(range(1, 400000), 1000);
        foreach ($arrays as $items) {
            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'author_id' => $faker->randomElement($authors),
                    'book_id' => $books[$booksIndex],
                ];

                $booksIndex = ($booksIndex + 1) % $booksCount;

            }
            DB::table('author_book')->insert($data);
            unset($data);
        }
        DB::enableQueryLog();
        DB::connection()->setEventDispatcher($dispatcher);

    }
}
