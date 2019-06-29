<?php


namespace App\Repositories;


interface MoneyInterface
{
    public function getAll();

    public function update(int $id, int $amount);

    public function checkEnoughChange($change, CurrencyInterface $currencyService);

    public function updateArray(array $money);

}
