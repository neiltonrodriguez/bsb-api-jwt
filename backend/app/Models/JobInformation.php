<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInformation extends Model
{
    use HasFactory;
    protected $table = "job_information";
    protected $fillable = [
        'client_id',
        'job_category_id',
        'job_bond_id',
        'job_type_id',
        'company',
        'admission_date',
        'address',
        'neighborhood',
        'city',
        'zip_code',
        'UF',
        'office',
        'phone',
        'gross_salary',
        'net_salary',
        'registration',
        'benefit_number',
        'ocupation'
    ];
}
