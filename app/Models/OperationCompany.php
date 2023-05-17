<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class OperationCompany extends Model
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'pass_id',
        'company_name',
        'uen',
        'company_add',
        'incorporation_date',
        'company_email',
        'company_pass',
        'user_id',
        'created_by',
    ];
    public function company_share()
    {
        return $this->hasMany(OperationShareholder::class,'cmp_id');
    }
    public function company_fi()
    {
        return $this->hasMany(OperationFinancial::class,'cmp_id');
    }
}
