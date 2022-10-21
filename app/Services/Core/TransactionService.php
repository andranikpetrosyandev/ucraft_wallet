<?php

namespace App\Services\Core;

use App\Services\Core\Transaction\CreateTransactionParams;

interface TransactionService
{
    function getList(int $userId);

    function getById(int $id);

    function getByWalletId(int $walletId);

    function getByUserId(int $userId);


    function create(CreateTransactionParams $params);
}
