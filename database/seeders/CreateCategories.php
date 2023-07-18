<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CreateCategories extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();


        for ($i = 0; $i < 200; $i++) {
            $categories[] = [
                'name' => $faker->unique()->slug(2),
                'created_at' => now(),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
