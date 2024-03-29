<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(MoneyTableSeeder::class);
         $this->call(SnacksTableSeeder::class);
         $this->call(CurrencyTableSeeder::class);
    }
}
