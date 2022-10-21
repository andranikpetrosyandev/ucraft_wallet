<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Log;

class TransactionRepository
{
    public function create(int $walletId, $type, float $amount)
    {
        $transaction = Transaction::create([
            'wallet_id' => $walletId,
            'type' => $type,
            'amount' => $amount
        ]);
        Log::info('Created Transaction with ', ['wallet_id' => $transaction->wallet_id, 'type' => $transaction->type, 'amount' => $transaction->amount]);
        return $transaction;
    }

//    public function getByUserId(int $userId)
//    {
//        return Wallet::where(['user_id' => $userId])->get();
//
//    }

    public function getById(int $id)
    {
        return Wallet::find($id);
    }

    public function getByWalletId(int $walletId)
    {
        return Transaction::where(['wallet_id' => $walletId])->orderBy("created_at", "DESC")->paginate(10);

    }

    function getByUserId(int $userId)
    {
        return Transaction::whereHas('wallet', function ($query) use ($userId) {
            $query->where(['user_id' => $userId]);
        })->paginate(10);
    }

}
