<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function edit(User $user): bool
    {

        return $user->is_admin === true;
    }

    public function destroy(User $user): bool
    {

        return $user->is_admin === true;
    }
}
