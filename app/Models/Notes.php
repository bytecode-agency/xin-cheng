<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = [
        'module_name',
        'application_id',
        'notes_description',
        'created_by',
        
    ];
}
