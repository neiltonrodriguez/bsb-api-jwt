<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "address";
    protected $fillable = [
        'name',
        'client_id',
        'neighborhood',
        'complement',
        'number',
        'city',
        'UF',
        'zip_code',
        'type_of_residence',
        'resides_since',
    ];

    // public function client()
    // {
    //     return $this->belongsTo(Client::class, 'id');
    // }

    
}
