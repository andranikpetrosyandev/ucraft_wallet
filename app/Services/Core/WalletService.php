<?php

namespace App\Services\Core;

use App\Models\Wallet;
use App\Services\Core\Wallet\CreateWalletParams;

interface WalletService
{
    function getById(int $id);

    function create(CreateWalletParams $params): Wallet;

    function listByUserId(int $id);

    function getTotalAmountForUser(int $userId): float;

    function increaseTotalAmount(int $walletId, float $amount);

    function decreaseTotalAmount(int $walletId, float $amount);

    function destroy(int $walletId);

}
