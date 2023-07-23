<?php

namespace App\Http\Repositories\User;

use App\Http\Services\User\UserIterator;
use Illuminate\Support\Facades\DB;

class UsersRepository
{

    public function getById(int $id): UserIterator
    {
        return new UserIterator(
            DB::table('users')
                ->where('id', '=', $id)
                ->first()
        );
    }
}
