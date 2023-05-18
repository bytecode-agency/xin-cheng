<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationParent extends Model
{
    use HasFactory;
    protected $fillable = [  
        'education_id',
        'pass_name_eng',        
        'pass_name_chinese', 
        'relationship_with_client',
        'gender',
        'dob',   
        'pass_no', 
        'pass_reminder',     
        'pass_expiry_date',     
        'pass_trigger_frq',     
        'pass_country',     
        'job_occupation',     
        'annual_income',     
        'email',    
        'phone',     
        'address', 
        'remarks', 
    ];
}
