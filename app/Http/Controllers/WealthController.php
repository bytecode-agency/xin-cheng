<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File; 

use Illuminate\Http\Request;
use App\Models\Wealth;
use App\Models\User;
use App\Models\WealthCompany;
use App\Models\WealthShareholder;
use App\Models\WealthBusiness;
use App\Models\WealthPersonal;
use App\Models\WealthFollowup;
use App\Models\WealthFiles;
use App\Models\LogActivity;
use App\Models\Notes;
use App\Models\WealthMas;
use App\Models\WealthFinancial;
use App\Models\WealthPass;
use App\Models\WealthBusinessApp;
use  App\Models\Wealth_business_redempt;
use DataTables;
use DB;
use Auth;


class WealthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(Request $request)
    {
        $b=2;
        $data2 =WealthFollowup::all();  
       
        if ($request->ajax()) {                  
                return Datatables::of($data2)  
                ->editcolumn('id',function($query){
                    return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                })                       
               ->make(true); 
        }
        
        return view('wealth.dashboard',compact('b'));
    }
    public function index(Request $request)
    {
        $data= array();
        $new_name="";
        $data = Wealth::with('companies.shareholder')->get();  
       
        if ($request->ajax()) {             
            return Datatables::of($data)  
                    ->editcolumn('id',function($query){
                        return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                    })
                    ->editColumn('name', function ($query) {
                        $company_nme = array();
                        if(count($query->companies) > 0 ){
                            foreach($query->companies as $cmp_name)
                            {
                                $company_nme[] = $cmp_name->name;
                            }
                            return $company_nme;
                        }
                        else
                        {
                            return '-';
                        }
                        })  
                    ->editColumn('pass_name_eng', function ($query) {                       
                       $share_name = array();
                       if(count($query->companies)> 0) 
                       {
                            foreach($query->companies as $key => $shareholder)
                            {                        
                                foreach($shareholder->shareholder as $share)
                                {
                                    if($share->pass_name_eng){
                                        $share_name = $share->pass_name_eng;
                                    }
                                    else
                                    {
                                        return '-';
                                    }
                                }
                            }
                            return $share_name;
                        }
                    
                        elseif(($query->business_type =="Non-FO") && ($query->client_type == "Personal"))
                        {
                            $new_name = WealthPersonal::where('wealth_id',$query->id)->first();
                            if(isset($new_name->pass_name_eng) && $new_name->pass_name_eng != null)
                            {
                                return $new_name->pass_name_eng;
                            }
                            else
                            {
                                return '-';
                            }
                        }
                        else
                        {
                            return '-';
                        }
                    })  
                    ->editColumn('business_type', function ($query) {                               
                       return $query->business_type;                        
                    })                
                    ->editColumn('type_of_fo', function ($query) {                               
                        if($query->business_type == "FO")
                        {                           
                          $type_of_fo = WealthBusiness::select('type_of_fo')->where('wealth_id','=',$query->id)->first();                         
                          if(isset($type_of_fo->type_of_fo) && ($type_of_fo->type_of_fo != null))
                          {
                            return $type_of_fo->type_of_fo;                            
                          }
                          else
                          {
                            return '-'; 
                          }
                        }
                        else{                        
                             return '-';                         
                        }
                    })                     
                    ->editColumn('client_type', function ($query) {                               
                        return $query->client_type;  
                    }) 
                    ->editColumn('created_by', function ($query) {                             
                      $create_by = User::select('name')->where('id','=',$query->user_id)->first()->name;
                       return $create_by;
                    })             
                    ->addColumn('action','wealth.action')
                    ->rawColumns(['action'])    
                    ->make(true);                         
        }         
        return view('wealth.index');
    }
    public function show(Request $request)
    {
       return view('wealth.create');
    }
    public function save(Request $request)
    {
        // dd($request);
        // echo "<pre>";print_r($request->all());
        
      // for saving business type of wealth  
      $wealth_all = new Wealth;
      $wealth_all->user_id = $request->id;
      $wealth_all->business_type = $request->business_type;
      if($request->business_type == "Non-FO")
      {   
        $wealth_all->client_type = $request->nfo_client_type;       
      }
      else
      {
        $wealth_all->client_type = $request->client_type;
      }
      $wealth_all->save();
      //  for FO business details
      if($request->business_type == "FO")
      { 
        // dd($request);      
        $business_add = new WealthBusiness;
        $business_add->wealth_id = $wealth_all->id;
        $business_add->type_of_fo = $request->type_of_fo;
        $business_add->type_of_fo_specify = $request->type_of_fo_specify;
        $business_add->date_of_contract = $request->date_of_contract;
        $business_add->servicing_fee = $request->servicing_fee;
        $business_add->servicing_fee_currency = $request->servicing_fee_currency;
        $business_add->servicing_fee_status = $request->servicing_fee_status;
        $business_add->annual_servicing_fee = $request->annual_servicing_fee;
        $business_add->annual_fee_currency = $request->annual_fee_currency;
        $business_add->annual_fee_status = $request->annual_fee_status;
        $business_add->annual_fee_due_date = $request->annual_fee_due_date;
        $business_add->annual_fee_due_reminder = $request->annual_fee_due_reminder;
        $business_add->annual_fee_due_reminder_trigger = $request->annual_fee_due_reminder_trigger;
        $business_add->save();

        //  for FO companies and shareholder
        if(isset($request->cmp))
        {
            foreach($request->cmp as $key=> $company)
            { 
                // echo'<pre>';print_r($company['fo_company']);
                $company_add = new WealthCompany;
                $company_add->wealth_id = $wealth_all->id;
                $company_add->name = $company['name'];
                $company_add->uen = $company['uen'];
                $company_add->address= $company['address'];
                $company_add->incorporate_date = $company['incorporate_date'];
                $company_add->relationship = isset($company['relationship']) ? $company['relationship'] : null ;
                $company_add->company_email = $company['company_email'];
                $company_add->company_pass = $company['company_pass'];
                $company_add->save();            
                //    echo"<pre>";print_r($request->share);
               foreach($request->share[$key] as $key2=> $shareholder)
                {
                    // echo'<pre>';print_r($shareholder); 
                    $shareholder_all = new WealthShareholder;
                    $shareholder_all->company_id = $company_add->id;
                    $shareholder_all->equity_percentage = isset($shareholder['equity_percentage']) ?  $shareholder['equity_percentage'] :null;
                    $shareholder_all->shareholder_type = isset($shareholder['shareholder_type'])? $shareholder['shareholder_type']: null;   
                 
                        if(isset($shareholder['shareholder_type']) && $shareholder['shareholder_type'] == "Company")
                        {             
                            $shareholder_all->shareholder_company_name = isset($shareholder['shareholder_company_name']) ? $shareholder['shareholder_company_name'] :null;           
                        }
                        else{
                            $shareholder_all->pass_name_eng = isset($shareholder['pass_name_eng'])? $shareholder['pass_name_eng'] :null ;
                            $shareholder_all->pass_name_chinese = isset($shareholder['pass_name_chinese'])? $shareholder['pass_name_chinese']: null;
                            $shareholder_all->passport_renew = isset($shareholder['passport_renew']) ? $shareholder['passport_renew'] :null ; 
                            $shareholder_all->gender = isset($shareholder['gender']) ? $shareholder['gender'] : null;
                            $shareholder_all->dob = isset($shareholder['dob'])? $shareholder['dob']  :null;
                            $shareholder_all->passport_trg_fqy = isset($shareholder['passport_trg_fqy'])? $shareholder['passport_trg_fqy']:null ; 
                            $shareholder_all->passport_no = isset($shareholder['passport_no']) ? $shareholder['passport_no'] :null ;
                            $shareholder_all->passport_exp_date =  isset($shareholder['passport_exp_date']) ? $shareholder['passport_exp_date'] :null; 
                            $shareholder_all->passport_country = isset($shareholder['passport_country']) ? $shareholder['passport_country'] :null;
                            $shareholder_all->email = isset($shareholder['email']) ? $shareholder['email'] :null;
                            $shareholder_all->phone = isset($shareholder['phone']) ? $shareholder['phone']:null ;
                            $shareholder_all->residential_address = isset($shareholder['residential_address'])? $shareholder['residential_address'] :null;
                            $shareholder_all->tin_no = isset($shareholder['tin_no']) ? $shareholder['tin_no'] :null;
                            $shareholder_all->tin_country = isset($shareholder['tin_country']) ? $shareholder['tin_country'] :null ;
                            $shareholder_all->type_of_tin = isset($shareholder['type_of_tin']) ? $shareholder['type_of_tin']: null;
                            $shareholder_all->job_title = isset($shareholder['job_title']) ? $shareholder['job_title'] :null;
                            $shareholder_all->monthly_sal = isset($shareholder['monthly_sal']) ?$shareholder['monthly_sal'] :null;
                            $shareholder_all->company = isset($shareholder['company']) ?$shareholder['company'] :null;
                            $shareholder_all->monthly_salary_wef = isset($shareholder['monthly_salary_wef']) ?$shareholder['monthly_salary_wef'] :null;
                            $shareholder_all->relation_with_shareholder = isset($shareholder['relation_with_shareholder']) ? $shareholder['relation_with_shareholder'] :null;
                            $shareholder_all->rel_share_specify = isset($shareholder['relation_with_shareholder_specify']) ? $shareholder['relation_with_shareholder_specify'] :null;
                        }
                    
                    $shareholder_all->save();    
                }
            }       
        }
        // dd('here');
      }
      else
      {  
         // for NON-FO client type as personal or corporate
         if($request->nfo_client_type == "Personal")
         {
            $nf_personal = new WealthPersonal;
            $nf_personal-> wealth_id = $wealth_all->id;
            $nf_personal->pass_name_eng = $request->nfo_pass_name;
            $nf_personal->pass_name_chinese =  $request->nfo_pass_name_chinese;
            $nf_personal->gender =  isset($request->nfo_gender) ? $request->nfo_gender :null; 
            $nf_personal->dob =  $request->nfo_dob;
            $nf_personal->passport_no =  $request->nfo_pass_number;
            $nf_personal->passport_exp_date =  $request->nfo_pass_exp;
            $nf_personal->passport_renew = isset($request->nfo_pass_reminder) ? $request->nfo_pass_reminder :null;
            $nf_personal->passport_country =  $request->nfo_pass_country;
            $nf_personal->passport_trg_fqy =  $request->nfo_pass_trg_frq;
            $nf_personal->tin_no =  $request->nfo_tin_number;
            $nf_personal->tin_country =  $request->nfo_tin_ctry;
            $nf_personal->tin_before_application =  $request->nfo_tin_no_before_app;
            $nf_personal->type_of_tin =  isset($request->nfo_tin_type) ? $request->nfo_tin_type : null;
            $nf_personal->email =  $request->nfo_email;
            $nf_personal->tin_country_before_app =  $request->nfo_tin_country_before_app;
            $nf_personal->residential_address =  $request->nfo_residential_Add;
            $nf_personal->type_pin_before_app =  isset($request->nfo_tin_type_before_app) ? $request->nfo_tin_type_before_app :null ;
            $nf_personal->employer_industry =  $request->nfo_employer_ind;
            $nf_personal->phone =  $request->nfo_phone_number;
            $nf_personal->job_title =  $request->nfo_current_job_title;
            $nf_personal->employer_name =  $request->nfo_emp_name;
            $nf_personal->save();
         }
         else
         {   
            // dd($request);
            // for NON-FO Companies and shareholder
            if(isset($request->corporate))
            {
                // dd($request->corporate);
                // echo'<pre>';print_r($request->corporate);
                foreach($request->corporate as $k => $company)
                {   
                    
                    // echo'<pre>';print_r($k);
                    $company_add = new WealthCompany;
                    $company_add->wealth_id = $wealth_all->id;
                    $company_add->name = $company['nfo_company'];
                    $company_add->uen = $company['nfo_uen'];
                    $company_add->address= $company['nfo_company_add'];
                    $company_add->incorporate_date = $company['nfo_incorporation_date'];
                    $company_add->relationship = isset($company['nfo_relationship']) ? $company['nfo_relationship'] : null ;
                    $company_add->company_email = $company['nfo_company_email'];
                    $company_add->company_pass = $company['nfo_company_pass'];
                    $company_add->save();
                    // echo'<pre>';print_r($request->shrd);
                    
                    foreach($request->shrd[$k] as $key4 => $shareholder)
                    {
                        // echo'<pre>';print_r($shareholder); 
                    $shareholder_all = new WealthShareholder;
                    $shareholder_all->company_id = $company_add->id;
                    $shareholder_all->equity_percentage = isset($shareholder['nfo_equity']) ? $shareholder['nfo_equity']: null;                   
                  
                    $shareholder_all->pass_name_eng = isset($shareholder['nfo_pass_name']) ? $shareholder['nfo_pass_name']: null;
                    $shareholder_all->pass_name_chinese = isset($shareholder['nfo_pass_name_chinese']) ? $shareholder['nfo_pass_name_chinese'] : null ;
                    $shareholder_all->passport_renew = isset($shareholder['nfo_pass_reminder']) ? $shareholder['nfo_pass_reminder'] : null; 
                    $shareholder_all->gender = isset($shareholder['nfo_gender']) ? $shareholder['nfo_gender'] :null;
                    $shareholder_all->dob = isset($shareholder['nfo_dob']) ?$shareholder['nfo_dob'] :null;
                    $shareholder_all->passport_trg_fqy = isset($shareholder['nfo_pass_trg_frq'])? $shareholder['nfo_pass_trg_frq'] :null; 
                    $shareholder_all->passport_no = isset($shareholder['nfo_pass_number'])? $shareholder['nfo_pass_number']:null;
                    $shareholder_all->passport_exp_date = isset($shareholder['nfo_pass_exp']) ? $shareholder['nfo_pass_exp'] : null;
                    $shareholder_all->passport_country = isset($shareholder['nfo_pass_country']) ?  $shareholder['nfo_pass_country'] : null;
                    $shareholder_all->email = isset($shareholder['nfo_email']) ? $shareholder['nfo_email']: null;
                    $shareholder_all->phone = isset($shareholder['nfo_phone_number']) ? $shareholder['nfo_phone_number']: null;
                    $shareholder_all->residential_address = isset($shareholder['nfo_residential_Add'])? $shareholder['nfo_residential_Add'] :null;
                    $shareholder_all->tin_no = isset($shareholder['nfo_tin_number']) ? $shareholder['nfo_tin_number']:null;
                    $shareholder_all->tin_country = isset($shareholder['nfo_tin_ctry']) ? $shareholder['nfo_tin_ctry']: null;
                    $shareholder_all->type_of_tin = isset($shareholder['nfo_tin_type']) ? $shareholder['nfo_tin_type'] : null ;
                    $shareholder_all->job_title = isset($shareholder['nfo_job_title'])? $shareholder['nfo_job_title'] : null;
                    $shareholder_all->monthly_sal = isset($shareholder['nfo_mth_salary']) ? $shareholder['nfo_mth_salary'] : null;    
                    $shareholder_all->relation_with_shareholder= isset($shareholder['nfo_relation'])? $shareholder['nfo_relation'] : null ;           
                    
                    $shareholder_all->save();    
                    }
                }       
            }
         }
      }
     
      $data = (object)(['id'=> Auth::user()->id,        
      'name'=> Auth::user()->name,
      'userID' => $wealth_all->id,
      'module_name' => 'Wealth',
      'old_action' => null,       
      'action_perform'=> serialize($request->toArray()),
      'message'=>'Application Created',
      ]);
      activity_log($data);
    
     $response = ['success'=> $wealth_all];
     return response()->json($response);     
    } 

    public function destroy($id)
    {
       $get_data =  Wealth::find($id);  
       $company_id= WealthCompany::where('wealth_id','=',$get_data->id)->get();     
       foreach($company_id as $key=>$companies)
       {
          WealthShareholder::where('company_id','=',$companies->id)->delete();
          WealthCompany::where('id','=',$companies->id)->delete();
       }   
       if($get_data->business_type == "FO")
       {
         WealthBusiness::where('wealth_id','=',$get_data->id)->delete();
       }
       else
       {
         WealthPersonal::where('wealth_id','=',$get_data->id)->delete();
       }      
       Wealth::where('id',$id)->delete();   
       $success = ['success'=> '<i class="fa-regular fa-circle-check"></i> '.str_pad($id, 3, '000', STR_PAD_LEFT).' has been deleted.'];
       return response()->json($success);   
       
    }
    public function view($id)
    {   
        $data = Wealth::with('companies.shareholder')->with('users')->find($id); 
        // dd($data);
        if(!empty($data) && !empty($data->business_type) && $data->business_type == "FO")
        {
            $basic_data = WealthBusiness::where('wealth_id','=',$data->id)->first();           
        }
        else
        {
            if($data->client_type == "Personal")
            {
                $basic_data = WealthPersonal::where('wealth_id','=',$data->id)->first();     
            }
            else
            {
                $basic_data = $data;
            }                  
        }   
        $file = WealthFiles::where('wealth_id', $id)->orderBy('id','desc')->get(); 
        $notes = Notes::where('module_name','Wealth')->where('application_id',$id)->orderBy('id','desc')->get();  
        $action_log = LogActivity::where('module_name','=','Wealth')->where('userID','=',$id)->orderBy('id','desc')->get(); 
        $wealth_mas = WealthMas::where('wealth_id',$id)->first();
        $wealth_finance = WealthFinancial::where('wealth_id',$id)->get();
        $wealthpass = WealthPass::where('wealth_id',$id)->first();
        $wealthbuss = WealthBusinessApp::with('business_redempt')->orderBy('id','desc')->where('wealth_id',$id)->first();
        // dd($wealthbuss);
        return view('wealth.view',compact('data','basic_data','file','action_log','notes','wealth_mas','wealth_finance','wealthpass','wealthbuss'));
    }
    public function edit($id)
    {
        $data = Wealth::with('companies.shareholder')->with('users')->find($id); 
        if($data->business_type == "FO")
        {
            $basic_data = WealthBusiness::where('wealth_id','=',$data->id)->first();           
        }
        else
        {
            if($data->client_type == "Personal")
            {
                $basic_data = WealthPersonal::where('wealth_id','=',$data->id)->first();     
            }
            else
            {
                $basic_data = $data;
            }                  
        } 
        $file = WealthFiles::where('wealth_id', $id)->orderBy('id','desc')->get();   
        $wealth_mas = WealthMas::where('wealth_id',$id)->first();
        $wealthfinance = WealthFinancial::where('wealth_id',$id)->get();
       
        $wealthpass = WealthPass::where('wealth_id',$id)->first();
        $wealthbuss = WealthBusinessApp::with('business_redempt')->where('wealth_id',$id)->first();       
        
        $notes = Notes::where('module_name','Wealth')->where('application_id',$id)->orderBy('id','desc')->get();   
        return view('wealth.edit',compact('data','basic_data','file','notes','wealth_mas','wealthfinance','wealthpass','wealthbuss'));
    }
    public function update(Request $request)
    { 
        $business_account_types = null;
        if(!empty($request->business_account_type)){
            $business_account_types = implode(',' , $request->business_account_type);
        }

        $id= $request->wealth_id;
        $data_update = Wealth::with('companies.shareholder')->find($id); 
        if($request->client_status)
        {
             Wealth::find($id)->update(['client_status'=> $request->client_status]);
        }
       if($data_update->business_type == "FO")
       {
            
            $get_data = WealthBusiness::where('wealth_id',$id)->update([
                'servicing_fee' => $request->servicing_fee,
                'servicing_fee_currency' => $request->servicing_fee_currency,
                'servicing_fee_status' => $request->servicing_fee_status,
                'annual_servicing_fee' => $request->annual_servicing_fee,
                'annual_fee_currency' => $request->annual_fee_currency,
                'annual_fee_status' => $request->annual_fee_status,
                'date_of_contract' => $request->date_of_contract,
                'annual_fee_due_date' => $request->annual_fee_due_date,
                'annual_fee_due_reminder' => $request->annual_fee_due_reminder,
                'annual_fee_due_reminder_trigger' => $request->annual_fee_due_reminder_trigger,
                
            ]);
            
            if(isset($request->cmp))
            {
                foreach($request->cmp as $key=> $company)
                { 
                   
                    // echo'<pre>';print_r($company);
                    // dd($company);
                    $company_add = WealthCompany::updateOrCreate(['id' => $company['id'],'wealth_id' => $id], 
                    ['name' => $company['name'],
                    'uen' => $company['uen'],
                    'address' => $company['address'],
                    'incorporate_date' => $company['incorporate_date'],
                    'relationship' => isset($company['relationship'])? $company['relationship'] :null,
                    'company_email' => $company['company_email'],
                    'company_pass' => $company['company_pass']
                    ]);
                    
                    // echo'<pre>';print_r($company_add->id);  
                    // dd($company_add->id);
                    if(!empty($request->share) && is_array($request->share) && array_key_exists($key,$request->share)){
                        foreach($request->share[$key] as $key2=> $shareholder)
                        {
                            // dd($shareholder['id']);
                            // echo'<pre>';print_r($company_add['id']);                       
                            $shareholder_all = WealthShareholder::updateorCreate(['id'=> $shareholder['id'],'company_id' => $company_add['id']],
                            [
                            'equity_percentage' => isset($shareholder['equity_percentage']) ? $shareholder['equity_percentage'] : null,
                            'shareholder_company_name' => isset($shareholder['shareholder_company_name']) ? $shareholder['shareholder_company_name'] : null,
                            'shareholder_type' => isset($shareholder['shareholder_type']) ? $shareholder['shareholder_type'] : null,  
                            'pass_name_eng' => isset($shareholder['pass_name_eng']) ? $shareholder['pass_name_eng'] :null,
                            'pass_name_chinese' => isset($shareholder['pass_name_chinese'])? $shareholder['pass_name_chinese']: null,
                            'passport_renew' => isset($shareholder['passport_renew']) ? $shareholder['passport_renew'] :null, 
                            'gender' => isset($shareholder['gender']) ? $shareholder['gender'] : null,
                            'dob' => isset($shareholder['dob'])? $shareholder['dob']  :null,
                            'passport_trg_fqy' => isset($shareholder['passport_trg_fqy'])? $shareholder['passport_trg_fqy']:null,
                            'passport_no' => isset($shareholder['passport_no']) ? $shareholder['passport_no'] :null,
                            'passport_exp_date' =>  isset($shareholder['passport_exp_date']) ? $shareholder['passport_exp_date'] :null,
                            'passport_country' => isset($shareholder['passport_country']) ? $shareholder['passport_country'] :null,
                            'email' => isset($shareholder['email']) ? $shareholder['email'] :null,
                            'phone' => isset($shareholder['phone']) ? $shareholder['phone']:null,
                            'residential_address' => isset($shareholder['residential_address'])? $shareholder['residential_address'] :null,
                            'tin_no' => isset($shareholder['tin_no']) ? $shareholder['tin_no'] :null,
                            'tin_country' => isset($shareholder['tin_country']) ? $shareholder['tin_country'] :null,
                            'type_of_tin' => isset($shareholder['type_of_tin']) ? $shareholder['type_of_tin']: null,
                            'job_title' => isset($shareholder['job_title']) ? $shareholder['job_title'] :null,
                            'monthly_sal' => isset($shareholder['monthly_sal']) ?$shareholder['monthly_sal'] :null,
                            'monthly_salary_wef' =>  isset($shareholder['monthly_salary_wef']) ?$shareholder['monthly_salary_wef'] :null,
                            'relation_with_shareholder' => isset($shareholder['relation_with_shareholder']) ? $shareholder['relation_with_shareholder'] :null,
                            'rel_share_specify' => isset($shareholder['please_specify']) ? $shareholder['please_specify'] :null,
                            
                            ]);                       
                        }    
                    }
                
                }
            }

                // for application data mas_related
                // dd($request);
            $wealth_mas_application = WealthMas::updateOrCreate(
                ['id' => $request->wealth_mas_id , 'wealth_id' => $id],
                ['account_status' => isset($request->account_status) ? $request->account_status :null,
                'tax_advisor_name' => isset($request->tax_advisor_name) ? $request->tax_advisor_name :null,
                'tax_advisor_email'=>  isset($request->tax_advisor_email) ? $request->tax_advisor_email :null,
                'tax_advisor_no'=>  isset($request->tax_advisor_no) ? $request->tax_advisor_no :null,
                'kickstart_tax_advisor' =>  isset($request->kickstart_tax_advisor) ? $request->kickstart_tax_advisor :null,
                'deck_submission' =>  isset($request->deck_submission) ? $request->deck_submission :null,
                'presentation_deck'  =>  isset($request->presentation_deck) ? $request->presentation_deck :null,
                'masnet_account'  =>  isset($request->masnet_account) ? $request->masnet_account :null,
                'preliminary_approval'=>  isset($request->preliminary_approval) ? $request->preliminary_approval :null,
                'final_approval' =>  isset($request->final_approval) ? $request->final_approval :null,
                'final_submission' =>  isset($request->final_submission) ? $request->final_submission :null,
                'oic_name' =>  isset($request->oic_name) ? $request->oic_name :null,
                'masnet_username' => isset($request->masnet_username) ? $request->masnet_username :null,
                'masnet_password' => isset($request->masnet_password) ? $request->masnet_password :null,
                'institution_code' => isset($request->institution_code) ? $request->institution_code :null,
                'declaration_frequency'=>  isset($request->declaration_frequency) ? $request->declaration_frequency :null,
                'commencement_date'=>  isset($request->commencement_date) ? $request->commencement_date :null,
                'reminder_notification'=>  isset($request->reminder_notification) ? $request->reminder_notification :null,
                'annual_declaration_deadline'=> isset($request->annual_declaration_deadline) ? $request->annual_declaration_deadline :null,
                'internal_account_manager'=> isset($request->internal_account_manager) ? $request->internal_account_manager :null,
                'trigger_fqy_rem'=> isset($request->trigger_fqy_rem) ? $request->trigger_fqy_rem :null,
                'remarks'=> isset($request->remarks) ? $request->remarks :null,     
               ]
            );        
            if($request->financial)  
            { 
                  //  dd($request->financial);
                  foreach($request->financial as $f_key=>$f_value )
                  {
                    // dd(['id' => $f_value['wealth_finance_id'] , 'wealth_id' => $id]);
                   $wealth_financial_application = WealthFinancial::updateOrCreate(
                    ['id' => $f_value['wealth_finance_id'] , 'wealth_id' => $id],
                    ['stakeholder_type' => isset($f_value['stakeholder_type']) ? $f_value['stakeholder_type'] :null,
                    'financial_institution_name' => isset($f_value['financial_institution_name']) ? $f_value['financial_institution_name'] :null,
                    'poc_name'=>  isset($f_value['poc_name']) ? $f_value['poc_name'] :null,
                    'poc_contact_no' => isset($f_value['poc_contact_no']) ? $f_value['poc_contact_no'] :null,
                    'poc_email'=>  isset($f_value['poc_email']) ? $f_value['poc_email'] :null,
                    'application_submission' =>  isset($f_value['application_submission']) ? $f_value['application_submission'] :null,
                    'application_submission_date' =>  isset($f_value['application_submission_date']) ? $f_value['application_submission_date'] :null,
                    'account_type' =>  isset($f_value['account_type']) ? json_encode($f_value['account_type']) :null,
                    'account_type_specify' =>  isset($f_value['account_type_specify']) ? json_encode($f_value['account_type_specify']) :null,
                    'account_policy_no'  =>  isset($f_value['account_policy_no']) ? json_encode($f_value['account_policy_no']) :null,
                    'account_opening_status'  =>  isset($f_value['account_opening_status']) ? $f_value['account_opening_status'] :null,
                    'current_account_status'=>  isset($f_value['current_account_status']) ? $f_value['current_account_status'] :null,
                    'money_deposit_status' =>  isset($f_value['money_deposit_status']) ? $f_value['money_deposit_status'] :null,
                    'intial_deposit_amount' =>  isset($f_value['intial_deposit_amount']) ? $f_value['intial_deposit_amount'] :null,
                    'intial_deposit_currency' =>  isset($f_value['intial_deposit_currency']) ? $f_value['intial_deposit_currency'] :null,
                    'online_account_username' =>  isset($f_value['online_account_username']) ? $f_value['online_account_username'] :null,
                    'online_account_pass' => isset($f_value['online_account_pass']) ? $f_value['online_account_pass']:null,
                    'finacial_remarks' => isset($f_value['finacial_remarks']) ? $f_value['finacial_remarks'] :null,  ]);
                }
            }
            $wealth_pass_application = WealthPass::updateOrCreate(
                ['id' => $request->wealth_pass_id , 'wealth_id' => $id],
                ['passholder_shareholder' => isset($request->passholder_shareholder) ? $request->passholder_shareholder :null,
                'pass_holder_name' => isset($request->pass_holder_name) ? $request->pass_holder_name :null,
                'passposrt_name_chinese'=>  isset($request->passposrt_name_chinese) ? $request->passposrt_name_chinese :null,
                'dob' => isset($request->dob) ? $request->dob :null,
                'gender'=>  isset($request->gender) ? $request->gender :null,
                'passport_expiry_date' =>  isset($request->passport_expiry_date) ? $request->passport_expiry_date :null,
                'passport_no' =>  isset($request->passport_no) ? $request->passport_no :null,
                'passport_renewal_reminder'  =>  isset($request->passport_renewal_reminder) ? $request->passport_renewal_reminder :null,
                'passport_country'  =>  isset($request->passport_country) ? $request->passport_country :null,
                'passport_tri_frq'=>  isset($request->passport_tri_frq) ? $request->passport_tri_frq :null,
                'tin_country_before_app' =>  isset($request->tin_country_before_app) ? $request->tin_country_before_app :null,
                'type_of_tin_before_app' =>  isset($request->type_of_tin_before_app) ? $request->type_of_tin_before_app :null,
                'tin_no_before_pass_app' =>  isset($request->tin_no_before_pass_app) ? $request->tin_no_before_pass_app :null,
                'phone_no' => isset($request->phone_no) ? $request->phone_no :null,
                'email' => isset($request->email) ? $request->email :null,
                'business_type' =>  isset($request->business_type) ? $request->business_type :null,
                'business_type_specify' =>  isset($request->business_type_specify) ? $request->business_type_specify :null,
                'residential_add' =>  isset($request->residential_add) ? $request->residential_add :null,
                'pass_app_status' => isset($request->pass_app_status) ? $request->pass_app_status :null,
                'relation_with_pass'  =>  isset($request->relation_with_pass) ? $request->relation_with_pass :null,
                'relation_with_pass_specify'  =>  isset($request->relation_with_pass_specify) ? $request->relation_with_pass_specify :null,
                'pass_app_type'=>  isset($request->pass_app_type) ? $request->pass_app_type :null,
                'pass_app_type_specify'=>  isset($request->pass_app_type_specify) ? $request->pass_app_type_specify :null,
                'pass_inssuance'  =>  isset($request->pass_inssuance) ? $request->pass_inssuance :null,
                'pass_issuance_date'=>  isset($request->pass_issuance_date) ? $request->pass_issuance_date :null,
                'pass_expiry_date'  =>  isset($request->pass_expiry_date) ? $request->pass_expiry_date :null,
                'pass_renewal_reminder'=>  isset($request->pass_renewal_reminder) ? $request->pass_renewal_reminder :null,
                'duration'  =>  isset($request->duration) ? $request->duration :null,
                'fin_number'=>  isset($request->fin_number) ? $request->fin_number :null,
                'pass_renewal_frq'=>  isset($request->pass_renewal_frq) ? $request->pass_renewal_frq :null,
                'pass_jon_title'=>  isset($request->pass_jon_title) ? $request->pass_jon_title :null,
                'singpass_set_up'=>  isset($request->singpass_set_up) ? $request->singpass_set_up :null,
                'employee_name'=>  isset($request->employee_name) ? $request->employee_name :null,
                'monthly_sal'=>  isset($request->monthly_sal) ? $request->monthly_sal :null,
                'pass_remarks'=>  isset($request->pass_remarks) ? $request->pass_remarks :null,           
                ]
            );           
            $wealth_business_app = WealthBusinessApp::updateOrCreate(
                ['id' => $request->wealth_business_id , 'wealth_id' => $id],
                ['financial_institition_name' => isset($request->financial_institition_name) ? $request->financial_institition_name :null,
                'application_submision' => isset($request->application_submision) ? $request->application_submision :null,
                'business_account_status'=>  isset($request->business_account_status) ? $request->business_account_status :null,
                // 'business_account_status_specify'=>  isset($request->business_account_status_specify) ? $request->business_account_status_specify :null,
                'business_account_type' => isset($business_account_types) ? $business_account_types :null,
                'business_account_type_specify' => isset($request->business_account_type_specify) ? $request->business_account_type_specify :null,
                'business_account_policy_no'=>  isset($request->business_account_policy_no) ? $request->business_account_policy_no :null,
                'product_name' =>  isset($request->product_name) ? $request->product_name :null,
                'payment_mode' =>  isset($request->payment_mode) ? $request->payment_mode :null,
                'currency'  =>  isset($request->currency) ? $request->currency :null,
                'currency_specify'  =>  isset($request->currency_specify) ? $request->currency_specify :null,
                'investment_amount'  =>  isset($request->investment_amount) ? $request->investment_amount :null,
                'online_account_user'=>  isset($request->online_account_user) ? $request->online_account_user :null,
                'online_acc_pass' =>  isset($request->online_acc_pass) ? $request->online_acc_pass :null,
                'subscription' =>  isset($request->subscription) ? $request->subscription :null,
                'maturity_date' =>  isset($request->maturity_date) ? $request->maturity_date :null,
                'business_duration' => isset($request->business_duration) ? $request->business_duration :null,
                'maturity_reminder' => isset($request->maturity_reminder) ? $request->maturity_reminder :null,
                'maturity_reminder_trg' => isset($request->maturity_reminder_trg) ? $request->maturity_reminder_trg :null,
                'commision_status' => isset($request->commision_status) ? $request->commision_status :null,
                'commission_currency' => isset($request->commission_currency) ? $request->commission_currency :null,
                'commission_currency_specify' => isset($request->commission_currency_specify) ? $request->commission_currency_specify :null,
                'commission_amount' => isset($request->commission_amount) ? $request->commission_amount :null,
                'business_redemption_date' => isset($request->business_redemption_date) ? $request->business_redemption_date :null,
                'business_redemption_amount' => isset($request->business_redemption_amount) ? $request->business_redemption_amount :null,
                'net_amount_val' => isset($request->net_amount_val) ? $request->net_amount_val :null,
                'business_remarks' => isset($request->business_remarks) ? $request->business_remarks :null,               
            ]);
       }
       else
       {   
         if($data_update->client_type == "Personal")
            {
                WealthPersonal::where('wealth_id',$id)->update([        
                'pass_name_eng' => $request->nfo_pass_name,
                'pass_name_chinese' =>  $request->nfo_pass_name_chinese,
                'gender' =>  $request->nfo_gender,
                'dob' =>  $request->nfo_dob,
                'passport_no' =>  $request->nfo_pass_number,
                'passport_exp_date' =>  $request->nfo_pass_exp,
                'passport_renew' => $request->nfo_pass_reminder,
                'passport_country' =>  $request->nfo_pass_country,
                'passport_trg_fqy' =>  $request->nfo_pass_trg_frq,
                'tin_no' =>  $request->nfo_tin_number,
                'tin_country' =>  $request->nfo_tin_ctry,
                'tin_before_application' =>  $request->nfo_tin_no_before_app,
                'type_of_tin' =>  $request->nfo_tin_type,
                'email' =>  $request->nfo_email,
                'tin_country_before_app' =>  $request->nfo_tin_country_before_app,
                'residential_address' =>  $request->nfo_residential_Add,
                'type_pin_before_app' =>   $request->nfo_tin_type_before_app,
                'employer_industry' =>  $request->nfo_employer_ind,
                'phone' =>  $request->nfo_phone_number,
                'job_title' =>  $request->nfo_current_job_title,
                'employer_name' =>  $request->nfo_emp_name,
            ]); 

            }   
            else
            {
                if(isset($request->cmp))
                {  
                    //  dd($request);
                    // echo'<pre>';print_r($request->corporate);
                    foreach($request->cmp as $k_nfo => $companynfo)
                    {   
                        // $share_keys = $k_nfo;
                       
                        $company_add_nfo =  WealthCompany::updateOrCreate(['id' => $companynfo['id'],'wealth_id' => $id], 
                        ['name' => $companynfo['name'],
                        'uen' => $companynfo['uen'],
                        'address' => $companynfo['address'],
                        'incorporate_date' => $companynfo['incorporate_date'],
                        'relationship' => isset($companynfo['relationship'])? $companynfo['relationship'] :null,
                        'company_email' => $companynfo['company_email'],
                        'company_pass' => $companynfo['company_pass']
                        ]);
                        // echo'<pre>';print_r($request->shrd);
                       
                        foreach($request->share[$k_nfo] as $key4=> $shareholder)
                            {
                                // dd($shareholder);
                                 // echo'<pre>';print_r($shareholder); 
                                // dd($shareholder['id']);
                                // echo'<pre>';print_r($company_add['id']);                                
                                $shareholder_all_nfo = WealthShareholder::updateorCreate(['id'=> $shareholder['id'],'company_id' => $company_add_nfo['id']],
                                [
                                'equity_percentage' => isset($shareholder['equity_percentage']) ? $shareholder['equity_percentage'] : null,
                                'shareholder_type' => isset($shareholder['shareholder_type']) ? $shareholder['shareholder_type'] : null,  
                                'shareholder_company_name' => isset($shareholder['shareholder_company_name']) ? $shareholder['shareholder_company_name'] : null,
                                'pass_name_eng' => isset($shareholder['pass_name_eng']) ? $shareholder['pass_name_eng'] :null,
                                'pass_name_chinese' => isset($shareholder['pass_name_chinese'])? $shareholder['pass_name_chinese']: null,
                                'passport_renew' => isset($shareholder['passport_renew']) ? $shareholder['passport_renew'] :null, 
                                'gender' => isset($shareholder['gender']) ? $shareholder['gender'] : null,
                                'dob' => isset($shareholder['dob'])? $shareholder['dob']  :null,
                                'passport_trg_fqy' => isset($shareholder['passport_trg_fqy'])? $shareholder['passport_trg_fqy']:null,
                                'passport_no' => isset($shareholder['passport_no']) ? $shareholder['passport_no'] :null,
                                'passport_exp_date' =>  isset($shareholder['passport_exp_date']) ? $shareholder['passport_exp_date'] :null,
                                'passport_country' => isset($shareholder['passport_country']) ? $shareholder['passport_country'] :null,
                                'email' => isset($shareholder['email']) ? $shareholder['email'] :null,
                                'phone' => isset($shareholder['phone']) ? $shareholder['phone']:null,
                                'residential_address' => isset($shareholder['residential_address'])? $shareholder['residential_address'] :null,
                                'tin_no' => isset($shareholder['tin_no']) ? $shareholder['tin_no'] :null,
                                'tin_country' => isset($shareholder['tin_country']) ? $shareholder['tin_country'] :null,
                                'type_of_tin' => isset($shareholder['type_of_tin']) ? $shareholder['type_of_tin']: null,
                                'job_title' => isset($shareholder['job_title']) ? $shareholder['job_title'] :null,
                                'monthly_sal' => isset($shareholder['monthly_sal']) ?$shareholder['monthly_sal'] :null,
                                'relation_with_shareholder' => isset($shareholder['relation_with_shareholder']) ? $shareholder['relation_with_shareholder'] :null
                                ]);                       
                            }    
                    }       
                }
            }
            // dd($request);
            $wealth_business_app = WealthBusinessApp::updateOrCreate(
                ['id' => $request->wealth_business_id , 'wealth_id' => $id],
                ['financial_institition_name' => isset($request->financial_institition_name) ? $request->financial_institition_name :null,
                'application_submision' => isset($request->application_submision) ? $request->application_submision :null,
                'business_account_status'=>  isset($request->business_account_status) ? $request->business_account_status :null,
                'business_account_type' => isset($business_account_types) ? $business_account_types :null,
                'business_account_type_specify' => isset($request->business_account_type_specify) ? $request->business_account_type_specify :null,
                'business_account_policy_no'=>  isset($request->business_account_policy_no) ? $request->business_account_policy_no :null,
                'product_name' =>  isset($request->product_name) ? $request->product_name :null,
                'payment_mode' =>  isset($request->payment_mode) ? $request->payment_mode :null,
                'currency'  =>  isset($request->currency) ? $request->currency :null,
                'investment_amount'  =>  isset($request->investment_amount) ? $request->investment_amount :null,
                'online_account_user'=>  isset($request->online_account_user) ? $request->online_account_user :null,
                'online_acc_pass' =>  isset($request->online_acc_pass) ? $request->online_acc_pass :null,
                'subscription' =>  isset($request->subscription) ? $request->subscription :null,
                'maturity_date' =>  isset($request->maturity_date) ? $request->maturity_date :null,
                'business_duration' => isset($request->business_duration) ? $request->business_duration :null,
                'maturity_reminder' => isset($request->maturity_reminder) ? $request->maturity_reminder :null,
                'maturity_reminder_trg' => isset($request->maturity_reminder_trg) ? $request->maturity_reminder_trg :null,
                'commision_status' => isset($request->commision_status) ? $request->commision_status :null,
                'commission_currency' => isset($request->commission_currency) ? $request->commission_currency :null,
                'commission_amount' => isset($request->commission_amount) ? $request->commission_amount :null,
                'business_redemption_date' => isset($request->business_redemption_date) ? $request->business_redemption_date :null,
                'business_redemption_amount' => isset($request->business_redemption_amount) ? $request->business_redemption_amount :null,
                'net_amount_val' => isset($request->net_amount_val) ? $request->net_amount_val :null,
                'business_remarks' => isset($request->business_remarks) ? $request->business_remarks :null,               
            ]);        
    
       }
       
       if($request->notes)  
        {
            
            $notes = new Notes;
            $notes->module_name = $request->tbl_name;
            $notes->application_id = $request->application_id;
            $notes->notes_description = $request->notes;
            $notes->created_by = $request->created_by_name;
            $notes->save();
        }
       $data = (object)(['id'=> Auth::user()->id,        
       'name'=> Auth::user()->name,
       'userID' => $id,
       'module_name' => 'Wealth',
       'old_action' => null,       
       'action_perform'=> serialize($request->toArray()),
       'message'=>'Application Updated',
       ]);
       activity_log($data);
       $response = ['success'=> $data_update];
       return response()->json($response);
    }
    public function upload_file(Request $request)
    {
        // dd($request);
        $request->validate([
            'wealth_inputFile' => 'required|mimes:jpg,png,doc,docx,pdf,ppt,zip|max:100240',
        ]);

        if ($files = $request->file('wealth_inputFile')) {
             
            //store file into document folder
            // $fileName = time().'.'.$request->file->extension();  
            // $request->file->move(public_path('file'), $fileName);
            // $fileName2 = $request->file->extension();
            $f = $files->getClientOriginalName();
            $files->move(public_path('file'), $f);

            $file = new WealthFiles;
            $file->file = $f;
            $file->file_name = $f;
            $file->wealth_id = $request->wealth_id;
            $file->uploaded_by_name = $request->created_by;
            $file->uploaded_by_id = $request->user_id;
            $file->save();      
        } 
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $request->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => null,       
        'action_perform'=> $f,
        'message'=>'Document uploaded '.$f.' for Wealth section',
        ]);
        activity_log($data);
        return response()->json('File uploaded successfully');
    }
    public function delete_file($id)
    {
        // dd($id);
        $file = WealthFiles::find($id);        
        $old_user_data = serialize($file->toArray());
      
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $file->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => $old_user_data,       
        'action_perform'=> null,
        'message'=>'Removed Document '.$file->file_name.' for Wealth section',
        ]);
        activity_log($data);
        $file->delete();

        return response()->json();
    }
    
    public function business_tab_add(Request $request)
    {
        // dd($request);
        $bus_redemption_data = new Wealth_business_redempt;
        $bus_redemption_data->business_id = isset($request->red_id) ? $request->red_id : null;
        $bus_redemption_data->red_date = isset($request->red_date) ? $request->red_date : null;
        $bus_redemption_data->red_amount = isset($request->red_amount) ? $request->red_amount : null;
        $bus_redemption_data->save();

        $response = ['success'=> $bus_redemption_data];
        return response()->json($response);

    }
    public function finance_destroy(Request $request)
    {
        $id = $request->id;
        $finance_data = WealthFinancial::find($id);
        $old_user_data = serialize($finance_data->toArray());
      
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $finance_data->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => $old_user_data,       
        'action_perform'=> null,
        'message'=>'Finance Institution Deleted',
        ]);
        activity_log($data);
        $finance_data->delete();

        return response()->json();

    }
    public function business_destroy(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $business_data_get = Wealth_business_redempt::with('business_data')->find($id);  
       
        $old_data = serialize($business_data_get->toArray());
      
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $business_data_get->business_data->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => $old_data,       
        'action_perform'=> null,
        'message'=>'Business Related Deleted',
        ]);
        activity_log($data);
        $business_data_get->delete();
        $response = ['success'=> $business_data_get];
        return response()->json($response);

    }
    public function company_destroy(Request $request)
    {
        $id = $request->id;
        if(empty($id)){
            return response()->json();
        }
        $finance_data = WealthCompany::find($id);
        $old_user_data = serialize($finance_data->toArray());
      
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $finance_data->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => $old_user_data,       
        'action_perform'=> null,
        'message'=>'Company Deleted',
        ]);
        activity_log($data);
        $finance_data->delete();

        return response()->json();

    }
    public function company_shareholder_destroy(Request $request)
    {
        $id = $request->id;
        if(empty($id)){
            return response()->json();
        }
        $finance_data = WealthShareholder::find($id);
        $old_user_data = serialize($finance_data->toArray());
      
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $finance_data->wealth_id,
        'module_name' => 'Wealth',
        'old_action' => $old_user_data,       
        'action_perform'=> null,
        'message'=>'Company Shareholder Deleted',
        ]);
        activity_log($data);
        $finance_data->delete();

        return response()->json();

    }
}
