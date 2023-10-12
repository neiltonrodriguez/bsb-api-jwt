<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReference extends Model
{
    use HasFactory;
    protected $table = "personal_references";
    protected $fillable = [
        'client_id',
        'name',
        'phone',
        'kinship'
    ];
}
