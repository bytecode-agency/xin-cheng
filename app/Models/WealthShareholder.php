<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthShareholder extends Model
{
    use HasFactory;
    protected $fillable = [  
        'company_id',
        'equity_percentage',
        'shareholder_type',
        'shareholder_company_name',
        'pass_name_eng',
        'pass_name_chinese',
        'passport_renew',
        'gender',
        'dob',
        'passport_trg_fqy',
        'passport_no',
        'passport_exp_date',        
        'passport_country',
        'email',
        'phone',
        'residential_address',
        'tin_no',
        'tin_country',        
        'type_of_tin',
        'job_title',
        'monthly_sal',
        'company',
        'monthly_salary_wef',
        'relation_with_shareholder',
        'rel_share_specify'
        ];
}
