<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class OperationShareholder extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'cmp_id',
        'pass_id',
        'eqt_per',
        'passhol_name',
        'passport_name',
        'shareholder_dob',
        'shareholder_gender',
        'passport_number',
        'passport_country',
        'pass_exp_dob',
        'passport_ren_rem',
        'passport_rem_fre',
        'tintype',
        'tinno',
         'tincnt',
         'phno',
         'res_add',
         'email',
         'job_title',
         'month_sal',
         'rel_share_hol',
          'remarks',
         'user_id',
         'created_by',
    

    ];
}
