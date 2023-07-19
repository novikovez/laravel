<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Enum\LangEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CreateBooks extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();

        $arrays = array_chunk(range(1, 100000), 500);
        foreach ($arrays as $items) {
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
            echo $sizeInBytes = memory_get_usage(true) / 1048576;
            echo PHP_EOL;
            echo count($books);
            echo PHP_EOL;
            unset($books);
        }
    }
}

$da = new CreateBooks();
$dasas = $da->run();




