<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Services\StoreUserService;
use Exception;
use Illuminate\Http\RedirectResponse;

final class StoreUserController extends Controller
{

    public function __invoke(
        StoreUserRequest $request,
        StoreUserService $storeUserService
    ): RedirectResponse {
        try {
            $user = $storeUserService($request->validated());
            logger()->info("User with id: {$user->id} created!");

            return redirect()->route('user.login')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            logger()->error('An error occurred while creating the user: ' . $e->getMessage());

            return redirect()
                ->route('user.create')
                ->withErrors('An error occurred while creating the user!');
        }

    }
}
