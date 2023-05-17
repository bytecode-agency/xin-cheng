<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    protected $fillable =[
       'f_id',
       'i_name',
       'ba_app_sub',
       'ac_open_sta',
       'ac_type',
       'ac_number',
       'bank_ac_sta',
       'remarks',
       'c_id',
    ];
}
