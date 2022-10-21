<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function view (User $user, Wallet $wallet) {
        return $user->id == $wallet->user_id;
    }
    public function delete (User $user, Wallet $wallet) {
        return $user->id == $wallet->user_id;
    }
}
