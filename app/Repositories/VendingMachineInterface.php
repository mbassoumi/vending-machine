<?php


namespace App\Repositories;


use App\Models\Snack;

interface VendingMachineInterface
{
    public function checkEnoughMoney(Snack $snack, array $attributes);

}
