<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationSchool extends Model
{
    use HasFactory;
    protected $fillable = [  
        'education_id',        
        'school_name', 
        'education_description',
        'applied_date',
        'school_status',        
    ];
    

   
}
