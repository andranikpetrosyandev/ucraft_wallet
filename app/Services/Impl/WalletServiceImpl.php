<?php

namespace App\Services\Impl;

use App\Models\Wallet;
use App\Repositories\WalletRepository;
use App\Services\Core\TransactionService;
use App\Services\Core\UserService;
use App\Services\Core\Wallet\CreateWalletParams;
use App\Services\Core\WalletService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Log\Logger;

class WalletServiceImpl implements WalletService
{
    private WalletRepository $walletRepository;
    private UserService $userService;

    public function __construct(WalletRepository $walletRepository, UserService $userService)
    {
        $this->walletRepository = $walletRepository;
        $this->userService = $userService;
    }

    public function listByUserId(int $userId)
    {
        return $this->walletRepository->getByUserId($userId);
    }

    public function getById(int $id)
    {
        return $this->walletRepository->getById($id);
    }

    public function delete(int $id)
    {

    }

    function create(CreateWalletParams $params): Wallet
    {

        return $this->walletRepository->create($params->getWalletName(), $params->getWalletType(), $params->getUserId());
    }

    function increaseTotalAmount(int $walletId, float $amount)
    {
        $wallet = $this->walletRepository->increaseTotalAmount($walletId, $amount);
        Redis::set('totalAmountForUserWallets', $this->walletRepository->getTotalAmountForUser($wallet->user_id));
        return $wallet;

    }

    function decreaseTotalAmount(int $walletId, float $amount)
    {
        $wallet = $this->walletRepository->decreaseTotalAmount($walletId, $amount);
        Redis::set('totalAmountForUserWallets', $this->walletRepository->getTotalAmountForUser($wallet->user_id));
        return $wallet;
    }

    function destroy(int $walletId)
    {
        $user = $this->userService->getUserById(Auth::user()->id);
        $this->walletRepository->destroy($walletId);
        Redis::set('totalAmountForUserWallets', $this->walletRepository->getTotalAmountForUser($user->id));
        return $walletId;
    }

    function getTotalAmountForUser(int $userId): float
    {
        $total = Redis::get('totalAmountForUserWallets' . $userId);
        if ($total) {
            return $total;
        }
        $total = $this->walletRepository->getTotalAmountForUser($userId);
        Redis::set('totalAmountForUserWallets' . $userId, $total);
        return $total;
    }
}
