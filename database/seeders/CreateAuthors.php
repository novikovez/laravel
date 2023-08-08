<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CreateAuthors extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();


        for ($i = 0; $i < 5000; $i++) {
            $authors[] = [
                'author' => $faker->name,
                'created_at' => now(),
            ];
        }

        DB::table('authors')->insert($authors);
    }
}
