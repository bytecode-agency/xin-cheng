<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class OperationPr extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'pass_id',
        'application_date',
        'application_dep',
        'application_sts',
        'approval_date',
        'rep_expiry_date',
        'rep_ren_rem',
        'rep_ren_trg_fre',
        're_sub_trg_fre',
        'rejection_date',
        'remarks',
         'user_id',
         'created_by',
    

    ];
}

