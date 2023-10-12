<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    protected $table = "client";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_a',
        'phone_b',
        'date_of_birth',
        'CPF',
        'RG',
        'issuing_organization',
        'shipping_date',
        'marital_status',
        'sex',
        'mother',
        'father'
    ];

    // public function createClient($aaa)
    // {
    //     $resp = DB::table('client');
    //     $resp->insert();

    //     return $resp->get();
    // }

    // public function address()
    // {
    //     return $this->hasOne(Address::class, 'client_id');
    // }

    // public function loanrequest()
    // {
    //     return $this->belongsToOne(Client::class, 'id');
    // }
    
}
