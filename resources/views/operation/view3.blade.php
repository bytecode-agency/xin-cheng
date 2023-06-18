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
    <div class="custom_operation_edit">
        {{-- <form method="post" id="operation_form_edit" class="operation_form_edit">
        @csrf --}}
        <div class="filterPagination d-flex justify-content-between align-items-center">
            <div class="paginationLeft">
                <ul>
                    <li><a href="{{ route('operation.index') }}">Operation</a></li>
                    <li>{{ Breadcrumbs::render('operation.show', $data) }}</li>
                </ul>
            </div>
            <div class="filterBtn d-flex align-items-center justify-content-end">
                <a href="{{ route('operation.edit', $data->id) }}"><button class="btn saveBtn"><span>Edit</span></button></a>
                {{-- <button class="btn saveBtn cancelBtn del_confirm" data-id="{{ $data->id }}"><span>Delete</span></button> --}}
                {{-- <a href="javascript:void(0);" data-id={{$data->id}} title="Delete" class="btn del_confirm_opr">Delete</a> --}}
                <a href="javascript:void(0);" data-id={{ $data->id }} title="Delete"
                    class="btn del_confirm_opr saveBtn cancelBtn delete">Delete</a>
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
                        <div class="formAreahalf mb-1 ">
                            <label for="cby" class="form-label">Client Status</label>
                            <div class="active-btn">Active</div>
                        </div>

                    </div>
                </div>
                <div class="application_info">
                    <div class="card company_info formContentData border-0 p-4 ">
                        <h3>Application Information</h3>
                        <div class="tabbing_wealth_four">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button type="button" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mas" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Pass Related
                                    </button>
                                    <button type="button" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-financial" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Company Related</button>
                                    <button type="button" class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pass" type="button" role="tab" aria-controls="nav-contact"
                                        aria-selected="false">PR
                                        Related</button>
                                </div>
                            </nav>

                            <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                            <div class="tab-content border_styling" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-mas" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <fieldset id="start_field_pass"
                                        class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">
                                        {{-- <div id="mas_accordion" class="mas_related"> --}}
                                        {{-- <div class="mas_heading_accordian d-flex flex-wrap"> --}}
                                        {{-- <div id="passholder_section" class="card_potentials_fg passholder_section">
                                    <div id="pass_design"
                                        class="w-100 d-flex justify-content-start flex-wrap form-fields pass_design"> --}}

                                        <div
                                            class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                            <div class="accordion-item">

                                                <h2 class="accordion-header" id="panelsStayOpen-headingnoyespass">

                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapsenoyespass"
                                                        aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapsenoyespass">
                                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>
                                                </h2>

                                                <div id="panelsStayOpen-collapsenoyespass"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingnoyespass">
                                                    <div class="accordion-body d-flex flex-wrap">



                                                        <input type="hidden" name="pass[0][pass_id]"
                                                            value="{{ $data['id'] }}" />
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Business Type</label>
                                                            {{-- <input type="text" class="form-control" name="pass[0][bus_type]" value="{{ $data['bus_type'] }}"> --}}
                                                            <p>{{ $data['bus_type'] }}</p>

                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Application
                                                                Type</label>
                                                            <p>{{ $data['pass_app_type'] }}</p>
                                                        </div>
                                                        {{-- <button type="button" class="btn btn_set" data-toggle="collapse"
                                            data-target="#mas_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                           </button> --}}
                                                        {{-- </div> --}}
                                                        {{-- <div id="mas_collapseOne" class="collapse show " aria-labelledby="headingOne"
                                          data-parent="#mas_accordion">
                                          <div class="d-flex flex-wrap"> --}}
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Does passholder need to
                                                                set up
                                                                company?</label>
                                                            <p>{{ $data['passhol_setup'] }}</p>
                                                            {{-- <select name="pass[0][passhol_setup]" id="set_company"
                                                            class="set_company">

                                                            <option value="{{ $data['passhol_setup'] }}">
                                                                {{ $data['passhol_setup'] }}</option>

                                                        </select> --}}

                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Is the passholder
                                                                also
                                                                the
                                                                shareholder?
                                                                Number</label>

                                                            <p>{{ $data['passhol_sharehol'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Holder Name 1
                                                                (Eng)</label>

                                                            <p>{{ $data['passhol_name'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full Name
                                                                (Chinese)</label>

                                                            <p>{{ $data['passport_name'] }}</p>

                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">DOB
                                                                (DD/MM/YYYY)</label>

                                                            <p>{{ $data['pass_dob'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Gender (M/F)</label>

                                                            <p>{{ $data['pass_gender'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Expiry
                                                                Date(DD/MM/YYYY)</label>

                                                            <p>{{ $data['pass_exp_dob'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Number</label>

                                                            <p>{{ $data['passport_number'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Country</label>

                                                            <p>{{ $data['passport_country'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Renewal
                                                                Reminder</label>

                                                            <p>{{ $data['passport_ren_rem'] }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">TIN Number Before
                                                                Pass
                                                                Application</label>

                                                            <p>{{ $data['passport_tin_number'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Reminder
                                                                Trigger
                                                                Frequency</label>
                                                            <p>{{ $data['passport_rem_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">E-mail</label>
                                                            <p>{{ $data['email'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">TIN Country Before
                                                                Pass
                                                                Application</label>
                                                            <p>{{ $data['passport_tin_country'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Phone Number</label>
                                                            <p>{{ $data['phno'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Type of TIN Before
                                                                Pass
                                                                Application</label>
                                                            <p>{{ $data['pass_tin_type'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">FIN Number</label>
                                                            <p>{{ $data['finno'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Residential
                                                                Address</label>
                                                            <p>{{ $data['res_add'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Application
                                                                Status</label>
                                                            <p>{{ $data['pass_app_sts'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Issuance
                                                            </label>
                                                            <p>{{ $data['pass_iss'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Issuance
                                                                Date</label>
                                                            <p>{{ $data['pass_iss_date'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Expiry
                                                                Date</label>
                                                            <p>{{ $data['pass_exp_date'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Duration </label>
                                                            <p>{{ $data['duration'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Frequency </label>
                                                            <p>{{ $data['pass_ren_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Reminder</label>
                                                            <p>{{ $data['pass_ren_rem'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Trigger</label>
                                                            <p>{{ $data['pass_ren_ter_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Job Title
                                                            </label>
                                                            <p>{{ $data['pass_job_title'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Singpass Setup
                                                            </label>
                                                            <p>{{ $data['singpass_setup'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">1st PR Application
                                                                Reminder </label>
                                                            <p>{{ $data['pr_app_rem'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Relationship With
                                                                Pass Holder
                                                                1</label>
                                                            <p>{{ $data['rel_pass_hol'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Employer's Name
                                                            </label>
                                                            <p>{{ $data['emp_name'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary (SGD)
                                                            </label>
                                                            <p>{{ $data['month_sal'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Remarks </label>
                                                            <p>{{ $data['p_remarks'] }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Reminder
                                                                Trigger
                                                                Frequency</label>
                                                            <p>{{ $data['passport_rem_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">E-mail</label>
                                                            <p>{{ $data['email'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">TIN Country Before
                                                                Pass
                                                                Application</label>
                                                            <p>{{ $data['passport_tin_country'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Phone Number</label>
                                                            <p>{{ $data['phno'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Type of TIN Before
                                                                Pass
                                                                Application</label>
                                                            <p>{{ $data['pass_tin_type'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">FIN Number</label>
                                                            <p>{{ $data['finno'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Residential
                                                                Address</label>
                                                            <p>{{ $data['res_add'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Application
                                                                Status</label>
                                                            <p>{{ $data['pass_app_sts'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Issuance
                                                            </label>
                                                            <p>{{ $data['pass_iss'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Issuance Date </label>
                                                            <p>{{ $data['pass_iss_date'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Expiry
                                                                Date</label>
                                                            <p>{{ $data['pass_exp_date'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Duration </label>
                                                            <p>{{ $data['duration'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Frequency </label>
                                                            <p>{{ $data['pass_ren_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Reminder</label>
                                                            <p>{{ $data['pass_ren_rem'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Renewal
                                                                Trigger</label>
                                                            <p>{{ $data['pass_ren_ter_fre'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Pass Job Title
                                                            </label>
                                                            <p>{{ $data['pass_job_title'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Singpass Setup
                                                            </label>
                                                            <p>{{ $data['singpass_setup'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">1st PR Application
                                                                Reminder </label>
                                                            <p>{{ $data['pr_app_rem'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Relationship With
                                                                Pass Holder
                                                                1</label>
                                                            <p>{{ $data['rel_pass_hol'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Employer's Name
                                                            </label>
                                                            <p>{{ $data['emp_name'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary (SGD)
                                                            </label>
                                                            <p>{{ $data['month_sal'] }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Remarks </label>
                                                            <p>{{ $data['p_remarks'] }}</p>
                                                        </div>
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        {{-- </div>
                                  </div> --}}

                                        {{-- </div>
                                  </div> --}}
                                        <div id="appended_passholder_div" class="appended_passholder_div">
                                        </div>
                                        <div class="text-center pt-4 " id="add-pass-holder_btn_div">
                                            <button type="button" id="add-pass-holder"
                                                class="btn saveBtn btn_design add-pass-holder" name="add-pass-holder">Add
                                                Pass Holder</button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="tab-pane fade" id="nav-financial" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">

                                    <?php $c = 0; ?>
                                    @foreach ($data->pass_company as $company)
                                        <?php $c++; ?>
                                        <div
                                            class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                            <div class="accordion-item">

                                                <h2 class="accordion-header" id="panelsStayOpen-headingnoyescomp">

                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapsenoyescomp"
                                                        aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapsenoyescomp">
                                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>
                                                </h2>

                                                <div id="panelsStayOpen-collapsenoyescomp"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingnoyescomp">
                                                    <div class="accordion-body d-flex flex-wrap">
                                                        <div class=" d-flex flex-wrap">
                                                            {{-- <div id="financial_accordion" class="mas_related">

                                                     <div class="mas_heading_accordian d-flex flex-wrap"> --}}
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label"></label>
                                                                <p></p>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">UEN</label>
                                                                <p>{{ $company['uen'] }}</p>
                                                            </div>
                                                            <button class="btn btn_set collapsed" data-toggle="collapse"
                                                                data-target="#financial_collapseOne" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                            </button>
                                                        </div>

                                                        <div id="financial_collapseOne" class="collapse"
                                                            aria-labelledby="headingOne"
                                                            data-parent="#financial_accordion">
                                                            <div class="d-flex flex-wrap">
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Company
                                                                        Address</label>

                                                                    <p>{{ $company['company_add'] }}</p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Incorporation
                                                                        Date</label>
                                                                    <p>{{ $company['incorporation_date'] }}</p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Company
                                                                        Email</label>
                                                                    <p>{{ $company['company_email'] }}</p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Company
                                                                        Password</label>
                                                                    <p>{{ $company['company_pass'] }}</p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label"></label>
                                                                    <p></p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">UEN</label>
                                                                    <p>{{ $company['uen'] }}</p>
                                                                </div>
                                                                <button class="btn btn_set collapsed" data-toggle="collapse"
                                                                    data-target="#financial_collapseOne"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                                </button>
                                                            </div>

                                                            <div id="financial_collapseOne" class="collapse"
                                                                aria-labelledby="headingOne"
                                                                data-parent="#financial_accordion">
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label">Company
                                                                            Address</label>

                                                                        <p>{{ $company['company_add'] }}</p>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for=""
                                                                            class="form-label">Incorporation
                                                                            Date</label>
                                                                        <p>{{ $company['incorporation_date'] }}</p>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label">Company
                                                                            Email</label>
                                                                        <p>{{ $company['company_email'] }}</p>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label">Company
                                                                            Password</label>
                                                                        <p>{{ $company['company_pass'] }}</p>
                                                                    </div>
                                                                </div>



                                                                <div class="tabbing_wealth_four">

                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                            role="tablist">
                                                                            <button type="button" class="nav-link active"
                                                                                id="nav-home-tab-share"
                                                                                data-bs-toggle="tab"
                                                                                data-bs-target="#nav-mas-share"
                                                                                type="button" role="tab"
                                                                                aria-controls="nav-home-tab-share"
                                                                                aria-selected="true">Shareholder </button>
                                                                            <button type="button" class="nav-link"
                                                                                id="nav-profile-tab-2"
                                                                                data-bs-toggle="tab"
                                                                                data-bs-target="#nav-financial-financial2"
                                                                                type="button" role="tab"
                                                                                aria-controls="nav-profile-tab-2"
                                                                                aria-selected="false">Financial</button>

                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content border_styling"
                                                                        id="nav-tabContent">

                                                                        <div class="tab-pane fade show active"
                                                                            id="nav-mas-share" role="tabpanel"
                                                                            aria-labelledby="nav-home-tab-share">
                                                                            <fieldset id="FO_share_holder_form"
                                                                                class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">

                                                                                <?php $s = 0; ?>
                                                                                @foreach ($company['company_share'] as $share)
                                                                                    <?php $s++; ?>

                                                                                    <div
                                                                                        class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                                                                        <div class=" d-flex flex-wrap">

                                                                                            {{-- <div class="formAreahalf basic_data">
                                                                                <label for=""
                                                                                    class="form-label">Shareholder #{{($s+1)}}</label>

                                                                            </div>  --}}
                                                                                            <div class="accordion-item">

                                                                                                <h2 class="accordion-header"
                                                                                                    id="panelsStayOpen-headingnoyesshare{{ $s }}">

                                                                                                    <button
                                                                                                        class="accordion-button"
                                                                                                        type="button"
                                                                                                        data-bs-toggle="collapse"
                                                                                                        data-bs-target="#panelsStayOpen-collapsenoyesshare{{ $s }}"
                                                                                                        aria-expanded="true"
                                                                                                        aria-controls="panelsStayOpen-collapsenoyesshare{{ $s }}">
                                                                                                        <i class="fa fa-arrows-v"
                                                                                                            aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                </h2>
                                                                                                <div
                                                                                                    class="Share_holder-w sub-heading">
                                                                                                    <h4>Shareholder
                                                                                                        #{{ $s + 1 }}
                                                                                                    </h4>
                                                                                                </div>

                                                                                                <div id="panelsStayOpen-collapsenoyesshare{{ $s }}"
                                                                                                    class="accordion-collapse collapse show"
                                                                                                    aria-labelledby="panelsStayOpen-headingnoyesshare{{ $s }}">
                                                                                                    <div
                                                                                                        class="accordion-body d-flex flex-wrap">
                                                                                                        {{-- <div id="panelsStayOpen-collapsenoyesfin{{ $f }}"
                                                                                class="accordion-collapse collapse show"
                                                                                aria-labelledby="panelsStayOpen-headingnoyesfin{{ $f }}">
                                                                                <div class="accordion-body d-flex flex-wrap"> --}}
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Shareholder</label>

                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label"></label>
                                                                                                            <p></p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Equity
                                                                                                                Percentage</label>
                                                                                                            <p>{{ $share['eqt_per'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Full
                                                                                                                Name(Eng)</label>
                                                                                                            <p>{{ $share['passhol_name'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Full
                                                                                                                Name(Chinese)</label>
                                                                                                            <p>{{ $share['passport_name'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">DOB (DD/MM/YYYY)</label>
                                                                                                            <p>{{ $share['shareholder_dob'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Gender(M/F)</label>
                                                                                                            <p>{{ $share['shareholder_gender'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Number</label>
                                                                                                            <p>{{ $share['passport_number'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Country</label>
                                                                                                            <p>{{ $share['passport_country'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Expiry
                                                                                                                Date(dd/mm/yyyy)</label>
                                                                                                            <p>{{ $share['pass_exp_dob'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Renewal
                                                                                                                Reminder</label>
                                                                                                            <p>{{ $share['passport_ren_rem'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Passport
                                                                                                                Reminder
                                                                                                                Trigger
                                                                                                                Frequency</label>
                                                                                                            <p>{{ $share['passport_rem_fre'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Type
                                                                                                                of TIN
                                                                                                                Before
                                                                                                                Pass
                                                                                                                Application</label>
                                                                                                            <p>{{ $share['tintype'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">TIN
                                                                                                                Number
                                                                                                                Before
                                                                                                                Pass
                                                                                                                Application</label>
                                                                                                            <p>{{ $share['tinno'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Tin
                                                                                                                Country
                                                                                                                Before
                                                                                                                Pass
                                                                                                                Application</label>
                                                                                                            <p>{{ $share['tincnt'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Phone
                                                                                                                Number</label>
                                                                                                            <p>{{ $share['phno'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Residential
                                                                                                                Add.(according
                                                                                                                to
                                                                                                                Add.proof)</label>
                                                                                                            <p>{{ $share['res_add'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Email</label>
                                                                                                            <p>{{ $share['email'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Job
                                                                                                                Title</label>
                                                                                                            <p>{{ $share['job_title'] }}
                                                                                                            </p>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Monthly
                                                                                                                Salary(SGD)</label>
                                                                                                            <p>{{ $share['month_sal'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Relationship
                                                                                                                with
                                                                                                                shareholder</label>
                                                                                                            <p>{{ $share['rel_share_hol'] }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Remarks</label>
                                                                                                            <p>{{ $share['remarks'] }}
                                                                                                            </p>
                                                                                                        </div>


                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                                <input type="hidden" name="share_no"
                                                                                    id="share_no"
                                                                                    value="{{ $s }}" />
                                                                                <div id="appended_share_div"
                                                                                    class="appended_share_div">
                                                                                </div>
                                                                                <div class="text-center pt-4 add_potentia add_potential"
                                                                                    id="add_shareholder_btn_div">
                                                                                    <button type="button"
                                                                                        id="add_shareholder"
                                                                                        class="btn saveBtn btn_design add_shareholder"
                                                                                        name="add-shareholder"
                                                                                        data-id="` + btn_click + `">Add
                                                                                        shareholder</button>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>


                                                                        {{-- <div class="tab-content border_styling" id="nav-tabContent"> --}}

                                                                        <div class="tab-pane fade"
                                                                            id="nav-financial-financial2{{ $c }}"
                                                                            role="tabpanel"
                                                                            aria-labelledby="nav-profile-tab-2{{ $c }}">
                                                                            <fieldset id="FO_fin_form"
                                                                                class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">
                                                                                <?php $f = -1; ?>
                                                                                @foreach ($company['company_fi'] as $fi)
                                                                                    <?php $f++; ?>
                                                                                    <div
                                                                                        class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                                                                        <div class=" d-flex flex-wrap">
                                                                                            <div class="accordion-item">

                                                                                                <h2 class="accordion-header"
                                                                                                    id="panelsStayOpen-headingnoyesfin{{ $f }}">

                                                                                                    <button
                                                                                                        class="accordion-button"
                                                                                                        type="button"
                                                                                                        data-bs-toggle="collapse"
                                                                                                        data-bs-target="#panelsStayOpen-collapsenoyesfin{{ $f }}"
                                                                                                        aria-expanded="true"
                                                                                                        aria-controls="panelsStayOpen-collapsenoyesfin{{ $f }}">
                                                                                                        <i class="fa fa-arrows-v"
                                                                                                            aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                </h2>

                                                                                                <div id="panelsStayOpen-collapsenoyesfin{{ $f }}"
                                                                                                    class="accordion-collapse collapse show"
                                                                                                    aria-labelledby="panelsStayOpen-headingnoyesfin{{ $f }}">
                                                                                                    <div
                                                                                                        class="accordion-body d-flex flex-wrap">
                                                                                                        {{-- <div id="financial_accordion" class="mas_related">
                                                                        <div
                                                                            class="mas_heading_accordian d-flex flex-wrap"> --}}
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="company_id_share_append"
                                                                                                            id="company_id_share_append"
                                                                                                            value="{{ $c }}" />
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="fi[{{ $c }}][{{ $f }}][fi_id]"
                                                                                                            value="{{ $fi['id'] }}" />
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Poc
                                                                                                                Name</label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][poc_name]"
                                                                                                                id=""
                                                                                                                class="form-control"
                                                                                                                value="{{ $fi['poc_name'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Financial
                                                                                                                Institution
                                                                                                                Name</label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][fi_name]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['poc_name'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">POC
                                                                                                                Email</label>

                                                                                                            <input
                                                                                                                type="email"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][poc_email]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['poc_email'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">POC
                                                                                                                Contact
                                                                                                                Number</label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][poc_cno]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['poc_cno'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Account
                                                                                                                Type</label>

                                                                                                            <select
                                                                                                                name="fi[{{ $c }}][{{ $f }}][acc_type]"
                                                                                                                id="">

                                                                                                                <option
                                                                                                                    value=""
                                                                                                                    selected>
                                                                                                                    Please
                                                                                                                    select
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="SGD"
                                                                                                                    {{ isset($fi['acc_type']) && $fi['acc_type'] == 'SGD' ? 'selected' : '' }}>
                                                                                                                    SGD
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="USD"
                                                                                                                    {{ isset($fi['acc_type']) && $fi['acc_type'] == 'USD' ? 'selected' : '' }}>
                                                                                                                    USD
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Multi-currency"
                                                                                                                    {{ isset($fi['acc_type']) && $fi['acc_type'] == 'Multi-currency' ? 'selected' : '' }}>
                                                                                                                    Multi-currency
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Others (please specify)"
                                                                                                                    {{ isset($fi['acc_type']) && $fi['acc_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                                                                    Others
                                                                                                                    (please
                                                                                                                    specify)
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Application
                                                                                                                Submission</label>

                                                                                                            <select
                                                                                                                name="fi[{{ $c }}][{{ $f }}][app_sub]"
                                                                                                                id=""
                                                                                                                class="js-example-responsive">
                                                                                                                <option
                                                                                                                    value=""
                                                                                                                    selected>
                                                                                                                    Please
                                                                                                                    select
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Progress"
                                                                                                                    {{ isset($fi['app_sub']) && $fi['app_sub'] == 'Progress' ? 'selected' : '' }}>
                                                                                                                    In
                                                                                                                    Progress
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Done"
                                                                                                                    {{ isset($fi['app_sub']) && $fi['app_sub'] == 'Done' ? 'selected' : '' }}>
                                                                                                                    Done
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Account
                                                                                                                Opening
                                                                                                                Status</label>

                                                                                                            <select
                                                                                                                name="fi[{{ $c }}][{{ $f }}][acc_opn_sts]"
                                                                                                                id=""
                                                                                                                class="js-example-responsive">
                                                                                                                <option
                                                                                                                    value=""
                                                                                                                    selected>
                                                                                                                    Please
                                                                                                                    select
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Pending"
                                                                                                                    {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Pending' ? 'selected' : '' }}>
                                                                                                                    Pending
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Approved"
                                                                                                                    {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Approved' ? 'selected' : '' }}>
                                                                                                                    Approved
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Rejected"
                                                                                                                    {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Rejected' ? 'selected' : '' }}>
                                                                                                                    Rejected
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Account/Policy
                                                                                                                Number
                                                                                                            </label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][acc_pol_no]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['acc_pol_no'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Money
                                                                                                                Deposit
                                                                                                                Status</label>

                                                                                                            <select
                                                                                                                name="fi[{{ $c }}][{{ $f }}][money_dep_sts]"
                                                                                                                id=""
                                                                                                                class="js-example-responsive">

                                                                                                                <option
                                                                                                                    value=""
                                                                                                                    selected>
                                                                                                                    Please
                                                                                                                    select
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Progress"
                                                                                                                    {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'Progress' ? 'selected' : '' }}>
                                                                                                                    In
                                                                                                                    progress
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Done"
                                                                                                                    {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'Done' ? 'selected' : '' }}>
                                                                                                                    Done
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="N/A"
                                                                                                                    {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'N/A' ? 'selected' : '' }}>
                                                                                                                    N/A
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Account
                                                                                                                Current
                                                                                                                Status</label>

                                                                                                            <select
                                                                                                                name="fi[{{ $c }}][{{ $f }}][acc_crt_sts]"
                                                                                                                id=""
                                                                                                                class="js-example-responsive">
                                                                                                                <option
                                                                                                                    value=""
                                                                                                                    selected>
                                                                                                                    Please
                                                                                                                    select
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Pending"
                                                                                                                    {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Pending' ? 'selected' : '' }}>
                                                                                                                    Pending
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Approved"
                                                                                                                    {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Approved' ? 'selected' : '' }}>
                                                                                                                    Approved
                                                                                                                </option>
                                                                                                                <option
                                                                                                                    value="Rejected"
                                                                                                                    {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Rejected' ? 'selected' : '' }}>
                                                                                                                    Rejected
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Online
                                                                                                                Account
                                                                                                                Username</label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][on_acc_usr_nam]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['on_acc_usr_nam'] }}">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Online
                                                                                                                Account
                                                                                                                Password</label>

                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][on_acc_usr_pass]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['on_acc_usr_pass'] }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Maturity
                                                                                                                Date</label>

                                                                                                            <input
                                                                                                                type="date"
                                                                                                                class="form-control"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][mat_date]"
                                                                                                                id=""
                                                                                                                value="{{ $fi['mat_date'] }}">
                                                                                                        </div>

                                                                                                        <div
                                                                                                            class="formAreahalf basic_data">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Remarks</label>
                                                                                                            <blade
                                                                                                                ___html_tags_2___ />

                                                                                                        </div>


                                                                                                        {{-- </div>
                                                                    </div> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                                <input type="hidden" name="fi_no"
                                                                                    id="fi_no"
                                                                                    value="{{ $f }}" />
                                                                                <div id="appended_financial_div"
                                                                                    class="appended_financial_div">
                                                                                </div>

                                                                                <div class="text-center pt-4 add_potentia add_potential"
                                                                                    id="add_financial_btn_div">
                                                                                    <button type="button"
                                                                                        id="add_financial"
                                                                                        class="btn saveBtn btn_design add_financial"
                                                                                        name="add-financial"
                                                                                        data-id="` + btn_click + `">Add
                                                                                        Financial Institution</button>
                                                                                </div>

                                                                            </fieldset>
                                                                        </div>

                                                                        {{-- </div> --}}
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                    @endforeach
                                    <div class="text-center pt-4 " id="add_company_btn_div">
                                        <button type="button" id="add_company"
                                            class="btn saveBtn btn_design add_company" name="add-company">Add
                                            Company</button>
                                    </div>
                                    {{-- </div> --}}
                                </div>

                                <div class="tab-pane fade" id="nav-pass" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <fieldset id="FO_Pass_PR"
                                        class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">

                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Pass Holder Name</label>
                                            <p>{{ $data['passhol_name'] }}</p>
                                        </div>

                                        <?php $p = -1; ?>
                                        @foreach ($data->pass_pr as $pr)
                                            <?php $p++; ?>
                                            <div
                                                class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                                {{-- <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                        <div id="pass_accordion" class="mas_related"> --}}
                                                {{-- <div class="mas_heading_accordian">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Pass Holder Name</label>
                                                    <p>{{ $data['passhol_name'] }}</p>
                                                </div>
                                                <button type="button" class="btn btn_set collapsed" data-toggle="collapse"
                                                    data-target="#pass_collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                            </div> --}}
                                                {{-- <div id="pass_collapseOne" class="collapse" aria-labelledby="headingOne"
                                                data-parent="#pass_accordion"> --}}

                                                <div class="accordion-item">

                                                    <h2 class="accordion-header"
                                                        id="panelsStayOpen-headingnoyesbasic{{ $p }}">

                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-collapsenoyesbasic{{ $p }}"
                                                            aria-expanded="true"
                                                            aria-controls="panelsStayOpen-collapsenoyesbasic{{ $p }}">
                                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                        </button>
                                                    </h2>

                                                    <div id="panelsStayOpen-collapsenoyesbasic{{ $p }}"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="panelsStayOpen-headingnoyesbasic{{ $p }}">
                                                        <div class="accordion-body d-flex flex-wrap">


                                                            <input type="hidden"
                                                                name="pr[0][{{ $p }}][pr_id]"
                                                                value="{{ $pr['id'] }}" />
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">1st Time PR
                                                                    Application
                                                                    Date</label>

                                                                <input type="date" class="form-control"
                                                                    name="pr[0][{{ $p }}][application_date]"
                                                                    id=""
                                                                    value="{{ $pr['application_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label"></label>

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Application
                                                                    Dependent</label>

                                                                <select
                                                                    name="pr[0][{{ $p }}][application_dep]"
                                                                    id="">

                                                                    <option value="" selected>Please select pass
                                                                    </option>

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
                                                                <label for="" class="form-label">Pass Application
                                                                    Status</label>

                                                                <select
                                                                    name="pr[0][{{ $p }}][application_sts]"
                                                                    id="" class="js-example-responsive">

                                                                    <option value="" selected>Please select pass
                                                                    </option>
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
                                                                <label for="" class="form-label">PR Approval
                                                                    Date</label>
                                                                <p></p>
                                                                <input type="date" class="form-control"
                                                                    name="pr[0][{{ $p }}][approval_date]"
                                                                    id="" value="{{ $pr['approval_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">REP Expiry
                                                                    Date</label>
                                                                <p></p>
                                                                <input type="date" class="form-control"
                                                                    name="pr[0][{{ $p }}][rep_expiry_date]"
                                                                    id="" value="{{ $pr['rep_expiry_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">REP Renewal
                                                                    Reminder</label>


                                                                <select name="pr[0][{{ $p }}][rep_ren_rem]"
                                                                    id="">

                                                                    <option value="" selected>Please select pass
                                                                    </option>

                                                                    <option value="90 days before REP expiry"
                                                                        {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '90 days before REP expiry' ? 'selected' : '' }}>
                                                                        90 days before REP expiry</option>
                                                                    <option value="180 days before REP expiry"
                                                                        {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '180 days before REP expiry' ? 'selected' : '' }}>
                                                                        180 days before REP expiry</option>
                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">REP Renewal
                                                                    Trigger
                                                                    Frequency</label>

                                                                <select
                                                                    name="pr[0][{{ $p }}][rep_ren_trg_fre]"
                                                                    id="">

                                                                    <option value="" selected>Please select pass
                                                                    </option>
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
                                                                <label for="" class="form-label">Re-Submission
                                                                    Trigger
                                                                    Frequency</label>

                                                                <div class="select_box"><span
                                                                        class="every">Every</span><span
                                                                        class="select"><select
                                                                            name="pr[0][{{ $p }}][re_sub_trg_fre]"
                                                                            id="">

                                                                            <option value="" selected>Please select
                                                                                pass
                                                                            </option>

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

                                                                <textarea id="" name="pr[0][{{ $p }}][remarks]" rows="4" cols="50">{{ $pr['remarks'] }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <input type="hidden" id="pr_form_count" value="{{ $p }}">
                                        <div id="appended_pr_div" class="appended_pr_div">
                                        </div>
                                        <div class="text-center pt-4 add_potentia add_potential" id="add_pr_btn_div">
                                            <button type="button" id="add_pr" class="btn saveBtn btn_design add_pr"
                                                name="add-pr">Add
                                                Application Attempt</button>
                                        </div>
                                </div>
                                {{-- </div> --}}
                                {{-- </div> --}}



                                </fieldset>

                            </div>



                        </div>



                    </div>

                </div>

            </div>
        </div>
        {{-- </div> --}}
        </form>



        <div class="lower-bottom ">
            <div class="notes-common formContentData">
                <form method="post" id="multistep_form">
                    @csrf

                    <div class="textarea">
                        <label class="form-label mt-5" for="notes">Notes</label>

                        <textarea id="notes" name="notes" rows="8" cols="150" disabled placeholder="Notes"></textarea>
                        <input type="submit" class="btn saveBtn btn_notes disabled-btn" value="Save">
                    </div>

                    {{-- <input type="submit" name="btnnote" id="btnnote" class="btnnote btn saveBtn"
                                    value="Save" disabled> --}}
                </form>
            </div>

            <div class="card file upload">
                <h3>File Uploads</h3>
                <table class="table user_action_log">
                    <thead>
                        <tr>
                            <th scope="col">File Name</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($file as $files) --}}
                        <tr>
                            <td>abc.jpg</td>
                            <td>Super Admin</td>
                            <td>7 April 2023 01:00 pm</td>
                            <td><i class="fa fa-download" aria-hidden="true"></i>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>xyz.jpg</td>
                            <td>Super Admin</td>
                            <td>22 April 2023 04:00 pm</td>
                            <td><i class="fa fa-download" aria-hidden="true"></i>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>

            <div class="card file action">
                <h3>Action Log</h3>
                <table class="table user_action_log">
                    <thead>
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">Made By</th>
                            <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($action_log as $activity) --}}
                        <tr>
                            <td>Application Created</td>
                            <td>BeecaLam</td>
                            <td>22 july 2023 04:00 pm</td>

                            {{-- <td>{{ $activity->message }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td> --}}
                        </tr>

                        <tr>
                            <td>Application Updated</td>
                            <td>BeecaLam</td>
                            <td>21 july 2023 12:00 pm</td>

                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $('body').on('click', '.del_confirm_opr', function() {
            var id = $(this).attr('data-id');
            swal({
                title: "Are you sure you want to delete this application?",
                text: "You will not be able to retrieve this application again.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = "{{ route('operation.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            operation: id,
                        },
                        cache: false,
                        success: function(response) {
                            swal(
                                "Success!",
                                "Application deleted successfully",
                                "success",
                            );
                            // table.ajax.reload();
                            setTimeout(function() {
                                window.location =
                                    "{{ route('operation.index') }}";
                            }, 1000);
                        },
                        failure: function(response) {
                            swal(
                                "Internal Error",
                                "Oops, your user was not deleted.", // had a missing comma
                                "error"
                            )
                        }
                    });
                }
            })

        });
    </script>
@endpush
