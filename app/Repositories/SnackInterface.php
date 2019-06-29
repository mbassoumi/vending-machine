<?php


namespace App\Repositories;


interface SnackInterface
{
    public function getSnackDetailsByColumnRow(int $column, string $row);
    public function getAllSnacks();
    public function checkSnackQuantity($snack);
    public function updateSnackQuantity($snack, $quantity);
}
