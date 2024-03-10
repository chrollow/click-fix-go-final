<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_id'; // Specify the primary key if it's different from 'id'
    protected $fillable = [
        'device_type',
        'img',
    ];
}
