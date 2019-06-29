<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'type' => 'coin',
                'value' => 10,
                'symbol' => 'c',
                'cent_value' => 10
            ],
            [
                'type' => 'coin',
                'value' => 20,
                'symbol' => 'c',
                'cent_value' => 20
            ],
            [
                'type' => 'coin',
                'value' => 50,
                'symbol' => 'c',
                'cent_value' => 50
            ],
            [
                'type' => 'coin',
                'value' => 1,
                'symbol' => '$',
                'cent_value' => 100
            ],
            [
                'type' => 'note',
                'value' => 20,
                'symbol' => '$',
                'cent_value' => 2000
            ],
            [
                'type' => 'note',
                'value' => 50,
                'symbol' => '$',
                'cent_value' => 5000,
            ],


        ]);
    }
}
