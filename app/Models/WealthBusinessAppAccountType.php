<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthBusinessAppAccountType extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_app_id',
        'account_type',
        'policy_number',
        'other'
    ];
}
