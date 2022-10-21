<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Warning;

class WalletRepository
{
    public function create(string $walletName, string $walletType, int $userId): Wallet
    {
        $wallet = Wallet::create([
            'name' => $walletName,
            'type' => $walletType,
            'user_id' => $userId
        ]);
        Log::info('Created Wallet with', ['name' => $wallet->name, 'type' => $wallet->type, 'user_id' => $userId]);
        return $wallet;
    }

    public function getByUserId(int $userId): Collection
    {
        return Wallet::where(['user_id' => $userId])->get();
    }

    public function getById(int $id)
    {
        return Wallet::find($id);
    }

    public function destroy(int $walletId): int
    {
        Log::info('Deleted Wallet ', ['wallet_id' => $walletId]);

        return Wallet::destroy($walletId);
    }

    public function increaseTotalAmount(int $walletId, float $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->amount = $wallet->amount + $amount;
        $wallet->save();
        Log::info('increase Wallet total Amount', ['wallet_id' => $walletId, 'amount' => $amount]);

        return $wallet;
    }

    public function decreaseTotalAmount(int $walletId, float $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->amount = $wallet->amount - $amount;
        $wallet->save();
        Log::info('Decrease Wallet total Amount', ['wallet_id' => $walletId, 'amount' => $amount]);

        return $wallet;
    }

    public function getTotalAmountForUser(int $userId): float
    {
        return Wallet::where(['user_id' => $userId])->sum('amount');
    }


}
