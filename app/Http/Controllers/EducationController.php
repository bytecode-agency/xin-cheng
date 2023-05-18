<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationFollowup;
use App\Models\Education;
use App\Models\EducationSchool;
use App\Models\EducationStudentPass;
use App\Models\EducationParent;
use App\Models\EducationParentsLT;
use App\Models\EducationGuardian;

use DataTables;
use DB;
use Auth;

class EducationController extends Controller
{
    public function dashboard(Request $request)
    {
        $b=2;
        $data2 =EducationFollowup::all();  
       
        if ($request->ajax()) {                  
                return Datatables::of($data2)  
                ->editcolumn('id',function($query){
                    return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                })                       
               ->make(true); 
        }

        return view('education.dashboard',compact('b'));
    }
    
    
    public function add()
    {
        return view('education.create');
    }

    public function index(Request $request)
    {
        $data = Education::with('schools')->get();
        if ($request->ajax()) {             
            return Datatables::of($data)  
                    ->editcolumn('id',function($query){
                        return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                    })                  
                   
                    ->editColumn('client_name', function ($query) {                               
                       return $query->client_name;                        
                    })                
                           
                    ->editColumn('education_level', function ($query) {                               
                        return $query->education_level;  
                    }) 
                    ->editColumn('client_current_pass', function ($query) {                            
                     
                       return $query->client_current_pass;
                    })     
                    ->editColumn('school_status', function ($query) {                            
                        $school_app_status="";
                        foreach($query->schools as $schools)
                        {
                            
                        $school_app_status =  $schools->school_status;
                        }
                        if($school_app_status != null){
                        return $school_app_status;
                        }
                        else{
                        return "-";
                        }
                     })          
                    ->addColumn('action','education.action')
                    ->rawColumns(['action'])    
                    ->make(true);                         
        }         
        return view('education.index');
    }
    public function store(Request $request)
    {
        // dd($request);
        $education = new Education;
        $education->education_level = isset($request->education_type) ? $request->education_type : null;
        $education->client_name = isset($request->client_name) ? $request->client_name : null;
        $education->client_pass_name = isset($request->pass_name) ? $request->pass_name : null;
        $education->client_current_pass = isset($request->current_pass) ? $request->current_pass : null;
        $education->gender = isset($request->gender) ? $request->gender : null;
        $education->dob = isset($request->dob) ? $request->dob : null;
        $education->pass_no = isset($request->pass_no) ? $request->pass_no : null;
        $education->pass_country = isset($request->pass_country) ? $request->pass_country : null;
        $education->pass_exp_date = isset($request->pass_expiry_date) ? $request->pass_expiry_date : null;
        $education->pass_renewal_reminder = isset($request->pass_renewal_rem) ? $request->pass_renewal_rem : null;
        $education->pass_trigger_frq = isset($request->pass_trg_fqy) ? $request->pass_trg_fqy : null;
        $education->phone_no = isset($request->phone_no) ? $request->phone_no : null;
        $education->email = isset($request->email) ? $request->email : null;
        $education->address = isset($request->residential_add) ? $request->residential_add : null;
        $education->remarks = isset($request->remark) ? $request->remark : null;
        $education->save();
        if($request->edu)
        {
            foreach($request->edu as $k=>$education_school)
            {
                $education_school = new EducationSchool;
                $education_school->education_id= $education['id'];
                $education_school->school_name = isset($request->school_name)? $request->school_name : null;
                $education_school->education_description = isset($request->education_description)? $request->education_description : null;
                $education_school->applied_date = isset($request->application_date)? $request->application_date : null;
                $education_school->school_status = isset($request->school_application_status)? $request->school_application_status : null;
                $education_school->save();
            }
        }
        if($request->need_student_pass_app)
        {
            $education_pass = new EducationStudentPass;
            $education_pass->education_id = $education->id;
            $education_pass->need_of_student_pass = isset($request->need_student_pass_app)? $request->need_student_pass_app : null;
            $education_pass->pass_application_status = isset($request->pass_app_status)? $request->pass_app_status :null;
            $education_pass->pass_issuance = isset($request->pass_issuance)? $request->pass_issuance :null;
            $education_pass->pass_issuance_date = isset($request->pass_issuance_date)? $request->pass_issuance_date :null;
            $education_pass->pass_expiry_date = isset($request->std_pass_expiry_date)? $request->std_pass_expiry_date :null;
            $education_pass->pass_duration = isset($request->pass_duration)? $request->pass_duration :null;
            $education_pass->pass_renewal_reminder = isset($request->pass_renewal_reminder)? $request->pass_renewal_reminder :null;
            $education_pass->fin_number = isset($request->fin_number)? $request->fin_number :null;
            $education_pass->pass_renewal_frq = isset($request->pass_renewal_frq)? $request->pass_renewal_frq :null;
            $education_pass->remarks = isset($request->remak)? $request->remak :null;
            $education_pass->save();
        }
       
        if($request->par_pass_name)  
        {      
            $education_parent = new EducationParent;
            $education_parent->education_id = $education->id;
            $education_parent->pass_name_eng = isset($request->par_pass_name) ? $request->par_pass_name : null;
            $education_parent->pass_name_chinese = isset($request->par_pass_name_chinese) ? $request->par_pass_name_chinese : null;
            $education_parent->relationship_with_client = isset($request->relation_with_client) ? $request->relation_with_client : null;
            $education_parent->gender = isset($request->par_gender) ? $request->par_gender : null;
            $education_parent->dob = isset($request->par_dob) ? $request->par_dob : null;
            $education_parent->pass_no = isset($request->par_pass_no) ? $request->par_pass_no : null;
            $education_parent->pass_reminder = isset($request->par_pass_renewal_reminder) ? $request->par_pass_renewal_reminder : null;
            $education_parent->pass_expiry_date = isset($request->par_pass_exp_date) ? $request->par_pass_exp_date : null;
            $education_parent->pass_trigger_frq = isset($request->par_pass_renewal_frq) ? $request->par_pass_renewal_frq : null;
            $education_parent->pass_country = isset($request->par_pass_country) ? $request->par_pass_country : null;
            $education_parent->job_occupation = isset($request->par_job_occupation) ? $request->par_job_occupation : null;
            $education_parent->annual_income = isset($request->par_annual_income) ? $request->par_annual_income : null;
            $education_parent->email = isset($request->par_email) ? $request->par_email : null;
            $education_parent->phone = isset($request->par_phone) ? $request->par_phone : null;
            $education_parent->address = isset($request->par_address) ? $request->par_address : null;
            $education_parent->remarks = isset($request->remarks_parents) ? $request->remarks_parents : null;
            $education_parent->save();
        }
        if($request->parents_ltvp_app)
        {
            $education_par_ltvp = new EducationParentsLT;
            $education_par_ltvp->education_id = $education->id;     
            $education_par_ltvp->parents_ltvp_app = isset($request->parents_ltvp_app)? $request->parents_ltvp_app : null;        
            $education_par_ltvp->pass_application_status = isset($request->par_ltvp_pass_app_status)? $request->par_ltvp_pass_app_status :null;
            $education_par_ltvp->pass_issuance = isset($request->par_ltvp_pass_issuance)? $request->par_ltvp_pass_issuance :null;
            $education_par_ltvp->pass_issuance_date = isset($request->par_ltvp_pass_issuance_date)? $request->par_ltvp_pass_issuance_date :null;
            $education_par_ltvp->pass_expiry_date = isset($request->par_ltvp_pass_issuance_exp_date)? $request->par_ltvp_pass_issuance_exp_date :null;
            $education_par_ltvp->pass_duration = isset($request->par_ltvp_pass_duration)? $request->par_ltvp_pass_duration :null;
            $education_par_ltvp->fin_number = isset($request->par_ltvp_fin_no)? $request->par_ltvp_fin_no :null;
            $education_par_ltvp->pass_renewal_reminder = isset($request->par_ltvp_pass_renewal)? $request->par_ltvp_pass_renewal :null;
            $education_par_ltvp->pass_renewal_frq = isset($request->par_ltvp_pass_frq)? $request->par_ltvp_pass_frq :null;
            $education_par_ltvp->remarks = isset($request->par_ltvp_remarks)? $request->par_ltvp_remarks :null;
            $education_par_ltvp->save();
         
        }
       
        if($request->guardian_relation && ($request->guardian_relation != null))
        {
             $education_guardian= new EducationGuardian;
             $education_guardian->education_id = $education->id;
             $education_guardian->relationship_with_client = isset($request->guardian_relation) ? $request->guardian_relation : null;
             $education_guardian->pass_name_eng = isset($request->guardian_pass_name) ? $request->guardian_pass_name : null;
             $education_guardian->pass_name_chinese = isset($request->guardian_pass_name_chinese) ? $request->guardian_pass_name_chinese : null;
             $education_guardian->gender = isset($request->guardian_gender) ? $request->guardian_gender : null;
             $education_guardian->dob = isset($request->guardian_dob) ? $request->guardian_dob : null;
             $education_guardian->pass_no = isset($request->guardian_pass_no) ? $request->guardian_pass_no : null;
             $education_guardian->pass_reminder = isset($request->guardian_pass_renewal) ? $request->guardian_pass_renewal : null;
             $education_guardian->pass_expiry_date = isset($request->guardian_pass_expiry_date) ? $request->guardian_pass_expiry_date : null;
             $education_guardian->pass_trigger_frq = isset($request->guardian_pass_frq) ? $request->guardian_pass_frq : null;
             $education_guardian->pass_country = isset($request->guardian_pass_country) ? $request->guardian_pass_country : null;
             $education_guardian->job_occupation = isset($request->guardian_job) ? $request->guardian_job : null;
             $education_guardian->annual_income = isset($request->guardian_annual_income) ? $request->guardian_annual_income : null;
             $education_guardian->email = isset($request->guardian_email) ? $request->guardian_email : null;
             $education_guardian->phone = isset($request->guardian_phone) ? $request->guardian_phone : null;
             $education_guardian->address = isset($request->guardian_address) ? $request->guardian_address : null;
             $education_guardian->remarks = isset($request->guardian_remarks) ? $request->guardian_remarks : null;
             $education_guardian->save();
        }

        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $education->id,
        'module_name' => 'Education',
        'old_action' => null,       
        'action_perform'=> serialize($request->toArray()),
        'message'=>'Application Created',
        ]);
        activity_log($data);
      
       $response = ['success'=> $education];
       return response()->json($response);         
        
    }
    public function view($id)
    {
        return view('education.view');
    }
}
