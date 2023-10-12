<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBond extends Model
{
    use HasFactory;
    protected $table = "job_bond";
    protected $fillable = [
        'name',
        'slug',
        'job_type_id'
    ];

    public $timestamps = false;
}
