<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $primaryKey = 'stock_id';
    protected $fillable = [
        'qty',
        'price',
        'stock_name',
    ];
}