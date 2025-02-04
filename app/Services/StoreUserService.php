<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Hash;

final class StoreUserService
{
    /**
     * @throws BindingResolutionException
     */
    public function __invoke(array $params): User
    {
        $user = app(User::class)
            ->create([
                'name' => $params['name'],
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
            ]);
        $user->createToken('api_token')->plainTextToken;

        return $user;
    }
}
