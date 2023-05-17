@extends('layouts.app')
@push('css')
@endpush

@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add Wealth Application</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('wealth.index') }}">Wealth</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Form card data -->
    <div class="dataAreaMain">

        {!! Form::open([
            'url' => 'javascript:void(0);',
            'method' => 'POST',
            'class' => 'd-flex justify-content-start flex-wrap',
            'id' => 'multistep_form',
        ]) !!}
        @csrf

        <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

        <fieldset id="start_field" class="w-100 justify-content-start flex-wrap form-fields wealth">
            <div class="card formContentData border-0 p-4">

                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4> Business Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="formAreahalf first_selection ">
                    <label for="business_type" class="form-label">Business Type</label>
                    <select id="business_type" name="business_type">
                        <option value="-1" selected disabled>Choose Business Type</option>
                        <option value="FO">FO</option>
                        <option value="Non-FO">Non-FO</option>
                    </select>
                </div>
                <div id="append_div_form" class="w-100 d-flex justify-content-start flex-wrap form-fields"></div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next1" class="btn saveBtn next1">Next</button>
                <button type="button" style="display:none;" id="previous1" class="btn saveBtn cancelBtn ">Back</button>
            </div>
        </fieldset>

        <fieldset id="FO_company" class="w-100 justify-content-start flex-wrap form-fields wealth" style="display:none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4>Company Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="2">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">3</a>
                                <p> Shareholder </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_compnay" class="form-label">Company Name 1</label>
                            <input type="text" name="cmp[0][fo_company]" id="fo_compnay" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_uen" class="form-label">UEN</label>
                            <input type="text" class="form-control" name="cmp[0][fo_uen]" id="fo_uen">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_add" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="cmp[0][fo_company_add]" id="fo_company_add">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                            <input type="text" class="form-control" name="cmp[0][fo_incorporation_date]"
                                id="fo_incorporation_date">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_email" class="form-label">Company Email</label>
                            <input type="text" class="form-control" name="cmp[0][fo_company_email]"
                                id="fo_company_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_pass" class="form-label">Company Password</label>
                            <input type="text" class="form-control" name="cmp[0][fo_company_pass]"
                                id="fo_company_pass">
                        </div>
                    </div>
                </div>

                <div id="appended_company_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_company_btn_div">
                    <button type="button" id="add_company" class="btn saveBtn btn_design add_company"
                        name="add-company">Add
                        Company</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next2" class="btn saveBtn next2">Next</button>
                <button type="button" id="previous2" class="btn saveBtn cancelBtn previous">Back</button>
            </div>
        </fieldset>

        <fieldset id="FO_shareholder" class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder">
        </fieldset>
        <fieldset id="FO_shareholder_extra"
            class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder_extra">
        </fieldset>

        <fieldset id="NFO_personal" class="w-100 justify-content-start flex-wrap form-fields wealth"
            style="display:none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4> Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Personal Details </p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">3</a>
                                <p> Complete Details </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="nfo_personal" class="w-100 d-flex justify-content-start flex-wrap form-fields">
                    <div class="formAreahalf">
                        <label for="nfo_pass_name" class="form-label">Passport Full Name(Eng)</label>
                        <input type="text" class="form-control" name="nfo_pass_name" id="nfo_pass_name"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
                        <input type="text" class="form-control" name="nfo_pass_name_chinese"
                            id="nfo_pass_name_chinese">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" name="nfo_gender" id="nfo_gender">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_dob" class="form-label">DOB</label>
                        <input type="text" class="form-control" name="nfo_dob" id="nfo_dob">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_number" class="form-label">Passport Number</label>
                        <input type="text" class="form-control" name="nfo_pass_number"
                            id="nfo_pass_number">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                        <input type="text" class="form-control" name="nfo_pass_exp" id="nfo_pass_exp">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                        <input type="text" class="form-control" name="nfo_pass_reminder"
                            id="nfo_pass_reminder">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_country" class="form-label">Passport Country</label>
                        <input type="text" class="form-control" name="nfo_pass_country"
                            id="nfo_pass_country">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                        <input type="text" class="form-control" name="nfo_pass_trg_frq"
                            id="nfo_pass_trg_frq">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                        <input type="text" class="form-control" name="nfo_tin_number" id="nfo_tin_number">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                        <input type="text" class="form-control" name="nfo_tin_ctry" id="nfo_tin_ctry">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_no_before_app" class="form-label">TIN Number Before Pass Application </label>
                        <input type="text" class="form-control" name="nfo_tin_no_before_app"
                            id="nfo_tin_no_before_app">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                        <input type="text" class="form-control" name="nfo_tin_type" id="nfo_tin_type">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" name="nfo_email" id="nfo_email">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_country_before_app" class="form-label">TIN Country Before Pass Application </label>
                        <input type="text" class="form-control" name="nfo_tin_country_before_app"
                            id="nfo_tin_country_before_app">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                        <input type="text" class="form-control" name="nfo_residential_Add"
                            id="nfo_residential_Add">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type_before_app" class="form-label">Type of TIN Before Pass Application</label>
                        <input type="text" class="form-control" name="nfo_tin_type_before_app" id="nfo_tin_type_before_app">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_employer_ind" class="form-label">Employer's Industry</label>
                        <input type="text" class="form-control" name="nfo_employer_ind"
                            id="nfo_employer_ind">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="nfo_phone_number"
                            id="nfo_phone_number">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_current_job_title" class="form-label">Current Job Title</label>
                        <input type="text" class="form-control" name="nfo_current_job_title" id="nfo_current_job_title">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_emp_name" class="form-label">Employer's Name</label>
                        <input type="text" class="form-control" name="nfo_emp_name" id="nfo_emp_name">
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next3_nfo" class="btn saveBtn next-step fo_form_sub">Submit</button>
                <button type="button" id="previous5" class="btn saveBtn cancelBtn">Back</button>
            </div>
        </fieldset>

        <fieldset id="NFO_corporate" class="w-100 justify-content-start flex-wrap form-fields wealth"
            style="display:none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">3</a>
                                <p> Shareholder</p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nfo_corporate" class="corporate">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="nfo_compnay" class="form-label">Company Name 1</label>
                            <input type="text" name="corporate[0][nfo_company]" id="nfo_compnay" class="form-control"
                                value="">             
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_uen" class="form-label">UEN</label>
                            <input type="text" class="form-control" name="corporate[0][nfo_uen]" id="nfo_uen">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_company_add" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="corporate[0][nfo_company_add]"
                                id="nfo_company_add">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_incorporation_date" class="form-label">Incorporation Date</label>
                            <input type="text" class="form-control" name="corporate[0][nfo_incorporation_date]"
                                id="nfo_incorporation_date">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_company_email" class="form-label">Company Email</label>
                            <input type="text" class="form-control" name="corporate[0][nfo_company_email]"
                                id="nfo_company_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_company_pass" class="form-label">Company Password</label>
                            <input type="text" class="form-control" name="corporate[0][nfo_company_pass]"
                                id="nfo_company_pass">
                        </div>
                    </div>
                </div>
                <div id="appended_corporate_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential " id="add_corporate_btn_div">
                    <button type="button" id="add_corporate"
                        class="btn saveBtn btn_design add_nfo_company add_corporate">Add
                        Company</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next_nfo_2" class="btn saveBtn next_nfo_2">Next</button>
                <button type="button" id="previous2_nfo" class="btn saveBtn cancelBtn previous2_nfo">Back</button>
            </div>
        </fieldset>

        <fieldset id="NFO_shareholder" class="w-100 justify-content-start flex-wrap form-fields wealth NFO_shareholder">
        </fieldset>
        <fieldset id="NFO_shareholder_extra" class="w-100 justify-content-start flex-wrap form-fields wealth NFO_shareholder_extra">
        </fieldset>
        

        {!! Form::close() !!}
    </div>

    <div id="FO_First" class="formAreahalf" style="display:none;">
        <div class="formAreahalf">
            <label for="fo_client_type" class="form-label">Client Type</label>
            <input type="text" class="form-control" name="fo_client_type" id="fo_client_type">
        </div>
        <div class="formAreahalf">
            <label for="fo_type" class="form-label">Type of FO</label>
            <input type="text" class="form-control" name="fo_type" id="fo_type">
        </div>
        <div class="formAreahalf">
            <label for="fo_servicing_fee_amount" class="form-label">One-Time Servicing Fee Amount</label>
            <input type="text" class="form-control" name="fo_servicing_fee_amount" id="fo_servicing_fee_amount">
        </div>
        <div class="formAreahalf">
            <label for="fo_servicing_fee_currency" class="form-label">One-Time Servicing Fee Currency</label>
            <input type="text" class="form-control" name="fo_servicing_fee_currency" id="fo_servicing_fee_currency">
        </div>
        <div class="formAreahalf">
            <label for="fo_servicing_fee_status" class="form-label">One-Time Servicing Fee Status</label>
            <input type="text" class="form-control" name="fo_servicing_fee_status" id="fo_servicing_fee_status">
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee" class="form-label">Annual Servicing Fee Amount</label>
            <input type="text" class="form-control" name="fo_annual_fee" id="fo_annual_fee">
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee_currency" class="form-label">Annual Servicing Fee Currency</label>
            <input type="text" class="form-control" name="fo_annual_fee_currency" id="fo_annual_fee_currency">
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee_status" class="form-label">Annual Servicing Fee Status</label>
            <input type="text" class="form-control" name="fo_annual_fee_status" id="fo_annual_fee_status">
        </div>
    </div>
    <div id="FO_shareholder_new" style="display:none;">

        <div class="formAreahalf">
            <label for="fo_pass_name" class="form-label">Passport Full Name</label>
            <input type="text" class="form-control" name="fo_pass_name" id="fo_pass_name">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
            <input type="text" class="form-control" name="fo_pass_name_chinese" id="fo_pass_name_chinese">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
            <input type="text" class="form-control" name="fo_pass_reminder" id="fo_pass_reminder">
        </div>
        <div class="formAreahalf">
            <label for="fo_dob" class="form-label">DOB</label>
            <input type="text" class="form-control" name="fo_dob" id="fo_dob">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
            <input type="text" class="form-control" name="fo_pass_trg_frq" id="fo_pass_trg_frq">
        </div>
        <div class="formAreahalf">
            <label for="fo_gender" class="form-label">Gender</label>
            <input type="text" class="form-control" name="fo_gendez" id="fo_gender">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_number" class="form-label">Passport Number</label>
            <input type="text" class="form-control" name="fo_pass_number" id="fo_pass_number">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
            <input type="text" class="form-control" name="fo_pass_exp" id="fo_pass_exp">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_country" class="form-label">Passport Country</label>
            <input type="text" class="form-control" name="fo_pass_country" id="fo_pass_country">
        </div>
        <div class="formAreahalf">
            <label for="fo_email" class="form-label">E-mail</label>
            <input type="text" class="form-control" name="fo_email" id="fo_email">
        </div>
        <div class="formAreahalf">
            <label for="fo_phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="fo_phone_number" id="fo_phone_number">
        </div>
        <div class="formAreahalf">
            <label for="fo_residential_Add" class="form-label">Residential Add.(according to Add.
                proof)</label>
            <input type="text" class="form-control" name="fo_residential_add" id="fo_residential_add">
        </div>
        <div class="formAreahalf">
            <label for="fo_tin_ctry" class="form-label">Current TIN country</label>
            <input type="text" class="form-control" name="fo_tin_ctry" id="fo_tin_ctry">
        </div>
        <div class="formAreahalf">
            <label for="fo_tin_number" class="form-label">Current TIN Number</label>
            <input type="text" class="form-control" name="fo_tin_number" id="fo_tin_number">
        </div>
        <div class="formAreahalf">
            <label for="fo_tin_type" class="form-label">Type of TIN</label>
            <input type="text" class="form-control" name="fo_tin_type" id="fo_tin_type">
        </div>
        <div class="formAreahalf">
            <label for="fo_job_title" class="form-label">Job Title</label>
            <input type="text" class="form-control" name="fo_job_title" id="fo_job_title">
        </div>
        <div class="formAreahalf">
            <label for="fo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>
            <input type="text" class="form-control" name="fo_mth_salary" id="fo_mth_salary">
        </div>
        <div class="formAreahalf single_div">
            <label for="fo_shrhold_rel" class="form-label">Relationship with shareholder</label>
            <input type="text" class="form-control" name="fo_shrhold_rel" id="fo_shrhold_rel">
        </div>
    </div>
   
    <ul id="nav_list_add_fo" style="display:none;">
        <li class="list-group-item active">
            <a href="#">1</a>
            <p> Business Details </p>
        </li>
        <li class="list-group-item">
            <a href="#">2</a>
            <p> Company Details</p>
        </li>
        <li class="list-group-item">
            <a href="#">3</a>
            <p> Shareholder</p>
        </li>
        <li class="list-group-item">
            <a href="#">4</a>
            <p> Complete </p>
        </li>
    </ul>
    <div id="NFO_First" class="formAreahalf" style="display:none;">
        <div class="formAreahalf">
            <label for="nfo_client_type" class="form-label">Client Type</label>
            <select name="nfo_client_type" id="nfo_client_type" class="nfo_client_type">
                <option value="" selected disabled>Please select client type</option>
                <option value="Personal">Personal</option>
                <option value="Corporate">Corporate</option>
            </select>
        </div>
    </div>
    <ul id="nav_list_add_nfo" style="display:none;">
        <li class="list-group-item active">
            <a href="#">1</a>
            <p> Business Details </p>
        </li>
        <li class="list-group-item">
            <a href="#">2</a>
            <p> Personal Details</p>
        </li>
        <li class="list-group-item">
            <a href="#">3</a>
            <p> Complete </p>
        </li>
    </ul>
    <ul id="nav_list_add_nfo_corporate" style="display:none;">
        <li class="list-group-item active">
            <a href="#">1</a>
            <p> Business Details </p>
        </li>
        <li class="list-group-item">
            <a href="#">2</a>
            <p> Company Details</p>
        </li>
        <li class="list-group-item">
            <a href="#">3</a>
            <p> Shareholder </p>
        </li>
        <li class="list-group-item">
            <a href="#">4</a>
            <p> Complete </p>
        </li>
    </ul>
    <div id="NFO_shrhold_c2_company" class="added_shareholder_cmp2_nfo" style="display:none;">
        <div class="formAreahalf">
            <label for="nfo_cpm2_cmpname" class="form-label">Company Name</label>
            <input type="text" name="nfo_cpm2_cmpname" id="nfo_cpm2_cmpname" class="form-control" value="">
        </div>
    </div>
    <div id="NFO_shrhold_c2_personal" class="added_shareholder_cmp2_nfo" style="display:none;">
        <div class="formAreahalf">
            <label for="nfo_cpm2_passname" class="form-label">Passport Full Name(Eng)</label>
            <input type="text" name="nfo_cpm2_passname" id="nfo_cpm2_passname" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_ch" class="form-label">Passport Full Name(Chinese)</label>
            <input type="text" name="nfo_cpm2_pass_ch" id="nfo_cpm2_pass_ch" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_gender" class="form-label">Gender</label>
            <input type="text" name="nfo_cpm2_gender" id="nfo_cpm2_gender" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_dob" class="form-label">DOB(MM/DD/YYYY)</label>
            <input type="text" name="nfo_cpm2_dob" id="nfo_cpm2_dob" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_no" class="form-label">Passport Number</label>
            <input type="text" name="nfo_cpm2_pass_no" id="nfo_cpm2_pass_no" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_cnty" class="form-label">Passport Country</label>
            <input type="text" name="nfo_cpm2_pass_cnty" id="nfo_cpm2_pass_cnty" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
            <input type="text" name="nfo_cpm2_pass_exp" id="nfo_cpm2_pass_exp" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_renew" class="form-label">Passport Renewal Reminder</label>
            <input type="text" name="nfo_cpm2_pass_renew" id="nfo_cpm2_pass_renew" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_frq" class="form-label">Passport Reminder Trigger Frequency</label>
            <input type="text" name="nfo_cpm2_pass_frq" id="nfo_cpm2_pass_frq" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_email" class="form-label">Email</label>
            <input type="text" name="nfo_cpm2_email" id="nfo_cpm2_email" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_ctry" class="form-label">Current TIN country</label>
            <input type="text" name="nfo_cpm2_tin_ctry" id="nfo_cpm2_tin_ctry" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="fo_cpm2_res_add" class="form-label">Residential Add.(according to Add. proof)</label>
            <input type="text" name="fo_cpm2_res_add" id="fo_cpm2_res_add" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_type" class="form-label">Type of TIN</label>
            <input type="text" name="nfo_cpm2_tin_type" id="nfo_cpm2_tin_type" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_num" class="form-label">Current TIN Number</label>
            <input type="text" name="nfo_cpm2_tin_num" id="nfo_cpm2_tin_num" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_sal" class="form-label">Monthly Salary in the company(SGD)</label>
            <input type="text" name="nfo_cpm2_sal" id="nfo_cpm2_sal" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_job_title" class="form-label">Job Title</label>
            <input type="text" name="nfo_cpm2_job_title" id="nfo_cpm2_job_title" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_relation" class="form-label">Relationship with shareholder 1</label>
            <input type="text" name="nfo_cpm2_relation" id="nfo_cpm2_relation" class="form-control" value="">
        </div>
    </div>

@endsection
@push('js')
    <script src="{{asset('js/wealth.js')}}" type="text/javascript">       
    </script>
@endpush
