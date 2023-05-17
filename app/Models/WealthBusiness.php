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
        'servicing_fee',
        'servicing_fee_currency',
        'servicing_fee_status',
        'annual_servicing_fee',
        'annual_fee_currency',
        'annual_fee_status',
    ];
}
