<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
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


    public function view (User $user, Transaction $transaction) {
        return $user->id == $transaction->wallet()->user_id;
    }
    public function delete (User $user, Transaction $transaction) {
        return $user->id == $transaction->wallet()->user_id;
    }
}
