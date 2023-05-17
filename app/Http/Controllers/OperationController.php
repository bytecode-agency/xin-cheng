<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperationPassholder;
use App\Models\OperationShareholder;
use App\Models\OperationCompany;
use App\Models\OperationFinancial;
use App\Models\OperationApp;
use App\Models\OperationPr;
use App\Models\WealthFollowup;
use App\Models\Ofile;
use App\Models\Notes;
use App\Models\LogActivity;
use Auth;

use DataTables;

class OperationController extends Controller
{
    public function dashboard(Request $request)
    {
        $rejected = 0;
        $approved = 0;
        $pending = 0;
        $fo = 0;
        $pic = 0;
        $self_emp = 0;
        $emp_g = 0;
        $pr_app = 0;
        $pr_ren = 0;
        $citizen = 0;
        $others = 0;
        $b = 2;
        $data2 = OperationPassholder::all();
        $count_app = OperationPassholder::all()->count();
        //    $ep_sts=OperationPassholder::where('pass_app_type','EP')->get(['pass_app_sts']);
        $ep_sts['pending'] = OperationPassholder::where('pass_app_type', 'EP')->where('pass_app_sts', 'Pending')->count();
        $ep_sts['rejected'] = OperationPassholder::where('pass_app_type', 'EP')->where('pass_app_sts', 'Rejected')->count();
        $ep_sts['approved'] = OperationPassholder::where('pass_app_type', 'EP')->where('pass_app_sts', 'Approved')->count();


        $sp_sts['pending'] = OperationPassholder::where('pass_app_type', 'SP')->where('pass_app_sts', 'Pending')->count();
        $sp_sts['rejected'] = OperationPassholder::where('pass_app_type', 'SP')->where('pass_app_sts', 'Rejected')->count();
        $sp_sts['approved'] = OperationPassholder::where('pass_app_type', 'SP')->where('pass_app_sts', 'Approved')->count();

        $dp_sts['pending'] = OperationPassholder::where('pass_app_type', 'DP')->where('pass_app_sts', 'Pending')->count();
        $dp_sts['rejected'] = OperationPassholder::where('pass_app_type', 'DP')->where('pass_app_sts', 'Rejected')->count();
        $dp_sts['approved'] = OperationPassholder::where('pass_app_type', 'DP')->where('pass_app_sts', 'Approved')->count();

        $lvtp_sts['pending'] = OperationPassholder::where('pass_app_type', 'LVTP')->where('pass_app_sts', 'Pending')->count();
        $lvtp_sts['rejected'] = OperationPassholder::where('pass_app_type', 'LVTP')->where('pass_app_sts', 'Rejected')->count();
        $lvtp_sts['approved'] = OperationPassholder::where('pass_app_type', 'LVTP')->where('pass_app_sts', 'Approved')->count();
        // dd( $lvtp_sts['pending']);
        $wp_sts['pending'] = OperationPassholder::where('pass_app_type', 'WP')->where('pass_app_sts', 'Pending')->count();
        $wp_sts['rejected'] = OperationPassholder::where('pass_app_type', 'WP')->where('pass_app_sts', 'Rejected')->count();
        $wp_sts['approved'] = OperationPassholder::where('pass_app_type', 'WP')->where('pass_app_sts', 'Approved')->count();

        $pr_sts['pending'] = OperationPassholder::where('pass_app_type', 'PR')->where('pass_app_sts', 'Pending')->count();
        $pr_sts['rejected'] = OperationPassholder::where('pass_app_type', 'PR')->where('pass_app_sts', 'Rejected')->count();
        $pr_sts['approved'] = OperationPassholder::where('pass_app_type', 'PR')->where('pass_app_sts', 'Approved')->count();

        $citizen_sts['pending'] = OperationPassholder::where('pass_app_type', 'Citizen')->where('pass_app_sts', 'Pending')->count();
        $citizen_sts['rejected'] = OperationPassholder::where('pass_app_type', 'Citizen')->where('pass_app_sts', 'Rejected')->count();
        $citizen_sts['approved'] = OperationPassholder::where('pass_app_type', 'Citizen')->where('pass_app_sts', 'Approved')->count();

        $oth_sts['pending'] = OperationPassholder::where('pass_app_type', 'Others (please specify)')->where('pass_app_sts', 'Pending')->count();
        $oth_sts['rejected'] = OperationPassholder::where('pass_app_type', 'Others (please specify)')->where('pass_app_sts', 'Rejected')->count();
        $oth_sts['approved'] = OperationPassholder::where('pass_app_type', 'Others (please specify)')->where('pass_app_sts', 'Approved')->count();

        $total_count['pending'] = OperationPassholder::where('pass_app_sts', 'Pending')->count();
        // dd( $total_count['pending']);

        $total_count['rejected'] = OperationPassholder::where('pass_app_sts', 'Rejected')->count();

        $total_count['approved'] = OperationPassholder::where('pass_app_sts', 'Approved')->count();

        // dd($ep_sts);
        foreach ($data2 as $key_od => $val_op) {
            // echo'<pre>';
            // print_r($val_op['pass_app_sts']);
            // echo'</pre>';
            if (isset($val_op['pass_app_sts'])) {
                if ($val_op['pass_app_sts'] == "Rejected") {
                    $rejected++;
                }
                if ($val_op['pass_app_sts'] == "Approved") {
                    $approved++;
                }
                if ($val_op['pass_app_sts'] == "Pending") {
                    $pending++;
                }
            }

            if (isset($val_op['bus_type'])) {
                if ($val_op['bus_type'] == "FO") {
                    $fo++;
                }
                if ($val_op['bus_type'] == "PIC") {
                    $pic++;
                }
                if ($val_op['bus_type'] == "Self-employement") {
                    $self_emp++;
                }
                if ($val_op['bus_type'] == "Employer Guarantee") {
                    $emp_g++;
                }

                if ($val_op['bus_type'] == "PR application") {
                    $pr_app++;
                }
                if ($val_op['bus_type'] == "PR renewal") {
                    $pr_ren++;
                }
                if ($val_op['bus_type'] == "Citizen") {
                    $citizen++;
                }
                if ($val_op['bus_type'] == " Others (please specify)") {
                    $others++;
                }
            }
        }

        //    dd($count_app);
        if ($request->ajax()) {
            return Datatables::of($data2)
                ->editcolumn('id', function ($query) {
                    return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                })
                ->make(true);
        }

        return view('operation.dashboard', compact('b', 'count_app', 'rejected', 'approved', 'pending', 'fo', 'pic', 'self_emp', 'emp_g', 'pr_app', 'pr_ren', 'citizen', 'others', 'ep_sts', 'sp_sts', 'dp_sts', 'lvtp_sts', 'wp_sts', 'pr_sts', 'citizen_sts', 'oth_sts', 'total_count'));
    }
    public function index(Request $request)
    {
        // op_app_shareholder
        // $data = OperationPassholder::with('pass_company.company_share', 'pass_pr', 'pass_company.company_fi')->find($id);

        $data = OperationApp::with('op_app_passholder','op_app_company')->get();

        // $data = OperationPassholder::with('pass_company')->get();
        // dd($data);

        // if(count($query->op_app_passholder) > 0 ){
        //     foreach($query->op_app_passholder as $sh_name)
        //     {
        //         $passhol_name[] = $sh_name->passhol_name;
        //     }
        //     return $passhol_name;
        // }
        // else{

        // }


        if ($request->ajax()) {
            return Datatables::of($data)
                ->editcolumn('id', function ($query) {
                    return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                })
                ->editcolumn('passhol_name', function ($query) {
                    if (count($query->op_app_passholder) > 0) {
                        foreach ($query->op_app_passholder as $p_name) {

                            $passhol_name[] = $p_name->passhol_name;
                        }
                        return $passhol_name;
                    } else {
                        return '-';
                    }
                })
                ->editcolumn('company_name', function ($query) {
                    if (count($query->op_app_company) > 0) {
                        foreach ($query->op_app_company as $c_name) {

                            $company_name[] = $c_name->company_name;
                        }
                        return $company_name;
                    } else {
                        return '-';
                    }
                })
                // ->editcolumn('company_name', function ($query) {
                //     if (count($query->op_app_passholder) > 0) {
                //         foreach ($query->op_app_passholder as $pass_name) {
                //             if (count($pass_name->pass_company) > 1) {
                //                 foreach ($pass_name->pass_company as $comp) {
                //                     return $comp->company_name;
                //                 }
                //             } else {
                //                 return "-";
                //             }
                //         }
                //         // return $company_name;
                //     } else {
                //         return '-';
                //     }
                // })
                ->addColumn('action', 'operation.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('operation.index');
    }
    public function create()
    {

        return view('operation.create');
    }
    public function view($id)
    {
        $data = OperationApp::with('op_app_passholder.pass_pr', 'op_app_company.company_share', 'op_app_company.company_fi')->find($id);

        //   dd($data);
        // foreach($data->op_app_passholder as $pass_hol )
        // {
        //     foreach($pass_hol['pass_pr'] as $pr)
        //     {
        //       dd($pr['pass_id']);
        //     }
        // }


        // $data = OperationPassholder::with('pass_company.company_share', 'pass_pr', 'pass_company.company_fi')->where('op_app_id', $id);
        $notes = Notes::where('module_name', 'Operation')->where('application_id', $id)->get();

        $file = Ofile::where('pass_id', $id)->get();
        // dd($notes);
        $action_log = LogActivity::where('module_name', '=', 'Operation')->where('userID', '=', $id)->orderBy('id','desc')->get();

        return view('operation.view')->with('data', $data)->with('notes', $notes)->with('file', $file)->with('action_log', $action_log);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        //   echo'<pre>';
        //  print_r($request->pr);
        //  echo'</pre>';
        // dd($request->pr);
        $op_app = new OperationApp;
        $op_app->module_name = "Operation";
        $op_app->created_by = $request->created_by;
        $op_app->user_id = $request->uid;
        $op_app->save();
        foreach ($request->pass as $key => $pass_val) {
            $pass_key_share = $key;

            // echo'<pre>';print_r($pass_val );
            $op = new OperationPassholder;
            $op->op_app_id = $op_app->id;
            $op->created_by = $request->created_by;
            $op->user_id = $request->uid;
            $op->bus_type = $pass_val['bus_type'];
            if ($pass_val['bus_type'] == "Others (please specify)") {
                $op->bus_type_specify = $pass_val['bus_type_specify'];
            } else {
                $op->bus_type_specify = " ";
            }
            //    dd($pass_val);
            $op->pass_app_type = $pass_val['pass_app_type'];

            if ($pass_val['pass_app_type'] == "Others (please specify)") {
                $op->pass_app_type_specify = $pass_val['rel_pass_hol_specify'];
            } else {
                $op->pass_app_type_specify = " ";
            }

            if (isset($pass_val['passhol_setup'])) {
                $op->passhol_setup = $pass_val['passhol_setup'];
            } else {
                $op->passhol_setup = 'No';
            }
            if (isset($pass_val['passhol_sharehol'])) {
                $op->passhol_sharehol = $pass_val['passhol_sharehol'];
            } else {
                $op->passhol_sharehol = 'No';
            }
            $op->passhol_name = $pass_val['passhol_name'];
            $op->passport_name = $pass_val['passport_name'];
            $op->pass_dob = $pass_val['pass_dob'];
            $op->pass_gender = $pass_val['pass_gender'];

            $op->pass_exp_dob = $pass_val['pass_exp_dob'];
            $op->passport_number = $pass_val['passport_number'];
            $op->passport_country = $pass_val['passport_country'];
            $op->passport_ren_rem = $pass_val['passport_ren_rem'];

            $op->passport_tin_number = $pass_val['passport_tin_number'];
            $op->passport_rem_fre = $pass_val['passport_rem_fre'];
            $op->email = $pass_val['email'];
            $op->passport_tin_country = $pass_val['passport_tin_country'];

            $op->phno = $pass_val['phno'];
            $op->pass_tin_type = $pass_val['pass_tin_type'];
            $op->finno = $pass_val['finno'];
            $op->res_add = $pass_val['res_add'];

            $op->pass_app_sts = $pass_val['pass_app_sts'];
            $op->pass_iss = $pass_val['pass_iss'];
            $op->pass_iss_date = $pass_val['pass_iss_date'];
            $op->pass_exp_date = $pass_val['pass_exp_date'];
            $op->duration = $pass_val['duration'];
            $op->pass_ren_fre = $pass_val['pass_ren_fre'];

            $op->pass_ren_rem = $pass_val['pass_ren_rem'];
            $op->pass_ren_ter_fre = $pass_val['pass_ren_ter_fre'];
            $op->pass_job_title = $pass_val['pass_job_title'];
            $op->singpass_setup = $pass_val['singpass_setup'];
            $op->pr_app_rem = $pass_val['pr_app_rem'];
            $op->rel_pass_hol = $pass_val['rel_pass_hol'];

            if ($pass_val['rel_pass_hol'] == "Others (please specify)") {
                $op->rel_pass_hol_specify = $pass_val['rel_pass_hol_specify'];
            } else {
                $op->rel_pass_hol_specify = " ";
            }



            $op->emp_name = $pass_val['emp_name'];
            $op->month_sal = $pass_val['month_sal'];
            $op->p_remarks = $pass_val['p_remarks'];



            $op->save();

            // echo'<pre>';print_r($request->pr);

            foreach ($request->pr[$pass_key_share] as $key2 => $pr_val) {
                // print_r( "pass holder key was $key");
                // echo'<pre>';print_r($pr_val);
                $op_pr = new OperationPr;
                $op_pr->user_id = $request->uid;
                $op_pr->created_by = $request->created_by;
                $op_pr->pass_id = $op->id;

                $op_pr->application_date = $pr_val['application_date'];
                $op_pr->application_dep = $pr_val['application_dep'];
                $op_pr->application_sts = $pr_val['application_sts'];


                   if($pr_val['application_sts']=="Rejected")
                {
                    $op_pr->rejection_date = $pr_val['rejection_date'];
                    $op_pr->re_sub_rem = $pr_val['re_sub_rem'];
                    $op_pr->re_sub_sts = $pr_val['re_sub_sts'];
                }
                else
                {
                    $op_pr->approval_date = $pr_val['approval_date'];
                    $op_pr->rep_expiry_date = $pr_val['rep_expiry_date'];
                    $op_pr->rep_ren_rem = $pr_val['rep_ren_rem'];
                }


                $op_pr->rep_ren_trg_fre = $pr_val['rep_ren_trg_fre'];
                $op_pr->re_sub_trg_fre = $pr_val['re_sub_trg_fre'];
                $op_pr->remarks = $pr_val['remarks'];

                $op_pr->save();
            }
        }
        // dd('her');
        // dd($request->cmp);

        if (isset($request->cmp)) {
            foreach ($request->cmp as $key3 => $cmp_val) {

                $op_cmp = new OperationCompany;
                $op_cmp->user_id = $request->uid;

                $op_cmp->created_by = $request->created_by;
                $op_cmp->op_app_id = $op_app->id;
                $op_cmp->company_name = $cmp_val['fo_company'];
                $op_cmp->uen = $cmp_val['fo_uen'];
                $op_cmp->company_add = $cmp_val['fo_company_add'];
                $op_cmp->incorporation_date = $cmp_val['fo_incorporation_date'];
                $op_cmp->company_email = $cmp_val['fo_company_email'];
                $op_cmp->company_pass = $cmp_val['fo_company_pass'];
                if ($cmp_val['fo_company'] != "" || $cmp_val['fo_uen'] != "" || $cmp_val['fo_company_add'] != "") {
                    $op_cmp->save();

                    foreach ($request->share[$key3] as $sh_key => $share_val) {
                        $get_id = OperationPassholder::where('passhol_name', $share_val['passhol_name'])
                            ->where('pass_dob', $share_val['shareholder_dob'])->latest()->first();

                        // get $op->id where  $op_sh->passhol_name=$op->passhol_name and  $op_sh->shareholder_dob=$op->pass_dob

                        // if $op->id!="" $op_sh->pass_id=$op->id else $op_sh->pass_id="";

                        // dd($share_val);
                        $op_sh = new OperationShareholder;
                        $op_sh->cmp_id = $op_cmp->id;
                        if (isset($get_id->id) && ($get_id != null)) {

                            $op_sh->pass_id = $get_id->id;
                        }

                        $op_sh->created_by = $request->created_by;
                        $op_sh->user_id = $request->uid;
                        $op_sh->eqt_per = $share_val['eqt_per'];
                        $op_sh->passhol_name = $share_val['passhol_name'];
                        $op_sh->passport_name = $share_val['passport_name'];
                        $op_sh->shareholder_dob = $share_val['shareholder_dob'];
                        $op_sh->shareholder_gender = $share_val['shareholder_gender'];
                        $op_sh->passport_number = $share_val['passport_number'];
                        $op_sh->passport_country = $share_val['passport_country'];
                        $op_sh->pass_exp_dob = $share_val['pass_exp_dob'];
                        $op_sh->passport_ren_rem = $share_val['passport_ren_rem'];
                        $op_sh->passport_rem_fre = $share_val['passport_rem_fre'];
                        $op_sh->tintype = $share_val['tintype'];
                        $op_sh->tinno = $share_val['tinno'];
                        $op_sh->tincnt = $share_val['tincnt'];
                        $op_sh->phno = $share_val['phno'];
                        $op_sh->res_add = $share_val['res_add'];
                        $op_sh->email = $share_val['email'];
                        $op_sh->job_title = $share_val['job_title'];
                        $op_sh->month_sal = $share_val['month_sal'];
                        $op_sh->rel_share_hol = $share_val['rel_share_hol'];

                        // dd($share_val['p_rel_share_specific']);
                        if ($share_val['rel_share_hol'] == "Others (please specify)") {
                            // dd('yes');
                            $op_sh->rel_pass_hol_specify = $share_val['p_rel_share_specific'];
                        } else {
                            // dd('no');
                            $op_sh->rel_pass_hol_specify  = " ";
                        }



                        $op_sh->remarks = $share_val['remarks'];

                        $op_sh->save();
                    }
                    foreach ($request->fi[$key3] as $fi_key => $fi_val) {
                        // dd($fi_key = $fi_val);
                        $op_fi = new OperationFinancial;
                        $op_fi->user_id = $request->uid;
                        $op_fi->created_by = $request->created_by;
                        $op_fi->cmp_id = $op_cmp->id;
                        $op_fi->poc_name = $fi_val['poc_name'];
                        $op_fi->fi_name = $fi_val['fi_name'];
                        $op_fi->poc_email = $fi_val['poc_email'];
                        $op_fi->poc_cno = $fi_val['poc_cno'];
                        $op_fi->acc_type = $fi_val['acc_type'];

                        if ($fi_val['acc_type'] == "Others (please specify)") {
                            // dd('yes');
                            $op_fi->acc_type_specific = $fi_val['acc_type_specific'];
                        } else {
                            // dd('no');
                            $op_fi->acc_type_specific  = " ";
                        }


                        $op_fi->app_sub = $fi_val['app_sub'];
                        $op_fi->acc_opn_sts = $fi_val['acc_opn_sts'];
                        $op_fi->acc_pol_no = $fi_val['acc_pol_no'];
                        $op_fi->money_dep_sts = $fi_val['money_dep_sts'];

                        $op_fi->acc_crt_sts = $fi_val['acc_crt_sts'];
                        $op_fi->on_acc_usr_nam = $fi_val['on_acc_usr_nam'];
                        $op_fi->on_acc_usr_pass = $fi_val['on_acc_usr_pass'];
                        $op_fi->mat_date = $fi_val['mat_date'];
                        $op_fi->in_dep_amt = $fi_val['in_dep_amt'];
                        $op_fi->remarks = $fi_val['remarks'];

                        $op_fi->save();
                    }
                }
            }
        }
        $data = (object)([
            'id' => $request->uid,
            'name' => $request->created_by,
            'userID' => $op_app->id,
            'module_name' => 'Operation',
            'old_action' => null,
            'action_perform' => serialize($request->toArray()),
            'message' => 'Application Created',
        ]);
        activity_log($data);
        $view_id=$op_app->id;

        return redirect()->route('operation.index', compact('view_id'));
    }
    public function edit($id)
    {
        $data = OperationApp::with('op_app_passholder.pass_pr', 'op_app_company.company_share', 'op_app_company.company_fi')->find($id);
        // $data = OperationPassholder::with('pass_company.company_share', 'pass_pr', 'pass_company.company_fi')->find($id);
        $file = Ofile::where('pass_id', $id)->get();
        $notes = Notes::where('module_name', 'Operation')->where('application_id', $id)->get();
        $action_log = LogActivity::where('module_name', '=', 'Operation')->where('userID', '=', $id)->orderBy('id','desc')->get();
       
        // dd($data);

        return view('operation.edit')->with('data', $data)->with('file', $file)->with('notes', $notes)->with('action_log', $action_log);
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = OperationApp::with('op_app_passholder.pass_pr', 'op_app_company.company_share', 'op_app_company.company_fi')->find($id)->delete();
        // $data = OperationPassholder::with('pass_company.company_share', 'pass_pr', 'pass_company.company_fi')->find($id)->delete();
        return response()->json();
    }
    public function update(Request $request)
    {

    //   dd($request->all());
        foreach ($request->pass as $key => $pass_val) {

            $pass_key_share = $key;

            // echo'<pre>';print_r($pass_val );
            if(isset($pass_val['passholder_id']))
            {
                $op = OperationPassholder::find($pass_val['passholder_id']);

            }
            else
            {
                $op = new OperationPassholder;
                $op->op_app_id=$request->op_app_id;
            }
            // $op = OperationPassholder::find($pass_val['passholder_id']);
            $op->created_by = $request->created_by;
            $op->user_id = $request->uid;

            $op->bus_type = $pass_val['bus_type'];
            if ($pass_val['bus_type'] == "Others (please specify)") {
                $op->bus_type_specify = $pass_val['bus_type_specify'];
            } else {
                $op->bus_type_specify = " ";
            }
            $op->pass_app_type = $pass_val['pass_app_type'];
            if ($pass_val['pass_app_type'] == "Others (please specify)") {
                $op->pass_app_type_specify = $pass_val['rel_pass_hol_specify'];
            } else {
                $op->pass_app_type_specify = " ";
            }
            $op->passhol_setup = $pass_val['passhol_setup'];
            $op->passhol_sharehol = $pass_val['passhol_sharehol'];
            $op->passhol_name = $pass_val['passhol_name'];
            $op->passport_name = $pass_val['passport_name'];
            $op->pass_dob = $pass_val['pass_dob'];
            $op->pass_gender = $pass_val['pass_gender'];

            $op->pass_exp_dob = $pass_val['pass_exp_dob'];
            $op->passport_number = $pass_val['passport_number'];
            $op->passport_country = $pass_val['passport_country'];
            $op->passport_ren_rem = $pass_val['passport_ren_rem'];

            $op->passport_tin_number = $pass_val['passport_tin_number'];
            $op->passport_rem_fre = $pass_val['passport_rem_fre'];
            $op->email = $pass_val['email'];
            $op->passport_tin_country = $pass_val['passport_tin_country'];

            $op->phno = $pass_val['phno'];
            $op->pass_tin_type = $pass_val['pass_tin_type'];
            $op->finno = $pass_val['finno'];
            $op->res_add = $pass_val['res_add'];

            $op->pass_app_sts = $pass_val['pass_app_sts'];
            $op->pass_iss = $pass_val['pass_iss'];
            $op->pass_iss_date = $pass_val['pass_iss_date'];
            $op->pass_exp_date = $pass_val['pass_exp_date'];
            $op->duration = $pass_val['duration'];
            $op->pass_ren_fre = $pass_val['pass_ren_fre'];

            $op->pass_ren_rem = $pass_val['pass_ren_rem'];
            $op->pass_ren_ter_fre = $pass_val['pass_ren_ter_fre'];
            $op->pass_job_title = $pass_val['pass_job_title'];
            $op->singpass_setup = $pass_val['singpass_setup'];
            $op->pr_app_rem = $pass_val['pr_app_rem'];
            $op->rel_pass_hol = $pass_val['rel_pass_hol'];

            if ($pass_val['rel_pass_hol'] == "Others (please specify)") {
                $op->rel_pass_hol_specify = $pass_val['rel_pass_hol_specify'];
            } else {
                $op->rel_pass_hol_specify = " ";
            }

            $op->emp_name = $pass_val['emp_name'];
            $op->month_sal = $pass_val['month_sal'];
            $op->p_remarks = $pass_val['p_remarks'];

            $op->save();

            // echo'<pre>';print_r($request->pr);
if(isset($request->pr[$pass_key_share]))
{
            foreach ($request->pr[$pass_key_share] as $key2 => $pr_val) {
                // print_r( "pass holder key was $key");
                // echo'<pre>';print_r($pr_val);
                // $op_pr = new OperationPr;
                if(isset($pr_val['pr_id']))
                {
                    $op_pr = OperationPr::find($pr_val['pr_id']);

                }
                else
                {
                    $op_pr = new OperationPr;
                    $op_pr->pass_id=$op->id;
                }

                $op_pr->user_id = $request->uid;
                $op_pr->created_by = $request->created_by;
                // $op_pr->pass_id = $op->id;

                $op_pr->application_date = $pr_val['application_date'];
                $op_pr->application_dep = $pr_val['application_dep'];
                $op_pr->application_sts = $pr_val['application_sts'];
                if($pr_val['application_sts']=="Rejected")
                {
                    $op_pr->rejection_date = $pr_val['rejection_date'];
                    $op_pr->re_sub_rem = $pr_val['re_sub_rem'];
                    $op_pr->re_sub_sts = $pr_val['re_sub_sts'];
                }
                else
                {
                    $op_pr->approval_date = $pr_val['approval_date'];
                    $op_pr->rep_expiry_date = $pr_val['rep_expiry_date'];
                    $op_pr->rep_ren_rem = $pr_val['rep_ren_rem'];
                }

                $op_pr->rep_ren_trg_fre = $pr_val['rep_ren_trg_fre'];
                $op_pr->re_sub_trg_fre = $pr_val['re_sub_trg_fre'];
                $op_pr->remarks = $pr_val['remarks'];

                $op_pr->save();
            }
        }
        }
        // dd('her');
        // dd($request->cmp);

        if (isset($request->cmp)) {
            foreach ($request->cmp as $key3 => $cmp_val) {

                // $op_cmp = new OperationCompany;
                if(isset($cmp_val['company_id']))
                {
                    $op_cmp = OperationCompany::find($cmp_val['company_id']);

                }
                else
                {
                    $op_cmp = new OperationCompany;
                    $op_cmp->op_app_id=$request->op_app_id;
                }

                $op_cmp->user_id = $request->uid;

                $op_cmp->created_by = $request->created_by;
                // $op_cmp->pass_id=$op->id;
                $op_cmp->company_name = $cmp_val['fo_company'];
                $op_cmp->uen = $cmp_val['fo_uen'];
                $op_cmp->company_add = $cmp_val['fo_company_add'];
                $op_cmp->incorporation_date = $cmp_val['fo_incorporation_date'];
                $op_cmp->company_email = $cmp_val['fo_company_email'];
                $op_cmp->company_pass = $cmp_val['fo_company_pass'];
                if ($cmp_val['fo_company'] != "" || $cmp_val['fo_uen'] != "" || $cmp_val['fo_company_add'] != "") {
                    $op_cmp->save();
                    if (isset($request->share[$key3])) {
                    foreach ($request->share[$key3] as $sh_key => $share_val) {

                        // $get_id = OperationPassholder::where('passhol_name', $share_val['passhol_name'])
                        //     ->where('pass_dob', $share_val['shareholder_dob'])->latest()->first();

                        // get $op->id where  $op_sh->passhol_name=$op->passhol_name and  $op_sh->shareholder_dob=$op->pass_dob

                        // if $op->id!="" $op_sh->pass_id=$op->id else $op_sh->pass_id="";


                        // $op_sh = new OperationShareholder;
                        if(isset($share_val['share_id']))
                        {
                            $op_sh = OperationShareholder::find($share_val['share_id']);

                        }
                        else
                        {
                            $op_sh = new OperationShareholder;
                            $op_sh->cmp_id = $op_cmp->id;
                        }


                        // if (isset($get_id->id) && ($get_id != null)) {

                        //     $op_sh->pass_id = $get_id->id;
                        // }

                        $op_sh->created_by = $request->created_by;
                        $op_sh->user_id = $request->uid;
                        $op_sh->eqt_per = $share_val['eqt_per'];
                        $op_sh->passhol_name = $share_val['passhol_name'];
                        $op_sh->passport_name = $share_val['passport_name'];
                        $op_sh->shareholder_dob = $share_val['shareholder_dob'];
                        $op_sh->shareholder_gender = $share_val['shareholder_gender'];
                        $op_sh->passport_number = $share_val['passport_number'];
                        $op_sh->passport_country = $share_val['passport_country'];
                        $op_sh->pass_exp_dob = $share_val['pass_exp_dob'];
                        $op_sh->passport_ren_rem = $share_val['passport_ren_rem'];
                        $op_sh->passport_rem_fre = $share_val['passport_rem_fre'];
                        $op_sh->tintype = $share_val['tintype'];
                        $op_sh->tinno = $share_val['tinno'];
                        $op_sh->tincnt = $share_val['tincnt'];
                        $op_sh->phno = $share_val['phno'];
                        $op_sh->res_add = $share_val['res_add'];
                        $op_sh->email = $share_val['email'];
                        $op_sh->job_title = $share_val['job_title'];
                        $op_sh->month_sal = $share_val['month_sal'];
                        $op_sh->rel_share_hol = $share_val['rel_share_hol'];
                        $op_sh->remarks = $share_val['remarks'];

                        $op_sh->save();
                    }
                }
                if (isset($request->fi[$key3])) {
                    foreach ($request->fi[$key3] as $fi_key => $fi_val) {
                        // dd($fi_key = $fi_val);
                        // $op_fi = new OperationFinancial;
                        if(isset($fi_val['fi_id']))
                        {
                            $op_fi = OperationFinancial::find($fi_val['fi_id']);

                        }
                        else
                        {
                            $op_fi = new OperationFinancial;
                            $op_fi->cmp_id = $op_cmp->id;
                        }

                        $op_fi->user_id = $request->uid;
                        $op_fi->created_by = $request->created_by;
                        // $op_fi->cmp_id = $op_cmp->id;
                        $op_fi->poc_name = $fi_val['poc_name'];
                        $op_fi->fi_name = $fi_val['fi_name'];
                        $op_fi->poc_email = $fi_val['poc_email'];
                        $op_fi->poc_cno = $fi_val['poc_cno'];
                        $op_fi->acc_type = $fi_val['acc_type'];
                        $op_fi->app_sub = $fi_val['app_sub'];
                        $op_fi->acc_opn_sts = $fi_val['acc_opn_sts'];
                        $op_fi->acc_pol_no = $fi_val['acc_pol_no'];
                        $op_fi->money_dep_sts = $fi_val['money_dep_sts'];

                        $op_fi->acc_crt_sts = $fi_val['acc_crt_sts'];
                        $op_fi->on_acc_usr_nam = $fi_val['on_acc_usr_nam'];
                        $op_fi->on_acc_usr_pass = $fi_val['on_acc_usr_pass'];
                        $op_fi->mat_date = $fi_val['mat_date'];
                        // $op_fi->in_dep_amt = $fi_val['in_dep_amt'];
                        $op_fi->remarks = $fi_val['remarks'];

                        $op_fi->save();
                    }
                }
                }
            }
        }
        $data = (object)([
            'id' => $request->uid,
            'name' => $request->created_by,
            'userID' => $request->op_app_id,
            'module_name' => 'Operation',
            'old_action' => null,
            'action_perform' => serialize($request->toArray()),
            'message' => 'Application Updated',
        ]);
        activity_log($data);
    }

    public function file_upload(Request $request)
    {
        // dd('hij');
        $request->validate([
            'file' => 'required|mimes:jpg,png,doc,docx,pdf,ppt,zip|max:100240',
        ]);

        // $fileName = time().'.'.$request->file->extension();
        // $request->file->move(public_path('file'), $fileName);
        if ($files = $request->file('file')) {
            $fileName = time().'.'.$request->file->extension();
            $f = $request->file->getClientOriginalName();
            $request->file->move(public_path('file'), $fileName);

            $file = new ofile;
            $file->file = $fileName;
            $file->file_orignal_name = $f;
            $file->pass_id = $request->pass_id;
            $file->uploaded_by = $request->created_by;
            $file->uploaded_by_id = $request->uid;
            $file->save();
        }

        $data = (object)([
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'userID' => $request->pass_id,
            'module_name' => 'Operation',
            'old_action' => null,
            'action_perform' => $f,
            'message' => 'File Uploaded',
        ]);
        activity_log($data);



        return response()->json('File uploaded successfully');
    }
    public function file_del($id)
    {
        // dd($id);
        // $id=$request->id;
        // dd($id);
        $file =  ofile::find($id);
        // return Redirect::back()->with('msg', 'The Message');
        $old_data = serialize($file->toArray());

        $data = (object)([
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'userID' => $file->pass_id,
            'module_name' => 'Operation',
            'old_action' => $old_data,
            'action_perform' => null,
            'message' => 'File Deleted',
        ]);
        activity_log($data);

        $file->delete();
        return response()->json();
    }
}
