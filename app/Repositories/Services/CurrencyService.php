<?php


namespace App\Repositories\Services;


use App\Models\Currency;
use App\Repositories\CurrencyInterface;

class CurrencyService implements CurrencyInterface
{

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return Currency::get();
    }

    public function getAllOrderByCentValue()
    {
        return Currency::query()->orderBy('cent_value', 'desc')->get();
    }


}
