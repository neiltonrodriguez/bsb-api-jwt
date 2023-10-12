<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;
    protected $table = "loan_request";
    protected $fillable = [
        'client_id',
        'loan_type',
        'vehicle_id',
        'value',
        'installments',
        'description'
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
