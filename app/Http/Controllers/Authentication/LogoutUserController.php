<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

final class LogoutUserController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('user.login');
    }
}
