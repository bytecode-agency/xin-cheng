<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthFollowup extends Model
{
    use HasFactory;
    protected $fillable = [          
        'action', 
        'assigned_to',
        'deadline',
        'type_of_item',
    ];

}
