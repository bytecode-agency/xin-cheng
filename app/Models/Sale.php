<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Sale extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'bus_type',
        'client_type',
        'client_name',
        'client_country',
        'client_city',
        'poc_ph',
        'poc_name',
        'poc_email',
        'poc_wechat',
        'source_of_client',
        'source_of_client_specify',
        'b2b_sign',
        'b2b_agr_sign_date',
        'b2b_agr_exp_date',
        'agr_ren_rem',
        'agr_ren_fre',
        'type_pot_bus',
        'type_bus_gen',
        'created_by',
    

    ];

}
