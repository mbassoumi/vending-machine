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
        $faker = Faker\Factory::create('en_US');

        foreach ($codes as $code){
            $snacks[] = [
                'name' => $faker->realText(10),
                'column' => $code['column'],
                'row' => $code['row'],
                'quantity' => rand(0, 10),
                'price' => rand(1,70)
            ];
        }

        \Illuminate\Support\Facades\DB::table('snacks')->insert($snacks);
    }
}
