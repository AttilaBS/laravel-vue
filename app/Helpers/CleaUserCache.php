<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CleaUserCache
{
    public function __invoke(int $userId): void
    {
        Cache::tags(['user:' . $userId])->flush();
    }
}
