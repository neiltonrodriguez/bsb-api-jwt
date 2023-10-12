<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = "vehicle";
    protected $fillable = [
        'brand',
        'model',
        'year',
        'quantity_door',
        'fuel'
    ];

    public $timestamps = false;
}
