<?php

namespace App\Http\Controllers;

use App\Repositories\CurrencyInterface;
use App\Repositories\MoneyInterface;
use App\Repositories\SnackInterface;
use App\Repositories\VendingMachineInterface;
use Illuminate\Http\Request;

class VendingMachineController extends Controller
{

    protected $snackService;
    protected $moneyService;
    protected $vendingMachineService;
    protected $currencyService;

    public function __construct(SnackInterface $snackService, MoneyInterface $moneyService, VendingMachineInterface $vendingMachineService, CurrencyInterface $currencyService)
    {
        $this->snackService = $snackService;
        $this->moneyService = $moneyService;
        $this->vendingMachineService = $vendingMachineService;
        $this->currencyService = $currencyService;
    }

    public function vendingMachine()
    {

        $snacksData = $this->snackService->getAllSnacks();

        $snacks = [];
        foreach ($snacksData as $snack) {
            $snacks[$snack->row][] = $snack;
        }

        $money = $this->currencyService->getAll();

        $monies = [];
        foreach ($money as $value) {
            $monies[$value->type][] = $value;
        }
        return view('vending-machine', compact(['monies', 'snacks']));

    }

    public function getSnackPrice(string $code)
    {
        $codeArray = str_split($code, 1);
        $row = current($codeArray);
        $column = next($codeArray);
        $snack = $this->snackService->getSnackDetailsByColumnRow($column, $row);
        return response()->json(['price' => $snack->price]);
    }

    public function buySnack(Request $request)
    {
        $attributes = $request->only([
            'code', 'with_card', 'usd_input', 'coins_input', 'money'
        ]);
        $code = $attributes['code'];
        $codeArray = str_split($code, 1);
        $row = current($codeArray);
        $column = next($codeArray);
        $snack = $this->snackService->getSnackDetailsByColumnRow($column, $row);
        $hasQuantity = $this->snackService->checkSnackQuantity($snack);
        if (!$hasQuantity) {
            return response()->json(['message' => 'not enough quantity'], 400);
        }
        $charge = $this->vendingMachineService->checkEnoughMoney($snack, $attributes);
        if (!$charge) {
            return response()->json(['message' => 'not enough money'], 400);
        }
        if ($attributes['with_card'] == "false") {
            $charge = $this->moneyService->checkEnoughChange($charge, $this->currencyService);
            if ($charge){
                $this->moneyService->updateArray($attributes['money']);
            }
        }

        if ($charge) {
            $this->snackService->updateSnackQuantity($snack, -1);
            $message = 'have a sweet snack';
        }else{
            $message = 'not enough change';
        }
        $snack = $snack->fresh();
        return response()->json(['message' => $message, 'charge' => $charge, 'snack_quantity_id' => $snack->id, 'snack_quantity' => $snack->quantity], 200);
    }
}
