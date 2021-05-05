<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user) {

        if($user->getRoleNames() == 'Admin') {
            return true;
        };
        return false;

    }

    public function show(User $user) {

        if($user->getRoleNames() == 'Admin' | 'Developer' | 'Manager') {
            return true;
        };
        return false;

    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
