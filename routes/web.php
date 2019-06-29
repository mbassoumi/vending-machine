<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/vending-machine', 'VendingMachineController@vendingMachine');
//Route::get('/vending-machine/{code}', 'VendingMachineController@getSnackPrice');

Route::get('/snacks/{code}/price', 'VendingMachineController@getSnackPrice');
Route::post('/snacks/buy', 'VendingMachineController@buySnack');



Route::get('/', function () {
    $monies = [
        'coin' => [
            1 => '$',
            10 => 'c',
            20 => 'c',
            50 => 'c',
        ],
        'note' => [
            20 => '$',
            50 => '$'
        ],
        'card' => [

        ]
    ];


    $snacksData = \App\Models\Snack::get();

    $snacks = [];
    foreach ($snacksData as $snack){
        $snacks[$snack->row][] = $snack;
    }

    return view('vending-machine', compact(['monies', 'snacks']));
});




/*

vending machine display

$data = [];
    $rows = ['A', 'B', 'C', 'D', 'E'];
    $columns = [1, 2, 3, 4, 5];
    foreach ($rows as $key => $row) {
        $rowData = [];
        foreach ($columns as $column) {
            $rowData[] = $row . ' ' . $column;
        }
        $data[$key] = $rowData;
    }
 */
