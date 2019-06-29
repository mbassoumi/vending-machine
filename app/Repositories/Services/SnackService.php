<?php


namespace App\Repositories\Services;


use App\Models\Snack;
use App\Repositories\SnackInterface;

class SnackService implements SnackInterface
{

    public function getSnackDetailsByColumnRow(int $column, string $row)
    {
        // TODO: Implement getSnackDetailsByColumnRow() method.
        return Snack::query()->where('column', $column)->where('row', $row)->first();
    }

    public function getSnackDetailsById(int $id)
    {
        // TODO: Implement getSnackDetailsById() method.
        return Snack::find($id);
    }


    public function getAllSnacks()
    {
        // TODO: Implement getAllSnacks() method.
        return Snack::get();
    }

    public function checkSnackQuantity($snack)
    {
        // TODO: Implement checkSnackQuantity() method.
        return ($snack->quantity > 0);
    }

    public function updateSnackQuantity($snack, $quantity)
    {
        // TODO: Implement updateSnackQuantity() method.
        $snack->quantity +=$quantity;
        $snack->save();

    }
}
