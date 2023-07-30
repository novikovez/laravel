<?php

namespace App\Http\Repositories\User\WhiteListIp;

use Illuminate\Support\Facades\DB;

class WhiteListIpRepository
{
    public function checkUserIp(int $userId, string $ip): bool
    {
        return DB::table('white_list_ip')
            ->where('user_id', '=', $userId)
            ->where('ip', '=', $ip)
            ->exists();
    }
}
