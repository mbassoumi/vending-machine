<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnackMachineTest extends TestCase
{
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


    public function test_get_snack_price_api()
    {
        $response = $this->get('/snacks/A4/price');
        $response->assertStatus(200)
            ->assertJson(['price' => 61]);
    }

    public function test_buy_snack_api_with_card()
    {
        $response = $this->json('POST', '/snacks/buy', [
            'code' => 'A2',
            'with_card' => true,
            'usd_input' => 0,
            'coins_input' => 0,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                [
                    'message' => 'have a sweet snack',
                    'charge' => "",
                    'snack_quantity_id' => 1,
                    'snack_quantity' => 2
                ]
            ]);

    }
}
