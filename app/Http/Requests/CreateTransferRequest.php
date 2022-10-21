<?php

namespace App\Http\Requests;

use App\Rules\NegativeWalletBalance;
use Illuminate\Foundation\Http\FormRequest;
use Theatrisoft\Rules\ScheduleTimesValidation;

class CreateTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from_wallet_id' => ['required', new NegativeWalletBalance()],
            'to_wallet_id' => 'required',
            'amount' => 'required'
        ];
    }


}
