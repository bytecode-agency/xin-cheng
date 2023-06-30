<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthPass extends Model
{
    use HasFactory;
    protected $fillable = [
        'wealth_id',
        'passholder_shareholder',
        'pass_holder_name',
        'passposrt_name_chinese',
        'dob',
        'gender',
        'passport_expiry_date',
        'passport_no',
        'passport_renewal_reminder',
        'passport_country',
        'passport_tri_frq',
        'tin_country_before_app',
        'type_of_tin_before_app',
        'tin_no_before_pass_app',
        'phone_no',
        'email',
        'business_type',
        'business_type_specify',//
        'residential_add',
        'pass_app_status',
        'relation_with_pass',
        'relation_with_pass_specify',//
        'pass_app_type',
        'pass_app_type_specify',//
        'pass_inssuance',
        'first_pass_issuance_date',
        'pass_issuance_date',
        'pass_expiry_date',
        'pass_renewal_reminder',
        'duration',
        'fin_number',
        'pass_renewal_frq',
        'pass_jon_title',
        'singpass_set_up',
        'employee_name',
        'monthly_sal',
        'monthly_sal_wef',
        'pass_remarks',   


        

    ];
}
