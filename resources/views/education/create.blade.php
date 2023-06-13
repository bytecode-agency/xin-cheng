@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add Education Application</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('wealth.index') }}">Education</a></li>
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
    <div class="dataAreaMain education_add_form">

        {!! Form::open([
            'url' => 'javascript:void(0);',
            'method' => 'POST',
            'class' => 'd-flex justify-content-start flex-wrap',
            'id' => 'education_form',
        ]) !!}
        @csrf
        <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

        <fieldset id="education" class="w-100 justify-content-start  flex-wrap form-fields education">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item active">
                                <a href="">1</a>
                                <p> Personal Details </p>
                            </li>

                            <li class="list-group-item">
                                <a href="">2</a>
                                <p> Student Pass Application </p>
                            </li>

                            <li class="list-group-item">
                                <a href="">3</a>
                                <p> Parent’s Personal Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">4</a>
                                <p>Parent’s LTVP Application </p>
                            </li>
                            <li class="list-group-item">
                                <a href="">5</a>
                                <p>Parent/Guardian Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">6</a>
                                <p>Complete</p>
                            </li>

                        </ul>

                    </div>


                </div>
                <div class="education_info d-flex flex-wrap">
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Types of Education Level</label>
                        <select name="education_type" id="education_type" class="form-control">
                            <option value="" selected disabled>Choose types of education level</option>
                            <option value="Primary School">Primary School</option>
                            <option value="Secondary School">Secondary School</option>
                            <option value="Bachelor">Bachelor</option>
                            <option value="Master">Master</option>
                            <option value="Others (please specify)">Others (please specify)</option>

                        </select>
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Client's Full Name</label>
                        <input type="text" name="client_name" id="client_name" class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Full Name(Chinese)</label>
                        <input type="text" name="pass_name" id="pass_name" class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Client's Current Pass in SG</label>
                        <select name="current_pass" id="current_pass" class="form-control">
                            <option value="" selected disabled>Choose client's current pass in SG</option>
                            <option value="EP">EP</option>
                            <option value="SP">SP</option>
                            <option value="DP">DP</option>
                            <option value="LVTP">LVTP</option>
                            <option value="Student Pass">Student Pass</option>
                            <option value="N/A">N/A</option>
                            <option value="Others (please specify)">Others(please specify)</option>
                        </select>
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Gender(M/F)</label>
                        <!-- <input type="text" name="gender" id="gender" class="form-control" value=""> -->
                        <select name="gender" id="gender" class="form-control">
                        <option value="" selected disabled>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">DOB(DD/MM/YYYY)</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Number</label>
                        <input type="text" name="pass_no" id="pass_no" class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Country</label>
                        <input type="text" name="pass_country" id="pass_country" class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Expiry Date(DD/MM/YYYY) </label>
                        <input type="date" name="pass_expiry_date" id="pass_expiry_date" class="form-control"
                            value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Renewal Reminder </label>
                        <select name="pass_renewal_rem" id="pass_renewal_rem" class="form-control">
                            <option value="" selected disabled>Choose passport renewal reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>

                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Passport Reminder Trigger Frequency</label>
                        <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="pass_trg_fqy" id="pass_trg_fqy" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Phone Number</label>
                        <input type="text" name="phone_no" id="phone_no" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Residential Address</label>
                        <input type="text" name="residential_add" id="residential_add" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Remarks</label>
                        <textarea id="remark" name="remark" rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div id="add_schol_parent" class="parent_div">

                    <div id="add-school-1" data-id="1"
                        class="w-100 d-flex flex-wrap justify-content-start form-fields company_design add_school_div"
                        style="margin-left:100px;">
                        {{-- <span class="cancel_company cancel_school"><i class="fa fa-times"
                                    aria-hidden="true"></i></span> --}}
                        <div class="formAreahalf">
                            <label for="education_type" class="form-label">Name of School to be applied</label>
                             <input type="text" name="school_name" id="school_name" class="form-control" value=""> 
                           <!-- <select name="edu[1][school_name]" id="education_type" class="form-control">\ -->
                              <!--  <option value="" selected disabled>Choose name of school to be applied</option> -->
                               <!-- <option value="Hwa Chong International School">Hwa Chong International School</option> -->
                                
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="education_type" class="form-label">Education Description</label>
                            <textarea id="remark" name="edu[1][education_description]" rows="4" cols="50"></textarea>
                        </div>
                        <div class="formAreahalf">
                            <label for="education_type" class="form-label">Application Date(DD/MM/YYYY)</label>
                            <input type="date" name="edu[1][application_date]" id="education_type"
                                class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="education_type" class="form-label">School Application Status</label>
                            <select name="edu[1][school_application_status]" id="school_application_status"
                                class="js-example-responsive school_status form-control">
                                <option value="" selected disabled>Choose school application status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>


                    <div class="text-center pt-4 add_potentia add_school_btnDiv" id="add_company_btn_div">
                        <button type="button" id="add_school" class="btn saveBtn add_school" name="add_school">Add
                            School to be
                            applied</button>
                    </div>
                </div>

            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next" class="btn saveBtn next" data-id="1">Next</button>
            </div>
        </fieldset>
        <fieldset id="student_pass_education" class="w-100 justify-content-start flex-wrap form-fields education"
            style="display: none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item active">
                                <a href="">1</a>
                                <p> Personal Details </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">2</a>
                                <p> Student Pass Application </p>
                            </li>

                            <li class="list-group-item">
                                <a href="">3</a>
                                <p> Parent’s Personal Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">4</a>
                                <p>Parent’s LTVP Application </p>
                            </li>
                            <li class="list-group-item">
                                <a href="">5</a>
                                <p>Parent/Guardian Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">6</a>
                                <p>Complete</p>
                            </li>

                        </ul>

                    </div>


                </div>
                <div id="student_pass_opt" class="education_info d-flex flex-wrap">
                    <div class="formAreahalf education-fields">
                        <label for="education_type" class="form-label">Need of student-Pass Application</label>
                        <select name="need_student_pass_app" id="need_student_pass_app"
                            class="form-control student_pass">
                            <option value="" selected disabled>Choose option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next" class="btn saveBtn next" data-id="2">Next</button>
                <button type="button" id="previous" class="btn saveBtn cancelBtn previous"
                    data-id="1">Back</button>
            </div>
        </fieldset>
        <fieldset id="parents_details_education" class="w-100 justify-content-start flex-wrap form-fields education"
            style="display: none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item active">
                                <a href="">1</a>
                                <p> Personal Details </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">2</a>
                                <p> Student Pass Application </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">3</a>
                                <p> Parent’s Personal Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">4</a>
                                <p>Parent’s LTVP Application </p>
                            </li>
                            <li class="list-group-item">
                                <a href="">5</a>
                                <p>Parent/Guardian Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">6</a>
                                <p>Complete</p>
                            </li>

                        </ul>

                    </div>


                </div>
                <div class="education_info parents_info d-flex flex-wrap">
                    <div class="formAreahalf">
                        <label for="par_pass_name" class="form-label">Passport Full Name (Eng)</label>
                        <input type="text" name="par_pass_name" id="par_pass_name" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                        <input type="text" name="par_pass_name_chinese" id="par_pass_name_chinese"
                            class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="relation_with_client" class="form-label">Relationship with Client
                            (Father/Mother)</label>
                        <select name="relation_with_client" id="relation_with_client" class="form-control">
                            <option value="" selected disabled>Choose relationship with client</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_gender" class="form-label">Gender (M/F)</label>
                        <!-- <input type="text" name="par_gender" id="par_gender" class="form-control" value=""> -->
                        <select name="gender" id="gender" class="form-control">
                        <option value="" selected disabled>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_dob" class="form-label">DOB (DD/MM/YYYY)</label>
                        <input type="date" name="par_dob" id="par_dob" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_no" class="form-label">Passport Number</label>
                        <input type="text" name="par_pass_no" id="par_pass_no" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_renewal_reminder" class="form-label">Passport Renewal Reminder</label>
                        <select name="par_pass_renewal_reminder" id="par_pass_renewal_reminder" class="form-control">
                            <option value="" selected disabled>Choose passport renewal reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_exp_date" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                        <input type="date" name="par_pass_exp_date" id="par_pass_exp_date" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_renewal_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                        <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="par_pass_renewal_frq" id="par_pass_renewal_frq" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_pass_country" class="form-label">Passport Country</label>
                        <input type="text" name="par_pass_country" id="par_pass_country" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_job_occupation" class="form-label">Job Occupation</label>
                        <input type="text" name="par_job_occupation" id="par_job_occupation" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_annual_income" class="form-label">Annual Income</label>
                        <div class="dollersec"><span class="doller">$</span>
                            <span class="input"> <input type="text" class="form-control" name="par_annual_income"
                                    id="par_annual_income"></span>
                        </div>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_email" class="form-label">Email Address</label>
                        <input type="text" name="par_email" id="par_email" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_phone" class="form-label">Phone Number</label>
                        <input type="text" name="par_phone" id="par_phone" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="par_address" class="form-label">Residential Address</label>
                        <input type="text" name="par_address" id="par_address" class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="remarks_parents" class="form-label">Remarks</label>
                        <textarea id="remarks" name="remarks_parents" rows="4" cols="50"></textarea>

                    </div>

                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next" class="btn saveBtn next" data-id="3">Next</button>
                <button type="button" id="previous" class="btn saveBtn cancelBtn previous"
                    data-id="2">Back</button>
            </div>

        </fieldset>
        <fieldset id="parents_ltvp" class="w-100 justify-content-start flex-wrap form-fields education"
            style="display: none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item active">
                                <a href="">1</a>
                                <p> Personal Details </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">2</a>
                                <p> Student Pass Application </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">3</a>
                                <p> Parent’s Personal Details</p>
                            </li>
                            <li class="list-group-item active">
                                <a href="">4</a>
                                <p>Parent’s LTVP Application </p>
                            </li>
                            <li class="list-group-item">
                                <a href="">5</a>
                                <p>Parent/Guardian Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">6</a>
                                <p>Complete</p>
                            </li>

                        </ul>

                    </div>


                </div>
                <div class="education_info parents_info parent_lvtp d-flex flex-wrap">
                    <div class="formAreahalf education-fields">
                        <label for="education_type" class="form-label">Parent's LTVP Application</label>
                        <select name="parents_ltvp_app" id="parents_ltvp_app" class="form-group parents_ltvp_app">
                            <option value="" selected disabled>Choose Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next" class="btn saveBtn" data-id="4">Next</button>
                <button type="button" id="previous" class="btn saveBtn cancelBtn previous"
                    data-id="3">Back</button>
            </div>

        </fieldset>
        <fieldset id="guardian_details" class="w-100 justify-content-start flex-wrap form-fields education"
            style="display: none">
            <div class="card formContentData border-0 p-4">
                <div class="Personal_Details">
                    <div class="First-heading_">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item active">
                                <a href="">1</a>
                                <p> Personal Details </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">2</a>
                                <p> Student Pass Application </p>
                            </li>

                            <li class="list-group-item active">
                                <a href="">3</a>
                                <p> Parent’s Personal Details</p>
                            </li>
                            <li class="list-group-item active">
                                <a href="">4</a>
                                <p>Parent’s LTVP Application </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="">5</a>
                                <p>Parent/Guardian Details</p>
                            </li>
                            <li class="list-group-item">
                                <a href="">6</a>
                                <p>Complete</p>
                            </li>

                        </ul>

                    </div>


                </div>
                <div class="education_info parents_info guardian_info d-flex flex-wrap">
                    <div class="formAreahalf">
                        <label for="guardian_relation" class="form-label">Relationship with Client
                            (Mother/Grandmother)</label>
                        <select name="guardian_relation" id="guardian_relation" class="form-control">
                            <option value="" selected disabled>Choose relationship with client</option>
                            <option value="Mother">Mother</option>
                            <option value="Grandmother">Grandmother</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_name" class="form-label">Passport Full Name (Eng)</label>
                        <input type="text" name="guardian_pass_name" id="guardian_pass_name" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                        <input type="text" name="guardian_pass_name_chinese" id="guardian_pass_name_chinese"
                            class="form-control" value="">
                    </div>

                    <div class="formAreahalf">
                        <label for="guardian_gender" class="form-label">Gender (M/F)</label>
                        <input type="text" name="guardian_gender" id="guardian_gender" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_dob" class="form-label">DOB (DD/MM/YYYY)</label>
                        <input type="date" name="guardian_dob" id="guardian_dob" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_no" class="form-label">Passport Number</label>
                        <input type="text" name="guardian_pass_no" id="guardian_pass_no" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_renewal" class="form-label">Passport Renewal Reminder</label>
                        <select name="guardian_pass_renewal" id="guardian_pass_renewal" class="form-control">
                            <option value="" selected disabled>Choose passport renewal reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_expiry_date" class="form-label">Passport Expiry Date
                            (DD/MM/YYYY)</label>
                        <input type="date" name="guardian_pass_expiry_date" id="guardian_pass_expiry_date"
                            class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                        <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="guardian_pass_frq" id="guardian_pass_frq" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_pass_country" class="form-label">Passport Country</label>
                        <input type="text" name="guardian_pass_country" id="guardian_pass_country"
                            class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_job" class="form-label">Job Occupation</label>
                        <input type="text" name="guardian_job" id="guardian_job" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_annual_income" class="form-label">Annual Income</label>
                        <input type="text" name="guardian_annual_income" id="guardian_annual_income"
                            class="form-control" value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_email" class="form-label">Email Address</label>
                        <input type="text" name="guardian_email" id="guardian_email" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_phone" class="form-label">Phone Number</label>
                        <input type="text" name="guardian_phone" id="guardian_phone" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_address" class="form-label">Residential Address</label>
                        <input type="text" name="guardian_address" id="guardian_address" class="form-control"
                            value="">
                    </div>
                    <div class="formAreahalf">
                        <label for="guardian_remarks" class="form-label">Remarks</label>
                        <textarea id="guardian_remarks" name="guardian_remarks" rows="4" cols="50"></textarea>

                    </div>

                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next" class="btn saveBtn education_submit" data-id="4">Next</button>
                <button type="button" id="previous" class="btn saveBtn cancelBtn previous"
                    data-id="4">Back</button>
            </div>
        </fieldset>
        {!! Form::close() !!}


    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

            var form = $('#education_form');
            $('.add_school').click(function() {
                var dataId = $(this).parents('#add_schol_parent').find('.add_school_div:last').attr(
                    'data-id');
                dataId++;
                $(this).parents('#add_schol_parent').find('#add-school-' + (dataId - 1)).after(
                    `<div id="add-school-` + dataId + `" data-id=` + dataId + ` class="w-100 d-flex 
                                flex-wrap justify-content-start form-fields company_design add_school_div" style="margin-left:100px;">
                                <span class="cancel_company cancel_school"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <div class="formAreahalf">
                                    <label for="education_type" class="form-label">Name of School to be applied</label>
                                    <select name="edu[` + dataId + `][school_name]" id="education_type" class="form-control">
                                        <option value="" selected disabled>Choose name of school to be applied</option>
                                        <option value="Hwa Chong International School">Hwa Chong International School</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label for="education_type" class="form-label">Education Description</label>
                                    <textarea id="remark" name="edu[` + dataId + `][education_description]" rows="4" cols="50"></textarea>
                                </div>
                                <div class="formAreahalf">
                                    <label for="education_type" class="form-label">Application Date</label>
                                    <input type="date" name="edu[` + dataId + `][application_date]" id="education_type" class="form-control"
                                        value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="education_type" class="form-label">School Application Status</label>
                                    <select name="edu[` + dataId + `][school_application_status]" id="school_application_status" class="js-example-responsive school_status form-control">
                                        <option value="" selected disabled>Choose school application status</option>
                                        <option value="Approved">Approved</option>
                                        </select>
                                </div>
                            </div>`
                );
            });

            $('body').on('click', '.next', function() {
                // form.validate({
                //     rules: {
                //         education_type: {
                //             required: true
                //         },
                //         client_name: {
                //             required: true
                //         },
                //         gender: {
                //             required: true,

                //         },
                //         current_pass: {
                //             required: true
                //         },
                //         dob: {
                //             required: true
                //         },
                //         pass_no: {
                //             required: true,

                //         },
                //         pass_country: {
                //             required: true
                //         },
                //         pass_expiry_date: {
                //             required: true
                //         },
                //         pass_renewal_rem: {
                //             required: true
                //         },
                //         pass_trg_fqy: {
                //             required: true
                //         },
                //         phone_no: {
                //             required: true
                //         },
                //         email: {
                //             required: true
                //         },
                //         residential_add: {
                //             required: true
                //         },

                //     },
                // });
                // if (form.valid() === true) {
                $(this).parents('fieldset').hide();
                $(this).closest('fieldset').next().show();
                // }
            });
            $('body').on('click', '.previous', function() {
                $(this).parents('fieldset').hide();
                $(this).closest('fieldset').prev('fieldset').show();
            })
            $('body').on('click', '.cancel_school', function() {
                $(this).parents('.add_school_div').remove();
            });
            $('body').on('change', '.student_pass', function() {
                if ($(this).val() == "Yes") {
                    $('#student_pass_opt').css('margin-left', '100px');
                    $('#student_pass_opt').css('margin-bottom', '10px');
                    $('#student_pass_opt').html(`  
                    <div class="formAreahalf">
                        <label for="need_student_pass_app" class="form-label">Need of student-Pass Application</label>
                        <select name="need_student_pass_app" id="need_student_pass_app" class="form-control student_pass">                           
                            <option value="Yes" selected>Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>                      
                    <div class="formAreahalf">
                        <label for="pass_app_status" class="form-label">Pass Application Status</label>
                        <select name="pass_app_status" id="pass_app_status" class="js-example-responsive form-control">
                            <option value="" selected disabled>Choose pass application status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                    <label for="pass_issuance" class="form-label">Pass Issuance</label>
                    <select name="pass_issuance" id="pass_issuance" value="" class="js-example-responsive form-control">
                        <option value="" selected disabled>Choose pass issuance</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                        <option value="Withdrawn">Withdrawn</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                    <label for="pass_issuance_date" class="form-label">Pass Issuance Date(DD/MM/YYYY)</label>
                    <input type="date" name="pass_issuance_date" id="pass_issuance_date" value="" class="form-control">
                    </div>
                    <div class="formAreahalf">
                    <label for="std_pass_expiry_date" class="form-label">Pass Expiry Date(DD/MM/YYYY)</label>
                    <input type="date" name="std_pass_expiry_date" id="std_pass_expiry_date" value="" class="form-control">
                    </div>
                    <div class="formAreahalf">
                    <label for="pass_duration" class="form-label">Pass Duration (Years)</label>
                    <input type="text" name="pass_duration" id="pass_duration" value="" class="form-control">
                    </div>
                    <div class="formAreahalf">
                    <label for="pass_renewal_reminder" class="form-label">Pass Renewal Reminder</label>
                    <select name="pass_renewal_reminder" id="pass_renewal_reminder" value="" class="form-control">
                        <option value="" selected disabled>Choose pass renewal reminder</option>
                        <option value="90 days before expiry">90 days before expiry</option>
                        <option value="120 days before expiry">120 days before expiry</option>
                        <option value="180 days before expiry">180 days before expiry</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                    <label for="fin_number" class="form-label">FIN Number</label>
                    <input type="text" name="fin_number" id="fin_number" value="" class="form-control">
                    </div>
                    <div class="formAreahalf">
                    <label for="pass_renewal_frq" class="form-label">Pass Renewal Frequency</label>                   
                    <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="pass_renewal_frq" id="pass_renewal_frq" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
                    </div>
                    <div class="formAreahalf">
                    <label for="remak" class="form-label">Remarks</label>
                    <textarea id="remak" name="remak" rows="4" cols="50"></textarea>
                    </div>`);
                } else {
                    $('#student_pass_opt').css('margin-left', '500px');
                    $('#student_pass_opt').css('margin-bottom', '200px');
                    $('#student_pass_opt').html(`<div class="formAreahalf">
                        <label for="education_type" class="form-label">Need of student-Pass Application</label>
                        <select name="need_student_pass_app" id="need_student_pass_app" class="form-control student_pass">                           
                            <option value="Yes" >Yes</option>
                            <option value="No" selected>No</option>
                        </select>
                    </div>`);

                }

            });
            $('body').on('change', '.parents_ltvp_app', function() {
                $('.parent_lvtp').css('margin-left', '100px');
                $('.parent_lvtp').css('margin-bottom', '20px');
                if ($(this).val() == "Yes") {
                    $(this).parents('fieldset').find('#next').removeClass('education_submit');
                    $(this).parents('fieldset').find('#next').addClass('next');
                    $('.parent_lvtp').html(`
                    <div class="formAreahalf">
                        <label for="parents_ltvp_app" class="form-label">Parent's LTVP Application</label>
                        <select name="parents_ltvp_app" id="parents_ltvp_app" class="form-group parents_ltvp_app">
                            <option value="Yes" selected>Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="education_type" class="form-label">Pass Application Status</label>
                        <select name="par_ltvp_pass_app_status" id="par_ltvp_pass_app_status" class="form-control">
                            <option value="" selected disabled>Choose pass application status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            </select> 
                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_issuance" class="form-label">Pass Issuance</label>
                        <select name="par_ltvp_pass_issuance" id="par_ltvp_pass_issuance" class="form-control">
                            <option value="" selected disabled>Choose pass issuance</option>
                            <option value="Progress">Progress</option>
                            <option value="Done">Done</option>
                            <option value="Withdrawn">Withdrawn</option>
                        </select>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_issuance_date" class="form-label">Pass Issuances Date(DD/MM/YYYY)</label>
                        <input type="date" name="par_ltvp_pass_issuance_date" id="par_ltvp_pass_issuance_date" class="form-control" value=""> 

                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_issuance_exp_date" class="form-label">Pass Expiry Date(DD/MM/YYYY)</label>
                        <input type="date" name="par_ltvp_pass_issuance_exp_date" id="par_ltvp_pass_issuance_exp_date" class="form-control" value=""> 

                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_duration" class="form-label">Pass Duration (Years)</label>
                        <input type="text" name="par_ltvp_pass_duration" id="par_ltvp_pass_duration" class="form-control" value=""> 

                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_renewal" class="form-label">Pass Renewal Reminder</label>
                        <select name="par_ltvp_pass_renewal" id="par_ltvp_pass_renewal" class="form-control">
                            <option value="" selected disabled>Choose pass renewal reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                        </select>                        
                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_fin_no" class="form-label">FIN Number</label>
                        <input type="text" name="par_ltvp_fin_no" id="par_ltvp_fin_no" class="form-control" value=""> 

                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_pass_frq" class="form-label">Pass Renewal Frequency</label>
                        <div class="select_box"><span class="every">Every</span><span class="select"><select
                                    name="par_ltvp_pass_frq" id="par_ltvp_pass_frq" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option>
                                </select></span></div>
                    </div>
                    <div class="formAreahalf">
                        <label for="par_ltvp_remarks" class="form-label">Remarks</label>
                        <textarea name="par_ltvp_remarks" id="par_ltvp_remarks" rows="4" cols="50"></textarea> 
                    </div>
                    `);
                } else {
                    $('.parent_lvtp').css('margin-left', '500px');
                    $('.parent_lvtp').css('margin-bottom', '200px');
                    $(this).parents('fieldset').find('#next').addClass('education_submit');
                    $(this).parents('fieldset').find('#next').removeClass('next');
                    $('.parent_lvtp').html(`<div class="formAreahalf">
                            <label for="parents_ltvp_app" class="form-label">Parent's LTVP Application</label>
                            <select name="parents_ltvp_app" id="parents_ltvp_app" class="form-group parents_ltvp_app">
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            </select>
                        </div>`);

                }
            });
            $('body').on('click', '.education_submit', function() {
                var formdata = $('form').serialize();
                var url = "{{ route('education.create') }}";
                console.log(formdata);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: url,
                    data: formdata,
                    success: function(response) {

                        console.log(response.success);
                        const el = document.createElement('div');
                        el.innerHTML =
                            `<p>You can view Application <a class='view-application' href='/education-view/` +
                            response
                            .success.id + `'>here</a></p>
                            <div class='number_main swal_number education_add_model'><ul class="list-group list-group-horizontal" id = "nav_list">
                            <li class="list-group-item active"> <a href="#">1</a><p> Personal Details </p> </li> 
                            <li class="list-group-item active"> <a href="#">2</a><p> Student Pass Application </p> </li>                    
                            <li class="list-group-item active"> <a href="#">3</a><p> Parent Personal Details </p> </li></ul>
                            <li class="list-group-item active"> <a href="#">4</a><p> Parents LTVP Application </p> </li></ul>
                            <li class="list-group-item active"> <a href="#">5</a><p> Parent/Guardian Details </p> </li></ul>
                            <li class="list-group-item active"> <a href="#">5</a><p> Complete </p> </li></ul>
                            </div>`;

                        swal({
                            title: `Application Created`,
                            content: el,
                            icon: "success",
                            buttons: true,
                            buttons: {
                                cancel: false,
                                confirm: {
                                    text: 'Close',
                                    className: 'btn btn-danger'
                                },
                            },
                        }).then((result) => {
                            // $('#multistep_form')[0].reset();
                            window.location = "/education-add";
                        })
                    }
                });
            });

        });
    </script>
@endpush
