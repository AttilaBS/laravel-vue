<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CleaUserCache
{
    public function __invoke(User $user): void
    {
        Cache::tags(['user:' . $user->id])->flush();
    }
}
