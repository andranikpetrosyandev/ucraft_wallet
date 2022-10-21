<?php

namespace App\Rules;

use App\Models\Wallet;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class NegativeWalletBalance implements Rule, DataAwareRule
{
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if(isset($this->data['wallet_id'])){
            $wallet = Wallet::find($this->data['wallet_id']);

            if ($wallet->amount < $this->data['amount'] && $this->data['type']=='debit'){
                return false;
            }
        }else{
            $wallet = Wallet::find($this->data['from_wallet_id']);
            if ($wallet->amount < $this->data['amount']){
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rejected: Insufficient funds.';
    }
}
