<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

final class LogoutUserController extends Controller
{
    public function __invoke(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = app(User::class)->find($validated['email']);

        if ($user && Hash::check($validated['password'], $user->password)) {
            $user->tokens()->delete();

            auth()->guard('web')->logout();
        }

        return redirect()->route('home');
    }
}
