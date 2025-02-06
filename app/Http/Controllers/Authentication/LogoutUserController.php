<?php

namespace App\Http\Controllers\Authentication;

use App\Helpers\CleaUserCache;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

final class LogoutUserController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        app(CleaUserCache::class)(auth()->user()->id);
        auth()->logout();

        return redirect()->route('user.login');
    }
}
