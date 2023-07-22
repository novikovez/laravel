<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $user = [
            'name' => 'Igor',
            'email' => 'mail@mail.com',
            'password' => Hash::make(123456789)
        ];

        DB::table('users')->insert($user);
    }
}
