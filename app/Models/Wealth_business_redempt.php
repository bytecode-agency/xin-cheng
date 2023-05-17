<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wealth_business_redempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'red_date',
        'red_amount',        
    ];
    
    public function business_data()
    {
        return $this->belongsTo(WealthBusinessApp::class,'business_id');
    }
}
