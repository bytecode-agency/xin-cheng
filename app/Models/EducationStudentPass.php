<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationStudentPass extends Model
{
    use HasFactory;
    protected $fillable = [          
        'education_id', 
        'need_of_student_pass',
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
