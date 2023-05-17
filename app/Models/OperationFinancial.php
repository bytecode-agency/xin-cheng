<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class OperationFinancial extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'cmp_id',
        'poc_name',
        'fi_name',
        'poc_email',
        'poc_cno',
        'acc_type',
        'app_sub',
        'acc_opn_sts',
        'acc_pol_no',
        'money_dep_sts',
        'acc_crt_sts',
        'on_acc_usr_nam',
        'on_acc_usr_pass',
        'mat_date',
        'in_dep_amt',
        'remarks',
         'user_id',
         'created_by',
    

    ];
}

