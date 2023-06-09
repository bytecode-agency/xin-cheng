@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')


    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ $sale->id }} - {{ $sale->client_name }}</h2>
        </div>
    </div>

    <!-- Filter Data Pagination -->
    <form class="userForm d-flex justify-content-start flex-wrap sale_space" name="edit_form" method="post"
        id="multistep_form">
        @csrf
        <input type="hidden" name="created_by" id="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="uid" id="uid" value="{{ Auth::user()->id }}">
        <input type="hidden" name="sale_id" id="sale_id" value="{{ $sale->id }}">
        <input type="hidden" name="page" id="page" value="sales.edit">

        <div class="filterPagination d-flex justify-content-between align-items-center w-100">
            <div class="paginationLeft">
                <ul>
                    <li><a href="{{ route('sales.show', ['id' => $sale->id]) }}">Sales</a></li>
                    <li>{{ Breadcrumbs::render() }} </li>
                </ul>

            </div>

        </div>
        <div class="filterBtn viewSave ms-auto d-flex align-items-center justify-content-end ">
            <button type="submit" class="btn saveBtn"><span>Save</span></button>
            <a href="{{ route('sales.show', $sale->id) }}" class="btn saveBtn cancelBtn">Cancel</a>
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
        <!-- Form card data -->


        <div class="dataAreaMain sales-edit sales_check">
            <div class="card formContentData  basic border-0 p-4">
                <h3>Basic Information</h3>

                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">

                <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields mb-0">

                    <div class="formAreahalf">
                        <label for="c" class="form-label">Client(s)</label>
                        <br>{{ $sale->client_name }}
                    </div>

                    <div class="formAreahalf ">
                        <label for="cby" class="form-label">Created By</label>
                        <br>{{ $sale->created_by }}
                    </div>

                    <div class="formAreahalf  client_status mb-1 ">
                        <label for="cby" class="form-label">Client Status</label>
                        <select class="client-status-selector" name="csts" >
                            <option value="Active" class="btn text-start"
                                {{ $sale->client_sts == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Dormant" class="btn text-start"
                                {{ $sale->client_sts == 'Dormant' ? 'selected' : '' }}>Dormant</option>
                        </select>
                    </div>
                </fieldset>

            </div>

            <br>

            <div class="card formContentData application border-0 p-4">
                <h3>Application Information</h3>
                <div class="sales"><br><button type="button" id="abc" class="btn saveBtn">Sales Application</button>
                </div>




                <div class="accordion-item edit_application">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">


                        <div class="accordion-body">
                            <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields">

                                <div class="formAreahalf">
                                    <label for="bustype" class="form-label">Business Type</label>
                                    <select class="" name="business" id="business">
                                        <!-- <option value="" selected disabled>Please select business type</option> -->
                                        @if ($sale->bus_type == 'B2B')
                                            <option value="B2B" {{ $sale->bus_type == 'B2B' ? 'selected' : '' }}>B2B
                                            </option>
                                        @endif
                                        @if ($sale->bus_type == 'B2C')
                                            <option value="B2C" {{ $sale->bus_type == 'B2C' ? 'selected' : '' }}>B2C
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="formAreahalf ">
                                    <label for="clienttype" class="form-label">Client Type</label>
                                    <select class="" name="client" id="client">
                                        @if ($sale->bus_type == 'B2B')
                                            <option value="Personal"
                                                {{ $sale->client_type == 'Personal' ? 'selected' : '' }}>
                                                Personal</option>
                                            <option value="Corporate"
                                                {{ $sale->client_type == 'Corporate' ? 'selected' : '' }}>
                                                Corporate</option>
                                        @else
                                            <option value="Personal"
                                                {{ $sale->client_type == 'Personal' ? 'selected' : '' }}>
                                                Personal</option>
                                        @endif

                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Client's Full Name</label>
                                    <input type="text" class="form-control" id="cname" name="cname"
                                        value="{{ $sale->client_name }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Country of Client</label>
                                    <input type="text" class="form-control" id="ccountry" name="ccountry"
                                        value="{{ $sale->client_country }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">City of Client</label>
                                    <input type="text" class="form-control" id="ccity" name="ccity"
                                        value="{{ $sale->client_city }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Phone no. of POC</label>
                                    <input type="text" class="form-control" id="pocph" name="pocph"
                                        value="{{ $sale->poc_ph }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Name of POC</label>
                                    <input type="text" class="form-control" id="pocname" name="pocname"
                                        value="{{ $sale->poc_name }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Email of POC</label>
                                    <input type="text" class="form-control" id="pocemail" name="pocemail"
                                        value="{{ $sale->poc_email }}">
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label"> Wechat id of POC</label>
                                    <input type="text" class="form-control" id="pocwechat" name="pocwechat"
                                        value="{{ $sale->poc_wechat }}">
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label"> Source of Client</label>
                                    <select name="source_of_client" id="source_of_client" class="source_of_client ">
                                        <option value=""  disabled>Please select Source of Client </option>
                                        <option value="Referral"         {{isset($sale->source_of_client) && $sale->source_of_client == 'Referral' ? 'selected' : ''  }}>Referral</option>
                                        <option value="Online marketing" {{isset($sale->source_of_client) && $sale->source_of_client == 'Online marketing' ? 'selected' : ''  }}>Online marketing</option>
                                        <option value="Seminar"          {{isset($sale->source_of_client) && $sale->source_of_client == 'Seminar' ? 'selected' : ''  }}>Seminar</option>
                                        <option value="Warm market"      {{isset($sale->source_of_client) && $sale->source_of_client == 'Warm market' ? 'selected' : ''  }}>Warm market</option>
                                        <option value="Others"           {{isset($sale->source_of_client) && $sale->source_of_client == 'Others' ? 'selected' : ''  }}>Others</option>
                                    </select>
                                </div>
                                @if (isset($sale->source_of_client) && ($sale->source_of_client == 'Others' || $sale->source_of_client == 'Online marketing'))
                                    <div class="formAreahalf basic_data please_specify">
                                        <label for="" class="form-label">Others, please specify</label>
                                        <input type="text" class="form-control" id="source_of_client_specify" name="source_of_client_specify"
                                        value="{{ isset($sale->source_of_client_specify) ? $sale->source_of_client_specify : '' }}">
                                    </div>
                                @endif
                                @if ($sale->bus_type == 'B2B')
                                    <div class="formAreahalf ">
                                        <label for="clienttype" class="form-label">Sign of B2B Agreement?</label>
                                        <select class="" name="sign" id="sign">
                                            {{-- <option value="No">No</option>  --}}
                                            <!-- <option value=""></option> -->
                                            @if ($sale->bus_type == 'B2B')
                                                <option value="Yes" {{ $sale->b2b_sign == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No" {{ $sale->b2b_sign == 'No' ? 'selected' : '' }}>No
                                                </option>
                                            @else
                                                <option value="No">No</option>
                                            @endif
                                        </select>
                                    </div>



                                    <div class="formAreahalf" id="b2bsigndatediv">
                                        <label for="" class="form-label">B2B Agreement Sign Date</label>
                                        @if ($sale->b2b_sign == 'Yes')
                                            <input type="date" class="form-control" id="b2bsigndate"
                                                name="b2bsigndate" value="{{ $sale->b2b_agr_sign_date }}">
                                        @else
                                            <input type="" class="form-control" id="b2bsigndate"
                                                name="b2bsigndate" placeholder="-">
                                        @endif {{-- <input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate"
                                        value="{{ $sale->b2b_agr_sign_date }}"> --}}
                                    </div>

                                    <div class="formAreahalf" id="b2bexdatediv">
                                        <label for="" class="form-label">B2B Agreement Expiry Date</label>
                                        @if ($sale->b2b_sign == 'Yes')
                                            <input type="date" class="form-control" id="b2bexdate" name="b2bexdate"
                                                value="{{ $sale->b2b_agr_exp_date }}">
                                        @else
                                            <input type="" class="form-control" id="b2bexdate" name="b2bexdate"
                                                placeholder="-">
                                        @endif {{-- <input type="date" class="form-control" id="b2bexdate" name="b2bexdate"
                                        value="{{ $sale->b2b_agr_exp_date }}"> --}}
                                    </div>

                                    <div class="formAreahalf" id="renewlremdiv">
                                        <label for="clienttype" class="form-label"> Aggrement Renewal Reminder</label>
                                        @if ($sale->b2b_sign == 'Yes')
                                            <select name="renewlrem" id="renewlrem">
                                                <!-- <option value="">Please select aggrement renewal reminder</option> -->
                                                <option value="90 days before expiry"
                                                    {{ $sale->agr_ren_rem == '90 days before expiry' ? 'selected' : '' }}>
                                                    90
                                                    days
                                                    before expiry
                                                </option>
                                                <option value="120 days before expiry"
                                                    {{ $sale->agr_ren_rem == '120 days before expiry' ? 'selected' : '' }}>
                                                    120
                                                    days
                                                    before expiry</option>
                                                <option value="180 days before expiry"
                                                    {{ $sale->agr_ren_rem == '180 days before expiry' ? 'selected' : '' }}>
                                                    180
                                                    days
                                                    before expiry</option>
                                            </select>
                                        @else
                                            <input type="" class="form-control" id="renewlrem" name="renewlrem"
                                                placeholder="-">
                                        @endif
                                    </div>

                                    <div class="formAreahalf" id="renewlfrediv">
                                        <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                                        @if ($sale->b2b_sign == 'Yes')
                                            <div class="select_box"><span class="every">Every</span><span
                                                    class="select"><select name="renewlfre" id="renewlfre">
                                                        <!-- <option value="">Please select aggrement renewal frequency</option> -->
                                                        <option value="Day"
                                                            {{ $sale->agr_ren_fre == 'Day' ? 'selected' : '' }}>Day
                                                        </option>
                                                        <option value="3 Days"
                                                            {{ $sale->agr_ren_fre == '3 Days' ? 'selected' : '' }}>3 Days
                                                        </option>
                                                        <option value="Week"
                                                            {{ $sale->agr_ren_fre == 'Week' ? 'selected' : '' }}>
                                                            Week</option>
                                                        <option value="2 Weeks"
                                                            {{ $sale->agr_ren_fre == '2 Weeks' ? 'selected' : '' }}>2 Weeks
                                                        </option>
                                                        <option value="4 Weeks"
                                                            {{ $sale->agr_ren_fre == '4 Weeks' ? 'selected' : '' }}>4 Weeks
                                                        </option>

                                                    </select>

                                                </span>
                                            </div>
                                        @else
                                            <input type="" class="form-control" id="renewlrem" name="renewlrem"
                                                placeholder="-">
                                        @endif
                                    </div>
                                @endif
                            </fieldset>
                            <br><br>

                            <?php $tpb = unserialize($sale->type_pot_bus);

                            $tbg = unserialize($sale->type_bus_gen);

                            ?>

                            <div class="business_border_section">

                                <div class="accordion-body add_fieldset_fg  add_potensian">
                                    <div class="card formContentData Potential_business border-0 p-4">


                                        @if (isset($tpb))
                                            @php $i = -1; @endphp
                                            @foreach ($tpb as $s)
                                                @php $i++ @endphp


                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-collapseTwo{{ $i }}"
                                                            aria-expanded="true"
                                                            aria-controls="panelsStayOpen-collapseTwo">
                                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                        </button>

                                                    </h2>
                                                    <label for="clienttype" class="form-label"> Types of
                                                        Potential
                                                        Business {{ $i + 1 }}</label>
                                                    <div id="panelsStayOpen-collapseTwo{{ $i }}"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="panelsStayOpen-headingTwo">
                                                        <div class="accordion-body d-flex flex-wrap">

                                                            <fieldset id="dynamicAddRemove"
                                                                class=" w-100 d-flex justify-content-start flex-wrap form-fields type-of-potential-bussiness pt-0">

                                                                <div class="formAreahalf ">


                                                                    <select name="addpb[{{ $i }}][drp]"
                                                                        id="addpb[0][drp]" class="select_class"
                                                                        data-id="0">

                                                                        {{-- <option value="">Please select types of potential business</option> --}}
                                                                        {{-- @if (isset($s['drp']))

                                                                        @if ($s['drp'] != 'Wealth Management' && $s['drp'] != 'Immigration Programme' && $s['drp'] != 'Family Office' && $s['drp'] != 'Passport' && $s['drp'] != 'Real Property' && $s['drp'] != 'Pure Identity Management' && $s['drp'] != 'Account Services' && $s['drp'] != 'Education' && $s['drp'] != 'Bank Account Opening')
                                                                        <option value="Wealth Management">Wealth
                                                                            Management</option>
                                                                        <option value="Immigration Programme">
                                                                            Immigration Programme</option>
                                                                        <option value="Family Office">Family Office
                                                                        </option>
                                                                        <option value="Passport">Passport</option>
                                                                        <option value="Real Property">Real Property
                                                                        </option>
                                                                        <option value="Pure Identity Management">Pure
                                                                            Identity Management</option>
                                                                        <option value="Account Services">Account
                                                                            Services</option>
                                                                        <option value="Education">Education</option>
                                                                        <option value="Bank Account Opening">Bank
                                                                            Account Oppening</option>
                                                                            <option value="Others" selected>
                                                                            Others</option>
                                                                            @else
                                                                         <option value="Wealth Management"
                                                                                {{ $s['drp'] == 'Wealth Management' ? 'selected' : '' }}>
                                                                                Wealth Management</option>
                                                                            <option value="Immigration Programme"
                                                                                {{ $s['drp'] == 'Immigration Programme' ? 'selected' : '' }}>
                                                                                Immigration Programme</option>
                                                                            <option value="Family Office"
                                                                                {{ $sale->type_pot_bus == 'Family Office' ? 'selected' : '' }}>
                                                                                Family Office</option>
                                                                            <option value="Passport"
                                                                                {{ $s['drp'] == 'Passport' ? 'selected' : '' }}>
                                                                                Passport</option>
                                                                            <option value="Real Property"
                                                                                {{ $s['drp'] == 'Real Property' ? 'selected' : '' }}>
                                                                                Real Property</option>
                                                                            <option value="Pure Identity Management"
                                                                                {{ $s['drp'] == 'Pure Identity Management' ? 'selected' : '' }}>
                                                                                Pure Identity Management</option>
                                                                            <option value="Account Services"
                                                                                {{ $s['drp'] == 'Account Services' ? 'selected' : '' }}>
                                                                                Account Services</option>
                                                                            <option value="Education"
                                                                                {{ $s['drp'] == 'Education' ? 'selected' : '' }}>
                                                                                Education</option>
                                                                            <option value="Bank Account Opening"
                                                                                {{ $s['drp'] == 'Bank Account Opening' ? 'selected' : '' }}>
                                                                                Bank Account Opening</option>
                                                                            <option value="Others"
                                                                                {{ $s['drp'] == 'Others' ? 'selected' : '' }}>
                                                                                Others</option>
                                                                                @endif
                                                                        @else
                                                                            <option value="" selected disabled>Please
                                                                                select types of potential business
                                                                            </option>
                                                                            <option value="Wealth Management">Wealth
                                                                                Management</option>
                                                                            <option value="Immigration Programme">
                                                                                Immigration Programme</option>
                                                                            <option value="Family Office">Family Office
                                                                            </option>
                                                                            <option value="Passport">Passport</option>
                                                                            <option value="Real Property">Real Property
                                                                            </option>
                                                                            <option value="Pure Identity Management">Pure
                                                                                Identity Management</option>
                                                                            <option value="Account Services">Account
                                                                                Services</option>
                                                                            <option value="Education">Education</option>
                                                                            <option value="Bank Account Opening">Bank
                                                                                Account Oppening</option>
                                                                            <option value="Others">Others</option>
                                                                        @endif --}}

                                                                        {{-- @if (!isset($s['drp']))
                                                                            <option value="" selected disabled>Please
                                                                                select types of potential business
                                                                            </option>
                                                                        @endif --}}
                                                                        <option value="" selected disabled>Please
                                                                            select types of potential business
                                                                        </option>
                                                                        <option value="Wealth Management"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Wealth Management' ? 'selected' : '' }}>
                                                                            Wealth Management</option>
                                                                        <option value="Immigration Programme"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Immigration Programme' ? 'selected' : '' }}>
                                                                            Immigration Programme</option>
                                                                        <option value="Family Office"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Family Office' ? 'selected' : '' }}>
                                                                            Family Office</option>
                                                                        <option value="Passport"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Passport' ? 'selected' : '' }}>
                                                                            Passport</option>
                                                                        <option value="Real Property"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Real Property' ? 'selected' : '' }}>
                                                                            Real Property</option>
                                                                        <option value="Pure Identity Management"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Pure Identity Management' ? 'selected' : '' }}>
                                                                            Pure Identity Management</option>
                                                                        <option value="Account Services"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Account Services' ? 'selected' : '' }}>
                                                                            Account Services</option>
                                                                        <option value="Education"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Education' ? 'selected' : '' }}>
                                                                            Education</option>
                                                                        <option value="Bank Account Opening"
                                                                            {{ isset($s['drp']) && $s['drp'] == 'Bank Account Opening' ? 'selected' : '' }}>
                                                                            Bank Account Opening</option>
                                                                        <option value="Others"
                                                                            {{ isset($s['drp']) &&
                                                                            ($s['drp'] != 'Wealth Management' &&
                                                                                $s['drp'] != 'Immigration Programme' &&
                                                                                $s['drp'] != 'Family Office' &&
                                                                                $s['drp'] != 'Passport' &&
                                                                                $s['drp'] != 'Real Property' &&
                                                                                $s['drp'] != 'Pure Identity Management' &&
                                                                                $s['drp'] != 'Account Services' &&
                                                                                $s['drp'] != 'Education' &&
                                                                                $s['drp'] != 'Bank Account Opening')
                                                                                ? 'selected'
                                                                                : '' }}>
                                                                            Others</option>
                                                                    </select>
                                                                    <!-- <input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter list" class="form-control" /> -->
                                                                    @error('addMoreInputFields.*.subject')
                                                                        <div class="alert alert-danger mt-1 mb-1">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror

                                                                </div>

                                                                {{-- @if (isset($s['drp']))
                                                                    @if ($s['drp'] != 'Wealth Management' && $s['drp'] != 'Immigration Programme' && $s['drp'] != 'Family Office' && $s['drp'] != 'Passport' && $s['drp'] != 'Real Property' && $s['drp'] != 'Pure Identity Management' && $s['drp'] != 'Account Services' && $s['drp'] != 'Education' && $s['drp'] != 'Bank Account Opening')
                                                                        <div class="formAreahalf ">
                                                                            <label class="form-label"
                                                                                for="">Specific Business</label>
                                                                            <input type="text" class="form-control sds"
                                                                                id="drp_spc_g"
                                                                                name="topb_drp_spc[{{ $i }}]"
                                                                                value="{{ $s['drp'] }}">
                                                                        </div>
                                                                    @else
                                                                        <div class="formAreahalf others">
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="formAreahalf others">
                                                                    </div>
                                                                @endif --}}
                                                                @if (isset($s['drp']) &&
                                                                        ($s['drp'] != 'Wealth Management' &&
                                                                            $s['drp'] != 'Immigration Programme' &&
                                                                            $s['drp'] != 'Family Office' &&
                                                                            $s['drp'] != 'Passport' &&
                                                                            $s['drp'] != 'Real Property' &&
                                                                            $s['drp'] != 'Pure Identity Management' &&
                                                                            $s['drp'] != 'Account Services' &&
                                                                            $s['drp'] != 'Education' &&
                                                                            $s['drp'] != 'Bank Account Opening'))
                                                                    <div class="formAreahalf others">
                                                                        <label class="form-label" for="">Please
                                                                            Specify</label>
                                                                        <input type="text" class="form-control sds"
                                                                            id="drp_spc_g"
                                                                            name="topb_drp_spc[{{ $i }}]"
                                                                            value="{{ $s['drp'] }}">
                                                                    </div>
                                                                @else
                                                                    <div class="formAreahalf others">

                                                                    </div>
                                                                @endif

                                                                <div class="formAreahalf b2c_hide">
                                                                    <label class="form-label" for="dcname">Name of
                                                                        direct
                                                                        client</label>

                                                                    <input type="text" class="form-control"
                                                                        id="dcname[0][subject]"
                                                                        name="addpb[{{ $i }}][dcname]"
                                                                        value="{{ $s['dcname'] }}">


                                                                </div>
                                                                <div class="formAreahalf b2c_hide">
                                                                    <label class="form-label" for="passcountry">Passport
                                                                        Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="passcountry[0][subject]"
                                                                        name="addpb[{{ $i }}][passcountry]"
                                                                        value="{{ $s['passcountry'] }}">

                                                                </div>

                                                                <div class="formAreahalf b2c_hide">
                                                                    <label class="form-label" for="wechatidc">Wechat Id of
                                                                        client</label>

                                                                    <input type="text" class="form-control"
                                                                        id="wechatidc[0][subject]"
                                                                        name="addpb[{{ $i }}][wechatidc]"
                                                                        value="{{ $s['wechatidc'] }}">
                                                                </div>

                                                                <div class="formAreahalf b2c_hide">
                                                                    <label class="form-label" for="cmobileno">Mobile no.
                                                                        of
                                                                        Client</label>
                                                                    <input type="text" class="form-control"
                                                                        id="cmobileno[0][subject]"
                                                                        name="addpb[{{ $i }}][cmobileno]"
                                                                        value="{{ $s['cmobileno'] }}">
                                                                </div>

                                                                <div class="formAreahalf b2c_hide">
                                                                    <label class="form-label" for="cemail">Email address
                                                                        of
                                                                        client</label>
                                                                    <input type="email" class="form-control"
                                                                        id="cemail[0][subject]"
                                                                        name="addpb[{{ $i }}][cemail]"
                                                                        value="{{ $s['cemail'] }}">
                                                                </div>

                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="busdes">Business
                                                                        Description</label>
                                                                    <input type="text" class="form-control"
                                                                        id="busdes[0][subject]"
                                                                        name="addpb[{{ $i }}][busdes]"
                                                                        value="{{ $s['busdes'] }}">

                                                                </div>

                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="buscurr">Currency of
                                                                        Potential Business
                                                                    </label>
                                                                    {{-- <input type="text" class="form-control"
                                                                        id="buscurr[0][subject]"
                                                                        name="addpb[{{ $i }}][buscurr]"
                                                                        value="{{ $s['buscurr'] }}"> --}}

                                                                    <select name="addpb[{{ $i }}][buscurr]"
                                                                        id="addpb[0][buscurr]">
                                                                        @if (isset($s['buscurr']))
                                                                            <option value="SGD"
                                                                                {{ $s['buscurr'] == 'SGD' ? 'selected' : '' }}>
                                                                                SGD</option>
                                                                            <option value="USD"
                                                                                {{ $s['buscurr'] == 'USD' ? 'selected' : '' }}>
                                                                                USD</option>
                                                                        @else
                                                                            <option value="" selected disabled>Please
                                                                                select currency</option>
                                                                            <option value="SGD">SGD</option>
                                                                            <option value="USD">USD</option>
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="busamt">Amount of
                                                                        Potential Business
                                                                    </label>
                                                                    <div class="dollersec"><span
                                                                            class="doller">$</span><span
                                                                            class="input"><input type="number"
                                                                                class="form-control"
                                                                                id="busamt[0][subject]"
                                                                                name="addpb[{{ $i }}][busamt]"
                                                                                value="{{ $s['busamt'] }}"></span></div>

                                                                </div>

                                                                <div class="formAreahalf remark">
                                                                    <label class="form-label"
                                                                        for="remarks">Remarks</label>

                                                                    <textarea id="remarks[0][subject]" name="addpb[{{ $i }}][remarks]" rows="4" cols="50">{{ $s['remarks'] }}</textarea>

                                                                </div>

                                                            </fieldset>




                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                    </div>
                                    <input type="hidden" id="myInputHidden" value="{{ $i }}">
                                    @endif

                                    <button type="button" name="dynamic-ar" id="dynamic-ar"
                                        class="dynamic-ar btn saveBtn">Add
                                        Potential Business</button>

                                </div>


                                <div class="accordion-body add_fieldset_fg2  custom_sec ">
                                    <div class="card formContentData border-0 p-4 pt-0">
                                        @if (isset($tbg))
                                            @php $g = -1; @endphp
                                            @foreach ($tbg as $r)
                                                @php $g++ @endphp





                                                <div class="accordion-item mt-0 pt-0">
                                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-collapseThree{{ $g }}"
                                                            aria-expanded="true"
                                                            aria-controls="panelsStayOpen-collapseThree">
                                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                        </button>
                                                    </h2>
                                                    <label for="clienttype" class="form-label">Types of
                                                        Business
                                                        Generated {{ $g + 1 }} </label>
                                                    <div id="panelsStayOpen-collapseThree{{ $g }}"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="panelsStayOpen-headingThree">
                                                        <div class="accordion-body">

                                                            <fieldset id="dynamicAddRemove2"
                                                                class=" w-100 d-flex justify-content-start flex-wrap form-fields  business_generate">
                                                                <!-- <div class="col-sm-10" id="dynamicAddRemove2"> -->
                                                                <div class="formAreahalf ">

                                                                    <select name="addbg[{{ $g }}][g_drp]"
                                                                        id="addMoreInputFields2[0][select]"
                                                                        class="select_class_g" data-id="0">

                                                                        @if (!isset($r['g_drp']))
                                                                            <option value="" selected disabled>Please
                                                                                select types of potential business
                                                                            </option>
                                                                        @endif
                                                                        <option value="Wealth Management"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Wealth Management' ? 'selected' : '' }}>
                                                                            Wealth Management</option>
                                                                        <option value="Immigration Programme"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Immigration Programme' ? 'selected' : '' }}>
                                                                            Immigration Programme</option>
                                                                        <option value="Family Office"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Family Office' ? 'selected' : '' }}>
                                                                            Family Office</option>
                                                                        <option value="Passport"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Passport' ? 'selected' : '' }}>
                                                                            Passport</option>
                                                                        <option value="Real Property"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Real Property' ? 'selected' : '' }}>
                                                                            Real Property</option>
                                                                        <option value="Pure Identity Management"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Pure Identity Management' ? 'selected' : '' }}>
                                                                            Pure Identity Management</option>
                                                                        <option value="Account Services"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Account Services' ? 'selected' : '' }}>
                                                                            Account Services</option>
                                                                        <option value="Education"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Education' ? 'selected' : '' }}>
                                                                            Education</option>
                                                                        <option value="Bank Account Opening"
                                                                            {{ isset($r['g_drp']) && $r['g_drp'] == 'Bank Account Opening' ? 'selected' : '' }}>
                                                                            Bank Account Opening</option>
                                                                        <option value="Others"
                                                                            {{ isset($r['g_drp']) &&
                                                                            ($r['g_drp'] != 'Wealth Management' &&
                                                                                $r['g_drp'] != 'Immigration Programme' &&
                                                                                $r['g_drp'] != 'Family Office' &&
                                                                                $r['g_drp'] != 'Passport' &&
                                                                                $r['g_drp'] != 'Real Property' &&
                                                                                $r['g_drp'] != 'Pure Identity Management' &&
                                                                                $r['g_drp'] != 'Account Services' &&
                                                                                $r['g_drp'] != 'Education' &&
                                                                                $r['g_drp'] != 'Bank Account Opening')
                                                                                ? 'selected'
                                                                                : '' }}>
                                                                            Others</option>
                                                                    </select>



                                                                    <!-- <input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter list" class="form-control" /> -->
                                                                    @error('addMoreInputFields.*.subject')
                                                                        <div class="alert alert-danger mt-1 mb-1">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror

                                                                </div>

                                                                {{-- @if (isset($r['g_drp']))
                                                                    @if ($r['g_drp'] != 'Wealth Management' && $r['g_drp'] != 'Immigration Programme' && $r['g_drp'] != 'Family Office' && $r['g_drp'] != 'Passport' && $r['g_drp'] != 'Real Property' && $r['g_drp'] != 'Pure Identity Management' && $r['g_drp'] != 'Account Services' && $r['g_drp'] != 'Education' && $r['g_drp'] != 'Bank Account Opening')
                                                                        <div class="formAreahalf ">
                                                                            <label class="form-label"
                                                                                for="">Specific Business</label>
                                                                            <input type="text" class="form-control sds"
                                                                                id="drp_spc_g"
                                                                                name="togb_drp_spc[{{ $g }}]"
                                                                                value="{{ $r['g_drp'] }}">
                                                                        </div>
                                                                    @else
                                                                        {{-- else --}}
                                                                {{-- <div class="formAreahalf others2">
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="formAreahalf others2">
                                                                    </div>
                                                                @endif  --}}

                                                                @if (isset($r['g_drp']) &&
                                                                        ($r['g_drp'] != 'Wealth Management' &&
                                                                            $r['g_drp'] != 'Immigration Programme' &&
                                                                            $r['g_drp'] != 'Family Office' &&
                                                                            $r['g_drp'] != 'Passport' &&
                                                                            $r['g_drp'] != 'Real Property' &&
                                                                            $r['g_drp'] != 'Pure Identity Management' &&
                                                                            $r['g_drp'] != 'Account Services' &&
                                                                            $r['g_drp'] != 'Education' &&
                                                                            $r['g_drp'] != 'Bank Account Opening'))
                                                                    <div class="formAreahalf others2">
                                                                        <label class="form-label" for="">Please
                                                                            Specify</label>
                                                                        <input type="text" class="form-control sds"
                                                                            id="drp_spc_g"
                                                                            name="togb_drp_spc[{{ $g }}]"
                                                                            value="{{ $r['g_drp'] }}">
                                                                    </div>
                                                                @else
                                                                    <div class="formAreahalf others2">

                                                                    </div>
                                                                @endif




                                                                {{-- <!-- <option value="" selected disabled>Please select types of business generated</option> -->
                                                                        @if (isset($r['g_drp']))

                                                                        <div class="formAreahalf ">
                                                                          <br>  Others

                                                                        </div>
                                                                            <option value="Wealth Management"
                                                                                {{ $r['g_drp'] == 'Wealth Management' ? 'selected' : '' }}>
                                                                                Wealth Management</option>
                                                                            <option value="Immigration Programme"
                                                                                {{ $r['g_drp'] == 'Immigration Programme' ? 'selected' : '' }}>
                                                                                Immigration Programme</option>
                                                                            <option value="Family Office"
                                                                                {{ $r['g_drp'] == 'Family Office' ? 'selected' : '' }}>
                                                                                Family Office</option>
                                                                            <option value="Passport"
                                                                                {{ $r['g_drp'] == 'Passport' ? 'selected' : '' }}>
                                                                                Passport</option>
                                                                            <option value="Real Property"
                                                                                {{ $r['g_drp'] == 'Real Property' ? 'selected' : '' }}>
                                                                                Real Property</option>
                                                                            <option value="Pure Identity Management"
                                                                                {{ $r['g_drp'] == 'Pure Identity Management' ? 'selected' : '' }}>
                                                                                Pure Identity Management</option>
                                                                            <option value="Account Services"
                                                                                {{ $r['g_drp'] == 'Account Services' ? 'selected' : '' }}>
                                                                                Account Services</option>
                                                                            <option value="Education"
                                                                                {{ $r['g_drp'] == 'Education' ? 'selected' : '' }}>
                                                                                Education</option>
                                                                            <option value="Bank Account Opening"
                                                                                {{ $r['g_drp'] == 'Bank Account Opening' ? 'selected' : '' }}>
                                                                                Bank Account Opening</option>
                                                                            <option value="Others"
                                                                                {{ $r['g_drp'] == 'Others' ? 'selected' : '' }}>
                                                                                Others</option>
                                                                        @else
                                                                            <option value="" selected disabled>Please
                                                                                select type of generated business
                                                                            </option>
                                                                            <option value="Wealth Management">Wealth
                                                                                Management</option>
                                                                            <option value="Immigration Programme">
                                                                                Immigration Programme</option>
                                                                            <option value="Family Office">Family Office
                                                                            </option>
                                                                            <option value="Passport">Passport</option>
                                                                            <option value="Real Property">Real Property
                                                                            </option>
                                                                            <option value="Pure Identity Management">Pure
                                                                                Identity Management</option>
                                                                            <option value="Account Services">Account
                                                                                Services</option>
                                                                            <option value="Education">Education</option>
                                                                            <option value="Bank Account Opening">Bank
                                                                                Account Oppening</option>
                                                                            <option value="Others">Others</option>
                                                                        @endif
                                                                    </select>
                                                                    @error('addMoreInputFields.*.subject')
                                                                        <div class="alert alert-danger mt-1 mb-1">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="formAreahalf ">
                                                                </div> --}}

                                                                <div class="formAreahalf ">
                                                                    <label class="form-label" for="">Name of
                                                                        direct
                                                                        client</label>
                                                                    <input type="text" class="form-control"
                                                                        id="gendcname[{{ $g }}][subject]"
                                                                        name="addbg[{{ $g }}][g_dcname]"
                                                                        value="{{ $r['g_dcname'] }}">


                                                                </div>

                                                                <div class="formAreahalf ">
                                                                    <label class="form-label" for="passcountry">Passport
                                                                        Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="genpasscountry[0][subject]"
                                                                        name="addbg[{{ $g }}][g_passcountry]"
                                                                        value="{{ $r['g_passcountry'] }}">

                                                                </div>

                                                                <div class="formAreahalf ">
                                                                    <label class="form-label" for="wechatidc">Wechat Id of
                                                                        client</label>

                                                                    <input type="text" class="form-control"
                                                                        id="genwechatidc[0][subject]"
                                                                        name="addbg[{{ $g }}][g_wechatid]"
                                                                        value="{{ $r['g_wechatid'] }}">
                                                                </div>

                                                                <div class="formAreahalf ">
                                                                    <label class="form-label" for="cmobileno">Mobile no.
                                                                        of
                                                                        client</label>
                                                                    <input type="text" class="form-control"
                                                                        id="gencmobileno[0][subject]"
                                                                        name="addbg[{{ $g }}][g_cmobno]"
                                                                        value="{{ $r['g_cmobno'] }}">
                                                                </div>


                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="cemail">Email address
                                                                        of
                                                                        client</label>
                                                                    <input type="email" class="form-control"
                                                                        id="gencemail[0][subject]"
                                                                        name="addbg[{{ $g }}][g_cemail]"
                                                                        value="{{ $r['g_cemail'] }}">
                                                                </div>

                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="busdes">Business
                                                                        Description</label>
                                                                    <input type="text" class="form-control"
                                                                        id="genbusdes[0][subject]"
                                                                        name="addbg[{{ $g }}][g_busdes]"
                                                                        value="{{ $r['g_busdes'] }}">
                                                                </div>

                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="buscurr">Currency of
                                                                        Business
                                                                        Generated</label>
                                                                    {{-- <input type="text" class="form-control"
                                                                        id="genbuscurr[0][subject]"
                                                                        name="addbg[{{ $g }}][g_buscurr]"
                                                                        value="{{ $r['g_buscurr'] }}"> --}}

                                                                    <select name="addbg[{{ $g }}][g_buscurr]"
                                                                        id="addbg[0][g_buscurr]">
                                                                        @if (isset($r['g_buscurr']))
                                                                            <option value="SGD"
                                                                                {{ $r['g_buscurr'] == 'SGD' ? 'selected' : '' }}>
                                                                                SGD</option>
                                                                            <option value="USD"
                                                                                {{ $r['g_buscurr'] == 'USD' ? 'selected' : '' }}>
                                                                                USD</option>
                                                                        @else
                                                                            <option value="" selected disabled>Please
                                                                                select currency</option>
                                                                            <option value="SGD">SGD</option>
                                                                            <option value="USD">USD</option>
                                                                        @endif

                                                                    </select>
                                                                </div>



                                                                <div class="formAreahalf">
                                                                    <label class="form-label" for="busamt">Amount of
                                                                        Business
                                                                        Generated</label>
                                                                    <div class="dollersec"><span
                                                                            class="doller">$</span><span
                                                                            class="input"><input type="number"
                                                                                class="form-control"
                                                                                id="genbusamt[0][subject]"
                                                                                name="addbg[{{ $g }}][g_busamt]"
                                                                                value="{{ $r['g_busamt'] }}"></span>
                                                                    </div>

                                                                </div>

                                                                <div class="formAreahalf remarks">
                                                                    <label class="form-label"
                                                                        for="remarks">Remarks</label>
                                                                    <textarea id="addbg[0][genremarks]" name="addbg[{{ $g }}][g_remarks]" rows="4" cols="50">{{ $r['g_remarks'] }}</textarea>

                                                                </div>


                                                            </fieldset>






                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                    <input type="hidden" id="myInputHidden2" value="{{ $g }}">
                                    @endif
                                    <div class="text-end"><button type="button" name="add" id="dynamic-ar2"
                                            class="btn saveBtn add_potentia">Add
                                            Business Generated</button></div>
                                    {{-- </div> --}}



                                </div>
                            </div>





                        </div>




                    </div>

                </div>
    </form>
    </div>

    </div>
    <div class="dataAreaMain sales-edit extra_check">
        <div class="lower-bottom ">
            <div class="card file action">
                <div class="notes-common formContentData">


                    <form action="javascript:void(0)" method="POST" name="notes_form" id="notes"
                        class="note_send">
                        @csrf
                        <input type="hidden" name="created_by_name" value="{{ Auth::user()->name }}">

                        <input type="hidden" name="application_id" value="{{ $sale->id }}">
                        <input type="hidden" value="Sale Application" name="tbl_name">
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
                                {{ $note->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
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
                        <input type="hidden" name="sale_id" value="{{ $sale->id }}">
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
                            <table class="table table_yellow file_upload_table" >
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
                                            <td><a href="{{asset('file/'.$files->file_orignal_name)}}" target="_blank" >{{ $files->file_orignal_name }}</a></td>
                                            <td>{{ $files->uploaded_by }}</td>
                                            <td>{{ $files->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
                                            </td>
                                            <td> <a href="{{ url('file/' . $files->file_orignal_name) }}" download class="link-normal">
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
                            <table class="table table_yellow user_action_log" >
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
    </div>





@endsection
@push('js')
    <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>

    <script type="text/javascript">
        $("#text_notes").keyup(function() {

            $("#notes_cancel").show();
        });

        $("#notes_cancel").click(function() {
            // alert('eht');
            $("#text_notes").val('');
            $("#notes_cancel").hide();
        });
        $('body').on('submit', '.note_send', function() {

        });
    </script>
    <script type="text/javascript">
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
                url: "{{ route('sales.updfile') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        // alert('hjh');
                        // alert(response);

                        // $('#file-input-error').text('Upload Successfully');
                        // this.reset();

                        // alert('File has been uploaded successfully');
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
                            // window.location = "{{ route('sales.edit', $sale->id) }}";
                            // $('#multistep_form')[0].reset();
                            alert('Uploaded file will be visible in the list after submitting the complete form');
                        })
                    }
                },
                error: function(response) {
                    // alert('no');
                    // alert(response);
                    $('#file-input-error').text(response.responseJSON.message);
                }
            });
        });
    </script>


    <script>
        $("#sign").change(function() {
            // alert('sign');
            if (document.getElementById('sign').value == "Yes") {
                // alert('yes');
                $("#b2bsigndatediv").html(
                    '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate" >'
                );
                $("#b2bexdatediv").html(
                    '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="date" class="form-control" id="b2bexdate" name="b2bexdate">'
                );

                $("#renewlremdiv").html(
                    '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><select name="renewlrem" id="renewlrem"><option value="" selected disabled>Please select</option><option value="90 days before expiry">90 days before expiry</option><option value="120 days before expiry">120 days before expiry</option><option value="180 days before expiry">180 days before expiry</option></select>'
                );
                $("#renewlfrediv").html(
                    ` <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span class="select"><select
                                        name="renewlfre" id="renewlfre">
                                        <option value="" selected disabled>Please select</option>
                                        <option value="Day">Day</option>
                                        <option value="3 Days">3 Days</option>
                                        <option value="Week">Week</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="4 Weeks">4 Weeks</option>



                                    </select>
                                </span>`
                );

            } else {
                // alert('no');
                $("#b2bsigndatediv").html(
                    '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
                );
                $("#b2bexdatediv").html(
                    '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
                );
                $("#renewlremdiv").html(
                    '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><input type="" class="form-control" id="renewlrem" name="renewlrem" placeholder="-" disabled>'
                );
                $("#renewlfrediv").html(
                    '<label for="clienttype" class="form-label"> Agreement Renewal Frequency</label><input type="" class="form-control" id="renewlfre" name="renewlfre" placeholder="-" disabled>'
                );

            }
        })


        $("#dynamic-ar").click(function() {



            // $("#sign").change(function() {
            //     //  alert('bchange');
            //     // var option = document.getElementById("client").options;
            //     if (document.getElementById('sign').value == "Yes") {
            //       $("#b2bsigndatediv").html(
            //             '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate" >'
            //         );
            //         $("#b2bexdatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="date" class="form-control" id="b2bexdate" name="b2bexdate">'
            //         );
            //     }
            //     else
            //     {
            //       $("#b2bsigndatediv").html(
            //             '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
            //         );
            //         $("#b2bexdatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
            //         );

            //     }
            //   });



            // $("#business").change(function() {
            //     //  alert('bchange');
            //     var option = document.getElementById("client").options;
            //     if (document.getElementById('business').value == "B2B") {
            //         // alert('b2b');
            //         // $("#client").append('<option>Select</option>');
            //         $("#client").html(
            //             '<option value="" selected disabled>Please select client type</option><option value="Personal">Personal</option><option value="Corporate">Corporate</option>'
            //         );
            //         $("#sign").html(
            //             '<option value="No">No</option><option value="Yes">Yes</option>'
            //         );
            //         $("#b2bsigndatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
            //         );
            //         $("#b2bexdatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
            //         );


            //     }
            //     if (document.getElementById('business').value == "B2C") {
            //         // alert('b2b');
            //         // $("#client").append('<option>Select</option>');
            //         $("#client").html(
            //             '<option value="" selected disabled>Please select client type</option><option value="Personal">Personal</option>'
            //         );
            //         $("#sign").html(
            //             '<option value="No">No</option>'
            //         );
            //         $("#b2bsigndatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
            //         );
            //         $("#b2bexdatediv").html(
            //             '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
            //         );




            //     }
            // });




            var i = $("#myInputHidden").val();
            i++;
            var b2c_hide = "";
            if ($("#business").val() == "B2C"){
                b2c_hide = `style="display: none;"`;
            }
            var I = i + 1;
            $(".add_fieldset_fg .card").last().append(
                `<fieldset id="dynamicAddRemove" class="w-100 d-flex justify-content-start flex-wrap form-fields business generate Potens parent_field` +
                i + `">

    <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>
    <div class="accordion-item">
                
        <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>
        <div class="formAreahalf checkbox" style="display: flex; align-items: flex-start">
            <input type="checkbox" id="same_client_topb` + i + `"  class="same_client_topb" name="same_client_topb"  value="">
            <label for="same_client_topb` + i + `" class="form-label checkbox_label" style="margin-left: 10px;">Same Basic Information as Client?</label>
        </div>
                                                <h2 class="accordion-header" id="panelsStayOpen-headingT` + i + `">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseT` + i + `"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseT` +
                i +
                `">
                                                       <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>

                                                </h2>
                                                <label for="clienttype" class="form-label"> Type of Potential Business ` +
                I + ` </label>
                                                <div id="panelsStayOpen-collapseT` + i + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingT` + i + `">
                                                    <div class="accordion-body d-flex flex-wrap">
      <div class="formAreahalf ">

      <select name="addpb[` + i + `][drp]" id="addpb[` + i + `][drp]" class="select_class" data-id="` + i + `">
        <option value="" selected disabled>Please select types of potential business</option>
        <option value="Wealth Management">Wealth Management</option>
        <option value="Immigration Programme">Immigration Programme</option>
        <option value="Family Office">Family Office</option>
        <option value="Passport">Passport</option>
        <option value="Real Property">Real Property</option>
        <option value="Pure Identity Management">Pure Identity Management</option>
        <option value="Account Services">Account Services</option>
        <option value="Education">Education</option>
        <option value="Bank Account Opening">Bank Account Opening</option>
        <option value="Others">Others</option>
      </select>

         </div>
         <div class="formAreahalf others"></div>

    <div class="formAreahalf" `+b2c_hide+`>
      <label class="form-label" for="dcname">Name of direct client</label>

      <input type="text" class="form-control" id="dcname[` + i + `][subject]" name="addpb[` + i + `][dcname]">

    </div>
    <div class="formAreahalf" `+b2c_hide+`>
      <label class="form-label" for="passcountry">Passport Country</label>
      <input type="text" class="form-control" id="passcountry[` + i + `][subject]" name="addpb[` + i + `][passcountry]">

    </div>

    <div class="formAreahalf" `+b2c_hide+`>
      <label class="form-label" for="wechatidc">Wechat Id of client</label>

      <input type="text" class="form-control" id="wechatidc[` + i + `][subject]" name="addpb[` + i + `][wechatidc]">
    </div>

    <div class="formAreahalf " `+b2c_hide+`>
      <label class="form-label" for="cmobileno">Mobile no. of Client</label>
      <input type="text" class="form-control" id="cmobileno[` + i + `][subject]" name="addpb[` + i + `][cmobileno]">
    </div>

    <div class="formAreahalf " `+b2c_hide+`>
      <label class="form-label" for="cemail">Email address of client</label>
      <input type="email" class="form-control" id="cemail[` + i + `][subject]" name="addpb[` + i + `][cemail]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="busdes">Business Description</label>
      <input type="text" class="form-control" id="busdes[` + i + `][subject]" name="addpb[` + i + `][busdes]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="buscurr">Currency of Potential Business</label>
      <select name="addpb[` + i + `][buscurr]" id="addpb[` + i +
                `][buscurr]">
                                          <option value="" selected disabled>Please select currency</option>
                                          <option value="SGD">SGD</option>
                                          <option value="USD">USD</option>


                                      </select>

    </div>


    <div class="formAreahalf">
                                                                <label class="form-label" for="busamt">Amount of
                                                                    Potential Business
                                                                    </label>
                                                                       <div class="dollersec"><span class="doller">$</span><span class="input"><input type="number" class="form-control" id="busamt[` +
                i + `][subject]" name="addpb[` + i + `][busamt]"></span></div>

                                                            </div>
    <div class="formAreahalf">
      <label class="form-label" for="remarks">Remarks</label>

      <textarea id="remarks[` + i + `][subject]" name="addpb[` + i + `][remarks]" rows="4" cols="50"></textarea>

    </div>
</div>
</div>
</div>


  </fieldset>

  `)
            var $input = $('#myInputHidden');
            $input.val(+$input.val() + 1);
        });
        $(document).on('click', '.remove-input-field', function() {

            var id = $(this).attr('data-id');


            $(this).parents(id).remove();
            var $input = $('#myInputHidden');
            $input.val(+$input.val() - 1);
        });

        $(document).on('change', '.select_class', function() {
            //  alert('hsriuh');

            if ($(this).val() == "Others") {

                var tpb_id = $(this).attr('data-id');

                // $(this).parents('fieldset').find('.others').append('dssdff');
                $(this).parents('fieldset').find('.others').append(
                    '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc" name="topb_drp_spc[' +
                    tpb_id + ']">'
                );


            } else {
                $(this).parents('fieldset').find('.others').html('');
            }


        });



        $("#dynamic-ar2").click(function() {
            var g = $("#myInputHidden2").val();
            g++;
            var G = g + 1;
            $(".add_fieldset_fg2 .card").last().append(
                ` <fieldset ` + G +
                `id="dynamicAddRemove2" class=" w-100 d-flex justify-content-start flex-wrap form-fields business generate buss parent_field2` +
                g + `">
                <div class="cross"><span class="remove-input-field2" data-id=".parent_field2` + g + `">x</span></div>
                <div class="accordion-item">
                    <div class="formAreahalf checkbox" style="display: flex; align-items: flex-start">
                        <input type="checkbox" id="same_client_tobg` + g + `" class="same_client_tobg Potential_business"
                            name="same_client_topb" value="">
                        <label for="same_client_tobg` + g + `" class="form-label checkbox_label" style="margin-left: 10px;">Same as Type of Potential Business?</label>
                    </div>
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTw` + g + `">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseTw` + g +
                `"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTw` +
                g +
                `">
                                                       <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>

                                                </h2>
                                                <label for="clienttype" class="form-label"> Type of Generated Business ` +
                G + ` </label>
                                                <div id="panelsStayOpen-collapseTw` + g + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTw` + g + `">
                                                    <div class="accordion-body d-flex flex-wrap">
    <div class="formAreahalf ">


      <select name="addbg[` + g + `][g_drp]" id="addMoreInputFields2[0][select]" class="select_class_g" data-id="` +
                g + `">
        <option value="" selected disabled>Please select type of generated business</option>
        <option value="Wealth Management">Wealth Management</option>
        <option value="Immigration Programme">Immigration Programme</option>
        <option value="Family Office">Family Office</option>
        <option value="Passport">Passport</option>
        <option value="Real Property">Real Property</option>
        <option value="Pure Identity Management">Pure Identity Management</option>
        <option value="Account Services">Account Services</option>
        <option value="Education">Education</option>
        <option value="Bank Account Opening">Bank Account Opening</option>
        <option value="Others">Others</option>
      </select>
      @error('addMoreInputFields.*.subject')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
    <div class="formAreahalf others2"></div>
    <div class="formAreahalf ">
      <label class="form-label" for="">Name of direct client</label>

      <input type="text" class="form-control" id="gendcname[0][subject]" name="addbg[` + g + `][g_dcname]">

    </div>
    <div class="formAreahalf ">
      <label class="form-label" for="passcountry">Passport Country</label>
      <input type="text" class="form-control" id="genpasscountry[0][subject]" name="addbg[` + g + `][g_passcountry]">

    </div>

    <div class="formAreahalf ">
        <label class="form-label" for="wechatidc">Wechat Id of client</label>

      <input type="text" class="form-control" id="genwechatidc[0][subject]" name="addbg[` + g + `][g_wechatid]">
    </div>

    <div class="formAreahalf ">
      <label class="form-label" for="cmobileno">Mobile no. of client</label>
      <input type="text" class="form-control" id="gencmobileno[0][subject]" name="addbg[` + g + `][g_cmobno]">
    </div>


    <div class="formAreahalf">
      <label class="form-label" for="cemail">Email address of client</label>
      <input type="email" class="form-control" id="gencemail[0][subject]" name="addbg[` + g + `][g_cemail]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="busdes">Business Description</label>
      <input type="text" class="form-control" id="genbusdes[0][subject]" name="addbg[` + g + `][g_busdes]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="buscurr">Currency of Business Generated</label>

                <select name="addbg[` + g +
                `][g_buscurr]" id="addbg[` + g +
                `][g_buscurr]">
                                          <option value="" selected disabled>Please select currency</option>
                                          <option value="SGD">SGD</option>
                                          <option value="USD">USD</option>


                                      </select>
    </div>

    <div class="formAreahalf">
                                                                <label class="form-label" for="busamt">Amount of
                                                                    Business
                                                                    Generated</label>
                                                                       <div class="dollersec"><span class="doller">$</span><span class="input"><input type="number" class="form-control" id="genbusamt[0][subject]" name="addbg[` +
                g + `][g_busamt]"></span></div>

                                                            </div>


    <div class="formAreahalf">
      <label class="form-label" for="remarks">Remarks</label>

      <textarea id="addbg[0][genremarks]" name="addbg[` + g + `][g_remarks]" rows="4" cols="50"></textarea>

    </div>


    <!-- <input type="submit" name="submit" class="submit btn saveBtn" id="next1" name="next1" value="Next" style='margin-left:30%' /> -->


</fieldset>

  `)
            var $input = $('#myInputHidden2');
            $input.val(+$input.val() + 1);

        });
        $(document).on('click', '.remove-input-field2', function() {
            var id = $(this).attr('data-id');

            $(this).parents(id).remove();
            var $input = $('#myInputHidden2');
            $input.val(+$input.val() - 1);
        });

        $(document).on('change', '.select_class_g', function() {


            if ($(this).val() == "Others") {

                var tgb_id = $(this).attr('data-id');

                $(this).parents('fieldset').find('.others2').append(
                    '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc_g" name="togb_drp_spc[' +
                    tgb_id + ']">'
                );


            } else {
                $(this).parents('fieldset').find('.others2').html('');
            }


        });

        if ($("#multistep_form").length > 0) {
            $("#multistep_form").validate({
                rules: {
                    business: {
                        required: true
                    },
                    client: {
                        required: true
                    },
                    // cname: {
                    //     required: true
                    // },

                    pocph: {
                        minlength: 6,
                        maxlength: 16,
                        // digits: true
                    },

                    pocemail: {
                        email: true
                    },
                },
                messages: {
                    pocph: "Please enter valid phone number",

                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('sales.update', $sale->id) }}",
                        type: "POST",
                        data: $('#multistep_form').serialize(),
                        success: function(response) {
                            const el = document.createElement('div')
                            el.innerHTML =
                                "<p>You can view Application List <a class='view-application' href='{{ route('sales') }}'>here</a></p>"
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
                                window.location = "{{ route('sales.show', $sale->id) }}";
                                // $('#multistep_form')[0].reset();
                            })
                        },
                        error: function(error) {
                            alert(error.statusText);
                        }
                    });
                }
            })
        }

        // if ($("#addTask_form").length > 0) {
        //     $("#addTask_form").validate(
        //         rules: {
        //             file: {
        //                 required: true
        //             },


        //         submitHandler: function(form) {
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });
        //             $.ajax({
        //                 url: "{{ route('sales.updfile') }}",
        //                 type: "POST",
        //                 data: $('#addTask_form').serialize(),
        //                 success: function(response) {
        //                     console.log(response);
        //                     const el = document.createElement('div')
        //                     el.innerHTML =
        //                         "You can view Application List <a href='{{ route('sales') }}'>here</a>"
        //                     swal({
        //                         title: `Application Updated`,
        //                         content: el,
        //                         icon: "success",
        //                         buttons: true,
        //                         buttons: {
        //                             cancel: false,
        //                             confirm: {
        //                                 text: 'Close',
        //                                 className: 'btn btn-danger'
        //                             },
        //                         },
        //                     }).then((result) => {
        //                         // window.location = "{{ route('sales.edit', $sale->id) }}";
        //                         // $('#multistep_form')[0].reset();
        //                     })
        //                 }
        //             });
        //         }
        //     })
        // }

        // $(document).on('click', '.btn_notes', function(e) {
        //     var valid = true;

        //     // alert('nj');
        //     var notes = document.getElementById("notes").value;
        //     if (notes == "") {
        //         valid = false;
        //     }
        //     var sale_id = document.getElementById("sale_id").value;
        //     // var created_by = document.getElementById("created_by").value;
        //     // var uid = document.getElementById("uid").value;
        //     // var page = document.getElementById("page").value;

        //     // alert(notes);
        //     e.preventDefault();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     if (valid == true) {
        //         $.ajax({
        //             url: "{{ route('sales.notes') }}",
        //             type: "POST",
        //             data: {
        //                 notes: notes,
        //                 // uid: uid,
        //                 id: sale_id,
        //                 // created_by: created_by,
        //                 // page: page
        //             },
        //             success: function(result) {
        //                 // alert('ok');

        //                 // console.log(result)
        //                 const el = document.createElement('div')

        //                 swal({
        //                     title: `Notes Created`,
        //                     content: el,
        //                     icon: "success",
        //                     buttons: true,
        //                     buttons: {
        //                         cancel: false,
        //                         confirm: {
        //                             text: 'Close',
        //                             className: 'btn btn-danger'
        //                         },
        //                     },
        //                 }).then((result) => {
        //                     // document.getElementById("notes").value = "";
        //                     $("#notes_error").html("").removeClass("error");
        //                 })
        //             },
        //             error: function(result) {
        //                 alert('error');
        //             }
        //         });
        //     } else {

        //         $("#notes_error").html("<h3>This field is required.</h3>").addClass("error");
        //     }
        // });

        //         $(document).on('submit', '#addTask_form', function(e){
        //             alert('hiuhoijhiojjio');
        //   e.preventDefault();

        //   var form_data = new FormData($('#addTask_form')[0]); // this method will send the file request and the post data
        //   form_data.append("_token","{{ csrf_token() }}") //for csrf token
        //   $.ajax({
        //       type:'POST',
        //       url:'{{ route('sales.updfile') }}',
        //       async: false,
        //       cache: false,
        //       data : form_data,
        //       success: function(response){
        //         alert('file');

        //       }
        //   });
        // });


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
                    var url = "{{ route('files.deleted', ':id') }}";
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
                                    "{{ route('sales.edit', $sale->id) }}";
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

        $("#client").change(function() {
                
            if ($("#business").val() == "B2C"){
                $('.b2c_hide').hide();
            }
        });
        console.log($("#business").val());
        if ($("#business").val() == "B2C"){
            $('.b2c_hide').hide();
           
        }
    </script>
@endpush
