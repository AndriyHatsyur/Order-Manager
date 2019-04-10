<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->roles->user_create;
    }

    public function update(User $user)
    {
        return $user->roles->user_update;
    }

    public function delete(User $user)
    {
        return $user->roles->user_delete;
    }
}
