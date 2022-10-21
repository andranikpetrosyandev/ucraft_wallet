<?php

namespace App\Services\Impl;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Repositories\TransactionRepository;
use App\Services\Core\Transaction\CreateTransactionParams;
use App\Services\Core\TransactionService;
use App\Services\Core\WalletService;

class TransactionServiceImpl implements TransactionService
{
    private TransactionRepository $transactionRepository;
    private WalletService $walletService;

    public function __construct(TransactionRepository $transactionRepository, WalletService $walletService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->walletService = $walletService;
    }

    function getList(int $userId)
    {

    }

    function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    function getByWalletId(int $walletId)
    {
        return $this->transactionRepository->getByWalletId($walletId);

    }

    function create(CreateTransactionParams $params): Transaction
    {
        $transaction = $this->transactionRepository->create($params->getWalletId(), $params->getType(), $params->getAmount());
        if ($params->getType() == TransactionType::Credit->value) {
            $this->walletService->increaseTotalAmount($params->getWalletId(), $params->getAmount());
        } else if ($params->getType() == TransactionType::Debit->value) {
            $this->walletService->decreaseTotalAmount($params->getWalletId(), $params->getAmount());
        }
        return $transaction;
    }

    function getByUserId(int $userId)
    {
        return $this->transactionRepository->getByUserId($userId);
    }
}
