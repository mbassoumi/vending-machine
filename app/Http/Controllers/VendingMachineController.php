<?php

namespace App\Http\Controllers;

use App\Repositories\MoneyInterface;
use App\Repositories\SnackInterface;
use App\Repositories\VendingMachineInterface;
use Illuminate\Http\Request;

class VendingMachineController extends Controller
{

    protected $snackService;
    protected $moneyService;
    protected $vendingMachineService;

    public function __construct(SnackInterface $snackService, MoneyInterface $moneyService, VendingMachineInterface $vendingMachineService){
        $this->snackService = $snackService;
        $this->moneyService = $moneyService;
        $this->vendingMachineService = $vendingMachineService;
    }

    public function vendingMachine()
    {
        $snacksData = $this->snackService->getAllSnacks();

        $snacks = [];
        foreach ($snacksData as $snack){
            $snacks[$snack->row][] = $snack;
        }

        $money = $this->moneyService->getAllMoney();

        $monies = [];
        foreach ($money as $value){
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
}
