<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthCompany extends Model
{
    use HasFactory;
    protected $fillable = [  
        'wealth_id',        
        'name',
        'uen',
        'address',
        'incorporate_date',
        'relationship',
        'company_email',
        'company_pass',
        ''
        ];

    public function shareholder()
    {
        return $this->hasMany(WealthShareholder::class,'company_id');
    }

}
