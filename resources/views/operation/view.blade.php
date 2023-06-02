@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .closed .find_heading .formAreahalf.basic_data {
            display: block !important;
        }

        .find_heading .formAreahalf.basic_data {
            display: none !important;
        }
    </style>
@endpush
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
                {{-- @foreach ($data->op_app_passholder as $pass_hol) {{ $pass_hol['passhol_name'] }}  @endforeach --}}

                @php $PassName = ''; @endphp
                @if (count($data->op_app_passholder) > 0)
                    @foreach ($data->op_app_passholder as $pass_hol)
                        @php $PassName .= $pass_hol['passhol_name'].', ' @endphp
                    @endforeach
                    @php $PassName =  rtrim($PassName, ', '); @endphp
                    {{ $PassName }}
                @else
                    {{-- {{$basic_data}} --}}
                @endif

            </h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('operation.index') }}">Operation</a></li>
                <li>{{ Breadcrumbs::render('operation.show', $data, $PassName) }}</li>

            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="{{ route('operation.edit', $data->id) }}"><button class="btn saveBtn"><span>Edit</span></button></a>
            {{-- <a href=""><button class="btn saveBtn"><span>Edit</span></button></a> --}}
            <a href="javascript:void(0);" data-id={{ $data->id }} title="Delete"
                class="btn del_confirm_opr saveBtn cancelBtn delete">Delete</a>
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
    <div class="dataAreaMain wealth_view operation_view">
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
                <div class="tabbing_wealth_four op_view_custom">
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


                    <div class="tab-content border_styling" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-mas" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <?php $z = 0; ?>
                            @foreach ($data->op_app_passholder as $pass_hol)
                                <?php $z++; ?>

                                {{-- <div id="mas_accordion" class="mas_related">
                                <div class="mas_heading_accordian d-flex flex-wrap">

                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label"></label>
                                        <label for="" class="form-label">Pass Holder Name (Eng)</label>
                                        <p>{{ $pass_hol['passhol_name'] }}</p>
                                    </div>
                                    <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOne{{$z}}"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div id="mas_collapseOne{{$z}}" class="collapse hide" aria-labelledby="headingOne{{$z}}"
                                    data-parent="#mas_accordion{{$z}}">
                                    <div class="d-flex flex-wrap"> --}}

                                <div id="mas_accordion" class="mas_related tab-content cs_acc_pass closed">
                                    <div class="mas_heading_accordian d-flex flex-wrap find_heading">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Pass Holder Name {{ $z }} (Eng)</label>
                                            <p>
                                                @if (isset($pass_hol['passhol_name']))
                                                    {{ $pass_hol['passhol_name'] }}@else-
                                                @endif
                                            </p>
                                        </div>
                                        <button class="btn btn_set button-2" data-toggle="collapse"
                                            data-target="#financial_collapseOne_pass{{ $z }}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>

                                    </div>

                                    <div id="financial_collapseOne_pass{{ $z }}" class="collapse"
                                        aria-labelledby="headingOne" data-parent="#financial_accordion">

                                        <div id="financial_accordion" class="d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Business Type</label>
                                                <p>
                                                    @if (isset($pass_hol['bus_type']))
                                                    {{ $pass_hol['bus_type'] }} @else-
                                                    @endif
                                                </p>
                                            </div>
                                            @if (isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Others (please specify)')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($pass_hol['bus_type_specify']))
                                                    {{ $pass_hol['bus_type_specify'] }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif

                                            <div class="formAreahalf basic_data ">
                                                <label for="" class="form-label">Pass Application Type</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_app_type']))
                                                        {{ $pass_hol['pass_app_type'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            @if (isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'Others (please specify)')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($pass_hol['pass_app_type_specify']))
                                                    {{ $pass_hol['pass_app_type_specify'] }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Does passholder need to set up
                                                    company?</label>
                                                <p>
                                                    @if (isset($pass_hol['passhol_setup']))
                                                        {{ $pass_hol['passhol_setup'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Is the passholder also the
                                                    shareholder?
                                                </label>
                                                <p>
                                                    @if (isset($pass_hol['passhol_sharehol']))
                                                        {{ $pass_hol['passhol_sharehol'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Holder Name {{ $z }} (Eng)</label>
                                                <p>
                                                    @if (isset($pass_hol['passhol_name']))
                                                        {{ $pass_hol['passhol_name'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Full Name
                                                    (Chinese)
                                                </label>
                                                <p>
                                                    @if (isset($pass_hol['passport_name']))
                                                        {{ $pass_hol['passport_name'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_dob']))
                                                        {{ convertDate($pass_hol['pass_dob'],"d/m/Y") }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Gender (M/F)</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_gender']))
                                                        {{ $pass_hol['pass_gender'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Expiry
                                                    Date(DD/MM/YYYY)</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_exp_dob']))
                                                        {{ convertDate($pass_hol['pass_exp_dob'],"d/m/Y") }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Number</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_number']))
                                                        {{ $pass_hol['passport_number'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Country</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_country']))
                                                        {{ $pass_hol['passport_country'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Renewal
                                                    Reminder</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_ren_rem']))
                                                        {{ $pass_hol['passport_ren_rem'] }}@else-
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">TIN Number Before Pass
                                                    Application</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_tin_number']))
                                                        {{ $pass_hol['passport_tin_number'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_rem_fre']))
                                                        Every {{ $pass_hol['passport_rem_fre'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">E-mail</label>
                                                <p>
                                                    @if (isset($pass_hol['email']))
                                                        {{ $pass_hol['email'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">TIN Country Before Pass
                                                    Application</label>
                                                <p>
                                                    @if (isset($pass_hol['passport_tin_country']))
                                                        {{ $pass_hol['passport_tin_country'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Phone Number</label>
                                                <p>
                                                    @if (isset($pass_hol['phno']))
                                                        {{ $pass_hol['phno'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Type of TIN Before Pass
                                                    Application</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_tin_type']))
                                                        {{ $pass_hol['pass_tin_type'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">FIN Number</label>
                                                <p>
                                                    @if (isset($pass_hol['finno']))
                                                        {{ $pass_hol['finno'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Residential Address</label>
                                                <p>
                                                    @if (isset($pass_hol['res_add']))
                                                        {{ $pass_hol['res_add'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data ">
                                                <label for="" class="form-label">Pass Application Status</label>
                                                <p
                                                    class="@if ($pass_hol['pass_app_sts'] == 'Approved') active-btn @elseif($pass_hol['pass_app_sts'] == 'Pending') active-blue @elseif($pass_hol['pass_app_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                    @if (isset($pass_hol['pass_app_sts']))
                                                        {{ $pass_hol['pass_app_sts'] }}@else-
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance </label>
                                                <p
                                                    class="@if ($pass_hol['pass_iss'] == 'Done') active-btn @elseif($pass_hol['pass_iss'] == 'In progress') active-blue  @else ' ' @endif">
                                                    @if (isset($pass_hol['pass_iss']))
                                                        {{ $pass_hol['pass_iss'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance Date</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_iss_date']))
                                                        {{ convertDate($pass_hol['pass_iss_date'],"d/m/Y") }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Expiry Date</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_exp_date']))
                                                        {{ convertDate($pass_hol['pass_exp_date'],"d/m/Y") }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Duration </label>
                                                <p>
                                                    @if (isset($pass_hol['duration']))
                                                        {{ $pass_hol['duration'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Frequency </label>
                                                <p>
                                                    @if (isset($pass_hol['pass_ren_fre']))
                                                        {{ $pass_hol['pass_ren_fre'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Reminder</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_ren_rem']))
                                                        {{ $pass_hol['pass_ren_rem'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Trigger</label>
                                                <p>
                                                    @if (isset($pass_hol['pass_ren_ter_fre']))
                                                        Every {{ $pass_hol['pass_ren_ter_fre'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Job Title </label>
                                                <p>
                                                    @if (isset($pass_hol['pass_job_title']))
                                                        {{ $pass_hol['pass_job_title'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Singpass Setup </label>
                                                <p
                                                    class="@if ($pass_hol['singpass_setup'] == 'Done') active-btn @elseif($pass_hol['singpass_setup'] == 'In progress') active-blue  @else ' ' @endif">
                                                    @if (isset($pass_hol['singpass_setup']))
                                                        {{ $pass_hol['singpass_setup'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">1st PR Application Reminder
                                                </label>
                                                <p>
                                                    @if (isset($pass_hol['pr_app_rem']))
                                                        {{ $pass_hol['pr_app_rem'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Relationship With Pass Holder
                                                    1</label>
                                                <p>
                                                    @if (isset($pass_hol['rel_pass_hol']))
                                                        {{ $pass_hol['rel_pass_hol'] }}@else-
                                                    @endif
                                                </p>

                                            </div>
                                            @if (isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Others (please specify)')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please
                                                        specify</label>
                                                    @if (isset($pass_hol['rel_pass_hol_specify']))
                                                        {{ $pass_hol['rel_pass_hol_specify'] }}@else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Employer's Name </label>
                                                <p>
                                                    @if (isset($pass_hol['emp_name']))
                                                        {{ $pass_hol['emp_name'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Monthly Salary (SGD) </label>
                                                <p>
                                                    @if (isset($pass_hol['month_sal']))
                                                        ${{ $pass_hol['month_sal'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarks </label>
                                                <p>
                                                    @if (isset($pass_hol['p_remarks']))
                                                        {{ $pass_hol['p_remarks'] }}@else-
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="nav-financial" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <?php $c = 0;
                            // print_r($data->op_app_company);
                            ?>
                            {{-- @if (isset($data->op_app_company)) --}}
                            @if (count($data->op_app_company) == 0)
                                No Company Found!!
                            @else
                                @foreach ($data->op_app_company as $company_key => $company)
                                    <?php $c++; ?>

                                    <div id="financial_accordion" class="mas_related tab-content cs_acc_pass closed">
                                        <div class="mas_heading_accordian d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Company Name {{ $c }}
                                                </label>
                                                <p>{{ $company['company_name'] }}</p>
                                            </div>
                                            <button class="btn btn_set collapsed" data-toggle="collapse"
                                                data-target="#financial_collapseOne_{{ $company_key }}"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                        </div>

                                        <div id="financial_collapseOne_{{ $company_key }}" class="collapse"
                                            aria-labelledby="headingOne" data-parent="#financial_accordion">
                                            <div class="d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">UEN</label>
                                                    <p>
                                                        @if (isset($company['uen']))
                                                        {{ $company['uen'] }} @else-
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Company Address</label>

                                                    <p>
                                                        @if (isset($company['company_add']))
                                                        {{ $company['company_add'] }} @else-
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Incorporation
                                                        Date</label>
                                                    <p>
                                                        @if (isset($company['incorporation_date']))
                                                            {{ convertDate($company['incorporation_date'],"d/m/Y") }}
                                                        @else-
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Company Email</label>
                                                    <p>
                                                        @if (isset($company['company_email']))
                                                        {{ $company['company_email'] }} @else-
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Company Password</label>
                                                    <p>
                                                        @if (isset($company['company_pass']))
                                                        {{ $company['company_pass'] }} @else-
                                                        @endif
                                                    </p>
                                                </div>

                                            </div>


                                            <br><br><br><br>
                                            <div class="tabbing_wealth_four op_view_custom">

                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <button class="nav-link active"
                                                            id="nav-home-tab-share{{ $c }}"
                                                            data-bs-toggle="tab"
                                                            data-bs-target="#nav-mas-share{{ $c }}"
                                                            type="button" role="tab"
                                                            aria-controls="nav-share{{ $c }}"
                                                            aria-selected="true">Shareholder </button>
                                                        <button class="nav-link"
                                                            id="nav-profile-tab-2{{ $c }}"
                                                            data-bs-toggle="tab"
                                                            data-bs-target="#nav-financial-financial2{{ $c }}"
                                                            type="button" role="tab"
                                                            aria-controls="nav-profile-tab-2{{ $c }}"
                                                            aria-selected="false">Financial Institution</button>

                                                    </div>
                                                </nav>

                                                <div id="shareholder_accordion">

                                                    <div class="tab-content company-tab" id="nav-tabContent">
                                                        <div class="tab-pane fade show active"
                                                            id="nav-mas-share{{ $c }}" role="tabpanel"
                                                            aria-labelledby="nav-home-tab-share{{ $c }}">
                                                            @if (count($company['company_share']) == 0)
                                                                No Shareholder Found!!
                                                            @else
                                                                @foreach ($company['company_share'] as $share_key => $share)
                                                                    <div id="financial_accordion"
                                                                        class="mas_related tab-content">
                                                                        <div
                                                                            class="mas_heading_accordian d-flex flex-wrap">
                                                                            <div class="formAreahalf basic_data">
                                                                                <label for=""
                                                                                    class="form-label">Shareholder
                                                                                    #{{ $share_key + 1 }}</label>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                                                            data-target="#shareholder_collapseOne_{{ $share_key }}"
                                                                            aria-expanded="true"
                                                                            aria-controls="collapseOne">
                                                                            <i class="fa fa-caret-down"
                                                                                aria-hidden="true"></i>
                                                                        </button>
                                                                        <div id="shareholder_collapseOne_{{ $share_key }}"
                                                                            class="collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-parent="#shareholder_accordion">
                                                                            <div id="financial_accordion"
                                                                                class="mas_related">
                                                                                <div
                                                                                    class="mas_heading_accordian d-flex flex-wrap">

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Equity
                                                                                            Percentage</label>
                                                                                        <p>
                                                                                            @if (isset($share['eqt_per']))
                                                                                                {{ $share['eqt_per'] }}%
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Full
                                                                                            Name(Eng)</label>
                                                                                        <p>
                                                                                            @if (isset($share['passhol_name']))
                                                                                                {{ $share['passhol_name'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Full
                                                                                            Name(Chinese)</label>
                                                                                        <p>
                                                                                            @if (isset($share['passport_name']))
                                                                                                {{ $share['passport_name'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">DOB(DD/MM/YYYY)</label>
                                                                                        <p>
                                                                                            @if (isset($share['shareholder_dob']))
                                                                                                {{ convertDate($share['shareholder_dob'],"d/m/Y") }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Gender(M/F)</label>
                                                                                        <p>
                                                                                            @if (isset($share['shareholder_gender']))
                                                                                                {{ $share['shareholder_gender'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Number</label>
                                                                                        <p>
                                                                                            @if (isset($share['passport_number']))
                                                                                                {{ $share['passport_number'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Country</label>
                                                                                        <p>
                                                                                            @if (isset($share['passport_country']))
                                                                                                {{ $share['passport_country'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Expiry
                                                                                            Date(DD/MM/YYYY)</label>
                                                                                        <p>
                                                                                            @if (isset($share['pass_exp_dob']))
                                                                                                {{ convertDate($share['pass_exp_dob'],"d/m/Y") }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Renewal
                                                                                            Reminder</label>
                                                                                        <p>
                                                                                            @if (isset($share['passport_ren_rem']))
                                                                                                {{ $share['passport_ren_rem'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Passport
                                                                                            Reminder
                                                                                            Trigger
                                                                                            Frequency</label>
                                                                                        <p>
                                                                                            @if (isset($share['passport_rem_fre']))
                                                                                                {{ $share['passport_rem_fre'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Type
                                                                                            of TIN Before
                                                                                            Pass
                                                                                            Application</label>
                                                                                        <p>
                                                                                            @if (isset($share['tintype']))
                                                                                                {{ $share['tintype'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">TIN
                                                                                            Number Before
                                                                                            Pass
                                                                                            Application</label>
                                                                                        <p>
                                                                                            @if (isset($share['tinno']))
                                                                                                {{ $share['tinno'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Tin
                                                                                            Country Before
                                                                                            Pass
                                                                                            Application</label>
                                                                                        <p>
                                                                                            @if (isset($share['tincnt']))
                                                                                                {{ $share['tincnt'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Phone
                                                                                            Number</label>
                                                                                        <p>
                                                                                            @if (isset($share['phno']))
                                                                                            {{ $share['phno'] }} @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Residential
                                                                                            Add.(according to
                                                                                            Add.proof)</label>
                                                                                        <p>
                                                                                            @if (isset($share['res_add']))
                                                                                                {{ $share['res_add'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Email</label>
                                                                                        <p>
                                                                                            @if (isset($share['email']))
                                                                                                {{ $share['email'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Job
                                                                                            Title</label>
                                                                                        <p>
                                                                                            @if (isset($share['job_title']))
                                                                                                {{ $share['job_title'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Monthly
                                                                                            Salary(SGD)</label>
                                                                                        <p>
                                                                                            @if (isset($share['month_sal']))
                                                                                                {{ $share['month_sal'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Relationship
                                                                                            with
                                                                                            shareholder 1</label>
                                                                                        <p>
                                                                                            @if (isset($share['rel_share_hol']))
                                                                                                {{ $share['rel_share_hol'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                        <br>
                                                                                        @if (isset($data['rel_share_hol']) && $data['rel_share_hol'] == 'Others (please specify)')
                                                                                            <div
                                                                                                class="formAreahalf basic_data">
                                                                                                <label for=""
                                                                                                    class="form-label">Others,
                                                                                                    please specify</label>
                                                                                                @if (isset($share['rel_pass_hol_specify']))
                                                                                                    {{ $share['rel_pass_hol_specify'] }}
                                                                                                @else-
                                                                                                @endif
                                                                                                </p>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                    @if (isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'Others (please specify)')
                                                                                        <div
                                                                                            class="formAreahalf basic_data">
                                                                                            <label for=""
                                                                                                class="form-label">Others,
                                                                                                please specify</label>
                                                                                            @if (isset($share['rel_pass_hol_specify']))
                                                                                                {{ $share['rel_pass_hol_specify'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                            </p>
                                                                                        </div>
                                                                                    @endif

                                                                                    <div class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Remarks</label>
                                                                                        <p>
                                                                                            @if (isset($share['remarks']))
                                                                                                {{ $share['remarks'] }}
                                                                                            @else-
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>



                                                        <div class="tab-pane fade"
                                                            id="nav-financial-financial2{{ $c }}"
                                                            role="tabpanel"
                                                            aria-labelledby="nav-profile-tab-2{{ $c }}">
                                                            @if (count($company['company_fi']) == 0)
                                                                No Financial Institution Found!!
                                                            @else
                                                            <?php $f=0; ?>
                                                                @foreach ($company['company_fi'] as $fi_key => $fi)
                                                                <?php $f++; ?>
                                                                    <div id="financial_accordion"
                                                                        class="mas_related tab-content">
                                                                        <div
                                                                            class="mas_heading_accordian d-flex flex-wrap">
                                                                            <div class="formAreahalf basic_data">
                                                                                <label for=""
                                                                                    class="form-label">Financial
                                                                                    Institution
                                                                                    Name {{$f}}                                                                                              </label>
                                                                                <p>
                                                                                    @if (isset($fi['fi_name']))
                                                                                    {{ $fi['fi_name'] }} @else-
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                                                            data-target="#shareholder_collapseOne_{{ $fi_key }}"
                                                                            aria-expanded="true"
                                                                            aria-controls="collapseOne">
                                                                            <i class="fa fa-caret-down"
                                                                                aria-hidden="true"></i>
                                                                        </button>
                                                                        <div id="shareholder_collapseOne_{{ $fi_key }}"
                                                                            class="collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-parent="#shareholder_accordion">

                                                                            <div
                                                                                class="mas_heading_accordian d-flex flex-wrap">


                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">POC Name</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_name']))
                                                                                        {{ $fi['poc_name'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Financial
                                                                                        Institution
                                                                                        Name {{$f}}</label>
                                                                                    <p>
                                                                                        @if (isset($fi['fi_name']))
                                                                                        {{ $fi['fi_name'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">POC
                                                                                        Email</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_email']))
                                                                                        {{ $fi['poc_email'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">POC
                                                                                        Contact
                                                                                        Number</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_cno']))
                                                                                        {{ $fi['poc_cno'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Type</label>
                                                                                    <p>
                                                                                        @if (isset($fi['acc_type']))
                                                                                        {{ $fi['acc_type'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Application
                                                                                        Submission</label>
                                                                                    <p
                                                                                        class="@if ($fi['app_sub'] == 'Done') active-btn @elseif($fi['app_sub'] == 'In progress') active-blue  @else ' ' @endif">
                                                                                        @if (isset($fi['app_sub']))
                                                                                        {{ $fi['app_sub'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Opening
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['acc_opn_sts'] == 'Approved') active-btn @elseif($fi['acc_opn_sts'] == 'Pending') active-blue @elseif($fi['acc_opn_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                                                        @if (isset($fi['acc_opn_sts']))
                                                                                            {{ $fi['acc_opn_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account/Policy
                                                                                        Number
                                                                                    </label>
                                                                                    <p>
                                                                                        @if (isset($fi['acc_pol_no']))
                                                                                        {{ $fi['acc_pol_no'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Money
                                                                                        Deposit
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['money_dep_sts'] == 'Done') active-btn @elseif($fi['money_dep_sts'] == 'In progress') active-blue  @else ' ' @endif">
                                                                                        @if (isset($fi['money_dep_sts']))
                                                                                            {{ $fi['money_dep_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Current
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['acc_crt_sts'] == 'Approved') active-btn @elseif($fi['acc_crt_sts'] == 'Pending') active-blue @elseif($fi['acc_crt_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                                                        @if (isset($fi['acc_crt_sts']))
                                                                                            {{ $fi['acc_crt_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Online
                                                                                        Account
                                                                                        Username</label>
                                                                                    <p>
                                                                                        @if (isset($fi['on_acc_usr_nam']))
                                                                                            {{ $fi['on_acc_usr_nam'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Online
                                                                                        Account
                                                                                        Password</label>
                                                                                    <p>
                                                                                        @if (isset($fi['on_acc_usr_pass']))
                                                                                            {{ $fi['on_acc_usr_pass'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Maturity
                                                                                        Date</label>
                                                                                    <p>
                                                                                        @if (isset($fi['mat_date']))
                                                                                            {{ convertDate($fi['mat_date'],"d/m/Y") }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Remarks</label>
                                                                                    <p>
                                                                                        @if (isset($fi['remarks']))
                                                                                        {{ $fi['remarks'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>



                                                        {{-- <div class="tab-pane fade"
                                                            id="nav-financial-financial2{{ $c }}"
                                                            role="tabpanel"
                                                            aria-labelledby="nav-profile-tab-2{{ $c }}">
                                                            @if (count($company['company_fi']) == 0)
                                                                No Financial Institution Found!!
                                                            @else
                                                                @foreach ($company['company_fi'] as $fi_key => $fi)
                                                                    <div id="financial_accordion"
                                                                        class="mas_related tab-content">
                                                                        <div
                                                                            class="mas_heading_accordian d-flex flex-wrap">
                                                                            <div class="formAreahalf basic_data">
                                                                                <label for=""
                                                                                    class="form-label">Financial
                                                                                    Institution
                                                                                    Name</label>
                                                                                <p>
                                                                                    @if (isset($fi['fi_name']))
                                                                                    {{ $fi['fi_name'] }} @else-
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                                                            data-target="#shareholder_collapseOne_{{ $fi_key }}"
                                                                            aria-expanded="true"
                                                                            aria-controls="collapseOne">
                                                                            <i class="fa fa-caret-down"
                                                                                aria-hidden="true"></i>
                                                                        </button>
                                                                        <div id="shareholder_collapseOne_{{ $fi_key }}"
                                                                            class="collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-parent="#shareholder_accordion">

                                                                            <div
                                                                                class="mas_heading_accordian d-flex flex-wrap">


                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Financial
                                                                                        Institution
                                                                                        Name</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_name']))
                                                                                        {{ $fi['poc_name'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">POC
                                                                                        Email</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_email']))
                                                                                        {{ $fi['poc_email'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">POC
                                                                                        Contact
                                                                                        Number</label>
                                                                                    <p>
                                                                                        @if (isset($fi['poc_cno']))
                                                                                        {{ $fi['poc_cno'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Type</label>
                                                                                    <p>
                                                                                        @if (isset($fi['acc_type']))
                                                                                        {{ $fi['acc_type'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Application
                                                                                        Submission</label>
                                                                                    <p
                                                                                        class="@if ($fi['app_sub'] == 'Done') active-btn @elseif($fi['app_sub'] == 'In progress') active-blue  @else ' ' @endif">
                                                                                        @if (isset($fi['app_sub']))
                                                                                        {{ $fi['app_sub'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Opening
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['acc_opn_sts'] == 'Approved') active-btn @elseif($fi['acc_opn_sts'] == 'Pending') active-blue @elseif($fi['acc_opn_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                                                        @if (isset($fi['acc_opn_sts']))
                                                                                            {{ $fi['acc_opn_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account/Policy
                                                                                        Number
                                                                                    </label>
                                                                                    <p>
                                                                                        @if (isset($fi['acc_pol_no']))
                                                                                        {{ $fi['acc_pol_no'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Money
                                                                                        Deposit
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['money_dep_sts'] == 'Done') active-btn @elseif($fi['money_dep_sts'] == 'In progress') active-blue  @else ' ' @endif">
                                                                                        @if (isset($fi['money_dep_sts']))
                                                                                            {{ $fi['money_dep_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Account
                                                                                        Current
                                                                                        Status</label>
                                                                                    <p
                                                                                        class="@if ($fi['acc_crt_sts'] == 'Approved') active-btn @elseif($fi['acc_crt_sts'] == 'Pending') active-blue @elseif($fi['acc_crt_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                                                        @if (isset($fi['acc_crt_sts']))
                                                                                            {{ $fi['acc_crt_sts'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Online
                                                                                        Account
                                                                                        Username</label>
                                                                                    <p>
                                                                                        @if (isset($fi['on_acc_usr_nam']))
                                                                                            {{ $fi['on_acc_usr_nam'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Online
                                                                                        Account
                                                                                        Password</label>
                                                                                    <p>
                                                                                        @if (isset($fi['on_acc_usr_pass']))
                                                                                            {{ $fi['on_acc_usr_pass'] }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Maturity
                                                                                        Date</label>
                                                                                    <p>
                                                                                        @if (isset($fi['mat_date']))
                                                                                            {{ convertDate($fi['mat_date'],"d/m/Y") }}
                                                                                        @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                                <div class="formAreahalf basic_data">
                                                                                    <label for=""
                                                                                        class="form-label">Remarks</label>
                                                                                    <p>
                                                                                        @if (isset($fi['remarks']))
                                                                                        {{ $fi['remarks'] }} @else-
                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                          
                            @endif
                        </div>



<?php $p_name=0; ?>
                        @foreach ($data->op_app_passholder as $pass_hol)
                        <?php $p_name++; ?>
                            <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="nav-contact-tab">

                                <div id="pass_accordion" class="mas_related">
                                    <div class="formAreahalf basic_data">

                                        <label for="" class="form-label">Pass Holder Name {{$p_name}} </label>
                                        <p>
                                            @if (isset($pass_hol['passhol_name']))
                                            {{ $pass_hol['passhol_name'] }} @else-
                                            @endif
                                        </p>
                                    </div>
                                    {{-- @if (count($data->op_app_passholder) == 0)
                                        No PR Related Data Found!!
                                  @else --}}
                                  <?php $pr_name=0; ?>
                                    @foreach ($pass_hol['pass_pr'] as $pr_key => $pr)
                                    <?php $pr_name++; 
                                      ?>
                                        {{-- <div class="w-100 m-1 d-flex justify-content-start flex-wrap form-fields company_design">
                                    <div class="mas_heading_accordian accordion-item">
                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                            data-target="#pass_collapseOne_{{$pr_key}}" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">1st Time PR Application Date</label>
                                            <p>@if (isset($pr['application_date'])){{ convertDate($pr['application_date'],"d/m/Y") }} @else-@endif</p>
                                        </div>

                                    </div>
                                    <div id="pass_collapseOne_{{$pr_key}}" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#pass_accordion">
                                        <div class="accordion-body d-flex flex-wrap"> --}}
                                      

                                        <div id="mas_accordion_pr" class="mas_related tab-content cs_acc_pass closed">
                                            <div class="mas_heading_accordian d-flex flex-wrap ">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">{{$pr_name}} Time PR Application
                                                        Date</label>
                                                    <p>
                                                        @if (isset($pr['application_date']))
                                                            {{ convertDate($pr['application_date'],"d/m/Y") }}
                                                        @else-
                                                        @endif
                                                    </p>
                                                </div>
                                                <button class="btn btn_set collapsed" data-toggle="collapse"
                                                    data-target="#financial_collapseOne_pr{{ $pr_key }}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                            </div>

                                            <div id="financial_collapseOne_pr{{ $pr_key }}" class="collapse"
                                                aria-labelledby="headingOne" data-parent="#financial_accordion">
                                                <div class="d-flex flex-wrap">



                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Application
                                                            Dependent</label>
                                                        <p>
                                                            @if (isset($pr['application_dep']))
                                                            {{ $pr['application_dep'] }} @else-
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Pass Application
                                                            Status</label>
                                                        <p
                                                            class="@if ($pr['application_sts'] == 'Approved') active-btn @elseif($pr['application_sts'] == 'Pending') active-blue @elseif($pr['application_sts'] == 'Rejected') active-btn Dormant @else ' ' @endif">
                                                            @if (isset($pr['application_sts']))
                                                            {{ $pr['application_sts'] }} @else-
                                                            @endif
                                                        </p>
                                                    </div>
                                                    @if ($pr['application_sts'] == 'Rejected')
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">PR Rejection
                                                                Date</label>
                                                            <p>
                                                                @if (isset($pr['rejection_date']))
                                                                    {{ convertDate($pr['rejection_date'],"d/m/Y") }}
                                                                @else-
                                                                @endif
                                                            </p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Re Submission
                                                                Reminder</label>
                                                            <p>
                                                                @if (isset($pr['re_sub_rem']))
                                                                {{ $pr['re_sub_rem'] }} @else-
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Re Submission
                                                                Status</label>
                                                            <p
                                                                class="@if ($pr['re_sub_sts'] == 'Done') active-btn @elseif($pr['re_sub_sts'] == 'Withdrawn') active-btn Dormant  @else ' ' @endif">
                                                                @if (isset($pr['re_sub_sts']))
                                                                {{ $pr['re_sub_sts'] }} @else-
                                                                @endif
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">PR Approval
                                                                Date</label>
                                                            <p>
                                                                @if (isset($pr['approval_date']))
                                                                    {{ convertDate($pr['approval_date'],"d/m/Y") }}
                                                                @else-
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">REP Expiry
                                                                Date</label>
                                                            <p>
                                                                @if (isset($pr['rep_expiry_date']))
                                                                    {{ convertDate($pr['rep_expiry_date'],"d/m/Y") }}
                                                                @else-
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">REP Renewal
                                                                Reminder</label>
                                                            <p>
                                                                @if (isset($pr['rep_ren_rem']))
                                                                {{ $pr['rep_ren_rem'] }} @else-
                                                                @endif
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">REP Renewal Trigger
                                                            Frequency</label>
                                                        <p>
                                                            @if (isset($pr['rep_ren_trg_fre']))
                                                            Every {{ $pr['rep_ren_trg_fre'] }} @else-
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Re-Submission Trigger
                                                            Frequency</label>
                                                        <p>
                                                            @if (isset($pr['re_sub_trg_fre']))
                                                            Every {{ $pr['re_sub_trg_fre'] }} @else-
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Remarks
                                                        </label>
                                                        <p>
                                                            @if (isset($pr['remarks']))
                                                            {{ $pr['remarks'] }} @else-
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- @endif --}}
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>





    <div class="lower-bottom ">
        <div class="notes-common formContentData">


            <form action="javascript:void(0)" method="POST" name="notes_form" id="notes" class="note_send">
                @csrf
                <input type="hidden" name="created_by_name" value="{{ Auth::user()->name }}">

                <input type="hidden" name="application_id" value="{{ $data->id }}">
                <input type="hidden" value="Operation" name="tbl_name">
                <div class="textarea">
                    <label class="form-label mt-5" for="notes">Notes</label>

                    <textarea id="text_notes" name="notes" placeholder="Type your notes here..." rows="8" cols="200"></textarea>
                    <input type="submit" class="btn saveBtn btn_notes " value="Save">
                    <input type="button" id="notes_cancel" class="btn saveBtn cancelBtn delete" value="Cancel"
                        style="display: none">
                </div>
            </form>

            @foreach ($notes as $note)
                <div class="notes_show">
                <div class="cross"><span class="note_remove" data-Id="{{ $note->id }}">x</span></div>
                    <p class="desc_notes">{{ $note->notes_description }}</p>
                    <p class="created">
                        {{ $note->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
                    </p>

                    <p class="createdby"><b>{{ $note->created_by }}</b></p>
                </div>
            @endforeach

            <ul id="pagin"></ul>

        </div>


        <div class="card file upload">
            <h3>File Uploads</h3>
            <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table user_action_log {{ count($file) > 0 ? 'commanDataTable' : '' }}">
                            <thead>
                                <tr>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Date & Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($file as $files)
                                    <tr>

                                        <td>{{ $files->file_orignal_name }}</td>
                                        <td>{{ $files->uploaded_by }}</td>
                                        <td>{{ $files->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td>
                                        <td> <a href="{{ url('file/' . $files->file) }}" download class="link-normal">
                                                <img src="{{ url('images/download_icon.svg') }}" alt="delete-icon">
                                            </a>
                                            <a href="javascript:void(0);" class="del_confirm" data-id="{{ $files->id }}"><i
                                                    class="fa-solid fa-trash ms-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <div class="card file action">
            <h3>Action Log</h3>
                    <table class="table table-responsive user_action_log  {{ count($file) > 0 ? 'commanDataTable' : '' }}" >
                        <thead>
                            <tr>
                                <th scope="col">Actions</th>
                                <th scope="col">Made By</th>
                                <th scope="col">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($action_log as $activity)
                                <tr>
                                    <td>{{ $activity->message }}</td>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->created_at->setTimezone('Asia/Singapore')->format('d/m/Y  g:i a') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    </div>






@endsection
@push('js')
    <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>

    <script>
        $(document).on('click', '.button-2', function() {
            $(this).parents('.cs_acc_pass').toggleClass('closed');
        })
        $(document).ready(function() {
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
        });

        $("#text_notes").keyup(function() {

            $("#notes_cancel").show();
        });

        $("#notes_cancel").click(function() {
            // alert('eht');
            $("#text_notes").val('');
            $("#notes_cancel").hide();
        });

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


        $('body').on('click', '.del_confirm', function() {
            var id = $(this).attr('data-id');
            swal({
                title: "Are you sure you want to delete this file ?",
                text: "You will not be able to retrieve this file again.",
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
                    var url = "{{ route('op.files.delete', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            id: id,
                        },
                        cache: false,
                        success: function(response) {
                            // alert(response);
                            swal(
                                "Success!",
                                "File deleted successfully",
                                "success",
                            );
                            setTimeout(function() {
                                window.location =
                                    "{{ route('operation.show', $data->id) }}";
                            }, 1000);
                            // window.location="{{ route('sales') }}";
                        },
                        failure: function(response) {
                            swal(
                                "Internal Error",
                                "Oops, your file was not deleted.", // had a missing comma
                                "error"
                            )
                        }
                    });
                }
            })

        });
    </script>
@endpush
