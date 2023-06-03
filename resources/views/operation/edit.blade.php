@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* .closed .accordion-header .formAreahalf.basic_data {
            display: block !important;
        }

        .accordion-header .formAreahalf.basic_data {
            display: none !important;
            
        } */
    </style>
@endpush
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
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
    <div class="custom_operation_edit">
        <form method="post" id="operation_form_edit" class="operation_form_edit">
            @csrf
            <div class="filterPagination d-flex justify-content-between align-items-center">
                <div class="paginationLeft">
                    <ul>
                        <li><a href="{{ route('operation.index') }}">Operation</a></li>
                        {{-- <li>{{ Breadcrumbs::render('operation.edit', $data) }}</li> --}}
                        <li>{{ Breadcrumbs::render('operation.edit', $data, $PassName) }}</li>
                    </ul>
                </div>
                <div class="filterBtn d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn saveBtn"><span>Save</span></button>
                    <a href="{{ route('operation.show', $data->id) }}"><button type="button"
                            class="btn saveBtn cancelBtn"><span>Cancel</span></button></a>
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
                        <div class="formAreahalf basic_data client_status">
                            <label for="" class="form-label">Client Status</label>
                            <select class="js-example-responsive form-control">
                                <option value="Active" {{ $data->client_status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Dormant" {{ $data->client_status == 'Dormant' ? 'selected' : '' }}>Dormant</option>
                            </select>
                        </div>
                        {{-- <div class="formAreahalf  client_status mb-1 ">
                            <label for="cby" class="form-label">Client Status</label>
                            <select class="" name="csts" id="business">
                                <option value="Active" class="btn text-start"
                                    {{ $sale->client_sts == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Dormant" class="btn text-start"  {{ $sale->client_sts == 'Dormant' ? 'selected' : '' }} >Dormant</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="application_info">
                    <div class="card company_info formContentData border-0 p-4 ">
                        <h3>Application Information</h3>
                        <div class="tabbing_wealth_four accordian_design_custom">
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
                            <input type="hidden" name="op_app_id" value="{{ $data->id }}">
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
                                        <?php $z = -1; ?>
                                        @foreach ($data->op_app_passholder as $pass_hol)
                                            <?php $z++;
                                            // echo'<pre>';
                                            //     print_r($pass_hol);
                                            //     echo'</pre>';
                                            ?>
                                            <div
                                                class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                                <div class="accordion-item pass_acc_it ">

                                                    <h2 class="accordion-header"
                                                        id="panelsStayOpen-headingnoyespass{{ $z }}">

                                                        <button class="accordion-button pass_acc_button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-collapsenoyespass{{ $z }}"
                                                            aria-expanded="true"
                                                            aria-controls="panelsStayOpen-collapsenoyespass">
                                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                        </button>
                                                    </h2>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Pass Holder Name
                                                            {{ ( $z + 1 ) }}
                                                            (Eng)
                                                        </label>
                                                        <br>{{ $pass_hol['passhol_name'] }}

                                                    
                                                    </div>
                                                    <div id="panelsStayOpen-collapsenoyespass{{ $z }}"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="panelsStayOpen-headingnoyespass{{ $z }}">
                                       
                                                        <div class="accordion-body d-flex flex-wrap">

                                                            <input type="hidden" name="passhole_counter"
                                                                value="{{ $z }}" />

                                                            <input type="hidden"
                                                                name="pass[{{ $z }}][passholder_id]"
                                                                value="{{ $pass_hol['id'] }}" />
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Business
                                                                    Type</label>
                                                                {{-- <input type="text" class="form-control" name="pass[0][bus_type]" value="{{ $data['bus_type'] }}"> --}}
                                                                {{-- {{ $pass_hol['id'] }} --}}
                                                                <select name="pass[{{ $z }}][bus_type]"
                                                                    class="select_class" data-id="{{ $z }}">
                                                                    <option value="" selected>Please select
                                                                    </option>

                                                                    <option value="FO"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'FO' ? 'selected' : '' }}>
                                                                        FO</option>
                                                                    <option value="PIC"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'PIC' ? 'selected' : '' }}>
                                                                        PIC</option>
                                                                    <option value="Self-employment"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Self-employment' ? 'selected' : '' }}>
                                                                        Self-employment</option>
                                                                    <option value="Employer Guarantee"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Employer Guarantee' ? 'selected' : '' }}>
                                                                        Employer Guarantee</option>
                                                                    <option value="PR application"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'PR application' ? 'selected' : '' }}>
                                                                        PR application</option>
                                                                    <option value="PR renewal"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'PR renewal' ? 'selected' : '' }}>
                                                                        PR renewal</option>
                                                                    <option value="EP"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Citizen' ? 'selected' : '' }}>
                                                                        Citizen</option>
                                                                    <option value="Others (please specify)"
                                                                        {{ isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                        Others (please specify)</option>


                                                                </select>

                                                            </div>


                                                            @if (isset($pass_hol['bus_type']) && $pass_hol['bus_type'] == 'Others (please specify)')
                                                                <div
                                                                    class="formAreahalf basic_data others others_hide_show others_alignment">
                                                                    <label class="form-label" for=""></label>
                                                                    <div class="select_box"><span class="every">Others,
                                                                            please specify: </span><span class="select">
                                                                            <input type="text" class="form-control sds"
                                                                                id="drp_spc_g"
                                                                                name="pass[{{ $z }}][bus_type_specify]"
                                                                                value="{{ $pass_hol['bus_type_specify'] }}"></span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="formAreahalf basic_data others others_hide_show others_alignment"
                                                                    style="display:none;">

                                                                </div>
                                                            @endif

                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Application
                                                                    Type</label>

                                                                <select name="pass[{{ $z }}][pass_app_type]"
                                                                    class="select_class_pass_app_type"
                                                                    data-id="{{ $z }}">
                                                                    <option value="" selected>Please select
                                                                    </option>

                                                                    <option value="EP"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'EP' ? 'selected' : '' }}>
                                                                        EP</option>
                                                                    <option value="SP"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'SP' ? 'selected' : '' }}>
                                                                        SP</option>
                                                                    <option value="DP"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'DP' ? 'selected' : '' }}>
                                                                        DP</option>
                                                                    <option value="LVTP"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'LVTP' ? 'selected' : '' }}>
                                                                        LVTP</option>
                                                                    <option value="WP"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'WP' ? 'selected' : '' }}>
                                                                        WP</option>
                                                                    <option value="PR"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'PR' ? 'selected' : '' }}>
                                                                        PR</option>
                                                                    <option value="Citizen"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'Citizen' ? 'selected' : '' }}>
                                                                        Citizen</option>
                                                                    <option value="Others (please specify)"
                                                                        {{ isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                        Others (please specify)</option>

                                                                </select>
                                                            </div>
                                                            @if (isset($pass_hol['pass_app_type']) && $pass_hol['pass_app_type'] == 'Others (please specify)')
                                                                <div class="formAreahalf others_pass_app others_alignment">
                                                                    <label class="form-label" for=""></label>
                                                                    <div class="select_box"><span class="every">Others,
                                                                            please specify: </span><span class="select">
                                                                            <input type="text" class="form-control sds"
                                                                                id="drp_spc_g_p"
                                                                                name="pass[{{ $z }}][rel_pass_hol_specify]"
                                                                                value="{{ $pass_hol['pass_app_type_specify'] }}"></span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="formAreahalf basic_data others_pass_app others_alignment"
                                                                    style="display:none;">

                                                                </div>
                                                            @endif
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
                                                                <label for="" class="form-label">Does passholder
                                                                    need
                                                                    to
                                                                    set up
                                                                    company?</label>

                                                                <select name="pass[{{ $z }}][passhol_setup]"
                                                                    id="set_company" class="set_company">

                                                                    <option value="{{ $pass_hol['passhol_setup'] }}">
                                                                        {{ $pass_hol['passhol_setup'] }}</option>

                                                                </select>

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Is the passholder
                                                                    also
                                                                    the
                                                                    shareholder?
                                                                </label>

                                                                <select name="pass[{{ $z }}][passhol_sharehol]"
                                                                    id="also_shareholder" class="also_shareholder">
                                                                    <option value="{{ $pass_hol['passhol_sharehol'] }}">
                                                                        {{ $pass_hol['passhol_sharehol'] }}</option>

                                                                    {{-- <option value="" selected >
                                                </option>
                                                <option value="Yes">Yes</option> --}}

                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Holder Name
                                                                    {{ ($z+1) }}
                                                                    (Eng)
                                                                </label>

                                                                <input type="text" class="form-control"
                                                                    id="passhol_name"
                                                                    name="pass[{{ $z }}][passhol_name]"
                                                                    value="{{ $pass_hol['passhol_name'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport Full
                                                                    Name
                                                                    (Chinese)</label>

                                                                <input type="text" class="form-control"
                                                                    id="gendcname[{{ $z }}][subject]"
                                                                    name="pass[{{ $z }}][passport_name]"
                                                                    value="{{ $pass_hol['passport_name'] }}">

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">DOB
                                                                    (DD/MM/YYYY)</label>

                                                                <input type="date" class="form-control"
                                                                    name="pass[{{ $z }}][pass_dob]"
                                                                    id="pass_holder_dob"
                                                                    value="{{ $pass_hol['pass_dob'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Gender
                                                                    (M/F)</label>

                                                                <select class=""
                                                                    name="pass[{{ $z }}][pass_gender]"
                                                                    id="gender">
                                                                    <option value="" selected>Please Select</option>
                                                                    <option value="M"
                                                                        {{ isset($pass_hol['pass_gender']) && $pass_hol['pass_gender'] == 'M' ? 'selected' : '' }}>
                                                                        M</option>
                                                                    <option value="F"
                                                                        {{ isset($pass_hol['pass_gender']) && $pass_hol['pass_gender'] == 'F' ? 'selected' : '' }}>
                                                                        F</option>

                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport Expiry
                                                                    Date(DD/MM/YYYY)</label>

                                                                <input type="date" class="form-control"
                                                                    name="pass[{{ $z }}][pass_exp_dob]"
                                                                    id="passport_exp_date"
                                                                    value="{{ $pass_hol['pass_exp_dob'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport
                                                                    Number</label>

                                                                <input type="text" class="form-control"
                                                                    id="passport_no"
                                                                    name="pass[{{ $z }}][passport_number]"
                                                                    value="{{ $pass_hol['passport_number'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport
                                                                    Country</label>

                                                                <input type="text" class="form-control"
                                                                    id="passport_cnt"
                                                                    name="pass[{{ $z }}][passport_country]"
                                                                    value="{{ $pass_hol['passport_country'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport Renewal
                                                                    Reminder</label>

                                                                <select name="pass[{{ $z }}][passport_ren_rem]"
                                                                    id="passport_ren_rem">
                                                                    <option value=""selected>Please select</option>
                                                                    <option value="90 days before expiry"
                                                                        {{ isset($pass_hol['passport_ren_rem']) && $pass_hol['passport_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                                                        90 days before expiry</option>
                                                                    <option value="120 days before expiry"
                                                                        {{ isset($pass_hol['passport_ren_rem']) && $pass_hol['passport_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                                                        120 days before expiry</option>
                                                                    <option value="180 days before expiry"
                                                                        {{ isset($pass_hol['passport_ren_rem']) && $pass_hol['passport_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                                                        180 days before expiry</option>

                                                                </select>
                                                            </div>

                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">TIN Number Before
                                                                    Pass
                                                                    Application</label>

                                                                <input type="text" class="form-control"
                                                                    id="tin_number"
                                                                    name="pass[{{ $z }}][passport_tin_number]"
                                                                    value="{{ $pass_hol['passport_tin_number'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Passport Reminder
                                                                    Trigger
                                                                    Frequency</label>

                                                                <div class="select_box"><span
                                                                        class="every">Every</span><span
                                                                        class="select"><select
                                                                            name="pass[{{ $z }}][passport_rem_fre]"
                                                                            id="passport_rem_trg_fre">
                                                                            <option value="" selected>Please select
                                                                            </option>
                                                                            <option value="Day"
                                                                                {{ isset($pass_hol['passport_rem_fre']) && $pass_hol['passport_rem_fre'] == 'Day' ? 'selected' : '' }}>
                                                                                Day</option>
                                                                            <option value="3 Days"
                                                                                {{ isset($pass_hol['passport_rem_fre']) && $pass_hol['passport_rem_fre'] == '3 Days' ? 'selected' : '' }}>
                                                                                3 Days</option>
                                                                            <option value="Week"
                                                                                {{ isset($pass_hol['passport_rem_fre']) && $pass_hol['passport_rem_fre'] == 'Week' ? 'selected' : '' }}>
                                                                                Week</option>
                                                                            <option value="2 Weeks"
                                                                                {{ isset($pass_hol['passport_rem_fre']) && $pass_hol['passport_rem_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                                                                2 Weeks</option>
                                                                            <option value="4 Weeks"
                                                                                {{ isset($pass_hol['passport_rem_fre']) && $pass_hol['passport_rem_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                                                                4 Weeks</option>

                                                                        </select></span></div>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">E-mail</label>

                                                                <input type="email" class="form-control"
                                                                    id="gendcname[0][subject]"
                                                                    name="pass[{{ $z }}][email]"
                                                                    value="{{ $pass_hol['email'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">TIN Country
                                                                    Before
                                                                    Pass
                                                                    Application</label>

                                                                <input type="text" class="form-control"
                                                                    name="pass[{{ $z }}][passport_tin_country]"
                                                                    id="tin_cnt"
                                                                    value="{{ $pass_hol['passport_tin_country'] }}">

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Phone
                                                                    Number</label>

                                                                <input type="text" class="form-control" id="ph_num"
                                                                    name="pass[{{ $z }}][phno]"
                                                                    value="{{ $pass_hol['phno'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Type of TIN
                                                                    Before
                                                                    Pass
                                                                    Application</label>

                                                                <select name="pass[{{ $z }}][pass_tin_type]"
                                                                    id="type_of_tin">

                                                                    <option value="" selected>Please select
                                                                    </option>

                                                                    <option value="WP"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'WP' ? 'selected' : '' }}>
                                                                        WP</option>
                                                                    <option value="SP"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'SP' ? 'selected' : '' }}>
                                                                        SP</option>
                                                                    <option value="EP"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'EP' ? 'selected' : '' }}>
                                                                        EP</option>
                                                                    <option value="LVTP"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'LVTP' ? 'selected' : '' }}>
                                                                        LVTP</option>
                                                                    <option value="DP"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'DP' ? 'selected' : '' }}>
                                                                        DP</option>
                                                                    <option value="NRIC"
                                                                        {{ isset($pass_hol['pass_tin_type']) && $pass_hol['pass_tin_type'] == 'NRIC' ? 'selected' : '' }}>
                                                                        EP</option>


                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">FIN
                                                                    Number</label>

                                                                <input type="text" class="form-control"
                                                                    id="fin_number"
                                                                    name="pass[{{ $z }}][finno]"
                                                                    value="{{ $pass_hol['finno'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Residential
                                                                    Address</label>

                                                                <input type="text" class="form-control" id="res_add"
                                                                    name="pass[{{ $z }}][res_add]"
                                                                    value="{{ $pass_hol['res_add'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Application
                                                                    Status</label>

                                                                <select name="pass[{{ $z }}][pass_app_sts]"
                                                                    class="js-example-responsive">
                                                                    <option value="" selected>Please select
                                                                    </option>
                                                                    <option value="Pending"
                                                                        {{ isset($pass_hol['pass_app_sts']) && $pass_hol['pass_app_sts'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="Approved"
                                                                        {{ isset($pass_hol['pass_app_sts']) && $pass_hol['pass_app_sts'] == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                    <option value="Rejected"
                                                                        {{ isset($pass_hol['pass_app_sts']) && $pass_hol['pass_app_sts'] == 'Rejected' ? 'selected' : '' }}>Rejected</option>

                                                                </select>
                                                            </div>
                                                    
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Issuance
                                                                </label>
                                                                <select name="pass[{{ $z }}][pass_iss]"
                                                                    class="js-example-responsive">
                                                                    <option value="" selected>Please select
                                                                    </option>
                                                                    <option value="In progress"
                                                                        {{ isset($pass_hol['pass_iss']) && $pass_hol['pass_iss'] == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                    <option value="Done"
                                                                        {{ isset($pass_hol['pass_iss']) && $pass_hol['pass_iss'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                    </select>
                                                                {{-- <select name="pass[{{ $z }}][pass_iss]"
                                                                    class="js-example-responsive">
                                                                    <option value="" selected>Please select pass
                                                                        issuance
                                                                    </option>
                                                                    <option value="In Progress"
                                                                        {{ isset($pass_hol['pass_iss']) && $pass_hol['pass_iss'] == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                                    <option value="Done"
                                                                        {{ isset($pass_hol['pass_iss']) && $pass_hol['pass_iss'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                </select> --}}
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Issuance
                                                                    Date</label>

                                                                <input type="date" class="form-control"
                                                                    name="pass[{{ $z }}][pass_iss_date]"
                                                                    value="{{ $pass_hol['pass_iss_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Expiry
                                                                    Date</label>

                                                                <input type="date" class="form-control"
                                                                    name="pass[{{ $z }}][pass_exp_date]"
                                                                    value="{{ $pass_hol['pass_exp_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Duration </label>

                                                                <input type="text" class="form-control"
                                                                    name="pass[{{ $z }}][duration]"
                                                                    value="{{ $pass_hol['duration'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Renewal
                                                                    Frequency
                                                                </label>

                                                                <select name="pass[{{ $z }}][pass_ren_fre]"
                                                                    id="renewlrem">
                                                                    <option value="" selected>Please select</option>

                                                                    <option value="90 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_fre']) && $pass_hol['pass_ren_fre'] == '90 days before expiry' ? 'selected' : '' }}>
                                                                        90 days before expiry</option>
                                                                    <option value="120 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_fre']) && $pass_hol['pass_ren_fre'] == '120 days before expiry' ? 'selected' : '' }}>
                                                                        120 days before expiry</option>
                                                                    <option value="180 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_fre']) && $pass_hol['pass_ren_fre'] == '180 days before expiry' ? 'selected' : '' }}>
                                                                        180 days before expiry</option>
                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Renewal
                                                                    Reminder</label>

                                                                <select name="pass[{{ $z }}][pass_ren_rem]"
                                                                    id="renewlrem">
                                                                    <option value="" selected>Please select pass
                                                                    </option>

                                                                    <option value="90 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_rem']) && $pass_hol['pass_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                                                        90 days before expiry</option>
                                                                    <option value="120 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_rem']) && $pass_hol['pass_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                                                        120 days before expiry</option>
                                                                    <option value="180 days before expiry"
                                                                        {{ isset($pass_hol['pass_ren_rem']) && $pass_hol['pass_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                                                        180 days before expiry</option>
                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Renewal
                                                                    Trigger</label>

                                                                <div class="select_box"><span
                                                                        class="every">Every</span><span
                                                                        class="select"><select
                                                                            name="pass[{{ $z }}][pass_ren_ter_fre]"
                                                                            id="renewlfre">
                                                                            <option value=""selected>Please select
                                                                            </option>
                                                                            <option value="Day"
                                                                                {{ isset($pass_hol['pass_ren_ter_fre']) && $pass_hol['pass_ren_ter_fre'] == 'Day' ? 'selected' : '' }}>
                                                                                Day</option>
                                                                            <option value="3 Days"
                                                                                {{ isset($pass_hol['pass_ren_ter_fre']) && $pass_hol['pass_ren_ter_fre'] == '3 Days' ? 'selected' : '' }}>
                                                                                3 Days</option>
                                                                            <option value="Week"
                                                                                {{ isset($pass_hol['pass_ren_ter_fre']) && $pass_hol['pass_ren_ter_fre'] == 'Week' ? 'selected' : '' }}>
                                                                                Week</option>
                                                                            <option value="2 Weeks"
                                                                                {{ isset($pass_hol['pass_ren_ter_fre']) && $pass_hol['pass_ren_ter_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                                                                2 Weeks</option>
                                                                            <option value="4 Weeks"
                                                                                {{ isset($pass_hol['pass_ren_ter_fre']) && $pass_hol['pass_ren_ter_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                                                                4 Weeks</option>
                                                                        </select></span></div>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Pass Job Title
                                                                </label>

                                                                <input type="text" class="form-control"
                                                                    name="pass[{{ $z }}][pass_job_title]"
                                                                    value="{{ $pass_hol['pass_job_title'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Singpass Setup
                                                                </label>
                                                                <select name="pass[{{ $z }}][singpass_setup]"
                                                                    class="js-example-responsive">
                                                                    <option value="" selected>Please select
                                                                    </option>
                                                                    <option value="In progress"
                                                                        {{ isset($pass_hol['singpass_setup']) && $pass_hol['singpass_setup'] == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                    <option value="Done"
                                                                        {{ isset($pass_hol['singpass_setup']) && $pass_hol['singpass_setup'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                </select>
                                                                {{-- <select name="pass[{{ $z }}][singpass_setup]"
                                                                    id="renewlfre" class="js-example-responsive">
                                                                    <option value="" selected>Please select</option>
                                                                    <option value="In Progress"
                                                                        {{ isset($pass_hol['singpass_setup']) && $pass_hol['singpass_setup'] == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                                    <option value="Done"
                                                                        {{ isset($pass_hol['singpass_setup']) && $pass_hol['singpass_setup'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                        
                                                                </select> --}}
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">1st PR
                                                                    Application
                                                                    Reminder
                                                                </label>

                                                                <select name="pass[{{ $z }}][pr_app_rem]"
                                                                    id="renewlrem">
                                                                    <option value="" selected>Please select</option>
                                                                    <option value="N/A"
                                                                        {{ isset($pass_hol['pr_app_rem']) && $pass_hol['pr_app_rem'] == 'N/A' ? 'selected' : '' }}>
                                                                        N/A</option>
                                                                    <option
                                                                        value="180 days after pass
                                                    issuance date"
                                                                        {{ isset($pass_hol['pr_app_rem']) &&
                                                                        $pass_hol['pr_app_rem'] ==
                                                                            '180 days after pass
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        issuance date'
                                                                            ? 'selected'
                                                                            : '' }}>
                                                                        180 days after pass
                                                                        issuance date</option>
                                                                    <option
                                                                        value="270 days after pass
                                                    issuance date"
                                                                        {{ isset($pass_hol['pr_app_rem']) &&
                                                                        $pass_hol['pr_app_rem'] ==
                                                                            '270 days after pass
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        issuance date'
                                                                            ? 'selected'
                                                                            : '' }}>
                                                                        180 days after pass
                                                                        issuance date</option>
                                                                    <option
                                                                        value="365 days after pass
                                                    issuance date"
                                                                        {{ isset($pass_hol['pr_app_rem']) &&
                                                                        $pass_hol['pr_app_rem'] ==
                                                                            '365 days after pass
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        issuance date'
                                                                            ? 'selected'
                                                                            : '' }}>
                                                                        365 days after pass
                                                                        issuance date</option>
                                                                    <option
                                                                        value="270 days after pass
                                                    issuance date"
                                                                        {{ isset($pass_hol['pr_app_rem']) &&
                                                                        $pass_hol['pr_app_rem'] ==
                                                                            '540 days after pass
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        issuance date'
                                                                            ? 'selected'
                                                                            : '' }}>
                                                                        540 days after pass
                                                                        issuance date</option>
                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Relationship With
                                                                    Pass
                                                                    Holder
                                                                    1</label>

                                                                <select name="pass[{{ $z }}][rel_pass_hol]"
                                                                    id="renewlrem" class="select_class_rel_share"  data-id="{{ $z }}">
                                                                    <option value="" selected>Please select
                                                                    </option>

                                                                    <option value="Self"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Self' ? 'selected' : '' }}>
                                                                        Self</option>
                                                                    <option value="Parents"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Parents' ? 'selected' : '' }}>
                                                                        Parents</option>
                                                                    <option value="Spouse"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Spouse' ? 'selected' : '' }}>
                                                                        Spouse</option>
                                                                    <option value="Children"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Children' ? 'selected' : '' }}>
                                                                        Children</option>
                                                                    <option value="Relatives"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Relatives' ? 'selected' : '' }}>
                                                                        Relatives</option>
                                                                    <option value="Friend"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Friend' ? 'selected' : '' }}>
                                                                        Friend</option>
                                                                    <option value="Others (please specify)"
                                                                        {{ isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                        Other(please specify)</option>
                                                                </select>
                                                            </div>
                                                            @if (isset($pass_hol['rel_pass_hol']) && $pass_hol['rel_pass_hol'] == 'Others (please specify)')
                                                            <div
                                                                class="formAreahalf basic_data others_rel_share others_alignment">
                                                                <label class="form-label" for=""></label>
                                                                <div class="select_box"><span class="every">Others,
                                                                        please specify: </span><span class="select">
                                                                        <input type="text" class="form-control sds"
                                                                            id="drp_spc_g_3"
                                                                            name="pass[{{ $z }}][rel_pass_hol_specify]"
                                                                            value="{{ $pass_hol['rel_pass_hol_specify'] }}"></span>
                                                                </div>
                                                            </div>
                                                        @else
                                        
                                                            <div class="formAreahalf basic_data others_rel_share others_alignment"
                                                                style="display:none;">

                                                            </div>
                                                        @endif
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Employer's Name
                                                                </label>

                                                                <input type="text" class="form-control"
                                                                    name="pass[{{ $z }}][emp_name]"
                                                                    value="{{ $pass_hol['emp_name'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Monthly Salary
                                                                    (SGD)
                                                                </label>

                                                                <div class="dollersec"><span class="doller">$</span><span
                                                                    class="input"><input type="integer" class="form-control"
                                                                    name="pass[{{ $z }}][month_sal]"
                                                                    id="month_salary"
                                                                    value="{{ $pass_hol['month_sal'] }}"></span></div>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Remarks </label>

                                                                <textarea id="addbg[0][genremarks]" name="pass[{{ $z }}][p_remarks]" rows="4" cols="50">{{ $pass_hol['p_remarks'] }}</textarea>
                                                            </div>

                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        @endforeach
                                        <input type="hidden" id="pass_counter_z" value="{{ $z }}">
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

                                    <?php $c = -1; ?>
                                    @foreach ($data->op_app_company as $company_key => $company)
                                        <?php $c++; ?>
                                        <div
                                            class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                            <div class="accordion-item pass_acc_it ">

                                                <h2 class="accordion-header" id="panelsStayOpen-headingnoyescomp">

                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapsenoyescomp{{$c}}"
                                                        aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapsenoyescomp">
                                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>
                                                </h2>
                                                <div class="accordion-body d-flex flex-wrap">
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Company Name
                                                            {{ ($c+1) }}</label>
                                                            <br>{{ $company['company_name'] }}
    
                                                    
                                                    </div>
                                                <div id="panelsStayOpen-collapsenoyescomp{{$c}}"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingnoyescomp">
                                                  
                                                 
                                                        <div class=" d-flex flex-wrap">
                                                            {{-- <div id="financial_accordion" class="mas_related">

                                                     <div class="mas_heading_accordian d-flex flex-wrap"> --}}
                                                            <input type="hidden"
                                                                name="cmp[{{ $c }}][company_id]"
                                                                value="{{ $company['id'] }}" />
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company Name
                                                                    {{ $c+1 }}</label>

                                                                <input type="text"
                                                                    name="cmp[{{ $c }}][fo_company]"
                                                                    id="fo_compnay" class="form-control"
                                                                    value="{{ $company['company_name'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label"></label>

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">UEN</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[{{ $c }}][fo_uen]"
                                                                    id="fo_uen" value="{{ $company['uen'] }}">
                                                            </div>
                                                            {{-- <button type="button" class="btn btn_set collapsed" data-toggle="collapse"
                                                   data-target="#financial_collapseOne{{ $c }}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button> --}}

                                                            {{-- </div> --}}
                                                            {{-- <div id="financial_collapseOne{{ $c }}" class="collapse show"
                                                   aria-labelledby="headingOne" data-parent="#financial_accordion">
                                                   <div class="d-flex flex-wrap"> --}}
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Address</label>
                                                                <input type="text" class="form-control"
                                                                    name="cmp[{{ $c }}][fo_company_add]"
                                                                    id="fo_company_add"
                                                                    value="{{ $company['company_add'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Incorporation
                                                                    Date</label>

                                                                <input type="date" class="form-control"
                                                                    name="cmp[{{ $c }}][fo_incorporation_date]"
                                                                    id="fo_incorporation_date"
                                                                    value="{{ $company['incorporation_date'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Email</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[{{ $c }}][fo_company_email]"
                                                                    id="fo_company_email"
                                                                    value="{{ $company['company_email'] }}">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Password</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[{{ $c }}][fo_company_pass]"
                                                                    id="fo_company_pass"
                                                                    value="{{ $company['company_pass'] }}">
                                                            </div>
                                                        </div>

                                                        {{-- </div> --}}
                                                        {{-- </div> --}}

                                                        <div class="tabbing_wealth_four accordian_design_custom">

                                                            <nav>
                                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                    <button type="button" class="nav-link active"
                                                                        id="nav-home-tab-share{{ $c }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#nav-mas-share{{ $c }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-home-tab-share"
                                                                        aria-selected="true">Shareholder </button>
                                                                    <button type="button" class="nav-link"
                                                                        id="nav-profile-tab-2{{ $c }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#nav-financial-financial2{{ $c }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="nav-profile-tab-2"
                                                                        aria-selected="false">Financial</button>

                                                                </div>
                                                            </nav>
                                                            <div class="tab-content border_styling" id="nav-tabContent">

                                                                <div class="tab-pane fade show active"
                                                                    id="nav-mas-share{{ $c }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="nav-home-tab-share{{ $c }}">
                                                                    <div>
                                                                        <fieldset id="FO_share_holder_form"
                                                                            class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">
                                                                            <?php $s = -1; ?>
                                                                            @foreach ($company['company_share'] as $share)
                                                                                <?php $s++; 
                                                                               ?>


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
                                                                                                    class="accordion-body acc-bo d-flex flex-wrap">

                                                                                                    <input type="hidden"
                                                                                                        name="company_id_share_append"
                                                                                                        id="company_id_share_append"
                                                                                                        value="{{ $company['id'] }}" />
                                                                                                    <input type="hidden"
                                                                                                        name="share[{{ $c }}][{{ $s }}][share_id]"
                                                                                                        value="{{ $share['id'] }}" />
                                                                                                    <input type="hidden"
                                                                                                        name="company_no"
                                                                                                        id="company_no"
                                                                                                        value="{{ $c }}" />

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Equity
                                                                                                            Percentage</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control equity_shareholders"
                                                                                                            name="share[{{ $c }}][{{ $s }}][eqt_per]"
                                                                                                            value="{{ $share['eqt_per'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Full
                                                                                                            Name(Eng)</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][passhol_name]"
                                                                                                            value="{{ $share['passhol_name'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Full
                                                                                                            Name(Chinese)</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][passport_name]"
                                                                                                            value="{{ $share['passport_name'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">DOB(DD/MM/YYYY)</label>
                                                                                                        <p></p>
                                                                                                        <input
                                                                                                            type="date"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][shareholder_dob]"
                                                                                                            value="{{ $share['shareholder_dob'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Gender(M/F)</label>

                                                                                                        <select
                                                                                                            class=""
                                                                                                            name="share[{{ $c }}][{{ $s }}][shareholder_gender]"
                                                                                                            id="sign">


                                                                                                            <option
                                                                                                                value="M"
                                                                                                                {{ isset($share['shareholder_gender']) && $share['shareholder_gender'] == 'M' ? 'selected' : '' }}>
                                                                                                                M</option>
                                                                                                            <option
                                                                                                                value="F"
                                                                                                                {{ isset($share['shareholder_gender']) && $share['shareholder_gender'] == 'F' ? 'selected' : '' }}>
                                                                                                                F</option>
                                                                                                        </select>
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Number</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][passport_number]"
                                                                                                            value="{{ $share['passport_number'] }}">
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Country</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][passport_country]"
                                                                                                            value="{{ $share['passport_country'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Expiry
                                                                                                            Date(DD/MM/YYYY)</label>

                                                                                                        <input
                                                                                                            type="date"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][pass_exp_dob]"
                                                                                                            value="{{ $share['pass_exp_dob'] }}">
                                                                                                    </div>
                                                                                                    {{-- </div> --}}
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Renewal
                                                                                                            Reminder</label>

                                                                                                        <select
                                                                                                            name="share[{{ $c }}][{{ $s }}][passport_ren_rem]"
                                                                                                            id="renewlrem">
                                                                                                            <option
                                                                                                                value=""
                                                                                                                selected>
                                                                                                                Please
                                                                                                                select
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="90 days before expiry"
                                                                                                                {{ isset($share['passport_ren_rem']) && $share['passport_ren_rem'] == '90 days before expiry' ? 'selected' : '' }}>
                                                                                                                90 days
                                                                                                                before
                                                                                                                expiry
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="120 days before expiry"
                                                                                                                {{ isset($share['passport_ren_rem']) && $share['passport_ren_rem'] == '120 days before expiry' ? 'selected' : '' }}>
                                                                                                                120 days
                                                                                                                before
                                                                                                                expiry
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="180 days before expiry"
                                                                                                                {{ isset($share['passport_ren_rem']) && $share['passport_ren_rem'] == '180 days before expiry' ? 'selected' : '' }}>
                                                                                                                180 days
                                                                                                                before
                                                                                                                expiry
                                                                                                            </option>

                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Passport
                                                                                                            Reminder
                                                                                                            Trigger
                                                                                                            Frequency</label>

                                                                                                        <div
                                                                                                            class="select_box">
                                                                                                            <span
                                                                                                                class="every">Every</span>
                                                                                                            <span
                                                                                                                class="select">
                                                                                                                <select
                                                                                                                    name="share[{{ $c }}][{{ $s }}][passport_rem_fre]"
                                                                                                                    id="renewlfre">
                                                                                                                    <option
                                                                                                                        value=""
                                                                                                                        selected>
                                                                                                                        Please
                                                                                                                        select
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="Day"
                                                                                                                        {{ isset($share['passport_rem_fre']) && $share['passport_rem_fre'] == 'Day' ? 'selected' : '' }}>
                                                                                                                        Day
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="3 Days"
                                                                                                                        {{ isset($share['passport_rem_fre']) && $share['passport_rem_fre'] == '3 Days' ? 'selected' : '' }}>
                                                                                                                        3
                                                                                                                        Days
                                                                                                                    </option>

                                                                                                                    <option
                                                                                                                        value="Week"
                                                                                                                        {{ isset($share['passport_rem_fre']) && $share['passport_rem_fre'] == 'Week' ? 'selected' : '' }}>
                                                                                                                        Week
                                                                                                                    </option>

                                                                                                                    <option
                                                                                                                        value="2 Weeks"
                                                                                                                        {{ isset($share['passport_rem_fre']) && $share['passport_rem_fre'] == '2 Weeks' ? 'selected' : '' }}>
                                                                                                                        2
                                                                                                                        Weeks
                                                                                                                    </option>

                                                                                                                    <option
                                                                                                                        value="4 Weeks"
                                                                                                                        {{ isset($share['passport_rem_fre']) && $share['passport_rem_fre'] == '4 Weeks' ? 'selected' : '' }}>
                                                                                                                        4
                                                                                                                        Weeks
                                                                                                                    </option>
                                                                                                                </select>

                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Type
                                                                                                            of TIN
                                                                                                        </label>

                                                                                                        <select
                                                                                                            name="share[{{ $c }}][{{ $s }}][tintype]">

                                                                                                            <option
                                                                                                                value=""
                                                                                                                selected>
                                                                                                                Please
                                                                                                                select
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="WP"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'WP' ? 'selected' : '' }}>
                                                                                                                WP</option>
                                                                                                            <option
                                                                                                                value="SP"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'SP' ? 'selected' : '' }}>
                                                                                                                SP</option>
                                                                                                            <option
                                                                                                                value="EP"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'EP' ? 'selected' : '' }}>
                                                                                                                EP</option>
                                                                                                            <option
                                                                                                                value="LVTP"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'LVTP' ? 'selected' : '' }}>
                                                                                                                LVTP
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="DP"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'DP' ? 'selected' : '' }}>
                                                                                                                DP</option>
                                                                                                            <option
                                                                                                                value="NRIC"
                                                                                                                {{ isset($share['tintype']) && $share['tintype'] == 'NRIC' ? 'selected' : '' }}>
                                                                                                                NRIC
                                                                                                            </option>

                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">TIN
                                                                                                            Number Before
                                                                                                            Pass
                                                                                                            Application</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][tinno]"
                                                                                                            value="{{ $share['tinno'] }}">
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

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][tincnt] "
                                                                                                            value="{{ $share['tincnt'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Phone
                                                                                                            Number</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][phno]"
                                                                                                            value="{{ $share['phno'] }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Residential
                                                                                                            Add.(according
                                                                                                            to
                                                                                                            Add.proof)</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="gendcname[0][subject]"
                                                                                                            name="share[{{ $c }}][{{ $s }}][res_add]"
                                                                                                            value="{{ $share['res_add'] }}">
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Email</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][email]"
                                                                                                            value="{{ $share['email'] }}">
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">
                                                                                                            Job
                                                                                                            Title</label>

                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][job_title]"
                                                                                                            value="{{ $share['job_title'] }}">
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Monthly
                                                                                                            Salary in the company(SGD)</label>

                                                                                                            <div class="dollersec"><span class="doller">$</span><span
                                                                                                                class="input"><input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][month_sal]"
                                                                                                            value="{{ $share['month_sal'] }}"></span></div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Relationship
                                                                                                            with
                                                                                                            shareholder {{ ($s+1) }}</label>

                                                                                                        <select
                                                                                                            name="share[{{ $c }}][{{ $s }}][rel_share_hol]"
                                                                                                            id="renewlrem" class="others_Relationship_share_class"  data-id="{{ $s }}" data-id-cmp="{{ $c }}">
                                                                                                            <option
                                                                                                                value=""
                                                                                                                selected>
                                                                                                                Please
                                                                                                                select
                                                                                                            </option>

                                                                                                            <option
                                                                                                                value="Self"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'Self' ? 'selected' : '' }}>
                                                                                                                Self
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="parents"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'parents' ? 'selected' : '' }}>
                                                                                                                parents
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="spouse"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'spouse' ? 'selected' : '' }}>
                                                                                                                spouse
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="children"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'children' ? 'selected' : '' }}>
                                                                                                                children
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="relatives"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'relatives' ? 'selected' : '' }}>
                                                                                                                relatives
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="friend"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'friend' ? 'selected' : '' }}>
                                                                                                                friend
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="Others (please specify)"
                                                                                                                {{ isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                                                                Others
                                                                                                                (please
                                                                                                                specify)
                                                                                                            </option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    @if (isset($share['rel_share_hol']) && $share['rel_share_hol'] == 'Others (please specify)')
                                                            <div
                                                                class="formAreahalf basic_data others others_Relationship_share others_alignment">
                                                                <label class="form-label" for=""></label>
                                                                <div class="select_box"><span class="every">Others,
                                                                        please specify: </span><span class="select">
                                                                        <input type="text" class="form-control sds"
                                                                            id="drp_spc_g_4"
                                                                            name="pass[{{ $c }}][{{ $s }}][p_rel_share_specific]"
                                                                            value="{{ $pass_hol['rel_pass_hol_specify'] }}"></span>
                                                                </div>
                                                            </div>
                                                        @else
                                        
                                                            <div class="formAreahalf basic_data others others_Relationship_share others_alignment"
                                                                style="display:none;">

                                                            </div>
                                                        @endif
                                                                                                    <div
                                                                                                        class="formAreahalf basic_data">
                                                                                                        <label
                                                                                                            for=""
                                                                                                            class="form-label">Remarks</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="share[{{ $c }}][{{ $s }}][remarks]"
                                                                                                            value="{{ $share['remarks'] }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <input type="hidden" name="comp_no"
                                                                                    class="comp_no" id="comp_no"
                                                                                    value="{{ $c }}" />
                                                                            @endforeach
                                                                            <input type="hidden" name="share_no"
                                                                            class="share_no" id="share_no"
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
                                                                                    <div class="accordion-item pass_acc_it ">

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
                                                                                        <div
                                                                                        class="formAreahalf basic_data">
                                                                                        <label for=""
                                                                                            class="form-label">Financial
                                                                                            Institution
                                                                                            Name {{ ($c+1) }}</label>
                                                                                            <br>{{ $fi['fi_name'] }}

                                                                                    </div>
                                                                                        <div id="panelsStayOpen-collapsenoyesfin{{ $f }}"
                                                                                            class="accordion-collapse collapse show"
                                                                                            aria-labelledby="panelsStayOpen-headingnoyesfin{{ $f }}">
                                                                                            <div
                                                                                                class="accordion-body ac-b d-flex flex-wrap">
                                                                                                {{-- <div id="financial_accordion" class="mas_related">
                                                                        <div
                                                                            class="mas_heading_accordian d-flex flex-wrap"> --}}
                                                                                             
                                                                                                <input type="hidden"
                                                                                                    name="fi[{{ $c }}][{{ $f }}][fi_id]"
                                                                                                    value="{{ $fi['id'] }}" />
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Poc
                                                                                                        Name</label>

                                                                                                    <input type="text"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][poc_name]"
                                                                                                        id=""
                                                                                                        class="form-control"
                                                                                                        value="{{ $fi['poc_name'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Financial
                                                                                                        Institution
                                                                                                        Name {{ ($f+1) }}</label>

                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][fi_name]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['fi_name'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">POC
                                                                                                        Email</label>

                                                                                                    <input type="email"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][poc_email]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['poc_email'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">POC
                                                                                                        Contact
                                                                                                        Number</label>

                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][poc_cno]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['poc_cno'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Account
                                                                                                        Type</label>

                                                                                                    <select
                                                                                                        name="fi[{{ $c }}][{{ $f }}][acc_type]"
                                                                                                        id="" class="select_acc_type_class" data-id="{{ $f }}" data-id-cmp="{{ $c }}">

                                                                                                        <option
                                                                                                            value=""
                                                                                                            selected>Please
                                                                                                            select
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="SGD"
                                                                                                            {{ isset($fi['acc_type']) && $fi['acc_type'] == 'SGD' ? 'selected' : '' }}>
                                                                                                            SGD</option>
                                                                                                        <option
                                                                                                            value="USD"
                                                                                                            {{ isset($fi['acc_type']) && $fi['acc_type'] == 'USD' ? 'selected' : '' }}>
                                                                                                            USD</option>
                                                                                                        <option
                                                                                                            value="Multi-currency"
                                                                                                            {{ isset($fi['acc_type']) && $fi['acc_type'] == 'Multi-currency' ? 'selected' : '' }}>
                                                                                                            Multi-currency
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="Others (please specify)"
                                                                                                            {{ isset($fi['acc_type']) && $fi['acc_type'] == 'Others (please specify)' ? 'selected' : '' }}>
                                                                                                            Others (please
                                                                                                            specify)
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                @if (isset($fi['acc_type']) && $fi['acc_type'] == 'Others (please specify)')
                                                                                                <div
                                                                                                    class="formAreahalf basic_data others others_acc_type others_alignment">
                                                                                                    <label class="form-label" for=""></label>
                                                                                                    <div class="select_box"><span class="every">Others,
                                                                                                            please specify: </span><span class="select">
                                                                                                            <input type="text" class="form-control sds"
                                                                                                                id="drp_spc_g"
                                                                                                                name="fi[{{ $c }}][{{ $f }}][acc_type_specific]"
                                                                                                                value="{{ $fi['acc_type_specific'] }}"></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="formAreahalf basic_data others others_acc_type others_alignment"
                                                                                                    style="display:none;">
                                
                                                                                                </div>
                                                                                            @endif
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Application
                                                                                                        Submission</label>

                                                                                                    <select
                                                                                                        name="fi[{{ $c }}][{{ $f }}][app_sub]"
                                                                                                        id=""
                                                                                                        class="js-example-responsive">
                                                                                                        <option
                                                                                                            value=""
                                                                                                            selected>Please
                                                                                                            select
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="In progress"
                                                                                                            {{ isset($fi['app_sub']) && $fi['app_sub'] == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                                                        <option
                                                                                                            value="Done"
                                                                                                            {{ isset($fi['app_sub']) && $fi['app_sub'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Account
                                                                                                        Opening
                                                                                                        Status</label>

                                                                                                    <select name="fi[{{ $c }}][{{ $f }}][acc_opn_sts]"  id="" class="js-example-responsive">
                                                                                                        <option
                                                                                                            value=""
                                                                                                            selected>Please
                                                                                                            select
                                                                                                        </option>
                                                                                                        <option value="Pending" {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                                                        <option value="Approved" {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                                                        <option value="Rejected" {{ isset($fi['acc_opn_sts']) && $fi['acc_opn_sts'] == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                                                                    </select>
                                                                                                 
                                                                                                </div>

                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Account/Policy
                                                                                                        Number
                                                                                                    </label>

                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][acc_pol_no]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['acc_pol_no'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Money
                                                                                                        Deposit
                                                                                                        Status</label>

                                                                                                    <select
                                                                                                        name="fi[{{ $c }}][{{ $f }}][money_dep_sts]"
                                                                                                        id=""
                                                                                                        class="js-example-responsive">

                                                                                                        <option
                                                                                                            value=""
                                                                                                            selected>Please
                                                                                                            select
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="In progress"
                                                                                                            {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                                                       
                                                                                                        <option
                                                                                                            value="Done"
                                                                                                            {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                                                        <option
                                                                                                            value="N/A"
                                                                                                            {{ isset($fi['money_dep_sts']) && $fi['money_dep_sts'] == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Account
                                                                                                        Current
                                                                                                        Status</label>

                                                                                                    <select
                                                                                                        name="fi[{{ $c }}][{{ $f }}][acc_crt_sts]"
                                                                                                        id=""
                                                                                                        class="js-example-responsive">
                                                                                                        <option
                                                                                                            value=""
                                                                                                            selected>Please
                                                                                                            select
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="Pending"
                                                                                                            {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                                                        <option
                                                                                                            value="Approved"
                                                                                                            {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                                                        <option
                                                                                                            value="Rejected"
                                                                                                            {{ isset($fi['acc_crt_sts']) && $fi['acc_crt_sts'] == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                                                                        


                                                                                                    </select>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Online
                                                                                                        Account
                                                                                                        Username</label>

                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][on_acc_usr_nam]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['on_acc_usr_nam'] }}">
                                                                                                </div>

                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Online
                                                                                                        Account
                                                                                                        Password</label>

                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][on_acc_usr_pass]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['on_acc_usr_pass'] }}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Maturity
                                                                                                        Date</label>

                                                                                                    <input type="date"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][mat_date]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['mat_date'] }}">
                                                                                                </div>

                                                                                                <div
                                                                                                    class="formAreahalf basic_data">
                                                                                                    <label for=""
                                                                                                        class="form-label">Remarks</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="fi[{{ $c }}][{{ $f }}][remarks]"
                                                                                                        id=""
                                                                                                        value="{{ $fi['remarks'] }}">

                                                                                                </div>


                                                                                                {{-- </div>
                                                                    </div> --}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <input type="hidden" name="comp_no"
                                                                                class="comp_no" id="comp_no"
                                                                                value="{{ $c }}" />
                                                                        @endforeach
                                                                        <input type="hidden" name="fi_no"
                                                                        class="fi_no" id="share_no"
                                                                        value="{{ $f }}" />
                                                                        <div id="appended_financial_div"
                                                                            class="appended_financial_div">
                                                                        </div>

                                                                        <div class="text-center pt-4 add_potentia add_potential"
                                                                            id="add_financial_btn_div">
                                                                            <button type="button" id="add_financial"
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
                                    <input type="hidden" class="cmp_array_id_for_appnd_cmp" name="cmp_array_id_for_appnd_cmp" id="cmp_array_id_for_appnd_cmp" value={{$c}}>
                                    <div id="appnd_company_div" class="appnd_company_div"></div>
                                    <div class="text-center pt-4 " id="add_company_btn_div">
                                        <button type="button" id="add_company"
                                            class="btn saveBtn btn_design add_company" name="add-company">Add
                                            Company</button>
                                    </div>
                                    {{-- </div> --}}
                                </div>

                                <div class="tab-pane fade" id="nav-pass" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">

                                    <?php $pas = -1; ?>
                                    <div>
                                        @foreach ($data->op_app_passholder as $pass_hol)
                                            <fieldset id="FO_Pass_PR"
                                                class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">
                                                <?php $pas++; ?>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Pass Holder Name {{$pas+1}}</label>
                                                    <p>{{ $pass_hol['passhol_name'] }}</p>
                                                </div>

                                                <?php $p = -1; ?>
                                                @foreach ($pass_hol['pass_pr'] as $pr_key => $pr)
                                                    <?php $p++; 
                                    //                     echo'<pre>';
                                    // print_r($pr);
                                    // echo'</pre>';
                                    ?>
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

                                                        <div class="accordion-item pass_acc_it ">

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
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">1st Time
                                                                    PR
                                                                    Application
                                                                    Date</label>
                                                                    <br>{{ $pr['application_date'] }}

                                                              
                                                            </div>
                                                            <div id="panelsStayOpen-collapsenoyesbasic{{ $p }}"
                                                                class="accordion-collapse collapse show"
                                                                aria-labelledby="panelsStayOpen-headingnoyesbasic{{ $p }}">
                                                                <div class="accordion-body d-flex flex-wrap">


                                                                    <input type="hidden"
                                                                        name="pr[{{ $pas }}][{{ $p }}][pr_id]"
                                                                        value="{{ $pr['id'] }}" />
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label">1st Time
                                                                            PR
                                                                            Application
                                                                            Date</label>

                                                                        <input type="date" class="form-control"
                                                                            name="pr[{{ $pas }}][{{ $p }}][application_date]"
                                                                            id=""
                                                                            value="{{ $pr['application_date'] }}">
                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label"></label>

                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for=""
                                                                            class="form-label">Application
                                                                            Dependent</label>

                                                                        <select
                                                                            name="pr[{{ $pas }}][{{ $p }}][application_dep]"
                                                                            id="">

                                                                            <option value="" selected>Please select
                                                                                pass
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
                                                                    <div class="formAreahalf basic_data ">
                                                                        <label for="" class="form-label">Pass
                                                                            Application
                                                                            Status</label>

                                                                        <select
                                                                            name="pr[{{ $pas }}][{{ $p }}][application_sts]"
                                                                            id=""
                                                                            class="js-example-responsive p_sts">

                                                                            <option value="" selected>Please select
                                                                            </option>
                                                                            <option value="Pending"
                                                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Pending' ? 'selected' : '' }}>Pending</option>

                                                                            <option value="Approved"
                                                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Approved' ? 'selected' : '' }}>Approved</option>


                                                                            <option value="Rejected"
                                                                                {{ isset($pr['application_sts']) && $pr['application_sts'] == 'Rejected' ? 'selected' : '' }}>Rejected</option>

                                                                        </select>
                                                                    </div>
                                                                    {{-- @if (isset($pr['application_sts']) && $pr['application_sts'] == 'Rejected') --}}
                                                                    <div class="formAreahalf basic_data p_status_div"
                                                                        style="display:none">
                                                                        <label for="" class="form-label">PR
                                                                            Rejection Date</label>
                                                                        <input type="date" class="form-control"
                                                                            name="pr[{{ $pas }}][{{ $p }}][rejection_date]"
                                                                            id="" value="{{ $pr['rejection_date'] }}">
                                                                    </div>

                                                                    <div class="formAreahalf basic_data p_status_div"
                                                                        style="display:none">
                                                                        <label for="" class="form-label">Re
                                                                            Submission Reminder</label>
                                                                        <select
                                                                            name="pr[{{ $pas }}][{{ $p }}][re_sub_rem]"
                                                                            id="" >
                                                                            <option value="180 days before REP expiry"  {{ isset($pr['re_sub_rem']) && $pr['re_sub_rem'] == '180 days before REP expiry' ? 'selected' : '' }}>180
                                                                                days before REP expiry</option>
                                                                            <option value="90 days before REP expiry" {{ isset($pr['re_sub_rem']) && $pr['re_sub_rem'] == '90 days before REP expiry' ? 'selected' : '' }}>90
                                                                                days before REP expiry</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data p_status_div"
                                                                        style="display:none">
                                                                        <label for="" class="form-label">Re
                                                                            Submission Status </label>
                                                                        <select
                                                                            name="pr[{{ $pas }}][{{ $p }}][re_sub_sts]"
                                                                            id="abc"
                                                                            class="js-example-responsive form-control">
                                                                            <option value="">Please select</option>
                                                                            <option value="Done" {{ isset($pr['re_sub_sts']) && $pr['re_sub_sts'] == 'Done' ? 'selected' : '' }}>Done</option>
                                                                            <option value="Withdrawn" {{ isset($pr['re_sub_sts']) && $pr['re_sub_sts'] == 'Withdrawn' ? 'selected' : '' }}>Withdrawn</option>

                                                                        </select>

                                                                    </div>



                                                                    {{-- @else --}}
                                                                    <div
                                                                        class="formAreahalf basic_data p_status_div_default">
                                                                        <label for="" class="form-label">PR
                                                                            Approval
                                                                            Date</label>
                                                                        <p></p>
                                                                        <input type="date" class="form-control"
                                                                            name="pr[{{ $pas }}][{{ $p }}][approval_date]"
                                                                            id=""
                                                                            value="{{ $pr['approval_date'] }}">
                                                                    </div>
                                                                    <div
                                                                        class="formAreahalf basic_data p_status_div_default">
                                                                        <label for="" class="form-label">REP
                                                                            Expiry
                                                                            Date</label>
                                                                        <p></p>
                                                                        <input type="date" class="form-control"
                                                                            name="pr[{{ $pas }}][{{ $p }}][rep_expiry_date]"
                                                                            id=""
                                                                            value="{{ $pr['rep_expiry_date'] }}">
                                                                    </div>
                                                                    <div
                                                                        class="formAreahalf basic_data p_status_div_default">
                                                                        <label for="" class="form-label">REP
                                                                            Renewal
                                                                            Reminder</label>


                                                                        <select
                                                                            name="pr[{{ $pas }}][{{ $p }}][rep_ren_rem]"
                                                                            id="">

                                                                            <option value="" selected>Please select
                                                                            </option>

                                                                            <option value="90 days before REP expiry"
                                                                                {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '90 days before REP expiry' ? 'selected' : '' }}>
                                                                                90 days before REP expiry</option>
                                                                            <option value="180 days before REP expiry"
                                                                                {{ isset($pr['rep_ren_rem']) && $pr['rep_ren_rem'] == '180 days before REP expiry' ? 'selected' : '' }}>
                                                                                180 days before REP expiry</option>
                                                                        </select>
                                                                    </div>

                                                                    {{-- @endif --}}
                                                                    {{-- <div class="formAreahalf basic_data p_status_div" style="display:none">
                                                                        <label for="" class="form-label">PR Rejection Date</label>
                                                                        <input type="date" class="form-control" name="pr[{{ $pas }}][{{ $p }}][rejection_date]"
                                                                            id="">
                                                                    </div>
                                                                  
                                                                    <div class="formAreahalf basic_data p_status_div" style="display:none">
                                                                        <label for="" class="form-label">Re Submission Reminder</label>
                                                                        <select name="pr[{{ $pas }}][{{ $p }}][re_sub_rem]" id="">
                                                                            <option value="180 days before REP expiry">180 days before REP expiry</option>
                                                                            <option value="90 days before REP expiry">90 days before REP expiry</option>
                                                                            
                                                                        </select>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data p_status_div" style="display:none;" >
                                                                        <label for="" class="form-label">Re Submission Status </label>
                                                                        <select name="pr[{{ $pas }}][{{ $p }}][re_sub_sts]" id="abc" class="js-example-responsive form-control">
                                                                            <option value="">Please select</option>
                                                                            <option value="Done">Done</option>
                                                                            <option value="Withdrawn">Withdrawn</option>
                                                                            
                                                                        </select>
                                    
                                                                    </div> --}}


                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="" class="form-label">REP
                                                                            Renewal
                                                                            Trigger
                                                                            Frequency</label>
                                                                        <div class="select_box"><span
                                                                                class="every">Every</span><span
                                                                                class="select">
                                                                                <select
                                                                                    name="pr[{{ $pas }}][{{ $p }}][rep_ren_trg_fre]"
                                                                                    id="">

                                                                                    <option value="" selected>Please
                                                                                        select

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
                                                                                </select></span></div>
                                                                    </div>
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for=""
                                                                            class="form-label">Re-Submission
                                                                            Trigger
                                                                            Frequency</label>

                                                                        <div class="select_box"><span
                                                                                class="every">Every</span><span
                                                                                class="select"><select
                                                                                    name="pr[{{ $pas }}][{{ $p }}][re_sub_trg_fre]"
                                                                                    id="">

                                                                                    <option value="" selected>Please
                                                                                        select
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

                                                                        <textarea id="" name="pr[{{ $pas }}][{{ $p }}][remarks]" rows="4"
                                                                            cols="50">{{ $pr['remarks'] }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" id="pass_id_count" class="pass_id_count"
                                                    value="{{ $pas }}">
                                                <input type="hidden" id="pr_form_count" class="pr_form_count"
                                                    value="{{ $p }}">
                                                <div id="appended_pr_div" class="appended_pr_div">
                                                </div>
                                                <div class="text-center pt-4 add_potentia add_potential"
                                                    id="add_pr_btn_div">
                                                    <button type="button" id="add_pr"
                                                        class="btn saveBtn btn_design add_pr" name="add-pr">Add
                                                        Application Attempt</button>
                                                </div>
                                    </div>
                                    </fieldset>
                                    @endforeach
                                </div>

                                {{-- </div> --}}
                                {{-- </div> --}}





                            </div>



                        </div>



                    </div>

                </div>

            </div>

        </form>



        <div class="lower-bottom ">
            <div class="notes-common formContentData">


                <form action="javascript:void(0)" method="POST" name="notes_form" id="notes"
                    class="note_send">
                    @csrf
                    <input type="hidden" name="created_by_name" value="{{ Auth::user()->name }}">

                    <input type="hidden" name="application_id" value="{{ $data->id }}">
                    <input type="hidden" value="Operation" name="tbl_name">
                    <div class="textarea">
                        <label class="form-label mt-5" for="notes">Notes</label>

                        <textarea id="text_notes" name="notes" placeholder="Type your notes here..." rows="8" cols="200"></textarea>
                        <input type="submit" class="btn saveBtn btn_notes" value="Save">
                        <input type="button" id="notes_cancel" class="btn saveBtn cancelBtn delete" value="Cancel"
                            style="display: none">
                    </div>
                </form>
                @foreach ($notes as $note)
                    <div class="notes_show" id="note{{$note->id }}">
                        <div class="cross"><span class="note_remove" data-Id="{{ $note->id }}">x</span></div>
                        <p class="desc_notes">{{ $note->notes_description }}</p>
                        <p class="created">
                            {{ convertDate($note->created_at,'d/m/Y h:i a')}}
                        </p>
                        <p class="createdby"><b>{{ $note->created_by }}</b></p>
                    </div>
                @endforeach

                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5"></div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <ul id="pagin" class="pagination"></ul>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>


            <div class="card file upload">
                <h3>File Uploads</h3>

                <form method="POST" id="file-upload" name="file_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="pass_id" value="{{ $data->id }}">
                    <div class="mb-3">

                        <input type="file" name="file" id="inputFile" class="form-control">
                        <span class="text-danger" id="file-input-error"></span>
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn saveBtn">Upload</button>
                    </div>
                </form>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table table_yellow file_upload_table">
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
                                            <a href="javascript:void(0);" class="del_confirm"
                                                data-id="{{ $files->id }}"><i class="fa-solid fa-trash ms-2"></i></a>
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
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table table_yellow user_action_log">
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
                                        <td>{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
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
    {{-- </div> --}}
@endsection
@push('js')
    <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>
    
    <script>
//         $(document).on('click', '.pass_acc_button', function(){
//             // alert('jok');
//     $(this).parents('.pass_acc_it').toggleClass('closed');
// })
        $(document).ready(function() {
            $(".p_sts").change();
            // $(".select_class").change();
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

        $(document).on('change', '.select_class', function() {
            if ($(this).val() == "Others (please specify)") {


                $(this).parents('.accordion-body').find('.others_hide_show').show();

                var tpb_id = $(this).attr('data-id');
                $(this).parents('.accordion-body').find('.others').append(
                    '<label class="form-label" for=""></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="drp_spc" name="pass[' +
                    tpb_id + '][bus_type_specify]"></span></div>'
                );
                // ++o;

            } else {
                $(this).parents('.accordion-body').find('.others').html('');
                // $(".others_hide_show").hide();
                $(this).parents('.accordion-body').find('.others_hide_show').hide();
            }


        });

        $(document).on('change', '.select_class_pass_app_type', function() {

            if ($(this).val() == "Others (please specify)") {

                $(this).parents('.accordion-body').find('.others_pass_app').show();
                var tpb_id = $(this).attr('data-id');
                $(this).parents('.accordion-body').find('.others_pass_app').append(
                    '<label class="form-label" for=""></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="drp_spc" name="pass[' +
                    tpb_id + '][rel_pass_hol_specify]" ></span></div>'
                );
                // ++o;

            } else {
                $(this).parents('.accordion-body').find('.others_pass_app').html('');

                $(this).parents('.accordion-body').find('.others_pass_app').hide();
            }


        });

        $(document).on('change', '.select_class_rel_share', function() {
          

if ($(this).val() == "Others (please specify)") {
    // alert('jj');
    $(this).parents('.accordion-body').find('.others_rel_share').show();
  
    var tpb_id = $(this).attr('data-id');
    $(this).parents('.accordion-body').find('.others_rel_share').append(
        '<label class="form-label" for=""></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="pass[' +
        tpb_id + '][rel_pass_hol_specify]" ></span></div>'
    );
   

} else {
    $(this).parents('.accordion-body').find('.others_rel_share').html('');

    $(this).parents('.accordion-body').find('.others_rel_share').hide();
}


});

$(document).on('change', '.others_Relationship_share_class', function() {
        //  alert('click');

                if ($(this).val() == "Others (please specify)") {
                    alert('others');
                
                    var tpb_id = $(this).attr('data-id');

                    var cmp_id_data = $(this).attr('data-id-cmp');
                    //    alert(cmp_id_data);
                    $(this).parents('.acc-bo').find('.others_Relationship_share').show();
                    $(this).parents('.acc-bo').find('.others_Relationship_share').append(
                        '<label class="form-label" for=""></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="share[' +
                        cmp_id_data + '][' +
                        tpb_id + '][p_rel_share_specific]"></span></div>'
                    );
                 

                } else {
                 
                    $(this).parents('.accordion-body').find('.others_Relationship_share').html('');
                    $(this).parents('.accordion-body').find('.others_Relationship_share').hide();
                }


            });

            $(document).on('change', '.select_acc_type_class', function() {
                // alert('ijij');

                if ($(this).val() == "Others (please specify)") {
                    // alert('ijijojij');

                    var tpb_id = $(this).attr('data-id');

                    var cmp_id_data = $(this).attr('data-id-cmp');
                   
                    // alert(cmp_id_data);
                    // alert(tpb_id);
                    $(this).parents('.ac-b').find('.others_acc_type').show();
                    //    alert(cmp_id_data);
                    $(this).parents('.ac-b').find('.others_acc_type').append(
                        '<label class="form-label" for=""></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="fi[' +
                        cmp_id_data + '][' +
                        tpb_id + '][acc_type_specific]"></span></div>'
                    );
                    // ++o;

                } else {
                    // alert('no');
                    $(this).parents('.ac-b').find('.others_acc_type').html('');
                    $(this).parents('.ac-b').find('.others_acc_type').hide();
                }


            });

        $(document).on('change', '.p_sts', function() {
            // alert('abc');

            if ($(this).val() == "Rejected") {
                $(this).parents('.accordion-body').find('.p_status_div_default').hide();
                $(this).parents('.accordion-body').find('.p_status_div').show();


            } else {

                $(this).parents('.accordion-body').find('.p_status_div_default').show();
                $(this).parents('.accordion-body').find('.p_status_div').hide();

            }


        });

        // // var pr_no = 0;
        //  var pr_no = $("#pr_form_count").val();

        $('body').on('click', '.add_pr', function() {

            // var pr_no = $("#pr_form_count").val();

            var pr_no = $(this).parents('fieldset').find(".pr_form_count").val();
            pr_no++;

            $(this).parents('fieldset').find('.pr_form_count').val(pr_no);
            var pass_id_no = $(this).parents('fieldset').find(".pass_id_count").val();

            // pr_form_count

            //   alert(pass_id_no);
            //   alert(pr_no);

            // i++;
            // alert('ethe');
            // var arr_id = $(this).attr('data-id');
            // var arr_id = 1;

            //  alert(pr_no);
            // $(this).closest('#appended_shareholder_div').append(
            $(this).parents('fieldset').find('.appended_pr_div').append(
                `<div id="fo_pr" class="pr_form_class prr` + pr_no + `">\
     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
         
         <div class="accordion-item pass_acc_it closed">
            <span class="cancel_pr"><i class="fa fa-times remove_pr" data-id="prr` + pr_no + `" aria-hidden="true"></i></span> \ 
                <h2 class="accordion-header" id="panelsStayOpen-headingnoyes` + pr_no + `">
                
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapsenoyes` + pr_no + `" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapsenoyes` + pr_no + `">
                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                    </button>
                </h2>
                <div class="formAreahalf">
                    <label for="" class="form-label">1st Time PR Application Date</label>
                 
                </div>
                <div id="panelsStayOpen-collapsenoyes` + pr_no + `" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingnoyes` + pr_no + `">
     <div class="accordion-body d-flex flex-wrap">

    
        <div class="formAreahalf">
                    <label for="" class="form-label">1st Time PR Application Date</label>
                    <input type="date" class="form-control" name="pr[` + pass_id_no + `][` + pr_no + `][application_date]"
                        id="">
                </div>
                <div class="formAreahalf ">
                    <label for="" class="form-label">Application Dependent</label>
                    <select name="pr[` + pass_id_no + `][` + pr_no + `][application_dep]" id="">
                        <option value="" selected >Please select
                        </option>
                        <option value="None">None</option>
                        <option value="Spouse only">Spouse only</option>
                        <option value="Children only">Children only</option>
                        <option value="Spouse and Children">Spouse and Children</option>
                    </select>
                </div>
                <div class="formAreahalf ">
                    <label for="" class="form-label">Pass Application Status sdsdsd</label>
                    <select name="pr[` + pass_id_no + `][` + pr_no + `][application_sts]" id="" class="js-example-responsive p_sts">
                        <option value="" selected >Please select
                        </option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="formAreahalf p_status_div_default">
                    <label for="" class="form-label">PR Approval Date</label>
                    <input type="date" class="form-control" name="pr[` + pass_id_no + `][` + pr_no + `][approval_date]"
                        id="">
                </div>
                <div class="formAreahalf p_status_div_default">
                    <label for="" class="form-label">REP Expiry Date</label>
                    <input type="date" class="form-control" name="pr[` + pass_id_no + `][` +
                pr_no + `][rep_expiry_date]"
                        id="">
                </div>
                <div class="formAreahalf p_status_div_default">
                    <label for="" class="form-label">REP Renewal Reminder</label>
                    <select name="pr[` + pass_id_no + `][` + pr_no + `][rep_ren_rem]" id="" >
                        <option value="" selected >Please select
                        </option>
                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                    </select>
                </div>
                <div class="formAreahalf p_status_div" style="display:none">
                                    <label for="" class="form-label">PR Rejection Date</label>
                                    <input type="date" class="form-control" name="pr[` + pass_id_no + `][` + pr_no + `][rejection_date]"
                                        id="">
                                </div>
                              
                                <div class="formAreahalf p_status_div" style="display:none">
                                    <label for="" class="form-label">Re Submission Reminder</label>
                                    <select name="pr[` + pass_id_no + `][` + pr_no + `][re_sub_rem]" id="">
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        
                                    </select>
                                </div>
                                <div class="formAreahalf p_status_div " style="display:none;" >
                                    <label for="" class="form-label">Re Submission Status </label>
                                    <select name="pr[` + pass_id_no + `][` + pr_no + `][re_sub_sts]" id="abc" class="js-example-responsive form-control">
                                        <option value="">Please select</option>
                                        <option value="Done">Done</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        
                                    </select>

                                </div>

              


                <div class="formAreahalf ">
                    <label for="" class="form-label">REP Renewal Trigger Frequency</label>
                    <div class="select_box"><span class="every">Every</span><span
                                class="select"><select name="pr[` + pass_id_no + `][` + pr_no + `][rep_ren_trg_fre]" id="">
                        <option value="" selected >Please select
                        </option>
                        <option value="Day">Day</option>
                <option value="3 Days">3 Days</option>
                <option value="Week">Week</option>
                <option value="2 Weeks">2 Weeks</option>
                <option value="4 Weeks">4 Weeks</option>
                    </select></span></div>
                </div>
                <div class="formAreahalf ">
                    <label for="" class="form-label">Re-Submission Trigger Frequency</label>
                    <div class="select_box"><span class="every">Every</span><span
                                class="select"><select name="pr[` + pass_id_no + `][` + pr_no + `][re_sub_trg_fre]" id="">
                        <option value="" selected >Please select
                        </option>
                        <option value="Day">Day</option>
                <option value="3 Days">3 Days</option>
                <option value="Week">Week</option>
                <option value="2 Weeks">2 Weeks</option>
                <option value="4 Weeks">4 Weeks</option>

                    </select></span></div>
                </div>
                <div class="formAreahalf">
                    <label class="form-label" for="remarks">Remarks</label>
                    <textarea id="" name="pr[` + pass_id_no + `][` + pr_no + `][remarks]" rows="4" cols="50"></textarea>
                </div>


         <div id="appended_user_financial_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
         </div>\
         </div>
        </div>
    </div>
     </div></div>`
            );
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

        });
        $(document).on('click', '.remove_pr', function() {
            // alert('id');
            var id = $(this).attr('data-id');
            // alert(id);
            // console.log(id);
            $(this).parents('.appended_pr_div').find('.' + id + '').remove();
        });


        // var p = 0;

        $('body').on('click', ".add-pass-holder", function() {
            // alert('dd');
            var p = $("#pass_counter_z").val();
            p++;
            $("#pass_counter_z").val(p);


            // console.log($(this).parents('fieldset'));
            $(this).parents('fieldset').find('.appended_passholder_div').append(`
                            <div id="fo_pr" class="pr_form_class parent_field` + p + `">\
     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                          
                            
                            <div class="accordion-item pass_acc_it closed">
                                <div class="cross"><span class="remove-input-field" data-id=".parent_field` + p + `">x</span></div>
                                <h2 class="accordion-header" id="panelsStayOpen-heading` + p + `">
                                
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapse` + p + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapse` + p + `">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div class="formAreahalf ">
                            <label class="form-label" for="">Pass Holder Name ` +(p+1) + ` (Eng)</label>


                        </div>
                                <div id="panelsStayOpen-collapse` + p + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-heading` + p + `">
                     <div class="accordion-body d-flex flex-wrap">

                        <div class="formAreahalf ">
                            <label for="bustype" class="form-label"> Business Type </label>
                          
                                <select name="pass[` + p + `][bus_type]" class="select_class" data-id="` + p + `"> 
                                <option value="" selected >Please select
                                </option>
                           

                                <option value="FO">FO</option>
                                                <option value="PIC">PIC</option>
                                                <option value="Self-employment">Self-employment</option>
                                                <option value="Employer Guarantee">Employer Guarantee</option>
                                                <option value="PR application">PR application</option>
                                                <option value="PR renewal">PR renewal</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                                </select>

                        </div>
                        <div class="formAreahalf others others_hide_show others_alignment" style="display:none;">
                         
                        </div>

                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Application Type </label>
                            <select name="pass[` + p +
                `][pass_app_type]" class="select_class_pass_app_type" data-id="` + p + `"> 
                                <option value="" selected >Please select pass application type
                                </option>
                                <option value="EP">EP</option>
                                                <option value="SP">SP</option>
                                                <option value="DP">DP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="WP">WP</option>
                                                <option value="PR">PR</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                
                            </select>
                         
                        </div>
                        <div class="formAreahalf basic_data others_pass_app others_alignment" style="display:none;">
                                                         
                       </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Does passholder need to set up company? </label>
                            <select name="pass[` + p + `][passhol_setup]" class="set_company" id="set_company">
                                <option value="" selected >Please select
                                </option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Is the passholder also the shareholder? </label>
                            <select name="pass[` + p + `][passhol_sharehol]" id="also_shareholder" class="also_shareholder">                            
                                <option value="" selected >Please select
                                </option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Pass Holder Name ` +(p+1) + ` (Eng)</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passhol_name]" id="passhol_name">

                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Full Name (Chinese)</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_name]">

                        </div>
                      
                        <div class="formAreahalf ">
                            <label for="" class="form-label">  DOB (DD/MM/YYYY)</label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_dob]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="gender" class="form-label">Gender (M/F)</label>
                            <select class="" name="pass[` + p + `][pass_gender]" id="sign">
                                <option value=""></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Passport Expiry Date (DD/MM/YYYY)</label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_exp_dob]">
                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_number]">

                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Country</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_country]">

                        </div>
                      

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Passport  Renewal Reminder</label>
                            <select name="pass[` + p + `][passport_ren_rem]" >
                                <option value="">Please select</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">TIN Number Before Pass Application</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_tin_number]">

                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label">Passport Reminder Trigger Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select name="pass[` + p + `][passport_rem_fre]" id="renewlfre">
                                <option value="">Please select</option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                            </select></span></div>
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">E-mail</label>
                            <input type="email" class="form-control" 
                                name="pass[` + p + `][email]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">TIN Country Before Pass Application</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_tin_country]">

                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Phone Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][phno]">

                        </div>


                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Type of TIN Before Pass Application</label>
                            <select name="pass[` + p + `][pass_tin_type]">
                                <option value="" selected >Please select type of TIN before pass application
                                </option>
                                <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>
                                
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">FIN Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][finno]">

                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Residential Address</label>
                            <input type="text" class="form-control" 
                                name="pass[` + p + `][res_add]">
                        </div>


                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Application Status dfdfdf</label>
                            <select name="pass[` + p + `][pass_app_sts]" class="js-example-responsive">
                                <option value="" selected >Please select application status
                                </option>
                                <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                            </select> 
                        </div>

                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Issuance </label>
                            <select name="pass[` + p + `][pass_iss]" class="js-example-responsive">
                                <option value="" selected >Please select pass issuance
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select> 
                        </div>


                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Issuance Date </label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_iss_date]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Expiry Date </label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_exp_date]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Duration </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][duration]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Pass Renewal Frequency</label>
                            <select name="pass[` + p + `][pass_ren_fre]" >
                                <option value="">Please select pass renewal reminder</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                <option value="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Pass Renewal Reminder</label>
                            <select name="pass[` + p + `][pass_ren_rem]" >
                                <option value="">Please select pass renewal reminder</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                <option value="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label">Pass Renewal Trigger Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select name="pass[` + p + `][pass_ren_ter_fre]" id="renewlfre">
                                <option value="">Please select </option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                            </select></span></div>
                        </div>


                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Job Title </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][pass_job_title]">
                        </div> 

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label">Singpass Setup</label>
                            <select name="pass[` + p + `][singpass_setup]" class="js-example-responsive">
                                <option value="">Please select</option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> 1st PR Application Reminder </label>
                            <select name="pass[` + p + `][pr_app_rem]" >
                                <option value="">Please select PR application reminder</option>
                                <option value="N/A">N/A</option>
                                <option value="180 days after pass issuance date">180 days after pass issuance date</option>
                                <option value="270 days after pass issuance date">270 days after pass issuance date</option>
                                <option value="365 days after pass issuance date">365 days after pass issuance date</option>
                                <option value="540 days after pass issuance date">540 days after pass issuance date</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Relationship With Pass Holder 1</label>
                            <select name="pass[` + p + `][rel_pass_hol]" class="select_class_rel_share">
                                <option value="">Please select</option>
                                <option value="Self">Self</option>
                                                <option value="Parents">Parents</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Children">Children</option>
                                                <option value="Relatives">Relatives</option>
                                                <option value="Friend">Friend</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                            </select>
                        </div>
                        <div class="formAreahalf others others_rel_share others_alignment" style="display:none;">
                         
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Employer's Name </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][emp_name]">
                        </div> 

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Monthly Salary (SGD)</label>
                            <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="integer" class="form-control"  name="pass[` + p + `][month_sal]"></span></div>
                        </div> 

                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea  name="pass[` + p + `][p_remarks]" rows="4" cols="50"></textarea>
                        </div>
                            </div></div>
                            </div></div></div>`


            )
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });


        });
        $(document).on('click', '.remove-input-field', function() {
            var id = $(this).attr('data-id');
            // console.log(id);
            $(this).parents(id).remove();
        });


        // var sh_no = $("#share_no").val();
        $('body').on('click', '.add_shareholder', function() {
            // var arr_id=1;
            // var sh_no=1;
            var arr_id1 = $(this).parents('fieldset').find(".comp_no").val();

            var sh_no = $(this).parents('fieldset').find(".share_no").val();

            // var arr_id1 = $("#company_id_share_append").val();


            // var arr_id1 = $(this).parents('fieldset').find('#company_id_share_append').val();
            // alert(arr_id1);
            sh_no++;
            $(this).parents('fieldset').find(".share_no").val(sh_no);

            $(this).parents('fieldset').find('.appended_share_div').append(
                `<div id="fo_shareholder" class="sharehold share` + sh_no + `">\
        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
           
            <div class="Share_holder-w sub-heading">\
                <h4>Shareholder #` + (sh_no + 1) + `</h4>\
            </div>\   
            <div class="accordion-item">
                <div class="cross"><span class="remove-input-field"  data-id=".share` +
                sh_no + `">x</span></div>

                <h2 class="accordion-header" id="panelsStayOpen-headingOne1234` + sh_no + `">

                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne1234` + sh_no + `" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                    </button>

                </h2>
               
                <div id="panelsStayOpen-collapseOne1234` + sh_no + `" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne123` + sh_no +
                `">
                    <div class="accordion-body acc-bo d-flex flex-wrap">

            <div class="formAreahalf">
                      <label for="eqtper" class="form-label"> Equity percentage </label>
                      <div class="dollersec percentage_input"><span class="input"> <input type="text" class="form-control equity_shareholders" name="share[` +
                arr_id1 + `][` +
                sh_no + `][eqt_per]"></span><span class="pecentage_end">%</span></div>
                  </div>
                  <div class="formAreahalf ">
                      <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

                      <input type="text" class="form-control" 
                      name="share[` + arr_id1 + `][` + sh_no + `][passhol_name]">

                  </div>

                  <div class="formAreahalf ">
                      <label class="form-label" for="">Passport Full Name
                          (Chinese)</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][passport_name]">

                  </div>

                  <div class="formAreahalf ">
                      <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                      <input type="date" class="form-control" name="share[` + arr_id1 + `][` +
                sh_no + `][shareholder_dob]">
                  </div>

                  <div class="formAreahalf ">
                      <label for="gender" class="form-label">Gender (M/F)</label>
                      <select class="" name="share[` + arr_id1 + `][` + sh_no + `][shareholder_gender]" id="sign">
                          <option value=""></option>
                          <option value="M">M</option>
                          <option value="F">F</option>
                      </select>
                  </div>

                  <div class="formAreahalf ">
                      <label class="form-label" for="">Passport Number</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][passport_number]">

                  </div>
               
                  <div class="formAreahalf ">
                      <label class="form-label" for="">Passport Country</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][passport_country]">

                  </div>

                  <div class="formAreahalf ">
                      <label for="" class="form-label"> Passport Expiry Date
                          (DD/MM/YYYY)</label>
                      <input type="date" class="form-control" name="share[` + arr_id1 + `][` +
                sh_no + `][pass_exp_dob]">
                  </div>

                  <div class="formAreahalf ">
                      <label for="clienttype" class="form-label"> Passport Renewal
                          Reminder</label>
                      <select name="share[` + arr_id1 + `][` + sh_no + `][passport_ren_rem]" id="renewlrem">
                          <option value="">Please select passport renewal reminder</option>
                          <option value="90 days before expiry">90 days before expiry</option>
                                <option value="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                      </select>
                  </div>

                  <div class="formAreahalf ">
                      <label for="clienttype" class="form-label">Passport Reminder Trigger
                          Frequency</label>
                          <div class="select_box"><span class="every">Every</span><span
                                class="select"><select name="share[` + arr_id1 + `][` + sh_no + `][passport_rem_fre]" id="renewlfre">
                          <option value="">Please select</option>
                          <option value="Day">Day</option>
                <option value="3 Days">3 Days</option>
                <option value="Week">Week</option>
                <option value="2 Weeks">2 Weeks</option>
                <option value="4 Weeks">4 Weeks</option>
                      </select></span></div>
                  </div>
 
            
                  <div class="formAreahalf ">
            <label for="passapptype" class="form-label"> Type of TIN </label>
            <select name="share[` + arr_id1 + `][` + sh_no + `][tintype]">
               <option value="" selected>Please select</option>
               <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>
                
            </select>
         
        </div>

                  <div class="formAreahalf ">
                      <label class="form-label" for="">Current Tin Number</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][tinno]">

                  </div>
                  <div class="formAreahalf ">
                      <label class="form-label" for="">Current Tin Country</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][tincnt]">

                  </div>

                  <div class="formAreahalf ">
                      <label class="form-label" for="">Phone Number</label>

                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][phno]">

                  </div>
              
                  <div class="formAreahalf ">
                      <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
                      <input type="text" class="form-control" id="gendcname[0][subject]"
                      name="share[` + arr_id1 + `][` + sh_no + `][res_add]">
                  </div>
              
                  <div class="formAreahalf ">
                      <label for="" class="form-label"> E-mail </label>
                      <input type="text" class="form-control" name="share[` + arr_id1 + `][` +
                sh_no + `][email]">
                  </div>

                  <div class="formAreahalf ">
                      <label for="" class="form-label"> Job Title </label>
                      <input type="text" class="form-control" name="share[` + arr_id1 + `][` +
                sh_no + `][job_title]">
                  </div>

                  <div class="formAreahalf ">
                      <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
                      <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="text" class="form-control" name="share[` + arr_id1 + `][` +
                sh_no + `][month_sal]"></span></div>
                  </div>

                  <div class="formAreahalf ">
                      <label for="clienttype" class="form-label"> Relationship With Share Holder
                          1</label>
                      <select name="share[` + arr_id1 + `][` + sh_no + `][rel_share_hol]" id="renewlrem" class="others_Relationship_share_class" data-id="` + sh_no + `" data-id-cmp="` + arr_id1 + `">
                          <option value="">Please select
                          </option>
                          <option value="Self">Self</option>
                                <option value="Parents">Parents</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Children">Children</option>
                                <option value="Relatives">Relatives</option>
                                <option value="Friend">Friend</option>
                                <option value="Others (please specify)">Others (please specify)</option>
                      </select>
                  </div>
                  <div class="formAreahalf others_Relationship_share" style="display:none;">
                   
                    </div>

                  <div class="formAreahalf">
                      <label class="form-label" for="remarks">Remarks</label>
                      <textarea id="addbg[0][genremarks]" name="share[` + arr_id1 + `][` + sh_no + `][remarks]" rows="4" cols="50"></textarea>
                  </div>
                </div>
            </div>
        </div>s
            



            <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
            </div>\
        </div></div>`
            );

        });

        $(document).on('click', '.remove_share', function() {
            // alert('id');
            var id = $(this).attr('data-id');
            // alert(id);
            // console.log(id);
            $(this).parents('.appended_share_div').find('.' + id + '').remove();
        });


        // var fi_no=0;
        // var fi_no = $("#fi_no").val();

        $('body').on('click', '.add_financial', function() {
            var arr_id = $(this).parents('fieldset').find(".comp_no").val();

            var fi_no = $(this).parents('fieldset').find(".fi_no").val();


            fi_no++;
            $(this).parents('fieldset').find(".fi_no").val(fi_no);

            // var arr_id = $("#company_no").val();


            // alert(arr_id);
            // var arr_id=1;
            // var arr_id = $(this).attr('data-id');

            //  alert(arr_id);
            // $(this).closest('#appended_shareholder_div').append(
            $(this).parents('fieldset').find('.appended_financial_div').append(
                `<div id="fo_financial" class="financial fi` + fi_no + `">\
     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
         
         <div class="accordion-item pass_acc_it closed">
            <div class="cross"><span class="remove-input-field"  data-id=".fi` + fi_no + `">x</span></div>
           
       <h2 class="accordion-header" id="panelsStayOpen-headingOne123ok` + fi_no + `">

           <button class="accordion-button" type="button" data-bs-toggle="collapse"
               data-bs-target="#panelsStayOpen-collapseOne123ok` + fi_no + `" aria-expanded="true"
               aria-controls="panelsStayOpen-collapseOne">
               <i class="fa fa-arrows-v" aria-hidden="true"></i>
           </button>

       </h2>
       <div class="formAreahalf">
            <label for="" class="form-label">Financial Institution Name ` + (fi_no + 1) + `</label>
           
        </div>
       <div id="panelsStayOpen-collapseOne123ok` + fi_no + `" class="accordion-collapse collapse show"
           aria-labelledby="panelsStayOpen-headingOne123ok` + fi_no + `">
           <div class="accordion-body ac-b d-flex flex-wrap">
         
         <div class="formAreahalf">
            <label for="" class="form-label">POC Name</label>
            <input type="text" name="fi[` + arr_id + `][` + fi_no + `][poc_name]" id="" class="form-control"
                value="">
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">Financial Institution Name ` + (fi_no + 1) + `</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][fi_name]" id="">
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">POC Email</label>
            <input type="email" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][poc_email]"
                id="">
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">POC Contact Number</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][poc_cno]" id="">
        </div>
        <div class="formAreahalf ">
            <label for="" class="form-label">Account Type</label>
            <select name="fi[` + arr_id + `][` + fi_no + `][acc_type]" id="" class="select_acc_type_class" data-id="` + fi_no + `" data-id-cmp="` + arr_id + `">
                <option value="" selected >Please select
                </option>
                <option value="SGD">SGD</option>
                <option value="USD">USD</option>
                <option value="Multi-currency">Multi-currency</option>
                <option value="Others (please specify)">Others (please specify)</option>
            </select>
        </div>
        <div class="formAreahalf basic_data others others_acc_type others_alignment" style="display:none;"></div>
        <div class="formAreahalf ">
            <label for="" class="form-label">Application Submission</label>
            <select name="fi[` + arr_id + `][` + fi_no + `][app_sub]" id="" class="js-example-responsive">
                <option value="" selected >Please select
                </option>
                <option value="In progress">In progress</option>
                <option value="Done">Done</option>
            </select>
        </div>
        <div class="formAreahalf ">
            <label for="" class="form-label">Account Opening Status</label>
            <select name="fi[` + arr_id + `][` + fi_no + `][acc_opn_sts]" id="" class="js-example-responsive">
                <option value="" selected >Please select
                </option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">Account/Policy Number</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][acc_pol_no]" id="">
        </div>
        <div class="formAreahalf ">
            <label for="" class="form-label">Money Deposit Status</label>
            <select name="fi[` + arr_id + `][` + fi_no + `][money_dep_sts]" id="" class="js-example-responsive">
                <option value="" selected >Please select
                </option>
                <option value="In progress">In progress</option>
                <option value="Done">Done</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="formAreahalf ">
            <label for="" class="form-label">Account Current Status</label>
            <select name="fi[` + arr_id + `][` + fi_no + `][acc_crt_sts]" id="" class="js-example-responsive">
                <option value="" selected >Please select
                </option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">Online Account Username</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][on_acc_usr_nam]" id="">
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">Online Account Password</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][on_acc_usr_pass]" id="">
        </div>

        <div class="formAreahalf">
            <label for="" class="form-label">Maturity Date</label>
            <input type="date" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][mat_date]"
                id="">
        </div>
        <div class="formAreahalf">
            <label for="" class="form-label">Initial Deposit Amount</label>
            <input type="text" class="form-control" name="fi[` + arr_id + `][` + fi_no + `][in_dep_amt]" id="">
        </div>

        <div class="formAreahalf">
            <label class="form-label" for="remarks">Remarks</label>
            <textarea id="" name="fi[` + arr_id + `][` + fi_no + `][remarks]" rows="4" cols="50"></textarea>
        </div>



         <div id="appended_user_financial_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
         </div>\
         </div>
        </div>
    </div>
     </div></div>`
            );
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

        });
        $(document).on('click', '.remove_fi', function() {

            var id = $(this).attr('data-id');

            $(this).parents('.appended_financial_div').find('.' + id + '').remove();
        });


        var c = 0;
            $('.add_company').click(function() {
                // alert('hij');
            
                // var C = c + 1;
                // var C = $('.compnies_holder').find('.accordion-body').length + 1;
                // alert(C);
                var c = $(this).parents('div').find(".cmp_array_id_for_appnd_cmp").val();
                // alert(c);
                   c++;
                $(this).parents('div').find(".cmp_array_id_for_appnd_cmp").val(c);
                $('#appnd_company_div').last().append(
                       ` <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design parent_field2` +
                    c + `">
                        <div class="accordion-item pass_acc_it closed">
            
           
            <h2 class="accordion-header" id="panelsStayOpen-heading` + c + `">
                      
                  
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse` +
                    c +
                    `" aria-expanded="true" aria-controls="panelsStayOpen-collapse` + c + `">
                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                          </button>
                        
                        </h2>
                        <div class="cross"><span class="remove-input" data-id=".parent_field2` + c + `">x</span></div>
                        <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company Name
                                                                    ` +(c+1) +`</label>

                                                              
                                                            </div>
                        <div id="panelsStayOpen-collapse` + c +
                    `" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading` +
                    c + `">
           <div class="accordion-body d-flex flex-wrap">
                                                        <div class=" d-flex flex-wrap">
                                                
                                                            <input type="hidden"
                                                                name="cmp[` + c + `][company_id]"
                                                                />
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company Name
                                                                    ` +(c+1) +`</label>

                                                                <input type="text"
                                                                    name="cmp[` + c + `][fo_company]"
                                                                    id="fo_compnay" class="form-control"
                                                                    ">
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label"></label>

                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">UEN</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[` + c + `][fo_uen]"
                                                                    id="fo_uen" >
                                                            </div>
                                             

                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Address</label>
                                                                <input type="text" class="form-control"
                                                                    name="cmp[` + c + `][fo_company_add]"
                                                                    id="fo_company_add"
                                                                    v>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Incorporation
                                                                    Date</label>

                                                                <input type="date" class="form-control"
                                                                    name="cmp[` + c + `][fo_incorporation_date]"
                                                                    id="fo_incorporation_date"
                                                                    >
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Email</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[` + c + `][fo_company_email]"
                                                                    id="fo_company_email"
                                                                    >
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Company
                                                                    Password</label>

                                                                <input type="text" class="form-control"
                                                                    name="cmp[` + c + `][fo_company_pass]"
                                                                    id="fo_company_pass"
                                                                   >
                                                            </div>
                                                        </div>
                        </div>

                    </div>

                          </div>
                        </div>
                      `)
            });
            $(document).on('click', '.remove-input', function() {
                var id = $(this).attr('data-id');
                $(this).parents(id).remove();
                var c = 1;
                $('.compnies_holder .accordion-item').each(function(index) {
                    $(this).find('.accordion-header label').html('Company Name ' + c);
                    c++;
                });

            });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#file-upload').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#file-input-error').text('');

            $.ajax({
                type: 'POST',
                url: "{{ route('operations.updfile') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {

                        swal({
                            title: `File Uploaded Successfully`,
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
                            window.location = "{{ route('operation.edit', $data->id) }}";

                        })
                    }
                },
                error: function(response) {

                }
            });
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
                                    "{{ route('operation.edit', $data->id) }}";
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



        if ($("#operation_form_edit").length > 0) {
            $("#operation_form_edit").validate({
                rules: {

                },
                messages: {


                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('operation.update', $data->id) }}",
                        type: "POST",
                        data: $('#operation_form_edit').serialize(),
                        success: function(response) {
                            console.log(response);
                            const el = document.createElement('div')
                            el.innerHTML =
                                "You can view Application List <a class='view-application' href='{{ route('operation.index') }}'>here</a>"
                            swal({
                                title: `Application Updated`,
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
                                window.location =
                                    "{{ route('operation.show', $data->id) }}";
                                // $('#multistep_form')[0].reset();
                            })
                        }
                    });
                }
            })
        }

        $("body").on('keyup', '.equity_shareholders', function (evt) {
            $(this).attr('value', $(this).val());
            let percentage = 0;
            var compId = $(this).parents('.full_div_share');
            var cal_eqty_percentage = compId.find(".equity_shareholders");
            for (per = 0; per < cal_eqty_percentage.length; per++) {
                // console.log(cal_eqty_percentage[per].value);
                // console.log($(cal_eqty_percentage[per]).attr('value'));
                percentage += parseFloat($(cal_eqty_percentage[per]).attr('value'));
            }
            console.log(cal_eqty_percentage.length);
            if (percentage == 100) {
                // console.log('here');
                $(this).parents(".full_div_share ").find('#next3').removeClass("disable");
                $(this).parents(".full_div_share ").find('#next3').prop("disabled", false);
            }
            else {
                // console.log('there');
                $(this).parents(".full_div_share ").find('#next3').addClass("disable");
                $(this).parents(".full_div_share ").find('#next3').attr('disabled', 'disabled');

            }
            if (percentage >= 100) {
                // console.log('ghty');
                $(".full_div_share ").find(".add_shareholder").addClass("disable");
                $(".full_div_share ").find(".add_shareholder").attr('disabled', 'disabled');
                $(".full_div_share ").find("#add_nfo_shareholder").addClass("disable");
                $(".full_div_share ").find("#add_nfo_shareholder").attr('disabled', 'disabled');
                //    $(".saveBtn").addClass("disable");
            }
            else {
                $(".full_div_share ").find(".add_shareholder").removeClass("disable");
                $(".full_div_share ").find(".add_shareholder").prop("disabled", false);
                $(".full_div_share ").find("#add_nfo_shareholder").removeClass("disable");
                $(".full_div_share ").find("#add_nfo_shareholder").prop('disabled',false);
            }


        });
    </script>
@endpush
