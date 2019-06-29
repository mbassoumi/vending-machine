<?php


namespace App\Repositories\Services;


use App\Models\Snack;
use App\Repositories\VendingMachineInterface;

class VendingMachineService implements VendingMachineInterface
{
    public function checkEnoughMoney(Snack $snack, array $attributes)
    {
        // TODO: Implement checkEnoughMoney() method.
        if ($attributes['with_card'] == "true"){
            return $this->checkIfCardIsValidAndHasMoney();
        }
        $snackPrice = $snack->price;
        $usd = $attributes['usd_input'];
        $cents = $attributes['coins_input'];
        $newUsd = $usd;
        $newCents = $cents;
        if ($cents >= 100){
            $remainingCents= $cents % 100;
            $mappedCents = intval($cents / 100);
            $newUsd = $usd + $mappedCents;
            $newCents = $remainingCents;
        }
        $inputMoneyResult = $newUsd . ".".$newCents;

        if (doubleval($inputMoneyResult) > $snackPrice){
            return (doubleval($inputMoneyResult) - $snackPrice);
        }else if (doubleval($inputMoneyResult) == $snackPrice){
            return true;
        }
        return false;

    }
    private function checkIfCardIsValidAndHasMoney(){
        return "take your card";
    }

}
