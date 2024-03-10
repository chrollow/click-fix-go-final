<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;
    protected $primaryKey = 'technician_id'; // Specify the primary key if it's different from 'id'
    protected $fillable = [
        'technician_name',
        'user_id',
        'phone_number',
        'email',
    ];
}
