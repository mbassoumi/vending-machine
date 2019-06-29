<?php


namespace App\Repositories;


interface SnackInterface
{
    public function getSnackDetailsByColumnRow(int $column, string $row);
    public function getAllSnacks();
}
