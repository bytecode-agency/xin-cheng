<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationParentsLT extends Model
{
    use HasFactory;
    protected $table = 'education_parents_lts';
    protected $fillable = [          
        'education_id', 
        'parents_ltvp_app',
        'pass_application_status',
        'pass_issuance',
        'pass_issuance_date',
        'pass_expiry_date',
        'pass_duration',
        'pass_renewal_reminder',
        'fin_number',
        'pass_renewal_frq',
        'remarks',
    ];
}
