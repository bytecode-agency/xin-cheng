<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Note extends Model
{
    use HasFactory,Notifiable, HasRoles;
    protected $fillable = [
        'note',
        'app_id',
        'created_by_id',
        'created_by',
        'client_country',
        'client_city',
        'page',
    ];
}
