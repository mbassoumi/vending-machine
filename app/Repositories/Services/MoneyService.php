<?php


namespace App\Repositories\Services;


use App\Models\Money;
use App\Repositories\CurrencyInterface;
use App\Repositories\MoneyInterface;

class MoneyService implements MoneyInterface
{
    public function getAll()
    {
        // TODO: Implement getAllMoney() method.
        return Money::get();
    }

    public function update(int $id, int $amount)
    {
        // TODO: Implement update() method.
        $money = Money::find($id);
        $money->amount = $amount;
        $money->save();
    }

    public function checkEnoughChange($change, CurrencyInterface $currencyService)
    {
        // TODO: Implement checkEnoughChange() method.
        $centAmount = $change * 100;
        $centAmount = intval($centAmount);
        $centAmount = ceil($centAmount);
        $centAmount = intval($centAmount);
        $allCurrencies = $currencyService->getAllOrderByCentValue();
        $allMoney = $this->getAll();
        $returnedMoney = [];
        foreach ($allCurrencies as $currency){
            $dummyValue = intval($centAmount / $currency->cent_value);
            if ($dummyValue){
                $moneyAmount = $currency->money->amount;
                if ($moneyAmount > $dummyValue){
                    $returnedMoney[$currency->id] = $dummyValue ;
                    $centAmount -= $dummyValue * $currency->cent_value;
                }else{
                    $returnedMoney[$currency->id] = $moneyAmount;
                    $centAmount -= $moneyAmount * $currency->cent_value;
                }
            }
        }
        if ($centAmount){
            return false;
        }

        $message = "";
        foreach ($returnedMoney as $currencyId => $moneyAmount){
            if ($moneyAmount) {
                $money = $allMoney->where('currency_id', $currencyId)->first();
                $money->amount -= $moneyAmount;
                $money->save();
                $message .= "{$moneyAmount} of {$money->currency->value}{$money->currency->symbol} | ";
            }
        }
        $message = trim($message ,'| ');
        return $message;
    }

    public function updateArray(array $money)
    {

        $allMoney = $this->getAll();
        foreach ($money as $key => $value){
            $tempMoney = $allMoney->where('currency_id', $key)->first();
            if ($tempMoney and !is_null($value)){
                $newAmount = $tempMoney->amount + $value;
                $this->update($tempMoney->id, $newAmount);
            }

        }
    }

}
