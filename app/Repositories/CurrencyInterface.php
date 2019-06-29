<?php


namespace App\Repositories;


interface CurrencyInterface
{
    public function getAll();
    public function getAllOrderByCentValue();


}
