<?php


namespace App\Repositories\Services;


use App\Models\Snack;
use App\Repositories\SnackInterface;

class SnackService implements SnackInterface
{

    public function getSnackDetailsByColumnRow(int $column, string $row)
    {
        // TODO: Implement getSnackDetails() method.
        return Snack::query()->where('column', $column)->where('row', $row)->first();
    }

    public function getSnackDetailsById(int $id)
    {
        // TODO: Implement getSnackDetails() method.
        return Snack::find($id);
    }


    public function getAllSnacks()
    {
        // TODO: Implement getAllSnacks() method.
        return Snack::get();
    }
}
