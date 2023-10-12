<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankReference extends Model
{
    use HasFactory;
    protected $table = "bank_references";
    protected $fillable = [
        'client_id',
        'bank',
        'account',
        'agency',
        'opening_date',
        'have_check',
    ];
}
