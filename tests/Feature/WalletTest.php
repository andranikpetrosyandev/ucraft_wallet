<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_wallet_unauthorized_user()
    {
        $response = $this->post(route('wallet.create'), [
            'wallet_name' => 'testWalletName',
            'wallet_type' => 'testWalletType'
        ]);
        $response->assertRedirect('login');
    }

    public function test_create_wallet()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->actingAs($user)->post(route('wallet.create'), [
            'wallet_name' => 'testWalletName',
            'wallet_type' => 'testWalletType'
        ]);
        $response->assertRedirect('/');
    }

    public function test_create_wallet_without_name()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->actingAs($user)->post(route('wallet.create'), [
            'wallet_type' => 'testWalletType'
        ]);
        $response->assertSessionHasErrors('wallet_name');
    }

    public function test_create_wallet_without_type()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->actingAs($user)->post(route('wallet.create'), [
            'wallet_name' => 'testWalletName',
        ]);
        $response->assertSessionHasErrors('wallet_type');
    }
}
