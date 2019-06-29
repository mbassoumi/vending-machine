<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class MoneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('money')->insert([
            [
                'type' => 'coin',
                'amount' => 10,
                'symbol' => 'c'
            ],
            [
                'type' => 'coin',
                'amount' => 20,
                'symbol' => 'c'
            ],
            [
                'type' => 'coin',
                'amount' => 50,
                'symbol' => 'c'
            ],
            [
                'type' => 'coin',
                'amount' => 1,
                'symbol' => '$'
            ],
            [
                'type' => 'note',
                'amount' => 20,
                'symbol' => '$'
            ],
            [
                'type' => 'note',
                'amount' => 50,
                'symbol' => '$'
            ],


        ]);
    }
}
