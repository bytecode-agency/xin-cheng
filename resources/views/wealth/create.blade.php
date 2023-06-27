@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
    <div class="dataAreaMain wealth_application">

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
                <div class="ghyu w-100 d-flex justify-content-start flex-wrap form-fields" id="append_div_form"
                    style="margin-bottom:40px">
                    <div class="formAreahalf">
                        <label for="business_type" class="form-label">Business Type</label>
                        <select id="business_type" name="business_type" class="business_type form-control">
                            <option value="" selected disabled>Choose Business Type</option>
                            <option value="FO">FO</option>
                            <option value="Non-FO">Non-FO</option>
                        </select>

                    </div>

                    {{-- <div id="append_div_form" class="w-100 d-flex justify-content-start flex-wrap form-fields"></div> --}}
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next1" class="btn saveBtn next1" data-id="1">Next</button>
                <button type="button" style="display:none;" id="#previous1"
                    class="btn saveBtn cancelBtn previous1">Back</button>
            </div>
        </fieldset>

        <fieldset id="FO_company" class="w-100 justify-content-start flex-wrap form-fields wealth wealth_companies"
            style="display:none">
            <div class="card formContentData border-0 p-4 wealth_companies_change">
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
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <div class="accordion-header" id="panelsStayOpen-headingOne">
                                    <div class="formAreahalf company-full_width_Cstm">
                                        <label for="fo_compnay_1" class="form-label">Company Name 1</label>
                                        <input type="text" name="cmp[1][name]" id="fo_compnay_1" class="form-control"
                                            value="">
                                    </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">
                                        <div class="formAreahalf">
                                            <label for="fo_uen_1" class="form-label">UEN</label>
                                            <input type="text" class="form-control" name="cmp[1][uen]"
                                                id="fo_uen_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_company_add_1" class="form-label">Company Address</label>
                                            <input type="text" class="form-control" name="cmp[1][address]"
                                                id="fo_company_add_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_incorporation_date_1" class="form-label">Incorporation
                                                Date (DD/MM/YYYY)</label>
                                            <input type="date" class="form-control" name="cmp[1][incorporate_date]"
                                                id="fo_incorporation_date_1" placeholder="dd/mm/yyyy">
                                        </div>
                                        <!-- <div class="formAreahalf"> <label for="fo_relationship_1"
                                                class="form-label">Relationship with Company 1</label> <select
                                                class="form-control" name="cmp[1][relationship]"
                                                id="fo_relationship_1">
                                                <option value="" selected="" disabled="">Choose
                                                    Relationship with Company</option>
                                                <option value="Self">Self</option>
                                                <option value="Subsidiary">Subsidiary</option>
                                                <option value="Parent company">Parent company</option>
                                                <option value="Fund co.">Fund co.</option>
                                                <option value="Management co.">Management co.</option>
                                            </select>
                                        </div> -->
                                        <div class="formAreahalf mb-5">
                                            <label for="fo_company_email_1" class="form-label">Company Email</label>
                                            <input type="email" class="form-control" name="cmp[1][company_email]"
                                                id="fo_company_email_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_company_pass_1" class="form-label">Company Password</label>
                                            <input type="text" class="form-control" name="cmp[1][company_pass]"
                                                id="fo_company_pass_1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="appended_company_div">
                    <div id="fo_company" data-id="0">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                            <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                                {{-- <span class="cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span> --}}
                                <div class="accordion-item accordian-items-comp" id="accordion-2">
                                    <div class="accordion-header" id="panelsStayOpen-headingOne">
                                        <div class="formAreahalf company-full_width_Cstm"> <label for="fo_compnay_2"
                                                class="form-label">Company Name 2</label> <input type="text"
                                                name="cmp[2][name]" id="fo_compnay_2" class="form-control" value="">
                                        </div> <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne2" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>

                                        </button>
                                    </div>
                                    <div id="panelsStayOpen-collapseOne2" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body d-flex flex-wrap">
                                            <div class="formAreahalf"> <label for="fo_uen_2"
                                                    class="form-label">UEN</label> <input type="text"
                                                    class="form-control" name="cmp[2][uen]" id="fo_uen_2"> </div>
                                            <div class="formAreahalf"> <label for="fo_company_add"
                                                    class="form-label">Company Address</label> <input type="text"
                                                    class="form-control" name="cmp[2][address]" id="fo_company_add">
                                            </div>
                                            <div class="formAreahalf"> <label for="fo_incorporation_date_2"
                                                    class="form-label">Incorporation Date (DD/MM/YYYY)</label> <input type="date"
                                                    class="form-control" name="cmp[2][incorporate_date]"
                                                    id="fo_incorporation_date_2" placeholder="dd/mm/yyyy"> </div>
                                            <div class="formAreahalf"> <label for="fo_relationship_2"
                                                    class="form-label">Relationship with Company 1</label> <select
                                                    class="form-control" name="cmp[2][relationship]"
                                                    id="fo_relationship_2">
                                                    <option value="" selected="" disabled="">Choose
                                                        Relationship with Company</option>
                                                    <option value="Self">Self</option>
                                                    <option value="Subsidiary">Subsidiary</option>
                                                    <option value="Parent company">Parent company</option>
                                                    <option value="Fund co.">Fund co.</option>
                                                    <option value="Management co.">Management co.</option>
                                                </select> </div>
                                            <div class="formAreahalf"> <label for="fo_company_email_2"
                                                    class="form-label">Company Email</label> <input type="email"
                                                    class="form-control" name="cmp[2][company_email]"
                                                    id="fo_company_email_2"> </div>
                                            <div class="formAreahalf"> <label for="fo_company_pass_2"
                                                    class="form-label">Company Password</label> <input type="text"
                                                    class="form-control" name="cmp[2][company_pass]"
                                                    id="fo_company_pass_2"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_company_btn_div">
                    <button type="button" id="add_company" class="btn saveBtn btn_design add_company"
                        name="add-company">Add
                        Company</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next2" class="btn saveBtn next2" data-id="2">Next</button>
                <button type="button" id="previous2" class="btn saveBtn cancelBtn previous">Back</button>
            </div>
        </fieldset>

        <fieldset id="FO_shareholder" class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder"
            style="display:none">
            <div class="full_div" id="comp_1">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6 id="cmp_name"></h6>
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
                                <li class="list-group-item active" id="3">
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
                    <div id="fo_shareholder" class="sharehold">
                        <div
                            class="w-100 d-flex justify-content-start flex-wrap form-fields company_design sharehold_length">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder #1</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <div class="dollersec percentage_input"><span class="input"><input type="number"
                                            name="share[1][0][equity_percentage]" id="fo_equity"
                                            class="form-control"></span><span class="pecentage_end">%</span></div>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Shareholder Type</label>
                                <select name="share[1][0][shareholder_type]" id="fo_shrholder_type"
                                    class="shrholder_type">

                                    <option value="Personal" selected>Personal</option>
                                </select>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
                        </div>
                    </div>
                    <div id="appended_shareholder_div">
                    </div>

                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
                            name="add-shareholder">Add
                            shareholder</button>
                    </div>
                </div>

                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next3" class="btn saveBtn fo_form_sub" data-id="3">hgfghf</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous"
                        data-id="1">Back</button>
                </div>
            </div>
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
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="nfo_personal" class="w-100 d-flex justify-content-start flex-wrap form-fields">
                    <div class="formAreahalf">
                        <label for="nfo_pass_name" class="form-label">Passport Full Name (Eng)</label>
                        <input type="text" class="form-control" name="nfo_pass_name" id="nfo_pass_name"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                        <input type="text" class="form-control" name="nfo_pass_name_chinese"
                            id="nfo_pass_name_chinese">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_gender" class="form-label">Gender (M/F)</label>
                        <select class="form-control" name="nfo_gender" id="nfo_gender">
                            <option value="" selected disabled>Choose Gender</option>
                            <option value="Male">M</option>
                            <option value="Female">F</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_dob" class="form-label">DOB (DD/MM/YYYY)</label>
                        <input type="text" name="nfo_dob" id="nfo_dob" class="form-control datepicker" placeholder="dd/mm/yyyy">
                        {{-- <div class="calender"><span class="cal_input"><input type="text" name="nfo_dob" id="nfo_dob"
                                    class="form-control"></span><i class="far fa-calendar-alt"></i></div> --}}
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_number" class="form-label">Passport Number</label>
                        <input type="text" class="form-control" name="nfo_pass_number" id="nfo_pass_number">

                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                        <input type="date" class="form-control" name="nfo_pass_exp" id="nfo_pass_exp" placeholder="dd/mm/yyyy">
                        {{-- <div class="calender"><span class="cal_input"><input type="date" name="nfo_pass_exp" id="nfo_pass_exp"
                            class="form-control"></span><i class="far fa-calendar-alt"></i></div> --}}
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                        <select class="form-control" name="nfo_pass_reminder" id="nfo_pass_reminder">
                            <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_country" class="form-label">Passport Country</label>
                        <input type="text" class="form-control" name="nfo_pass_country" id="nfo_pass_country">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                        {{-- <input type="text" class="form-control" name="nfo_pass_trg_frq" id="nfo_pass_trg_frq"> --}}
                        <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="nfo_pass_trg_frq" id="nfo_pass_trg_frq" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
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
                        <label for="nfo_tin_country_before_app" class="form-label">TIN Country Before Pass Application
                        </label>
                        <input type="text" class="form-control" name="nfo_tin_country_before_app"
                            id="nfo_tin_country_before_app">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_no_before_app" class="form-label">TIN Number Before Pass Application </label>
                        <input type="text" class="form-control" name="nfo_tin_no_before_app"
                            id="nfo_tin_no_before_app">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                        <select class="form-control" name="nfo_tin_type" id="nfo_tin_type">
                            <option value="" selected disabled>Choose Type of TIN</option>
                            <option value="WP">WP</option>
                            <option value="SP">SP</option>
                            <option value="EP">EP</option>
                            <option value="LTVP">LTVP</option>
                            <option value="DP">DP</option>
                            <option value="NRIC">NRIC</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" name="nfo_email" id="nfo_email">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_phone_number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="nfo_phone_number" name="nfo_phone_number" placeholder="+65 9876543210" pattern="[+][0-9]{2} [0-9]{3}[0-9]{4}[0-9]{3}" required>
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                        <input type="text" class="form-control" name="nfo_residential_Add" id="nfo_residential_Add">
                    </div>
                    <div class="formAreahalf mb-5">
                        <label for="nfo_emp_name" class="form-label">Employer's Name</label>
                        <input type="text" class="form-control" name="nfo_emp_name" id="nfo_emp_name">
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type_before_app" class="form-label">Type of TIN Before Pass
                            Application</label>
                        <select type="text" class="form-control" name="nfo_tin_type_before_app"
                            id="nfo_tin_type_before_app">
                            <option value="" selected disabled>Choose Type of TIN Before Pass
                                Application</option>
                            <option value="WP">WP</option>
                            <option value="SP">SP</option>
                            <option value="EP">EP</option>
                            <option value="LVTP">LVTP</option>
                            <option value="DP">DP</option>
                            <option value="NRIC">NRIC</option>
                        </select>
                    </div>
                    <div class="formAreahalf mb-5">
                        <label for="nfo_current_job_title" class="form-label">Current Job Title</label>
                        <input type="text" class="form-control" name="nfo_current_job_title"
                            id="nfo_current_job_title">
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_employer_ind" class="form-label">Employer's Industry</label>
                        <input type="text" class="form-control" name="nfo_employer_ind" id="nfo_employer_ind">
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next3_nfo" class="btn saveBtn next-step fo_form_sub_confirm">Submit</button>
                <button type="button" id="previous5" class="btn saveBtn cancelBtn">Back</button>
            </div>
        </fieldset>
        <fieldset id="Nfo_personal_confirm" class="w-100 justify-content-start flex-wrap form-fields wealth"
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
                        <label for="nfo_pass_name" class="form-label">Passport Full Name (Eng)</label>
                        <p id="nfo_pass_name_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                        <p id="nfo_pass_name_chinese_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_gender" class="form-label">Gender (M/F)</label>
                        <p id="nfo_gender_c">
                        </p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_dob" class="form-label">DOB (DD/MM/YYYY)</label>
                        <p id="nfo_dob_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_number" class="form-label">Passport Number</label>
                        <p id="nfo_pass_number_c"></p>

                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                        <p id="nfo_pass_exp_c">
                        </p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                        <p id="nfo_pass_reminder_c">
                        </p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_pass_country" class="form-label">Passport Country</label>
                        <p id="nfo_pass_country_c"></p>
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>

                        <p id="nfo_pass_trg_frq_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                        <p id="nfo_tin_number_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                        <p id="nfo_tin_ctry_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_no_before_app" class="form-label">TIN Number Before Pass Application </label>
                        <p id="nfo_tin_no_before_app_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                        <p id="nfo_tin_type_c">
                        </p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_email" class="form-label">E-mail</label>
                        <p id="nfo_email_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_country_before_app" class="form-label">TIN Country Before Pass Application
                        </label>
                        <p id="nfo_tin_country_before_app_c"></p>
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                        <p id="nfo_residential_Add_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_tin_type_before_app" class="form-label">Type of TIN Before Pass
                            Application</label>
                        <p id="nfo_tin_type_before_app_c">
                        </p>

                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_employer_ind" class="form-label">Employer's Industry</label>
                        <p id="nfo_employer_ind_c"></p>
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_phone_number" class="form-label">Phone Number</label>
                        <p id="nfo_phone_number_c"></p>
                    </div>

                    <div class="formAreahalf">
                        <label for="nfo_current_job_title" class="form-label">Current Job Title</label>
                        <p id="nfo_current_job_title_c"></p>
                    </div>
                    <div class="formAreahalf">
                        <label for="nfo_emp_name" class="form-label">Employer's Name</label>
                        <p id="nfo_emp_name_c"></p>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next3_nfo" class="btn saveBtn next-step fo_form_sub">Confirm</button>
                <button type="button" id="previous5" class="btn saveBtn cancelBtn nfo_personal_back">Back</button>
            </div>
        </fieldset>

        <fieldset id="NFO_corporate" class="w-100 justify-content-start flex-wrap form-fields wealth wealth_companies"
            style="display:none">
            <div class="card formContentData border-0 p-4 wealth_companies_change">
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
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_cmp_length">

                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <div class="formAreahalf company-full_width_Cstm">
                                        <label for="nfo_compnay_1" class="form-label">Company Name 1</label>
                                        <input type="text" name="corporate[1][nfo_company]" id="nfo_compnay_1"
                                            class="form-control" value="" >
                                    </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOneq" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOneq" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">
                                        <div class="formAreahalf">
                                            <label for="nfo_uen_1" class="form-label">UEN</label>
                                            <input type="text" class="form-control" name="corporate[1][nfo_uen]"
                                                id="nfo_uen_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="nfo_company_add_1" class="form-label">Company Address</label>
                                            <input type="text" class="form-control"
                                                name="corporate[1][nfo_company_add]" id="nfo_company_add_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="nfo_incorporation_date_1" class="form-label">Incorporation
                                                Date</label>
                                            <input type="date" class="form-control"
                                                name="corporate[1][nfo_incorporation_date]" id="nfo_incorporation_date_1" placeholder="dd/mm/yyyy">
                                        </div>
                                        <div class="formAreahalf mb-5">
                                            <label for="nfo_company_email_1" class="form-label">Company Email</label>
                                            <input type="email" class="form-control"
                                                name="corporate[1][nfo_company_email]" id="nfo_company_email_1">
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="nfo_company_pass_1" class="form-label">Company Password</label>
                                            <input type="text" class="form-control"
                                                name="corporate[1][nfo_company_pass]" id="nfo_company_pass_1">
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <fieldset id="NFO_shareholder" class="w-100 justify-content-start form-fields wealth NFO_shareholder">
        </fieldset>



        {!! Form::close() !!}
    </div>

    <div id="FO_First" class="formAreahalf" style="display:none;">
        <div class="formAreahalf ">
            <label for="business_type" class="form-label">Business Type</label>
            <select id="business_type" name="business_type" class="business_type">
                {{-- <option value="">Choose Business Type</option> --}}
                <option value="FO" selected>FO</option>
                <option value="Non-FO">Non-FO</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_client_type" class="form-label">Client Type</label>
            <select class="form-control" name="client_type" id="fo_client_type">
                <option value="" selected disabled>Choose Client Type </option>
                {{-- <option value="Personal">Personal</option> --}}
                <option value="Corporate">Corporate</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_type" class="form-label">Type of FO</label>
            <select class="form-control" name="type_of_fo" id="type_of_fo">
                <option value="" selected disabled>Choose Type of FO </option>
                <option value="13O">13O</option>
                <option value="13D">13D</option>
                <option value="13U">13U</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div class="formAreahalf basic_data">
            <label for="date_of_contract" class="form-label">Date of contract DD/MM/YYYY</label>
            <input type="date" class="form-control" name="date_of_contract"
                        id="date_of_contract" placeholder="dd/mm/yyyy">


        </div>
        <div class="formAreahalf">
            <label for="fo_servicing_fee_currency" class="form-label">One-time Servicing Fee Currency</label>
            <select class="form-control" name="servicing_fee_currency" id="fo_servicing_fee_currency">
                <option value="" selected disabled>Choose One-time Servicing Fee Currency</option>
                <option value="SGD">SGD</option>
                <option value="USD">USD</option>

            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_servicing_fee_amount" class="form-label">One-Time Servicing Fee Amount</label>
            <div class="dollersec"><span class="doller">$</span>
                <span class="input"> <input type="integer" class="form-control" name="servicing_fee"
                        id="fo_servicing_fee_amount"></span>
            </div>
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">One-Time Servicing Fee Status</label>
            <select class="js-example-responsive form-control one_time_status" name="servicing_fee_status">
                <option value="" selected disabled>Choose One-Time Servicing Fee Status</option>
                <option value="Pending">Pending</option>
                <option value="Received">Received</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee_currency" class="form-label">Annual Servicing Fee Currency</label>
            <select class="form-control" name="annual_fee_currency" id="fo_annual_fee_currency">
                <option value="" selected disabled>Choose Annual Servicing Fee Currency</option>
                <option value="SGD">SGD</option>
                <option value="USD">USD</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee" class="form-label">Annual Servicing Fee Amount</label>
            <div class="dollersec"><span class="doller">$</span>
                <span class="input"> <input type="integer" class="form-control" name="annual_servicing_fee"
                        id="fo_annual_fee"></span>
            </div>
        </div>
        <div class="formAreahalf">
            <label for="fo_annual_fee_status" class="form-label">Annual Servicing Fee Status</label>
            <select class="js-example-responsive form-control annual_status" name="annual_fee_status">
                <option value="" selected disabled>Choose Annual Servicing Fee Status</option>
                <option value="Pending">Pending</option>
                <option value="Received">Received</option>
                {{-- <option value="Rejected">Rejected</option> --}}
            </select>
        </div>
        <div class="formAreahalf">
            <label for="annual_fee_due_date" class="form-label">Annual Servicing Fee Due Date DD/MM/YYYY</label>
            <input type="date" class="form-control" name="annual_fee_due_date"
                        id="annual_fee_due_date" placeholder="dd/mm/yyyy">
        </div>
        <div class="formAreahalf mb-40">
            <label for="annual_fee_due_reminder" class="form-label">Annual Servicing Fee Due Reminder</label>
            <select class="form-control" name="annual_fee_due_reminder" id="annual_fee_due_reminder">
                <option value="" selected disabled>Choose Reminder </option>
                <option value="30 day before due">30 Days before due</option>
                <option value="60 day before due">60 Days before due</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="annual_fee_due_reminder_trigger" class="form-label">Annual Servicing Fee Due Reminder Trigger Frequency</label>
            <select class="form-control" name="annual_fee_due_reminder_trigger" id="annual_fee_due_reminder_trigger">
                    <option value="" selected="" disabled="">Please select</option>
                    <option value="Day">Day</option>
                    <option value="3 Days">3 Days</option>
                    <option value="Week">Week</option>
                    <option value="2 Weeks">2 Weeks</option>
                    <option value="4 Weeks">4 Weeks</option>
            </select>
        </div>
    </div>
    <div id="FO_shareholder_new" style="display:none;">

        <div class="formAreahalf">
            <label for="fo_pass_name" class="form-label">Passport Full Name</label>
            <input type="text" class="form-control" name="fo_pass_name" id="fo_pass_name">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
            <input type="text" class="form-control" name="fo_pass_name_chinese" id="fo_pass_name_chinese">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
            <input type="text" class="form-control" name="fo_pass_reminder" id="fo_pass_reminder">
        </div>
        <div class="formAreahalf">
            <label for="fo_dob" class="form-label">DOB (DD/MM/YYYY)</label>
            <input type="text" class="form-control datepicker" name="fo_dob" id="fo_dob">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
            <input type="text" class="form-control" name="fo_pass_trg_frq" id="fo_pass_trg_frq">
        </div>
        <div class="formAreahalf">
            <label for="fo_gender" class="form-label">Gender</label>
            <select class="form-control" name="fo_gender" id="fo_gender">
                <option value="" selecetd disabled>Choose gender</option>
                <option value="Male">M</option>
                <option value="Female">F</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_number" class="form-label">Passport Number</label>
            <input type="text" class="form-control" name="fo_pass_number" id="fo_pass_number">
        </div>
        <div class="formAreahalf">
            <label for="fo_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
            <input type="date" class="form-control" name="fo_pass_exp" id="fo_pass_exp">
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
            <input type="tel" id="fo_phone_number" name="fo_phone_number" class="form-control" placeholder="+65 9876543210" pattern="[+][0-9]{2} [0-9]{3}[0-9]{4}[0-9]{3}" required>
        </div>
        <div class="formAreahalf">
            <label for="fo_residential_Add" class="form-label">Residential Address</label>
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
            <label for="fo_mth_salary" class="form-label">Monthly Salary in the company (SGD)</label>
            <input type="integer" class="form-control" name="fo_mth_salary" id="fo_mth_salary">
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
            <label for="business_type" class="form-label">Business Type</label>
            <select id="business_type" name="business_type" class="business_type">
                {{-- <option value="">Choose Business Type</option> --}}
                <option value="FO">FO</option>
                <option value="Non-FO" selected>Non-FO</option>
            </select>
        </div>
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
            <label for="nfo_cpm2_passname" class="form-label">Passport Full Name (Eng)</label>
            <input type="text" name="nfo_cpm2_passname" id="nfo_cpm2_passname" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_ch" class="form-label">Passport Full Name (Chinese)</label>
            <input type="text" name="nfo_cpm2_pass_ch" id="nfo_cpm2_pass_ch" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_gender" class="form-label">Gender</label>
            <input type="text" name="nfo_cpm2_gender" id="nfo_cpm2_gender" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_dob" class="form-label">DOB (DD/MM/YYYY)</label>
            <input type="text" name="nfo_cpm2_dob datepicker" id="nfo_cpm2_dob" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_no" class="form-label">Passport Number</label>
            <input type="text" name="nfo_cpm2_pass_no" id="nfo_cpm2_pass_no" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_cnty" class="form-label">Passport Country</label>
            <input type="text" name="nfo_cpm2_pass_cnty" id="nfo_cpm2_pass_cnty" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
            <input type="date" name="nfo_cpm2_pass_exp" id="nfo_cpm2_pass_exp" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_renew" class="form-label">Passport Renewal Reminder</label>
            <input type="text" name="nfo_cpm2_pass_renew" id="nfo_cpm2_pass_renew" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_pass_frq" class="form-label">Passport Reminder Trigger Frequency</label>
            <div class="select_box"><span class="every">Every</span><span class="select"><select
                        name="nfo_cpm2_pass_frq" id="nfo_cpm2_pass_frq" class="form-control">
                        <option value="" selected="" disabled="">Please select</option>
                        <option value="Day">Day</option>
                        <option value="3 Days">3 Days</option>
                        <option value="Week">Week</option>
                        <option value="2 Weeks">2 Weeks</option>
                    </select></span></div>
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_email" class="form-label">E-mail</label>
            <input type="text" name="nfo_cpm2_email" id="nfo_cpm2_email" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_ctry" class="form-label">Current TIN country</label>
            <input type="text" name="nfo_cpm2_tin_ctry" id="nfo_cpm2_tin_ctry" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="fo_cpm2_res_add" class="form-label">Residential Address</label>
            <input type="text" name="fo_cpm2_res_add" id="fo_cpm2_res_add" class="form-control" value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_type" class="form-label">Type of TIN</label>
            <input type="text" name="nfo_cpm2_tin_type" id="nfo_cpm2_tin_type" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_tin_num" class="form-label">Current TIN Number</label>
            <input type="text" name="nfo_cpm2_tin_num" id="nfo_cpm2_tin_num" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_sal" class="form-label">Monthly Salary in the company (SGD)</label>
            <div class="dollersec"><span class="doller">$</span>
                <input type="integer" name="nfo_cpm2_sal" id="nfo_cpm2_sal" class="form-control" value="">
            </div>
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_job_title" class="form-label">Job Title</label>
            <input type="text" name="nfo_cpm2_job_title" id="nfo_cpm2_job_title" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="nfo_cpm2_relation" class="form-label">Relationship with shareholder 1</label>
            <input type="text" name="nfo_cpm2_relation" id="nfo_cpm2_relation" class="form-control"
                value="">
        </div>
    </div>
@endsection
@push('js')

    <script src="{{ asset('js/wealth.js') }}?v={{ time() }}" type="text/javascript"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endpush
