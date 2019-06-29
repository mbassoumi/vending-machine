<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $table = 'money';
    public $timestamps = false;


    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
