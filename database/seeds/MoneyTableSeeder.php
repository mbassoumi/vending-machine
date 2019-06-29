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

        $moneyData = [];
        for ($i = 1; $i<=6; $i++){
            $moneyData[] = [
                'currency_id' => $i,
                'amount' => 5,
            ];
        }
        DB::table('money')->insert($moneyData);
    }
}
