<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    use HasFactory;
    
    protected $fillable =[
       'c_id',
       'c_name',
       'c_uen',
       'c_address',
       'c_date',
       'c_email',
       'c_password',
       'finance_id'
    ];

    public function shareholders()
    {
        return $this->hasMany(Shareholder::class,'c_id');
    }

    public function financial()
    {
        return $this->hasMany(Financial::class,'c_id');
    }
}
