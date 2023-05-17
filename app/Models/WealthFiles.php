<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'file_name',
        'wealth_id',
        'uploaded_by_id',
        'uploaded_by_name',

    ];
}
