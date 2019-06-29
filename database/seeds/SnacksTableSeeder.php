<?php

use Illuminate\Database\Seeder;

class SnacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $char = ['A', 'B', 'C', 'D', 'E'];
        $codes = [];
        foreach ($char as $value) {
            for ($i = 1; $i <= 5; $i++) {
                $codes[] = [
                    'column' => $i,
                    'row' => $value
                ];
            }
        }

        $snacks = [];

        $price = 10;
        $quantity = 0;
        foreach ($codes as $key => $code){
            $snacks[] = [
                'name' => "snack ". ($key+1),
                'column' => $code['column'],
                'row' => $code['row'],
                'quantity' => $quantity++,
                'price' => $price++,
            ];
        }

        \Illuminate\Support\Facades\DB::table('snacks')->insert($snacks);
    }
}
