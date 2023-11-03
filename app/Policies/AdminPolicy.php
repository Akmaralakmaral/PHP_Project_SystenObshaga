<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }




    public function viewFaculties(User $user)
    {
        return $user->user_role === 'admin';
    }

}
