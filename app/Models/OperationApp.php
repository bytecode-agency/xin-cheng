<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class OperationApp extends Model
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'module_name',
        'user_id',
        'created_by',
    ];
    public function op_app_company()
    {
        return $this->hasMany(OperationCompany::class,'op_app_id');
    }
    public function op_app_passholder()
    {
        return $this->hasMany(OperationPassholder::class,'op_app_id');
    }
}
