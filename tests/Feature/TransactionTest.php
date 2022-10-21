<?php

namespace Tests\Feature;

use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use App\Rules\NegativeWalletBalance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_transaction_with_credit_type()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $wallet = Wallet::factory()->create([
            'name' => 'wallet 1',
            'user_id' => $user->id,
            'type' => 'type',
            'amount' => 0
        ]);
        $response = $this->actingAs($user)->post(route('transaction.create'), [
            'amount' => 12.4,
            'wallet_id' => $wallet->id,
            'type' => TransactionType::Credit->value
        ]);
        $response->assertRedirect('wallet/' . $wallet->id);
    }
    public function test_create_transaction_with_debit_type()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $wallet = Wallet::factory()->create([
            'name' => 'wallet 1',
            'user_id' => $user->id,
            'type' => 'type',
            'amount' => 15
        ]);
        $response = $this->actingAs($user)->post(route('transaction.create'), [
            'amount' => 12.4,
            'wallet_id' => $wallet->id,
            'type' => TransactionType::Debit->value
        ]);
        $response->assertRedirect('wallet/' . $wallet->id);
    }
    public function test_create_transaction_with_debit_type_when_amount_mode_then_balance()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $wallet = Wallet::factory()->create([
            'name' => 'wallet 1',
            'user_id' => $user->id,
            'type' => 'type',
            'amount' => 8
        ]);
        $response = $this->actingAs($user)->post(route('transaction.create'), [
            'amount' => 12.4,
            'wallet_id' => $wallet->id,
            'type' => TransactionType::Debit->value
        ]);
        $response->assertSessionHasErrors('wallet_id');
    }
}
