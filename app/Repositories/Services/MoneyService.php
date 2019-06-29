<?php


namespace App\Repositories\Services;


use App\Models\Money;
use App\Repositories\MoneyInterface;

class MoneyService implements MoneyInterface
{
    public function getAllMoney()
    {
        // TODO: Implement getAllMoney() method.
        return Money::get();
    }
}
