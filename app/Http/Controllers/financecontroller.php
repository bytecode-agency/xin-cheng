<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use App\Models\Financial;
use App\Models\Companie;
use App\Models\Shareholder;

use DataTables;

class financecontroller extends Controller
{
    public function newapp()
    {
      return view('finance.newapplication');
    }

    public function appstore(Request $request)
    {
      // echo "<pre>";print_r($request->all());exit;
          // print_r($request->share);
            $company_rep=serialize($request->cmp);
            $share_rep=serialize($request->share);
            $finance_rep=serialize($request->fin);
            $payment_rep=serialize($request->payment);
            $report_rep=serialize($request->report);


        if(($request->client) =="Personal"){

            $finance=new Finance;
            $finance->client_type = $request->client;
            $finance->bus_type = $request->business;
            $finance->bus_des = $request->businessdes;
            $finance->pname = $request->pname;
            $finance->pnamec = $request->pnamec;
            $finance->pgender = $request->pgender;
            $finance->pdob = $request->pdob;
            $finance->pnumber = $request->pnumber;
            $finance->pexdate = $request->pexdate;
            $finance->prenrem = $request->prenrem;
            $finance->pcountry = $request->pcountry;
            $finance->premtr = $request->premtf;
            $finance->ptinnumber = $request->ptinnumber;
            $finance->ptincountry = $request->ptincountry;
            $finance->ptypetin = $request->ptypetin;
            $finance->pphoneno = $request->pphoneno;
            $finance->pemail = $request->pemail;
            $finance->paddress = $request->paddress;
            $finance->premarks = $request->premarks;
            // $finance->companies = '-';
            // $finance->shareholders = $request->pname;
            // $finance->financial = '-';
            $finance->payment_rep = $payment_rep;
            $finance->report_rep = $report_rep;
            $finance->created_by = $request->create_by;

            $finance->save();
           return 1;

        }
        else
        {

           $s_name="";
           foreach($request->share as $key =>$value){
            foreach($value as $ke =>$val){                 //shareholders name
              if($s_name==""){
                $s_name=$val['pname'];
              }else{
                if($val['pname']!=""){
                $s_name.=",".$val['pname'];
                }
              }
            }
          }
          // foreach($request->share as $key =>$value){
          //   foreach($value as $ke =>$val){                 //shareholders name
          //     if($s_name==""){
          //       $s_name=$val['pname'];
          //     }else{
          //     $s_name.=",".$val['pname'];
          //     }
          //   }
          // }
          // dd($s_name);

          $finance=new Finance;
          $finance->client_type = $request->client;
          $finance->bus_type = $request->business;
          $finance->bus_des = $request->businessdes;          // Finance
          $finance->pname = $s_name;
          $finance->payment_rep = $payment_rep;
          $finance->report_rep = $report_rep;
          $finance->created_by = $request->create_by;

          $finance->save();

          // $financeid = $finance->id();

                                                           // company

          if(isset($request->cmp))
        {
            foreach($request->cmp as $key=> $company)
            {
                // echo'<pre>';print_r($company['fo_company']);
                $company_add = new Companie;
                $company_add->c_name = $company['fo_company'];
                $company_add->c_uen = $company['fo_uen'];
                $company_add->c_address= $company['fo_company_add'];
                $company_add->c_date = $company['fo_incorporation_date'];
                $company_add->c_email = $company['fo_company_email'];
                $company_add->c_password = $company['fo_company_pass'];
                $company_add->finance_id = $finance->id;
                $company_add->save();
                // echo'<pre>';print_r($company);

                foreach($request->share[$key] as $key2=> $shareholder)
                {
                    // echo'<pre>';print_r($shareholder);                       //shareholders
                $shareholder_all = new Shareholder;
                // $shareholder_all->company_id = $company_add->id;
                $shareholder_all->fo_equity = $shareholder['equity_percentage'];
                $shareholder_all->pname = $shareholder['pname'];
                $shareholder_all->pnamec = $shareholder['pnamec'];
                $shareholder_all->prenrem = $shareholder['prenrem'];
                $shareholder_all->pdob = $shareholder['pdob'];
                $shareholder_all->premtf = $shareholder['premtf'];
                $shareholder_all->pgender = $shareholder['pgender'];
                $shareholder_all->pnumber = $shareholder['pnumber'];
                $shareholder_all->pexdate = $shareholder['pexdate'];
                $shareholder_all->pcountry = $shareholder['pcountry'];
                $shareholder_all->pemail = $shareholder['pemail'];
                $shareholder_all->pphoneno = $shareholder['pphoneno'];
                $shareholder_all->paddress = $shareholder['paddress'];
                $shareholder_all->ptincountry = $shareholder['ptincountry'];
                $shareholder_all->ptinnumber = $shareholder['ptinnumber'];
                $shareholder_all->ptypetin = $shareholder['ptypetin'];
                $shareholder_all->jtitle = $shareholder['jtitle'];
                $shareholder_all->msalary = $shareholder['msalary'];
                $shareholder_all->rl_with_sh = $shareholder['rl_with_sh'];
                $shareholder_all->premarks = $shareholder['premarks'];
                $shareholder_all->c_id = $company_add->id;


                $shareholder_all->save();
                }

                foreach($request->fin[$key] as $key2=> $finstitution)
                {
                    // echo'<pre>';print_r($finstitution);
                $finstitution_all = new Financial;
                // $shareholder_all->company_id = $company_add->id;
                $finstitution_all->i_name = $finstitution['i_name'];
                $finstitution_all->ba_app_sub = $finstitution['ba_app_sub'];
                $finstitution_all->ac_open_sta = $finstitution['ac_open_sta'];
                $finstitution_all->ac_type = $finstitution['ac_type'];
                $finstitution_all->ac_number = $finstitution['ac_number'];
                $finstitution_all->bank_ac_sta = $finstitution['bank_ac_sta'];
                $finstitution_all->remarks = $finstitution['remarks'];

                $finstitution_all->c_id = $company_add->id;


                $finstitution_all->save();
                }
            }
        }


          return 2;
        }
      // print_r($finance);


    }



