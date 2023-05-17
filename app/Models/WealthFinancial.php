<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthFinancial extends Model
{
    use HasFactory;
    protected $fillable = [
        'wealth_id',
        'stakeholder_type',
        'financial_institution_name',
        'poc_name',
        'poc_contact_no',
        'poc_email',
        'application_submission',
        'account_type',
        'account_policy_no',
        'account_opening_status',
        'current_account_status',
        'money_deposit_status',
        'intial_deposit_amount',
        'online_account_username',
        'online_account_pass',
        'finacial_remarks',
        

    ];
}
