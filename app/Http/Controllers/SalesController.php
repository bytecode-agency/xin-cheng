<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sfile;
use App\Models\Note;
use DataTables;
use Redirect;
use Carbon\Carbon;
use App\Models\LogActivity;
use App\Models\Notes;
use Illuminate\Support\Facades\DB;
use Auth;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data = Sale::all();


        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                // ->editColumn('b2b_agr_sign_date', function ($query) {
                //     return $query->b2b_agr_sign_date->format('d/m/Y');
                // })
                ->editcolumn('id', function ($query) {
                    return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                })
                ->editColumn('b2b_agr_sign_date', function ($query) {
                    return \Carbon\Carbon::parse($query->b2b_agr_sign_date)->isoFormat('DD/MM/YYYY');
                    // return $query->b2b_agr_sign_date;
                })
                ->editcolumn('b2b_sign', function ($query) {
                    if ($query->b2b_sign == "") {
                        return "No";
                    } else
                        return $query->b2b_sign;
                })
                // ->removeColumn('id')
                ->addColumn('action', 'sales.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('sales.index');
    }

    public function dashboard(Request $request)

    {
        if(isset($request->period))
        {
        dd($request->period);
        }
        $applications = DB::table('sales')->where('created_at', 'like', '%2023%')->count();
        $data5 = Sale::all();
      $nogb=$data5;
      $wm_count=0;
      $ip_count=0;
      $rp_count=0;
      $fo_count=0;
      $pass_count=0;
      $pim_count=0;
      $ac_count=0;
      $ed_count=0;
      $bao_count=0;
      $oth_count=0;

      $wm_f_count=0;
      $ip_f_count=0;
      $rp_f_count=0;
      $fo_f_count=0;
      $pass_f_count=0;
      $pim_f_count=0;
      $ac_f_count=0;
      $ed_f_count=0;
      $bao_f_count=0;
      $oth_f_count=0;



      foreach($nogb as $key_nogb => $val_nogb)
      {


        $un_nogb=unserialize($val_nogb['type_bus_gen']);
        // echo'<pre>';
        // print_r($un_nogb);
        //       echo'</pre>';
              foreach($un_nogb as $key_un_nogb => $val_un_nogb)
        if(array_key_exists("g_drp",$val_un_nogb))
        {
        //     echo'<pre>';
        // print_r($val_un_nogb['g_drp']);
        //       echo'</pre>';

              if($val_un_nogb['g_drp']=="Wealth Management")
              {

                 $wm_f_count=$wm_count + 1;
                 $wm_count++;

              }
              elseif($val_un_nogb['g_drp']=="Immigration Programme")
              {

                 $ip_f_count=$ip_count + 1;
                 $ip_count++;

              }
              elseif( $val_un_nogb['g_drp'] && $val_un_nogb['g_drp']=="Passport")
              {

                 $pass_f_count=$pass_count + 1;
                 $pass_count++;

              }
              elseif($val_un_nogb['g_drp']=="Education")
              {

                 $ed_f_count=$ed_count + 1;
                 $ed_count++;

              }
              elseif($val_un_nogb['g_drp']=="Family Office")
              {

                 $fo_f_count=$fo_count + 1;
                 $fo_count++;

              }
              elseif($val_un_nogb['g_drp']=="Bank Account Opening")
              {

                 $bao_f_count=$bao_count + 1;
                 $bao_count++;

              }
              elseif($val_un_nogb['g_drp']=="Account Services")
              {

                 $ac_f_count=$ac_count + 1;
                 $ac_count++;

              }
              elseif($val_un_nogb['g_drp']=="Pure Identity Management")
              {

                 $pim_f_count=$pim_count + 1;
                 $pim_count++;

              }
              elseif($val_un_nogb['g_drp']=="Real Property")
              {

                 $rp_f_count=$rp_count + 1;
                 $rp_count++;

              }
              else
              {
                $oth_f_count=$oth_count + 1;
                $oth_count++;
              }

        }



      }

    //   print_r("count of wm is $wm_f_count");

    //   foreach()
    //   dd($nogb);

        // dd($applications);
        $datas = Sale::all();
        $b2b = DB::table('sales')->where('bus_type', 'B2B')->where('created_at', 'like', '%2023%')->count();
        $b2c = DB::table('sales')->where('bus_type', 'B2C')->where('created_at', 'like', '%2023%')->count();
        $bus_type = array(
            'B2B' => $b2b,
            'B2C' => $b2c,
        );
        $personal = DB::table('sales')->where('client_type', 'Personal')->where('created_at', 'like', '%2023%')->count();
        $corporate = DB::table('sales')->where('client_type', 'Corporate')->where('created_at', 'like', '%2023%')->count();
        $client_type = array(
            'personal' => $personal,
            'corporate' => $corporate,
        );
        $sign_yes = DB::table('sales')->where('b2b_sign', 'Yes')->where('created_at', 'like', '%2023%')->count();
        $sign_no = DB::table('sales')->where('b2b_sign', '!=', 'Yes')->where('created_at', 'like', '%2023%')->count();
        $sign = array(
            'sign_yes' => $sign_yes,
            'sign_no' => $sign_no,
        );
        // dd($bus_type);
        $amt = 0;
        foreach ($datas as $data) {
            if (isset($data->type_pot_bus)) {
                $topbs = unserialize($data->type_pot_bus);
                if (isset($topbs)) {
                    foreach ($topbs as $topb) {
                        if (is_numeric($topb['busamt'])) {
                            $amt += $topb['busamt'];
                        }
                    }
                }
            }
        }
        foreach ($datas as $data) {
            if (isset($data->type_bus_gen)) {
                $tbgs = unserialize($data->type_bus_gen);
                if (isset($tbgs)) {
                    foreach ($tbgs as $tbg) {
                        if (is_numeric($tbg['g_busamt'])) {
                            $amt += $tbg['g_busamt'];
                        }
                    }
                }
            }
        }


        $data2 = Sale::all();



        if ($request->ajax()) {

            return Datatables::of($data2)
                // ->addIndexColumn()
                // ->editColumn('b2b_agr_sign_date', function ($query) {
                //     return $query->b2b_agr_sign_date->format('d/m/Y');
                // })
                // ->editColumn('b2b_agr_sign_date', function ($query) {
                //     return \Carbon\Carbon::parse($query->b2b_agr_sign_date )->isoFormat('DD/MM/YYYY');
                // })
                // ->removeColumn('id')
                // ->addColumn('action','sales.action')
                // ->rawColumns(['action'])
                ->make(true);
        }
        return view('sales.dashboard')->with('applications', $applications)->with('amt', $amt)->with('bus_type', $bus_type)->with('client_type', $client_type)->with('sign', $sign)->with('wm', $wm_f_count)->with('rp', $rp_f_count)->with('fo', $fo_f_count)->with('rp', $rp_f_count)->with('wm', $wm_f_count)->with('bao', $bao_f_count)->with('ac', $ac_f_count)->with('ed', $ed_f_count)->with('pim', $pim_f_count)->with('oth', $oth_f_count)->with('ip', $ip_f_count)->with('pass', $pass_f_count);
    }

    public function create()
    {
        return view('sales.create');
    }
    public function show(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $sale = Sale::where('id', $id)->first();
        $sale = ($sale) ? $sale : new Sale;

        // $action_log = LogActivity::where('module_name','=','Wealth')->where('userID','=',$id)->orderBy('id','desc')->get();

        $action_log = LogActivity::where('module_name', '=', 'Sale Application')->where('userID', '=', $id)->orderBy('id','desc')->get();
        $file = Sfile::where('sale_app_id', $id)->get();
        $notes = Notes::where('module_name','Sale Application')->where('application_id',$id)->get();


        return view('sales.view', compact('sale', 'action_log', 'file','notes'));
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $notes = Notes::where('module_name','Sale Application')->where('application_id',$id)->get();
        $sale = Sale::where('id', $id)->first();
        $file = Sfile::where('sale_app_id', $id)->get();
        $action_log = LogActivity::where('module_name', '=', 'Sale Application')->where('userID', '=', $id)->orderBy('id','desc')->get();

        // dd($action_log);
        // dd($sale);
        return view('sales.edit', compact('sale', 'file', 'action_log','notes'));
    }
    public function store(Request $request)
    {
        // dd($request->addbg);
        //  dd($request->all());
        $typeofpotentialbus = $request->addpb;
        foreach ($typeofpotentialbus as $key => $val) {
            if (isset($val['drp'])) {
                if ($val['drp'] == "Others") {
                    $typeofpotentialbus[$key]['drp'] = $request->topb_drp_spc[$key];
                }
            }
            // echo'<pre>';
            // print_r($val['drp']);
            // echo'</pre>';
        }
        // dd($typeofpotentialbus);


        $typeofbusgen = $request->addbg;

        foreach ($typeofbusgen as $key => $val) {


            // if(isset($val['g_drp']))
            // {
            if (isset($val['g_drp']) && $val['g_drp'] == "Others") {

                $typeofbusgen[$key]['g_drp'] = $request->togb_drp_spc[$key];
                // print_r($request->togb_drp_spc[$key]);

            }

            // print_r($typeofbusgen[$key]['g_drp']);
            //  }
            // echo'<pre>';

            // echo'</pre>';
        }
        // dd($typeofbusgen);


        $topb = serialize($typeofpotentialbus);
        $tobg = serialize($typeofbusgen);

        $sale = new Sale;
        $sale->notes = '';
        $sale->bus_type = $request->business;
        $sale->client_type = $request->client;
        $sale->client_name = $request->cname;
        $sale->client_country = $request->ccountry;
        $sale->client_city = $request->ccity;
        $sale->client_sts = "Active";

        $sale->poc_ph = $request->pocph;
        $sale->poc_name = $request->pocname;
        $sale->poc_email = $request->pocemail;
        $sale->poc_wechat = $request->pocwechat;
        $sale->source_of_client = $request->source_of_client;
        $sale->source_of_client_specify = $request->source_of_client_specify;
        $sale->b2b_sign = $request->sign;
        $sale->b2b_agr_sign_date = $request->b2bsigndate;
        $sale->b2b_agr_exp_date = $request->b2bexdate;
        $sale->agr_ren_rem = $request->renewlrem;
        $sale->agr_ren_fre = $request->renewlfre;
        $sale->created_by = $request->created_by;


        $sale->type_pot_bus = $topb;
        $sale->type_bus_gen = $tobg;
        // dd($request->created_by);

        $sale->save();

        $data = (object)([
            'id' => $request->uid,
            'name' => $request->created_by,
            'userID' => $sale->id,
            'module_name' => 'Sale Application',
            'old_action' => null,
            'action_perform' => serialize($request->toArray()),
            'message' => 'Application Created',
        ]);
        activity_log($data);
        $view_id=$sale->id;
        return redirect()->route('sales', compact('view_id'));
    }

    public function destroy($id)
    {
        Sale::find($id)->delete();
        return response()->json();

        // return redirect()->route('sales')
        //                 ->with('success','User deleted successfully');
    }

    public function update(Request $request)
    {
        //    dd($request->togb_drp_spc);
        //   dd($request->all());

        $id = $request->sale_id;

        $sale = Sale::find($id);
        // dd($sale);

        $old_user_data = serialize($sale->toArray());


        $typeofpotentialbus = $request->addpb;
        foreach ($typeofpotentialbus as $key => $val) {

            if (isset($val['drp']) && $val['drp'] == "Others") {
                if(isset($request->topb_drp_spc[$key]) && $request->topb_drp_spc[$key]!="")
                {
                    $typeofpotentialbus[$key]['drp'] = $request->topb_drp_spc[$key];

                }
                else
                {
                    $typeofpotentialbus[$key]['drp'] = '';
                }
            }
            // echo'<pre>';
            // print_r($val['drp']);
            // echo'</pre>';
        }
        // dd($typeofpotentialbus);


        $typeofbusgen = $request->addbg;
        foreach ($typeofbusgen as $key => $val) {


            if (isset($val['g_drp']) && $val['g_drp'] == "Others") {
                if(isset($request->togb_drp_spc[$key]) && $request->togb_drp_spc[$key]!="")
                {
                    // dd('abc');
                $typeofbusgen[$key]['g_drp'] =$request->togb_drp_spc[$key];
                }
                else
                {
                    $typeofbusgen[$key]['g_drp'] = '';
                    }
                // print_r($request->togb_drp_spc[$key]);

            }
        }

        // $typeofpotentialbus = $request->addpb;
        // $typeofbusgen = $request->addbg;


        $topb = serialize($typeofpotentialbus);
        $tobg = serialize($typeofbusgen);

        //    $sale->notes = $request->notes;
        $sale->bus_type = $request->business;
        $sale->client_type = $request->client;
        $sale->client_name = $request->cname;
        $sale->client_country = $request->ccountry;
        $sale->client_city = $request->ccity;
        $sale->client_sts = $request->csts;

        $sale->poc_ph = $request->pocph;
        $sale->poc_name = $request->pocname;
        $sale->poc_email = $request->pocemail;
        $sale->poc_wechat = $request->pocwechat;
        $sale->source_of_client = $request->source_of_client;
        $sale->source_of_client_specify = $request->source_of_client_specify;
        $sale->b2b_sign = $request->sign;
        $sale->b2b_agr_sign_date = $request->b2bsigndate;
        $sale->b2b_agr_exp_date = $request->b2bexdate;
        $sale->agr_ren_rem = $request->renewlrem;
        $sale->agr_ren_fre = $request->renewlfre;
        $sale->created_by = $request->created_by;


        $sale->type_pot_bus = $topb;
        $sale->type_bus_gen = $tobg;

        $sale->save();

        $data = (object)([
            'id' => $request->uid,
            'name' => $request->created_by,
            'userID' => $sale->id,
            'module_name' => 'Sale Application',
            'old_action' => $old_user_data,
            'action_perform' => serialize($request->toArray()),
            'message' => 'Application Updated',
        ]);
        activity_log($data);
        return redirect()->route('sales');
    }

    public function notes(Request $request)
    {
        //    dd($request->notes);
        $id = $request->id;
        // dd($id);

        $sale = Sale::find($id);

        $sale->notes = $request->notes;


        $sale->save();


        return redirect()->route('sales');
    }
    public function note(Request $request)
    {
        // $id= $request->id;
        // dd($request->all());
        $note = new Note;
        $note->note = $request->notes;
        $note->created_by = $request->created_by;
        $note->created_by_id = $request->uid;
        $note->app_id = $request->sale_id;
        $note->page = $request->page;

        $note->save();
        $id = $request->sale_id;
        // if($request->page=="sales.view")
        // {
        // return redirect()->route('sales.show', $id)
        // ->with('success','Note created');
        // }
        // if($request->page=="sales.edit")
        // {
        return redirect()->route('sales.edit', $id)
            ->with('success', 'Note created');
        // }

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

        $file = new Sfile;
        $file->file = $fileName;
        $file->file_orignal_name = $f;
        $file->sale_app_id = $request->sale_id;
        $file->uploaded_by = $request->created_by;
        $file->uploaded_by_id = $request->uid;
        $file->save();
        }
        // File::create(['name' => $fileName]);
        $data = (object)(['id'=> Auth::user()->id,
        'name'=> Auth::user()->name,
        'userID' => $request->sale_id,
        'module_name' => 'Sale Application',
        'old_action' => null,
        'action_perform'=> $f,
        'message'=>'Document uploaded '.$f.' for Wealth section',
        ]);
        activity_log($data);


        //All files
        $file       = Sfile::where('sale_app_id', $request->sale_id)->get();
        $files_view = \View::make('sales.files_table_body' , ['file'=>$file])->render();

        return response()->json(['message'=>'File uploaded successfully' , 'files_view' => $files_view]);
    }
    public function file_del($id)
    {
        // dd($id);
        // $id=$request->id;
        // dd($id);
        $file=  Sfile::find($id);
        // return Redirect::back()->with('msg', 'The Message');
        $old_data = serialize($file->toArray());

        $data = (object)(['id'=> Auth::user()->id,
        'name'=> Auth::user()->name,
        'userID' => $file->sale_app_id,
        'module_name' => 'Sale Application',
        'old_action' => $old_data,
        'action_perform'=> null,
        'message'=>'Removed Document '.$file->file_orignal_name.' for seles section',
        ]);
        activity_log($data);
        $file->delete();
        return response()->json();
    }
}