    public function showapp(Request $request)
    {
      // $data =Finance::all();
      $data= array();
      $data = Finance::with('companies.shareholders','companies.financial')->get();

      // dd($data);

      if ($request->ajax()) {
          return Datatables::of($data)
                  ->addIndexColumn()
                  // ->editColumn('b2b_agr_sign_date', function ($query) {
                  //     return $query->b2b_agr_sign_date->format('d/m/Y');
                  // })
                  ->editcolumn('id',function($query){
                      return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                  })
                  ->editColumn('companies', function ($query) {
                    $company_nme = array();
                    if(count($query->companies) > 0 ){
                        foreach($query->companies as $cmp_name)
                        {
                            $company_nme[] = $cmp_name->c_name;
                        }
                        return $company_nme;
                    }
                    else
                    {
                        return '-';
                    }
                    })
                  // ->removeColumn('id')
                  ->addColumn('action','finance.action')
                  ->rawColumns(['action'])
                  ->make(true);
      }
       return view('finance.allapps');
    }

    public function destroy(Request $request)
    {
      // echo "<pre>";print_r($request->all());exit;

      // dd($request->id);

       $get_data =  Finance::find($request->id);

       if($get_data->client_type == "Personal")
       {
        Finance::where('id',$request->user)->delete();
           return 1;
        //  WealthBusiness::where('wealth_id','=',$get_data->id)->delete();
        //  $company_id= WealthCompany::where('wealth_id','=',$get_data->id)->get();
        //  foreach($company_id as $key=>$companies)
        //  {
        //     // WealthCompany::where('wealth_id','=',$companies->id)->delete();
        //     // foreach($companies as $key2=> $shareholder)
        //     // {

        //         // WealthShareholder::where('company_id','=',$shareholder)->delete();
        //     // }
        //  }
       }
       else
       {

          Finance::where('id', $request->id)->delete();

          $c_id=Companie::where('finance_id' ,'=', $request->id)->get();

      // echo "<pre>";print_r($c_id);exit;
          // print_r($c_id);
          foreach($c_id as $key =>$companies)
          {
            // dd($companies->finance_id);
            Companie::where('finance_id', $companies->finance_id)->delete();
            // echo "<pre>";print_r($companies);exit;

            // foreach($companies as $key2 => $shareholder){
            //   // dd($shareholder->finance_id);
            //    Shareholder::where('c_id','=',$shareholder->c_id)->delete();
            // }

            // foreach($companies as $key3 => $financial){
            //   Financial::where('c_id','=',$financial->c_id)->delete();
            // }

          }

          foreach($c_id as $key =>$companies)
          {
            Shareholder::where('c_id',$companies->c_id)->delete();
          }

          foreach($c_id as $key =>$companies)
          {
            Financial::where('c_id',$companies->c_id)->delete();
          }


          return 2;
       }
        // Wealth_FO::where('wealth_id',$id)->delete();
        // Wealth_NFO::where('wealth_id',$id)->delete();

        // return response()->json();

        //        echo "<pre>";print_r($request->all());exit;
        //        Finance::where('id',$request->user)->delete();

    }



