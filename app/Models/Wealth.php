<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wealth extends Model
{
    use HasFactory;
    protected $fillable = [          
        'business_type', 
        'client_type',
        'client_status',
    ];

    public function companies()
    {
        return $this->hasMany(WealthCompany::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
   
}
