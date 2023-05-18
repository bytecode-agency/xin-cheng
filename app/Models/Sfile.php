<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class Sfile extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'file',
        'sale_app_id',
        'uploaded_by_id',
        'uploaded_by',

    ];
}