    public function showdetails(Request $request)
    {
      //  dd($request->id);
      $data = Finance::with('companies.shareholders','companies.financial')->find($request->id);
       $report= Finance::where('id',$request->id)->value('report_rep');
      // dd($report);
      $report_rep=unserialize($report);
      $payment= Finance::where('id',$request->id)->value('payment_rep');
      $payment_rep=unserialize($payment);
      // dd($payment_rep);
            // echo "<pre>";print_r($data);exit;
            return view('finance.view',compact('data','report_rep','payment_rep'));
    }


    public function editdetails(Request $request)
    {
      //  dd($request->id);
      $data = Finance::with('companies.shareholders','companies.financial')->find($request->id);
       $report= Finance::where('id',$request->id)->value('report_rep');
      // dd($report);
      $report_rep=unserialize($report);
      $payment= Finance::where('id',$request->id)->value('payment_rep');
      $payment_rep=unserialize($payment);
      // dd($payment_rep);
            // echo "<pre>";print_r($data);exit;
            return view('finance.edit',compact('data','report_rep','payment_rep'));
    }



    public function appupdate(Request $request)
    {
                  // echo "<pre>";print_r($request->all());exit;
            // echo "<pre>";print_r($request->all());exit;
          // print_r($request->share);
          $company_rep=serialize($request->cmp);
          $share_rep=serialize($request->share);
          $finance_rep=serialize($request->fin);
          $payment_rep=serialize($request->payment);
          $report_rep=serialize($request->report);


      if(($request->client) =="Personal"){

         $finance =Finance::updateOrCreate([
           'id'=>$request->finance_id,
         ],                                                  // Finance
         [
           'client_type' => $request->client,
           'bus_type' => $request->business,
           'bus_des' => $request->businessdes,
           'pname' => $request->pname,
           'pnamec' => $request->pnamec,
           'pgender' => $request->pgender,
           'pdob' => $request->pdob,
           'pnumber' => $request->pnumber,
           'pexdate' => $request->pexdate,
           'prenrem' => $request->prenrem,
           'pcountry' => $request->pcountry,
           'premtr' => $request->premtf,
           'ptinnumber' => $request->ptinnumber,
           'ptincountry' => $request->ptincountry,
           'ptypetin' => $request->ptypetin,
           'pphoneno' => $request->pphoneno,
           'pemail' => $request->pemail,
           'paddress' => $request->paddress,
           'premarks' => $request->premarks,

           'payment_rep' => $payment_rep,
           'report_rep' => $report_rep,
           'created_by' => $request->create_by

         ]);
          // $finance=new Finance;
          // $finance->client_type = $request->client;
          // $finance->bus_type = $request->business;
          // $finance->bus_des = $request->businessdes;
          // $finance->pname = $request->pname;
          // $finance->pnamec = $request->pnamec;
          // $finance->pgender = $request->pgender;
          // $finance->pdob = $request->pdob;
          // $finance->pnumber = $request->pnumber;
          // $finance->pexdate = $request->pexdate;
          // $finance->prenrem = $request->prenrem;
          // $finance->pcountry = $request->pcountry;
          // $finance->premtr = $request->premtf;
          // $finance->ptinnumber = $request->ptinnumber;
          // $finance->ptincountry = $request->ptincountry;
          // $finance->ptypetin = $request->ptypetin;
          // $finance->pphoneno = $request->pphoneno;
          // $finance->pemail = $request->pemail;
          // $finance->paddress = $request->paddress;
          // $finance->premarks = $request->premarks;
          // // $finance->companies = '-';
          // // $finance->shareholders = $request->pname;
          // // $finance->financial = '-';
          // $finance->payment_rep = $payment_rep;
          // $finance->report_rep = $report_rep;
          // $finance->created_by = $request->create_by;

          // $finance->save();
         return 1;

      }
      else
      {

         $s_name="";
        foreach($request->share as $key =>$value){
          foreach($value as $ke =>$val){                 //shareholders name
            if($s_name==""){
              $s_name=$val['pname'];
            }else{
              if($val['pname']!=""){
              $s_name.=",".$val['pname'];
              }
            }
          }
        }
        // dd($s_name);
        // dd($request->finance_id);
        $finance =Finance::updateOrCreate([
          'id'=>$request->finance_id,
        ],                                                  // Finance
        [
           'client_type' => $request->client,
           'bus_type' => $request->business,
           'bus_des' => $request->businessdes,
           'pname' => $s_name,
           'payment_rep' => $payment_rep,
           'report_rep' => $report_rep,
           'created_by' => $request->create_by

        ]);

        // $financeid = $finance->id();

                                                         // company

        if(isset($request->cmp))
      {
          foreach($request->cmp as $key=> $company)
          {
              // echo'<pre>';print_r($company['fo_company']);
              // $company_add = new Companie;
              $company_add =Companie::updateOrCreate([
                'id' => $company['c_id'],
                'finance_id'=>$request->finance_id,
              ],
              [                                                         // Company
                 'c_name' => $company['fo_company'],
                 'c_uen' => $company['fo_uen'],
                 'c_address' => $company['fo_company_add'],
                 'c_date' => $company['fo_incorporation_date'],
                 'c_email' => $company['fo_company_email'],
                 'c_password' => $company['fo_company_pass'],
                //  'finance_id' => $finance->id

              ]);
              // echo'<pre>';print_r($company);

              foreach($request->share[$key] as $key2=> $shareholder)
              {
                  // echo'<pre>';print_r($shareholder);                       //shareholders

                  $shareholder_all =Shareholder::updateOrCreate([
                    'id' => $shareholder['s_id'],
                    'c_id'=> $shareholder['c_id'],
                  ],
                  [
                     'fo_equity' => $shareholder['fo_equity'],
                     'pname' => $shareholder['pname'],
                     'pnamec' => $shareholder['pnamec'],
                     'prenrem' => $shareholder['prenrem'],
                     'pdob' => $shareholder['pdob'],
                     'premtf' => $shareholder['premtf'],
                     'pgender' => $shareholder['pgender'],
                     'pnumber' => $shareholder['pnumber'],
                     'pexdate' => $shareholder['pexdate'],
                     'pcountry' => $shareholder['pcountry'],
                     'pemail' => $shareholder['pemail'],
                     'pphoneno' => $shareholder['pphoneno'],
                     'paddress' => $shareholder['paddress'],
                     'ptincountry' => $shareholder['ptincountry'],
                     'ptinnumber' => $shareholder['ptinnumber'],
                     'ptypetin' => $shareholder['ptypetin'],
                     'jtitle' => $shareholder['jtitle'],
                     'msalary' => $shareholder['msalary'],
                     'rl_with_sh' => $shareholder['rl_with_sh'],
                     'premarks' => $shareholder['premarks'],
                     'c_id' => $company['c_id'],

                  ]);
              // dd($shareholder_all);
              }

              foreach($request->fin[$key] as $key2=> $finstitution)
              {
                  // echo'<pre>';print_r($finstitution);
              // $finstitution_all = new Financial;
              // $shareholder_all->company_id = $company_add->id;
              $finstitution_all =Financial::updateOrCreate([
                'id' =>$finstitution['f_id'],
                'c_id'=>$finstitution['c_id'],                           //shareholders
              ],
              [
                 'i_name' => $finstitution['i_name'],
                 'ba_app_sub' => $finstitution['ba_app_sub'],
                 'ac_open_sta' => $finstitution['ac_open_sta'],
                 'ac_type' => $finstitution['ac_type'],
                 'ac_number' => $finstitution['ac_number'],
                 'bank_ac_sta' => $finstitution['bank_ac_sta'],
                 'remarks' => $finstitution['remarks'],
                 'c_id' => $company_add->id,

              ]);
              }
          }
      }


        return 2;
      }
    // print_r($finance);

    }
    public function dashboard()
    {
      return view('finance.dashboard');
    }


}
