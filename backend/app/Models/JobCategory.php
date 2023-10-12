<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $table = "job_category";
    protected $fillable = [
        'name',
        'slug',
    ];

    public $timestamps = false;
}
