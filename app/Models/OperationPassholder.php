<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class OperationPassholder extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'bus_type',
        'pass_app_type',
        'passhol_setup',
        'passhol_sharehol',
        'passhol_name',
        'passport_name',
        'pass_dob',
        'pass_gender',
        'pass_exp_dob',
        'passport_number',
        'passport_country',
        'passport_ren_rem',
        'passport_tin_number',
        'passport_rem_fre',
        'email',
        'passport_tin_country',
         'phno',
         'pass_tin_type',
         'finno',
         'res_add',
         'pass_app_sts',
         'pass_iss',
         'pass_iss_date',
         'pass_exp_date',
         'duration',
         'pass_ren_fre',
         'pass_ren_rem',
          'pass_ren_ter_fre',
         'pass_job_title',
         'singpass_setup',
          'pr_app_rem',
         'rel_pass_hol',
         'emp_name',
          'month_sal',
          'p_remarks',
         'user_id',
         'created_by',
    

    ];
  

    //      $op->bus_type=$pass_val['bus_type'];
         
    //      $op->pass_app_type=$pass_val['pass_app_type'];
    //      $op->passhol_setup=$pass_val['passhol_setup'];
    //      $op->passhol_sharehol=$pass_val['passhol_sharehol'];
    //      $op->passhol_name=$pass_val['passhol_name'];
    //      $op->passport_name=$pass_val['passport_name'];
    //      $op->pass_dob=$pass_val['pass_dob'];
    //      $op->pass_gender=$pass_val['pass_gender'];
         
    //      $op->pass_exp_dob=$pass_val['pass_exp_dob'];
    //      $op->passport_number=$pass_val['passport_number'];
    //      $op->passport_country=$pass_val['passport_country'];
    //      $op->passport_ren_rem=$pass_val['passport_ren_rem'];

    //      $op->passport_tin_number=$pass_val['passport_tin_number'];
    //      $op->passport_rem_fre=$pass_val['passport_rem_fre'];
    //      $op->email=$pass_val['email'];
    //      $op->passport_tin_country=$pass_val['passport_tin_country'];

    //      $op->phno=$pass_val['phno'];
    //      $op->pass_tin_type=$pass_val['pass_tin_type'];
    //      $op->finno=$pass_val['finno'];
    //      $op->res_add=$pass_val['res_add'];

    //      $op->pass_app_sts=$pass_val['pass_app_sts'];
    //      $op->pass_iss=$pass_val['pass_iss'];
    //      $op->pass_iss_date=$pass_val['pass_iss_date'];
    //      $op->pass_exp_date=$pass_val['pass_exp_date'];
    //      $op->duration=$pass_val['duration'];
    //      $op->pass_ren_fre=$pass_val['pass_ren_fre'];

    //      $op->pass_ren_rem=$pass_val['pass_ren_rem'];
    //      $op->pass_ren_ter_fre=$pass_val['pass_ren_ter_fre'];
    //      $op->pass_job_title=$pass_val['pass_job_title'];
    //      $op->singpass_setup=$pass_val['singpass_setup'];
    //      $op->pr_app_rem=$pass_val['pr_app_rem'];
    //      $op->rel_pass_hol=$pass_val['rel_pass_hol'];

    //      $op->emp_name=$pass_val['emp_name'];
    //      $op->month_sal=$pass_val['month_sal'];
    //      $op->p_remarks=$pass

   
    public function pass_pr()
    {
        return $this->hasMany(OperationPr::class,'pass_id');
    }

}
