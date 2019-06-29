<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnackMachineTest extends TestCase
{

    public function refreshDataBase()
    {
        Artisan::call('migrate:fresh --seed');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_rendering_vending_machine()
    {
        $response = $this->get('/vending-machine');

        $response->assertStatus(200);
    }

    public function test_successful_buy_with_cash()
    {
        $this->refreshDataBase();
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A2',
            'with_card' => false,
            'usd_input' => 20,
            'coins_input' => 0,
            'money' => [
                5 => 1
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_buy_with_card()
    {
        $this->refreshDataBase();
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A2',
            'with_card' => true,
            'usd_input' => 0,
            'coins_input' => 0
        ]);

        $response->assertStatus(200);

    }
////
    public function test_failed_buy_not_enough_quantity()
    {
        $this->refreshDataBase();
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A1',
            'with_card' => false,
            'usd_input' => 50,
            'coins_input' => 0,
            'money' => [
                6 => 1,
            ]
        ]);

        $response->assertStatus(400);
    }

    public function test_failed_buy_not_enough_money()
    {
        $this->refreshDataBase();
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A2',
            'with_card' => false,
            'usd_input' => 1,
            'coins_input' => 0,
            'money' => [
                4 => 1,
            ]
        ]);

        $response->assertStatus(400);
    }
    public function test_failed_buy_not_enough_change()
    {
        $this->refreshDataBase();
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A1',
            'with_card' => false,
            'usd_input' => 1000,
            'coins_input' => 0,
            'money' => [
                6 => 20,
            ]
        ]);

        $response->assertStatus(400);
    }



}
