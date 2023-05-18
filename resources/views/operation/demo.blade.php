@extends('layouts.app')
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
                {{ $data->passhol_name }}

            </h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->

    <form  method="post" id="operation_form_edit"
    class="operation_form_edit">
    @csrf
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('operation.index') }}">Operation</a></li>
                <li>{{ Breadcrumbs::render('operation.edit', $data) }}</li>
            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <button type="submit" class="btn saveBtn"><span>Save</span></button>
            <a href="{{ route('operation.show', $data->id) }}"><button class="btn saveBtn cancelBtn"><span>cancel</span></button></a>
            {{-- <button class="btn saveBtn cancelBtn del_confirm" data-id="{{ $data->id }}"><span>Cancel</span></button> --}}
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{-- <strong>Whoops!</strong>Something went wrong.<br><br> --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Form card data -->
    <div class="dataAreaMain wealth_view">
        <div class="card company_basic_info formContentData border-0 p-4">
            <h3>Basic Information</h3>
            <div class="company_basic_data d-flex flex-wrap">
                <div class="formAreahalf basic_data">
                    <label for="" class="form-label">Created By</label>
                    <p>{{ $data->created_by }}</p>
                </div>
                <div class="formAreahalf basic_data">
                    <label for="" class="form-label">Client Status</label>
                    <p></p>
                </div>

            </div>
        </div>
        <div class="application_info">
            <div class="card company_info formContentData border-0 p-4 ">
                <h3>Application Information</h3>

                <div class="tabbing_wealth_four">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-mas"
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pass Related
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-financial" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Company Related</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-pass"
                                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">PR
                                Related</button>
                        </div>
                    </nav>

                    <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                    <div class="tab-content border_styling" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-mas" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div id="mas_accordion" class="mas_related">
                                <div class="mas_heading_accordian d-flex flex-wrap">
                                    <input type="hidden" name="pass[0][pass_id]" value="{{ $data['id'] }}" />
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Business Type</label>
                                        {{-- <input type="text" class="form-control" name="pass[0][bus_type]" value="{{ $data['bus_type'] }}"> --}}
                                        <select name="pass[0][bus_type]">
                                            <option value="" selected >Please select
                                            </option>
                                           
                                            <option value="FO"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'FO' ? 'selected' : '' }}>
                                            FO</option>
                                            <option value="PIC"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'PIC' ? 'selected' : '' }}>
                                            PIC</option>
                                            <option value="Self-employment"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'Self-employment' ? 'selected' : '' }}>
                                            Self-employment</option>
                                            <option value="Employer Guarantee"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'Employer Guarantee' ? 'selected' : '' }}>
                                            Employer Guarantee</option>
                                            <option value="PR application"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'PR application' ? 'selected' : '' }}>
                                            PR application</option>
                                            <option value="PR renewal"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'PR renewal' ? 'selected' : '' }}>
                                            PR renewal</option>
                                            <option value="EP"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'Citizen' ? 'selected' : '' }}>
                                            Citizen</option>
                                            <option value="Others (please specify)"
                                            {{ isset($data['bus_type']) && $data['bus_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                            Others (please specify)</option>
                                          

                                        </select>
                                        
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Application Type</label>
                                    
                                        <select name="pass[0][pass_app_type]">
                                            <option value="" selected >Please select
                                            </option>
                                           
                                            <option value="EP"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'EP' ? 'selected' : '' }}>
                                            EP</option>
                                            <option value="SP"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'SP' ? 'selected' : '' }}>
                                            SP</option>
                                            <option value="DP"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'DP' ? 'selected' : '' }}>
                                            DP</option>
                                            <option value="LVTP"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'LVTP' ? 'selected' : '' }}>
                                            LVTP</option>
                                            <option value="WP"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'WP' ? 'selected' : '' }}>
                                            WP</option>
                                            <option value="PR"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'PR' ? 'selected' : '' }}>
                                            PR</option>
                                            <option value="Citizen"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'Citizen' ? 'selected' : '' }}>
                                            Citizen</option>
                                            <option value="Others (please specify)"
                                            {{ isset($data['pass_app_type']) && $data['pass_app_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                            Others (please specify)</option>

                                        </select>
                                    </div>

                                    <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div id="mas_collapseOne" class="collapse show " aria-labelledby="headingOne"
                                    data-parent="#mas_accordion">
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Does passholder need to set up
                                            company?</label>
                    
                                        <select name="pass[0][passhol_setup]" id="set_company" class="set_company">
                                            
                                            <option value="{{$data['passhol_setup']}}">
                                                {{$data['passhol_setup']}}</option>
                                  
                                        </select>
                                  
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Is the passholder also the
                                            shareholder?
                                            Number</label>
                                   
                                        <select name="pass[0][passhol_sharehol]" id="also_shareholder"
                                            class="also_shareholder">
                                            <option value="{{$data['passhol_sharehol']}}">
                                                {{$data['passhol_sharehol']}}</option>
                                  
                                            {{-- <option value="" selected >
                                            </option>
                                            <option value="Yes">Yes</option> --}}

                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Holder Name 1 (Eng)</label>
                                      
                                        <input type="text" class="form-control" id="passhol_name"
                                        name="pass[0][passhol_name]" value="{{ $data['passhol_name'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Full Name
                                            (Chinese)</label>
                                   
                                        <input type="text" class="form-control" id="gendcname[0][subject]"
                                            name="pass[0][passport_name]" value="{{ $data['passport_name'] }}">

                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                       
                                        <input type="date" class="form-control" name="pass[0][pass_dob]"
                                        id="pass_holder_dob" value="{{ $data['pass_dob'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Gender (M/F)</label>
                                   
                                        <select class="" name="pass[0][pass_gender]" id="gender">
                                            <option value="" selected >Please Select</option>
                                            <option value="data['passhol_setup']"
                                            {{ isset($data['pass_gender']) && $data['pass_gender'] == 'M' ? 'selected' : '' }}>
                                            M</option>
                                            <option value="data['passhol_setup']"
                                            {{ isset($data['pass_gender']) && $data['pass_gender'] == 'F' ? 'selected' : '' }}>
                                            F</option>
                                        
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Expiry
                                            Date(DD/MM/YYYY)</label>
                                       
                                        <input type="date" class="form-control" name="pass[0][pass_exp_dob]"
                                        id="passport_exp_date" value="{{ $data['pass_exp_dob'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Number</label>
                                     
                                        <input type="text" class="form-control" id="passport_no"
                                            name="pass[0][passport_number]" value="{{ $data['passport_number'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Country</label>
                                      
                                        <input type="text" class="form-control" id="passport_cnt"
                                        name="pass[0][passport_country]" value="{{ $data['passport_country'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Renewal
                                            Reminder</label>
                                      
                                        <select name="pass[0][passport_ren_rem]" id="passport_ren_rem">
                                            <option value=""selected >Please select</option>
                                            <option value="90 days before expiry"
                                            {{ isset($data['passport_ren_rem']) && $data['passport_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                            90 days before expiry</option>
                                            <option value="120 days before expiry"
                                            {{ isset($data['passport_ren_rem']) && $data['passport_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                            120 days before expiry</option>
                                            <option value="180 days before expiry"
                                            {{ isset($data['passport_ren_rem']) && $data['passport_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                            180 days before expiry</option>
                                          
                                        </select>
                                    </div>

                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">TIN Number Before Pass
                                            Application</label>
                                      
                                        <input type="text" class="form-control" id="tin_number"
                                            name="pass[0][passport_tin_number]" value="{{ $data['passport_tin_number'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                                     
                                        <div class="select_box"><span class="every">Every</span><span
                                            class="select"><select name="pass[0][passport_rem_fre]" id="passport_rem_trg_fre">
                                        <option value="" selected >Please select
                                            </option>
                                            <option value="Day"
                                            {{ isset($data['passport_rem_fre']) && $data['passport_rem_fre'] == 'Day' ? 'selected' : '' }}>
                                            Day</option>
                                            <option value="3 Days"
                                            {{ isset($data['passport_rem_fre']) && $data['passport_rem_fre'] == '3 Days' ? 'selected' : '' }}>
                                            3 Days</option>
                                            <option value="Week"
                                            {{ isset($data['passport_rem_fre']) && $data['passport_rem_fre'] == 'Week' ? 'selected' : '' }}>
                                            Week</option>
                                            <option value="2 Weeks"
                                            {{ isset($data['passport_rem_fre']) && $data['passport_rem_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                            2 Weeks</option>
                                            <option value="4 Weeks"
                                            {{ isset($data['passport_rem_fre']) && $data['passport_rem_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                            4 Weeks</option>
                                            
                                    </select></span></div>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">E-mail</label>
                                    
                                        <input type="email" class="form-control" id="gendcname[0][subject]"
                                            name="pass[0][email]" value="{{ $data['email'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">TIN Country Before Pass
                                            Application</label>
                                        
                                        <input type="text" class="form-control"
                                        name="pass[0][passport_tin_country]" id="tin_cnt" value="{{ $data['passport_tin_country'] }}">

                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Phone Number</label>
                                        
                                        <input type="text" class="form-control" id="ph_num"
                                            name="pass[0][phno]" value="{{ $data['phno'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Type of TIN Before Pass
                                            Application</label>
                                      
                                        <select name="pass[0][pass_tin_type]" id="type_of_tin">

                                            <option value="" selected >Please select
                                            </option>
                                          
                                            <option value="EP"
                                            {{ isset($data['pass_tin_type']) && $data['pass_tin_type'] == 'EP' ? 'selected' : '' }}>
                                            EP</option>

                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">FIN Number</label>
                                       
                                        <input type="text" class="form-control" id="fin_number"
                                            name="pass[0][finno]" value="{{ $data['finno'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Residential Address</label>
                                       
                                        <input type="text" class="form-control" id="res_add"
                                        name="pass[0][res_add]" value="{{ $data['res_add'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Application Status</label>
                                       
                                        <select name="pass[0][pass_app_sts]">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="Pending"
                                            {{ isset($data['pass_app_sts']) && $data['pass_app_sts'] == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                            <option value="Approved"
                                            {{ isset($data['pass_app_sts']) && $data['pass_app_sts'] == 'Approved' ? 'selected' : '' }}>
                                            Approved</option>
                                            <option value="Rejected"
                                            {{ isset($data['pass_app_sts']) && $data['pass_app_sts'] == 'Rejected' ? 'selected' : '' }}>
                                            Rejected</option>

                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Issuance </label>
                                      
                                        <select name="pass[0][pass_iss]">
                                            <option value="" selected >Please select pass issuance
                                            </option>
                                            <option value="In Progress"
                                            {{ isset($data['pass_iss']) && $data['pass_iss'] == 'In Progress' ? 'selected' : '' }}>
                                            In Progress</option>
                                            <option value="Done"
                                            {{ isset($data['pass_iss']) && $data['pass_iss'] == 'Done' ? 'selected' : '' }}>
                                            Done</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Issuance Date</label>
                                       
                                        <input type="date" class="form-control" name="pass[0][pass_iss_date]" value="{{ $data['pass_iss_date'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Expiry Date</label>
                                      
                                        <input type="date" class="form-control" name="pass[0][pass_exp_date]" value="{{ $data['pass_exp_date'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Duration </label>
                                     
                                        <input type="text" class="form-control" name="pass[0][duration]" value="{{ $data['duration'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Renewal Frequency </label>
                                    
                                        <select name="pass[0][pass_ren_fre]" id="renewlrem">
                                            <option value="" selected >Please select</option>
                                          
                                            <option value="90 days before expiry"
                                            {{ isset($data['pass_ren_fre']) && $data['pass_ren_fre'] == '90 days before expiry' ? 'selected' : '' }}>
                                            90 days before expiry</option>
                                            <option value="120 days before expiry"
                                            {{ isset($data['pass_ren_fre']) && $data['pass_ren_fre'] == '120 days before expiry' ? 'selected' : '' }}>
                                            120 days before expiry</option>
                                            <option value="180 days before expiry"
                                            {{ isset($data['pass_ren_fre']) && $data['pass_ren_fre'] == '180 days before expiry' ? 'selected' : '' }}>
                                            180 days before expiry</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Renewal Reminder</label>
                                   
                                        <select name="pass[0][pass_ren_rem]" id="renewlrem">
                                            <option value="" selected >Please select pass</option>
                                     
                                            <option value="90 days before expiry"
                                            {{ isset($data['pass_ren_rem']) && $data['pass_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                            90 days before expiry</option>
                                            <option value="120 days before expiry"
                                            {{ isset($data['pass_ren_rem']) && $data['pass_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                            120 days before expiry</option>
                                            <option value="180 days before expiry"
                                            {{ isset($data['pass_ren_rem']) && $data['pass_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                            180 days before expiry</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Renewal Trigger</label>
                                      
                                        <div class="select_box"><span class="every">Every</span><span
                                            class="select"><select name="pass[0][pass_ren_ter_fre]" id="renewlfre">
                                        <option value=""selected >Please select
                                        </option>
                                        <option value="Day"
                                        {{ isset($data['pass_ren_ter_fre']) && $data['pass_ren_ter_fre'] == 'Day' ? 'selected' : '' }}>
                                        Day</option>
                                        <option value="3 Days"
                                        {{ isset($data['pass_ren_ter_fre']) && $data['pass_ren_ter_fre'] == '3 Days' ? 'selected' : '' }}>
                                        3 Days</option>
                                        <option value="Week"
                                        {{ isset($data['pass_ren_ter_fre']) && $data['pass_ren_ter_fre'] == 'Week' ? 'selected' : '' }}>
                                        Week</option>
                                        <option value="2 Weeks"
                                        {{ isset($data['pass_ren_ter_fre']) && $data['pass_ren_ter_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                       2 Weeks</option>
                                        <option value="4 Weeks"
                                        {{ isset($data['pass_ren_ter_fre']) && $data['pass_ren_ter_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                        4 Weeks</option>
                                    </select></span></div>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Pass Job Title </label>
                                       
                                        <input type="text" class="form-control" name="pass[0][pass_job_title]" value="{{ $data['pass_job_title'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Singpass Setup </label>
                                     
                                        <select name="pass[0][singpass_setup]" id="renewlfre">
                                            <option value="" selected >Please select</option>
                                          
                                            <option value="In Progress"
                                            {{ isset($data['singpass_setup']) && $data['singpass_setup'] == 'In Progress' ? 'selected' : '' }}>
                                            In Progress</option>
                                            <option value="Done"
                                            {{ isset($data['singpass_setup']) && $data['singpass_setup'] == 'Done' ? 'selected' : '' }}>
                                            Done</option>

                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">1st PR Application Reminder </label>
                                       
                                        <select name="pass[0][pr_app_rem]" id="renewlrem">
                                            <option value="" selected>Please select</option>
                                         
                                                <option value="180 days after pass
                                                issuance date"
                                                {{ isset($data['pr_app_rem']) && $data['pr_app_rem'] == '180 days after pass
                                                issuance date' ? 'selected' : '' }}>
                                                180 days after pass
                                                issuance date</option>
                                                <option value="270 days after pass
                                                issuance date"
                                                {{ isset($data['pr_app_rem']) && $data['pr_app_rem'] == '270 days after pass
                                                issuance date' ? 'selected' : '' }}>
                                                180 days after pass
                                                issuance date</option>
                                                <option value="365 days after pass
                                                issuance date"
                                                {{ isset($data['pr_app_rem']) && $data['pr_app_rem'] == '365 days after pass
                                                issuance date' ? 'selected' : '' }}>
                                                365 days after pass
                                                issuance date</option>
                                                <option value="270 days after pass
                                                issuance date"
                                                {{ isset($data['pr_app_rem']) && $data['pr_app_rem'] == '540 days after pass
                                                issuance date' ? 'selected' : '' }}>
                                                540 days after pass
                                                issuance date</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Relationship With Pass Holder
                                            1</label>
                                   
                                        <select name="pass[0][rel_pass_hol]" id="renewlrem">
                                            <option value="" selected >Please select
                                            </option>
                                       
                                            <option value="Self"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'Self' ? 'selected' : '' }}>
                                            Self</option>
                                            <option value="parents"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'parents' ? 'selected' : '' }}>
                                            parents</option>
                                            <option value="spouse"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'spouse' ? 'selected' : '' }}>
                                            spouse</option>
                                            <option value="children"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'children' ? 'selected' : '' }}>
                                            children</option>
                                            <option value="relatives"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'relatives' ? 'selected' : '' }}>
                                            relatives</option>
                                            <option value="friend"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'friend' ? 'selected' : '' }}>
                                            friend</option>
                                            <option value="other (please specify)"
                                            {{ isset($data['rel_pass_hol']) && $data['rel_pass_hol'] == 'other (please specify)' ? 'selected' : '' }}>
                                            other (please specify)</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Employer's Name </label>
                                       
                                        <input type="text" class="form-control" name="pass[0][emp_name]" value="{{ $data['emp_name'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Monthly Salary (SGD) </label>
                                        
                                        <input type="text" class="form-control" name="pass[0][month_sal]"
                                        id="month_salary" value="{{ $data['month_sal'] }}">
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Remarks </label>
                                   
                                        <textarea id="addbg[0][genremarks]" name="pass[0][p_remarks]" rows="4" cols="50">{{ $data['p_remarks'] }}</textarea>
                                    </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-financial" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <?php $c=-1; ?>
                            @foreach ($data->pass_company as $company)
                            <?php $c++; ?>
                                <div id="financial_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap">
                                        <input type="hidden" name="cmp[{{$c}}][company_id]" value="{{ $company['id'] }}" />
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Company Name 1</label>
                                           
                                            <input type="text" name="cmp[{{$c}}][fo_company]" id="fo_compnay"
                                            class="form-control" value="{{ $company['company_name'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"></label>
                                          
                                        </div>

                                        <button class="btn btn_set" data-toggle="collapse"
                                            data-target="#financial_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                    <div id="financial_collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#financial_accordion">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">UEN</label>
                                            
                                            <input type="text" class="form-control" name="cmp[{{$c}}][fo_uen]"
                                                id="fo_uen" value="{{ $company['uen'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Company Address</label>
                                            <input type="text" class="form-control" name="cmp[{{$c}}][fo_company_add]"
                                            id="fo_company_add" value="{{ $company['company_add'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Incorporation
                                                Date</label>
                                          
                                            <input type="date" class="form-control"
                                            name="cmp[{{$c}}][fo_incorporation_date]" id="fo_incorporation_date" value="{{ $company['incorporation_date'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Company Email</label>
                                        
                                            <input type="text" class="form-control" name="cmp[{{$c}}][fo_company_email]"
                                            id="fo_company_email" value="{{ $company['company_email'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Company Password</label>
                                           
                                            <input type="text" class="form-control" name="cmp[{{$c}}][fo_company_pass]"
                                            id="fo_company_pass" value="{{ $company['company_pass'] }}">
                                        </div>

                                        </div>
                                    </div>
                                </div>



                                <br><br><br><br>
                                <div class="tabbing_wealth_four">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab-share{{$c}}" data-bs-toggle="tab"
                                                data-bs-target="#nav-mas-share{{$c}}" type="button" role="tab"
                                                aria-controls="nav-home-tab-share{{$c}}" aria-selected="true">Shareholder </button>
                                            <button class="nav-link" id="nav-profile-tab-2{{$c}}" data-bs-toggle="tab"
                                                data-bs-target="#nav-financial-financial2{{$c}}" type="button" role="tab"
                                                aria-controls="nav-profile-tab-2{{$c}}" aria-selected="false">Financial</button>

                                        </div>
                                    </nav>
                                    <div class="tab-content border_styling" id="nav-tabContent">

                                        <div class="tab-pane fade show active" id="nav-mas-share{{$c}}" role="tabpanel"
                                            aria-labelledby="nav-home-tab-share{{$c}}">
                                        <?php $s=-1; ?>
                                            @foreach ($company['company_share'] as $share)
                                            <?php $s++; ?>
                                                <div id="financial_accordion" class="mas_related">
                                                    <div class="mas_heading_accordian d-flex flex-wrap">
                                                        <input type="hidden" name="share[{{$c}}][{{$s}}][share_id]" value="{{ $share['id'] }}" />
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Shareholder</label>

                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label"></label>
                                                           
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Equity
                                                                Percentage</label>
                                                           
                                                            <input type="text" class="form-control" name="share[{{$c}}][{{$s}}][eqt_per]" value="{{ $share['eqt_per'] }}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full
                                                                Name(Eng)</label>
                                                         
                                                            <input type="text" class="form-control" 
                                                            name="share[{{$c}}][{{$s}}][passhol_name]" value="{{ $share['passhol_name'] }}" >
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full
                                                                Name(Chinese)</label>
                                                            
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[{{$c}}][{{$s}}][passport_name]" value="{{$share['passport_name']}}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for=""
                                                                class="form-label">DOB(DD/MM/YYYY)</label>
                                                            <p></p>
                                                            <input type="date" class="form-control" name="share[{{$c}}][{{$s}}][shareholder_dob]" value="{{$share['shareholder_dob']}}" >
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Gender(M/F)</label>
                                                         
                                                            <select class="" name="share[{{$c}}][{{$s}}][shareholder_gender]" id="sign">
                                      
                                                          
                                                                <option value="M"
                                                                {{ isset($share['shareholder_gender']) && $share['shareholder_gender'] == 'M' ? 'selected' : '' }}>
                                                                M</option>
                                                                <option value="F"
                                                                {{ isset($share['shareholder_gender']) && $share['shareholder_gender'] == 'F' ? 'selected' : '' }}>
                                                                F</option>
                                                            </select>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Number</label>
                                                          
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[{{$c}}][{{$s}}][passport_number]"  value="{{ $share['passport_number'] }}">
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Country</label>
                                                  
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                                            name="share[{{$c}}][{{$s}}][passport_country]" value="{{ $share['passport_country'] }}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Expiry
                                                                Date(dd/mm/yyyy)</label>
                                                         
                                                            <input type="date" class="form-control" name="share[{{$c}}][{{$s}}][pass_exp_dob]" value="{{ $share['pass_exp_dob'] }}">
                                                                  </div>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Renewal
                                                                Reminder</label>
                                                       
                                                            <select name="share[{{$c}}][{{$s}}][passport_ren_rem]" id="renewlrem">
                                                                <option value="" selected >Please select</option>
                                                                <option value="90 days before expiry"
                                                                {{ isset( $share['passport_ren_rem']) &&  $share['passport_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                                                90 days before expiry</option>
                                                                <option value="120 days before expiry"
                                                                {{ isset( $share['passport_ren_rem']) &&  $share['passport_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                                                120 days before expiry</option>
                                                                <option value="180 days before expiry"
                                                                {{ isset( $share['passport_ren_rem']) &&  $share['passport_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                                                180 days before expiry</option>
                                        
                                                            </select>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Reminder
                                                                Trigger
                                                                Frequency</label>
                                                        
                                                            <div class="select_box"><span class="every">Every</span><span
                                                                class="select"><select name="share[{{$c}}][{{$s}}][passport_rem_fre]" id="renewlfre">
                                                                    <option value="" selected >Please select</option>
                                                                    <option value="Day"
                                                                    {{ isset( $share['passport_rem_fre']) &&  $share['passport_rem_fre'] == 'Day' ? 'selected' : '' }}>
                                                                    Day</option></select></span></div>
                                                                    <option value="3 Days"
                                                                    {{ isset( $share['passport_rem_fre']) &&  $share['passport_rem_fre'] == '3 Days' ? 'selected' : '' }}>
                                                                    3 Days</option></select></span></div>
                                                                    <option value="Week"
                                                                    {{ isset( $share['passport_rem_fre']) &&  $share['passport_rem_fre'] == 'Week' ? 'selected' : '' }}>
                                                                    Week</option></select></span></div>
                                                                    <option value="2 Weeks"
                                                                    {{ isset( $share['passport_rem_fre']) &&  $share['passport_rem_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                                                    2 Weeks</option></select></span></div>
                                                                    <option value="4 Weeks"
                                                                    {{ isset( $share['passport_rem_fre']) &&  $share['passport_rem_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                                                    4 Weeks</option></select></span></div>

                                                           
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Type of TIN Before
                                                                Pass
                                                                Application</label>
                                                           
                                                            <select name="share[{{$c}}][{{$s}}][tintype]">
                               
                                                                <option value="" selected >Please select</option>
                                                                <option value="EP"
                                                                {{ isset( $share['tintype']) &&  $share['tintype'] == 'EP' ? 'selected' : '' }}>
                                                                EP</option>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">TIN Number Before
                                                                Pass
                                                                Application</label>
                                                          
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                                            name="share[{{$c}}][{{$s}}][tinno]" value="{{$share['tinno']}}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Tin Country Before
                                                                Pass
                                                                Application</label>
                                                         
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[{{$c}}][{{$s}}][tincnt] " value="{{$share['tincnt']}}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Phone Number</label>
                                                         
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                                            name="share[{{$c}}][{{$s}}][phno]" value="{{$share['phno']}}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Residential
                                                                Add.(according to
                                                                Add.proof)</label>
                                                          
                                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                                            name="share[{{$c}}][{{$s}}][res_add]" value="{{$share['res_add']}}">
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Email</label>
                                                            
                                                            <input type="text" class="form-control" name="share[{{$c}}][{{$s}}][email]" value="{{ $share['email'] }}">
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass. Job
                                                                Title</label>
                                                           
                                                            <input type="text" class="form-control" name="share[{{$c}}][{{$s}}][job_title]" value="{{ $share['job_title'] }}">
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly
                                                                Salary(SGD)</label>
                                                         
                                                            <input type="text" class="form-control" name="share[{{$c}}][{{$s}}][month_sal]" value="{{ $share['month_sal'] }}">
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Relationship with
                                                                shareholder</label>
                                                           
                                                            <select name="share[{{$c}}][{{$s}}][rel_share_hol]" id="renewlrem">
                                                                <option value="" selected >Please select
                                                                </option>
                                                           
                                                                <option value="Self"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'Self' ? 'selected' : '' }}>
                                                                Self</option>
                                                                <option value="parents"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'parents' ? 'selected' : '' }}>
                                                                parents</option>
                                                                <option value="spouse"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'spouse' ? 'selected' : '' }}>
                                                                spouse</option>
                                                                <option value="children"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'children' ? 'selected' : '' }}>
                                                                children</option>
                                                                <option value="relatives"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'relatives' ? 'selected' : '' }}>
                                                                relatives</option>
                                                                <option value="friend"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'friend' ? 'selected' : '' }}>
                                                                friend</option>
                                                                <option value="other (please specify)"
                                                                {{ isset( $share['rel_share_hol']) &&  $share['rel_share_hol'] == 'other (please specify)' ? 'selected' : '' }}>
                                                                other (please specify)</option>
                                                               
                                                            </select>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Remarks</label>
                                                            
                                                            <textarea id="addbg[0][genremarks]" name="share[{{$c}}][{{$s}}][remarks]" rows="4" cols="50">{{ $share['remarks'] }}</textarea>
                                                        </div>


                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="tab-content border_styling" id="nav-tabContent">

                                        <div class="tab-pane fade" id="nav-financial-financial2{{$c}}"
                                            role="tabpanel" aria-labelledby="nav-profile-tab-2{{$c}}">
                                            <?php $f=0; ?>
                                            @foreach ($company['company_fi'] as $fi)
                                            <?php $f++; ?>
                                            <div id="financial_accordion" class="mas_related">
                                                <div class="mas_heading_accordian d-flex flex-wrap">
                                                    <input type="hidden" name="fi[{{$c}}][{{$f}}][fi_id]" value="{{ $fi['id'] }}" />
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Poc Name</label>
                                                        
                                                        <input type="text" name="fi[{{$c}}][{{$f}}][poc_name]" id="" class="form-control"
                                                        value="{{ $fi['poc_name'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Financial Institution
                                                            Name</label>
                                                     
                                                        <input type="text" class="form-control" name="fi[{{$c}}][{{$f}}][fi_name]" id="" value="{{ $fi['poc_name'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">POC Email</label>
                                                   
                                                        <input type="email" class="form-control" name="fi[{{$c}}][{{$f}}][poc_email]"
                                                        id="" value="{{ $fi['poc_email'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">POC Contact
                                                            Number</label>
                                                       
                                                        <input type="text" class="form-control" name="fi[{{$c}}][{{$f}}][poc_cno]" id="" value="{{ $fi['poc_cno'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Account Type</label>
                                                      
                                                        <select name="fi[{{$c}}][{{$f}}][acc_type]" id="">
                                                          
                                                            <option value="" selected  >Please select
                                                            </option>
                                                            <option value="SGD"
                                                            {{ isset(  $fi['acc_type'] ) &&   $fi['acc_type']  == 'SGD' ? 'selected' : '' }}>
                                                            SGD</option>
                                                            <option value="USD"
                                                            {{ isset(  $fi['acc_type'] ) &&   $fi['acc_type']  == 'USD' ? 'selected' : '' }}>
                                                            USD</option>
                                                            <option value="Multi-currency"
                                                            {{ isset(  $fi['acc_type'] ) &&   $fi['acc_type']  == 'Multi-currency' ? 'selected' : '' }}>
                                                            Multi-currency</option>
                                                            <option value="Others (please specify)"
                                                            {{ isset(  $fi['acc_type'] ) &&   $fi['acc_type']  == 'Others (please specify)' ? 'selected' : '' }}>
                                                            Others (please specify)</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Application
                                                            Submission</label>
                                                       
                                                        <select name="fi[{{$c}}][{{$f}}][app_sub]" id="">
                                                            <option value="" selected  >Please select
                                                            </option>
                                                            <option value="In Progress"
                                                            {{ isset(  $fi['app_sub'] ) &&   $fi['app_sub']  == 'In Progress' ? 'selected' : '' }}>
                                                            In Progress</option>
                                                            <option value="Done"
                                                            {{ isset(  $fi['app_sub'] ) &&   $fi['app_sub']  == 'Done' ? 'selected' : '' }}>
                                                            Done</option>
                                                        </select>
                                                    </div>
                                
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Account Opening
                                                            Status</label>
                                                     
                                                        <select name="fi[{{$c}}][{{$f}}][acc_opn_sts]" id="">
                                                            <option value="" selected  >Please select
                                                            </option>
                                                            <option value="Pending"
                                                            {{ isset(  $fi['acc_opn_sts'] ) &&   $fi['acc_opn_sts']  == 'Pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                            <option value="Approved"
                                                            {{ isset(  $fi['acc_opn_sts'] ) &&   $fi['acc_opn_sts']  == 'Approved' ? 'selected' : '' }}>
                                                            Approved</option>
                                                            <option value="Rejected"
                                                            {{ isset(  $fi['acc_opn_sts'] ) &&   $fi['acc_opn_sts']  == 'Rejected' ? 'selected' : '' }}>
                                                            Rejected</option>
                                                        </select>
                                                    </div>
                                
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Account/Policy Number
                                                        </label>
                                                      
                                                        <input type="text" class="form-control" name="fi[{{$c}}][{{$f}}][acc_pol_no]" id="" value="{{ $fi['acc_pol_no'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Money Deposit
                                                            Status</label>
                                                       
                                                        <select name="fi[{{$c}}][{{$f}}][money_dep_sts]" id="">
                                                           
                                                            <option value="" selected  >Please select
                                                            </option>
                                                            <option value="In progress"
                                                            {{ isset(  $fi['money_dep_sts'] ) &&   $fi['money_dep_sts']  == 'In progress' ? 'selected' : '' }}>
                                                            In progress</option>
                                                            <option value="Done"
                                                            {{ isset(  $fi['money_dep_sts'] ) &&   $fi['money_dep_sts']  == 'Done' ? 'selected' : '' }}>
                                                            Done</option>
                                                            <option value="N/A"
                                                            {{ isset(  $fi['money_dep_sts'] ) &&   $fi['money_dep_sts']  == 'N/A' ? 'selected' : '' }}>
                                                            N/A</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Account Current
                                                            Status</label>
                                                  
                                                        <select name="fi[{{$c}}][{{$f}}][acc_crt_sts]" id="">
                                                            <option value="" selected  >Please select
                                                            </option>
                                                            <option value="Pending"
                                                            {{ isset(  $fi['acc_crt_sts'] ) &&   $fi['acc_crt_sts']  == 'Pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                            <option value="Approved"
                                                            {{ isset(  $fi['acc_crt_sts'] ) &&   $fi['acc_crt_sts']  == 'Approved' ? 'selected' : '' }}>
                                                            Approved</option>
                                                            <option value="Rejected"
                                                            {{ isset(  $fi['acc_crt_sts'] ) &&   $fi['acc_crt_sts']  == 'Rejected' ? 'selected' : '' }}>
                                                            Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Online Account
                                                            Username</label>
                                                        
                                                        <input type="text" class="form-control" name="fi[{{$c}}][{{$f}}][on_acc_usr_nam]" id="" value="{{ $fi['on_acc_usr_nam'] }}">
                                                    </div>
                                
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Online Account
                                                            Password</label>
                                                       
                                                        <input type="text" class="form-control" name="fi[{{$c}}][{{$f}}][on_acc_usr_pass]" id="" value="{{ $fi['on_acc_usr_pass'] }}">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Maturity Date</label>
                                                      
                                                        <input type="date" class="form-control" name="fi[{{$c}}][{{$f}}][mat_date]"
                                                        id="" value="{{ $fi['mat_date'] }}">
                                                    </div>
                                
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Remarks</label>
                                                        <textarea id="" name="fi[{{$c}}][{{$f}}][remarks]" rows="4" cols="50">{{ $fi['remarks'] }}</textarea>
                                                      
                                                    </div>
                                
                                
           
                                                </div>
                                            </div>
                                        @endforeach

                                        </div>
                                    </div>



                                </div>
                            @endforeach

                        </div>
                        <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div id="pass_accordion" class="mas_related">
                                @foreach ($data->pass_pr as $pr)
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label">Pass Holder Name</label>
                                    <p>{{ $data['passhol_name'] }}</p>
                                </div>
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label">1st Time PR Application Date</label>
                                    
                                    <input type="date" class="form-control" name="pr[0][{{$p}}][application_date]"
                                    id="" value="{{ $pr['application_date'] }}">
                                </div>
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label"></label>
                                   
                                </div>

                                        <button class="btn btn_set" data-toggle="collapse"
                                            data-target="#pass_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="pass_collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#pass_accordion">
                                        <input type="hidden" name="pr[0][{{$p}}][pr_id]" value="{{ $pr['id'] }}" />
                                     
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Application Dependent</label>
                                         
                                            <select name="pr[0][{{$p}}][application_dep]" id="">
                    
                                                <option value="" selected >Please select pass</option>
        
                                                <option value="None"
                                                {{ isset($pr['application_dep']) && $pr['application_dep'] == 'None' ? 'selected' : '' }}>
                                                None</option>
                                                <option value="Spouse only"
                                                {{ isset($pr['application_dep']) && $pr['application_dep'] == 'Spouse only' ? 'selected' : '' }}>
                                                Spouse only</option>
                                                <option value="Children only"
                                                {{ isset($pr['application_dep']) && $pr['application_dep'] == 'Children only' ? 'selected' : '' }}>
                                                Children only</option>
                                                <option value="Spouse and Children"
                                                {{ isset($pr['application_dep']) && $pr['application_dep'] == 'Spouse and Children' ? 'selected' : '' }}>
                                                Spouse and Children</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Pass Application Status</label>
                                         
                                            <select name="pr[0][{{$p}}][application_sts]" id="">
                                               
                                                <option value="" selected>Please select pass</option>
                                                <option value="Pending"
                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                                <option value="Approved"
                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Approved' ? 'selected' : '' }}>
                                                Approved</option>
                                           
                                                <option value="Rejected"
                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">PR Approval Date</label>
                                            <p></p>
                                            <input type="date" class="form-control" name="pr[0][{{$p}}][approval_date]"
                                            id="" value="{{ $pr['approval_date'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">REP Expiry Date</label>
                                            <p></p>
                                            <input type="date" class="form-control" name="pr[0][{{$p}}][rep_expiry_date]"
                                            id="" value="{{ $pr['rep_expiry_date'] }}">
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">REP Renewal Reminder</label>
                                     

                                            <select name="pr[0][{{$p}}][rep_ren_rem]" id="">
                    
                                                <option value="" selected >Please select pass</option>
                            
                                                <option value="90 days before REP expiry"
                                                {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '90 days before REP expiry' ? 'selected' : '' }}>
                                                90 days before REP expiry</option>
                                                <option value="180 days before REP expiry"
                                                {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '180 days before REP expiry' ? 'selected' : '' }}>
                                                180 days before REP expiry</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">REP Renewal Trigger Frequency</label>
                                       
                                            <select name="pr[0][{{$p}}][rep_ren_trg_fre]" id="">
                                                
                                                <option value="" selected >Please select pass</option>
                                                <option value="Day"
                                                {{ isset($pr['rep_ren_trg_fre']) && $pr['rep_ren_trg_fre'] == 'Day' ? 'selected' : '' }}>
                                                Day</option>
                                                <option value="3 Days"
                                                {{ isset($pr['rep_ren_trg_fre']) && $pr['rep_ren_trg_fre'] == '3 Days' ? 'selected' : '' }}>
                                                3 Days</option>
                                                <option value="Week"
                                                {{ isset($pr['rep_ren_trg_fre']) && $pr['rep_ren_trg_fre'] == 'Week' ? 'selected' : '' }}>
                                                Week</option>
                                                <option value="2 Weeks"
                                                {{ isset($pr['rep_ren_trg_fre']) && $pr['rep_ren_trg_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                                2 Weeks</option>
                                                <option value="4 Weeks"
                                                {{ isset($pr['rep_ren_trg_fre']) && $pr['rep_ren_trg_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                                4 Weeks</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Re-Submission Trigger
                                                Frequency</label>
                                        
                                            <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[0][{{$p}}][re_sub_trg_fre]" id="">
                                         
                                            <option value="" selected >Please select pass</option>
            
                                            <option value="Day"
                                            {{ isset($pr['re_sub_trg_fre']) && $pr['re_sub_trg_fre'] == 'Day' ? 'selected' : '' }}>
                                            Day</option>
                                            <option value="3 Days"
                                            {{ isset($pr['re_sub_trg_fre']) && $pr['re_sub_trg_fre'] == '3 Days' ? 'selected' : '' }}>
                                            3 Days</option>
                                            <option value="Week"
                                            {{ isset($pr['re_sub_trg_fre']) && $pr['re_sub_trg_fre'] == 'Week' ? 'selected' : '' }}>
                                            Week</option>
                                            <option value="2 Weeks"
                                            {{ isset($pr['re_sub_trg_fre']) && $pr['re_sub_trg_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                            2 Weeks</option>
                                            <option value="4 Weeks"
                                            {{ isset($pr['re_sub_trg_fre']) && $pr['re_sub_trg_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                            4 Weeks</option>
                                        </select></span></div>
                                            

                                      
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Remarks
                                            </label>
                                           
                                            <textarea id="" name="pr[0][{{$p}}][remarks]" rows="4" cols="50">{{ $pr['remarks'] }}</textarea>
                                        </div>


                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>






              
          
                  