<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthBusiness extends Model
{
    use HasFactory;
    protected $fillable = [         
        'wealth_id',
        'type_of_fo',
        'type_of_fo_specify',//
        'date_of_contract',//
        'servicing_fee',
        'servicing_fee_currency',
        'servicing_fee_status',
        'annual_servicing_fee',
        'annual_fee_currency',
        'annual_fee_status',
        'annual_fee_due_date',//
        'annual_fee_due_reminder',//
        'annual_fee_due_reminder_trigger',//
    ];
}
