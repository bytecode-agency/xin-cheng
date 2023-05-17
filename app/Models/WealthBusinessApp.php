<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthBusinessApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'wealth_id',
        'financial_institition_name',
        'application_submision',
        'business_account_status',
        'business_account_type',
        'business_account_policy_no',
        'product_name',
        'payment_mode',
        'currency',
        'investment_amount',
        'online_account_user',
        'online_acc_pass',
        'subscription',
        'maturity_date',
        'business_duration',
        'maturity_reminder',
        'maturity_reminder_trg',
        'commision_status',
        'commission_currency',
        'commission_amount',
        'business_redemption_date',
        'business_redemption_amount',
        'net_amount_val',
        'business_remarks',        

    ];

    public function business_redempt()
    {
        return $this->hasMany(Wealth_business_redempt::class,'business_id')->orderBy('id','desc');
    }
    
}
