<?php

namespace App\Services\Core\Wallet;

class CreateWalletParams
{
    private string $walletName;
    private string $walletType;
    private int $userId;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param string $walletName
     * @param string $walletType
     */
    public function __construct(string $walletName, string $walletType, $userId)
    {
        $this->walletName = $walletName;
        $this->walletType = $walletType;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getWalletName(): string
    {
        return $this->walletName;
    }

    /**
     * @return string
     */
    public function getWalletType(): string
    {
        return $this->walletType;
    }

}
