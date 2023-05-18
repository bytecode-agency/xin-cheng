<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthPersonal extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'wealth_id',
        'pass_name_eng',
        'pass_name_chinese',
        'gender',
        'dob',
        'passport_no',
        'passport_exp_date',
        'passport_renew',
        'passport_country',
        'passport_trg_fqy',
        'tin_no',
        'tin_country',
        'tin_before_application',
        'type_of_tin',
        'email',
        'tin_country_before_app',
        'residential_address',
        'type_pin_before_app',
        'employer_industry',
        'phone',
        'job_title',
        'employer_name',
        ];
}
