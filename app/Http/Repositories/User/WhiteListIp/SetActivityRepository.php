<?php

namespace App\Http\Repositories\User\WhiteListIp;

use Illuminate\Support\Facades\DB;

class SetActivityRepository
{
    public function setUserActivity(int $userId, string $ip): void
    {
        DB::table('last_activity_user')
            ->insert([
                'user_id' => $userId,
                'ip' => $ip,
                'created_at' => now(),
            ]);
    }
}
