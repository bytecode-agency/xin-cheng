<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [          
        'education_level', 
        'client_name',
        'client_pass_name',
        'client_current_pass',
        'gender',
        'dob',
        'pass_no',
        'pass_country',
        'pass_exp_date',
        'pass_renewal_reminder',
        'pass_trigger_frq',
        'phone_no',
        'email',
        'address',
        'remarks',
    ];
    public function schools()
    {
        return $this->hasMany(EducationSchool::class,'education_id');
    }
}
