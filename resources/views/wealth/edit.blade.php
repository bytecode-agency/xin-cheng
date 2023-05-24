@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
                @php $companyName = ''; @endphp
                @if (count($data->companies) > 0)
                    @foreach ($data->companies as $key => $cmp_name)
                        @php $companyName .= $cmp_name->name.', ' @endphp
                    @endforeach
                    @php $companyName =  rtrim($companyName, ', '); @endphp
                    {{ $companyName }}
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
                <li><a href="{{ route('wealth.index') }}">Wealth</a></li>
                <li>{{ Breadcrumbs::render('wealth.edit') }}</li>
            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <button class="btn saveBtn edit_save"><span>Save</span></button>
            <a href="{{ route('wealth.show', $data->id) }}"><button
                    class="btn saveBtn cancelBtn"><span>Cancel</span></button></a>
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
    <div class="dataAreaMain edit_wealth">

        <form action="javascript:void(0);" class="justify-content-start flex-wrap" id="multistep_form_edit">
            @csrf
            <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="wealth_id" id="wealth_id" value="{{ $data->id }}">

            <div class="card company_basic_info formContentData border-0 p-4">
                <h3>Basic Information</h3>
                <div class="company_basic_data d-flex flex-wrap">
                    @if ($data->business_type == 'FO')
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company(s)</label>
                            <p>
                                {{-- @foreach ($data->companies as $company_name)
                                    {{ $company_name->name }}
                                @endforeach --}}
                                {{ $companyName }}
                            </p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Business Type</label>
                            <p>{{ $data->business_type }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Type of FO</label>
                            <p> {{ $basic_data->type_of_fo }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Client Type</label>
                            <p>{{ $data->client_type }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Created By</label>
                            <p>{{ $data->users->name }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Client Status</label>
                            <select class="js-example-responsive form-control" name="client_status">
                                {{-- <option value="" selected disabled>Choose Client Status</option> --}}
                                <option value="Active"{{ $data->client_status == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Dormant"{{ $data->client_status == 'Dormant' ? 'selected' : ''}}>Dormant</option>
                            </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">One Time Servicing Fee Amount</label>
                            <div class="dollersec"><span class="doller">$</span>
                                <span class="input"> <input type="text" class="form-control" name="servicing_fee"
                                        id="fo_servicing_fee_amount" value="{{ $basic_data->servicing_fee }}"></span>
                            </div>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">One Time Servicing Fee Currency</label>
                            <select class="form-control" name="servicing_fee_currency">
                                <option value ="" selected disabled>Choose one time servicing fee currency</option>
                                <option value="SGD"
                                    {{ $basic_data->servicing_fee_currency == 'SGD' ? 'selected' : '' }}>SGD</option>
                                <option value="USD"
                                    {{ $basic_data->servicing_fee_currency == 'USD' ? 'selected' : '' }}>USD</option>
                            </select>

                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Annual Servicing Fee Currency</label>
                            <select class="form-control" name="annual_fee_currency">
                                <option value ="" selected disabled>Choose annual servicing fee currency</option>
                                <option value="SGD" {{ $basic_data->annual_fee_currency == 'SGD' ? 'selected' : '' }}>
                                    SGD</option>
                                <option value="USD" {{ $basic_data->annual_fee_currency == 'USD' ? 'selected' : '' }}>
                                    USD
                                </option>
                            </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">One Time Servicing Fee Status</label>
                            <select type="text" class="js-example-responsive form-control" name="servicing_fee_status">
                                <option value ="" selected disabled>Choose one time servicing fee status</option>
                                <option value="Pending"
                                    {{ $basic_data->servicing_fee_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Received"
                                    {{ $basic_data->servicing_fee_status == 'Received' ? 'selected' : '' }}>Received
                                </option>
                                {{-- <option value="Rejected"
                                    {{ $basic_data->servicing_fee_status == 'Rejected' ? 'selected' : '' }}>Rejected
                                </option> --}}

                            </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Annual Servicing Fee Status</label>
                            <select class="js-example-responsive form-control" name="annual_fee_status">
                                <option value ="" selected disabled>Choose annual servicing fee status</option>
                                <option value="Pending"
                                    {{ $basic_data->annual_fee_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Received"
                                    {{ $basic_data->annual_fee_status == 'Received' ? 'selected' : '' }}>Received</option>
                                {{-- <option value="Rejected"
                                    {{ $basic_data->annual_fee_status == 'Rejected' ? 'selected' : '' }}>Rejected</option> --}}
                            </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Annual Servicing Fee Amount</label>
                            <div class="dollersec"><span class="doller">$</span>
                                <span class="input"> <input type="text" class="form-control" name="annual_servicing_fee"
                                        value="{{ $basic_data->annual_servicing_fee }}"></span>
                            </div>
                        </div>
                    @else
                            @if ($data->business_type == 'Non-FO' && $data->client_type == 'Personal')
                            <div class="formAreahalf basic_data">
                                <label for="" class="form-label">Client(s)</label>
                                <p> {{ $basic_data->pass_name_eng }}</p>
                            </div>
                        @else
                            <div class="formAreahalf basic_data">
                                <label for="" class="form-label">Company(s)</label>
                                <p> {{ $companyName }}</p>
                            </div>
                        @endif
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Business Type</label>
                            <p>{{ $data->business_type }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Client Type</label>
                            <p>{{ $data->client_type }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Created By</label>
                            <p>{{ $data->users->name }}</p>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Client Status</label>
                            <select class="js-example-responsive form-control" name="client_status">
                                {{-- <option value="" selected disabled>Choose Client Status</option> --}}
                                <option value="Active"{{ $data->client_status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Dormant"{{ $data->client_status == 'Dormant' ? 'selected' : '' }}>Dormant</option>
                            </select>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card company_info formContentData border-0 p-4">

                @if ($data->business_type == 'FO')
                    @include('wealth.fo_edit')
                @elseif($data->business_type == 'Non-FO' && $data->client_type == 'Personal')
                    @include('wealth.nfo_personal_edit')
                @else
                    @include('wealth.nfo_edit')
                @endif

            </div>
            <div class="application_info">
                <div class="card company_info formContentData border-0 p-4 ">
                    <h3>Application Information</h3>
                    <div class="tabbing_wealth_four tab_accordian_change">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @if ($data->business_type == 'FO')
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mas" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">MAS
                                        Related</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-financial" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Financial Institution
                                        Related</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pass" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Pass
                                        Related</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-business" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Business Related</button>
                                @else
                                    <button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-business" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Business Related</button>
                                @endif
                            </div>
                        </nav>
                        <div class="tab-content border_styling tab_design_chnages" id="nav-tabContent">
                            @if ($data->business_type == 'FO')
                               

                                <div class="tab-pane fade show active" id="nav-mas" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <input type="hidden" name="wealth_mas_id"
                                    value="@isset($wealth_mas->id) {{ $wealth_mas->id }} @endisset">
                                    <div id="mas_accordion" class="mas_related">
                                        <div class="mas_heading_accordian">
                                            <div class="formAreahalf basic_data">
                                                <label for="account_status" class="form-label">Account Status</label>
                                                <select name="account_status" id="account_status"
                                                    class="js-example-responsive form-control">
                                                    <option value="" selected disabled>Choose account status</option>
                                                    <option value="Active"
                                                        {{ isset($wealth_mas->account_status) && $wealth_mas->account_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Dormant"
                                                        {{ isset($wealth_mas->account_status) && $wealth_mas->account_status == 'Dormant' ? 'selected' : '' }}>Dormant</option>
                                                </select>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="tax_advisor_name" class="form-label">Tax Advisor
                                                    Name</label>
                                                <input type="text" name="tax_advisor_name" id="tax_advisor_name"
                                                    value="@isset($wealth_mas->tax_advisor_name) {{ $wealth_mas->tax_advisor_name }} @endisset"
                                                    class="form-control">
                                            </div>
                                            <button class="btn btn_set" data-toggle="collapse"
                                                data-target="#mas_collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div id="mas_collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-inner-text d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="tax_advisor_email" class="form-label">Tax Advisor
                                                        Email</label>
                                                    <input type="text" name="tax_advisor_email" id="tax_advisor_email"
                                                        value="@isset($wealth_mas->tax_advisor_email) {{ $wealth_mas->tax_advisor_email }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="tax_advisor_no" class="form-label">Tax Advisor Contact
                                                        Number</label>
                                                    <input type="text" name="tax_advisor_no" id="tax_advisor_no"
                                                        value="@isset($wealth_mas->tax_advisor_no) {{ $wealth_mas->tax_advisor_no }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="kickstart_tax_advisor" class="form-label">Kickstart to
                                                        Tax
                                                        Advisor</label>
                                                    <select name="kickstart_tax_advisor" id="kickstart_tax_advisor"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose kickstart to
                                                            tax
                                                            advisor</option>
                                                        <option value="In progress"
                                                            {{ isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option value="Done"
                                                            {{ isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="deck_submission" class="form-label">Deck
                                                        Submission</label>
                                                    <select name="deck_submission" id="deck_submission"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose deck submission
                                                        </option>
                                                        <option value="In progress"
                                                            {{ isset($wealth_mas->deck_submission) && $wealth_mas->deck_submission == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option value="Done"
                                                            {{ isset($wealth_mas->deck_submission) && $wealth_mas->deck_submission == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="presentation_deck" class="form-label">Presentation
                                                        Deck
                                                        (Final)
                                                    </label>
                                                    <select name="presentation_deck" id="presentation_deck"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose presentation
                                                            deck</option>
                                                        <option
                                                            value="In progress"{{ isset($wealth_mas->presentation_deck) && $wealth_mas->presentation_deck == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option
                                                            value="Done"{{ isset($wealth_mas->presentation_deck) && $wealth_mas->presentation_deck == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="masnet_account" class="form-label">MASNET Account
                                                        Opening</label>
                                                    <select name="masnet_account" id="masnet_account"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose MASNET account
                                                            opening
                                                        </option>
                                                        <option
                                                            value="In progress"{{ isset($wealth_mas->tax_advisor_name) && $wealth_mas->masnet_account == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option
                                                            value="Done"{{ isset($wealth_mas->masnet_account) && $wealth_mas->masnet_account == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="preliminary_approval" class="form-label">Preliminary
                                                        Approval</label>
                                                    <select name="preliminary_approval" id="preliminary_approval"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose preliminary
                                                            approval
                                                        </option>
                                                        <option
                                                            value="Pending"{{ isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option
                                                            value="Approved"{{ isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                        <option
                                                            value="Rejected"{{ isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="final_approval" class="form-label">Final
                                                        Approval</label>
                                                    <select name="final_approval" id="final_approval"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose final approval
                                                        </option>
                                                        <option
                                                            value="Pending"{{ isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option
                                                            value="Approved"{{ isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                        <option
                                                            value="Rejected"{{ isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="final_submission" class="form-label">Final
                                                        Submission</label>
                                                    <select name="final_submission" id="final_submission"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose final
                                                            submission
                                                        </option>
                                                        <option
                                                            value="In progress"{{ isset($wealth_mas->final_submission) && $wealth_mas->final_submission == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option
                                                            value="Done"{{ isset($wealth_mas->final_submission) && $wealth_mas->final_submission == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="oic_name" class="form-label">OIC Name</label>
                                                    <input type="text" name="oic_name" id="oic_name"
                                                        value="@isset($wealth_mas->oic_name) {{ $wealth_mas->oic_name }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="masnet_username" class="form-label">MASNET
                                                        Username</label>
                                                    <input type="text" name="masnet_username" id="masnet_username"
                                                        value="@isset($wealth_mas->masnet_username) {{ $wealth_mas->masnet_username }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="masnet_password" class="form-label">MASNET
                                                        Password</label>
                                                    <input type="text" name="masnet_password" id="masnet_password"
                                                        value="@isset($wealth_mas->masnet_password){{ $wealth_mas->masnet_password }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="institution_code" class="form-label">Institution
                                                        Code</label>
                                                    <input type="text" name="institution_code" id="institution_code"
                                                        value="@isset($wealth_mas->institution_code){{ $wealth_mas->institution_code }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="declaration_frequency" class="form-label">Declaration
                                                        Frequency</label>
                                                    <select name="declaration_frequency" id="declaration_frequency"
                                                        class="form-control">
                                                        <option value="" selected disabled>Choose declaration
                                                            frequency
                                                        </option>
                                                        <option
                                                            value="Yearly"{{ isset($wealth_mas->declaration_frequency) && $wealth_mas->declaration_frequency == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                                            <option
                                                            value="Half-yearly"{{ isset($wealth_mas->declaration_frequency) && $wealth_mas->declaration_frequency == 'Half-yearly' ? 'selected' : '' }}>Half-yearly</option>
                                                            <option
                                                            value="Quarterly"{{ isset($wealth_mas->declaration_frequency) && $wealth_mas->declaration_frequency == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                      </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="commencement_date" class="form-label">Commencement
                                                        Date</label>
                                                    <input type="date" name="commencement_date" id="commencement_date"
                                                        value="@isset($wealth_mas->commencement_date) {{ convertDate($wealth_mas->commencement_date,'m/d/Y') }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="reminder_notification" class="form-label">Reminder
                                                        Notification</label>
                                                    <select name="reminder_notification" id="reminder_notification"
                                                        class="form-control">
                                                        <option value="" selected disabled>Choose reminder
                                                            notification
                                                        </option>
                                                        <option value="60 days onwards till deadline"
                                                            {{ isset($wealth_mas->reminder_notification) && $wealth_mas->reminder_notification == '60 days onwards till deadline' ? 'selected' : '' }}>
                                                            60 days onwards till deadline</option>
                                                            <option value="90 days onwards till deadline"
                                                            {{ isset($wealth_mas->reminder_notification) && $wealth_mas->reminder_notification == '90 days onwards till deadline' ? 'selected' : '' }}>
                                                            90 days onwards till deadline</option><option value="120 days onwards till deadline"
                                                            {{ isset($wealth_mas->reminder_notification) && $wealth_mas->reminder_notification == '120 days onwards till deadline' ? 'selected' : '' }}>
                                                            120 days onwards till deadline</option><option value="180 days onwards till deadline"
                                                            {{ isset($wealth_mas->reminder_notification) && $wealth_mas->reminder_notification == '180 days onwards till deadline' ? 'selected' : '' }}>
                                                            180 days onwards till deadline</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="annual_declaration_deadline" class="form-label">Annual
                                                        Declaration
                                                        Deadline</label>
                                                    <input type="text" name="annual_declaration_deadline"
                                                        id="annual_declaration_deadline" 
                                                        value="@isset($wealth_mas->annual_declaration_deadline) {{ $wealth_mas->annual_declaration_deadline }} @endisset"
                                                        class="form-control datepicker" placeholder="dd/mm/yy">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="internal_account_manager" class="form-label">Internal
                                                        Account
                                                        Manager</label>
                                                    <input type="text" name="internal_account_manager"
                                                        id="internal_account_manager"
                                                        value="@isset($wealth_mas->internal_account_manager) {{ $wealth_mas->internal_account_manager }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="trigger_fqy_rem" class="form-label">Maturity Reminder Trigger Frequency</label>
                                                    <div class="select_box"><span class="every">Every</span><span
                                                            class="select"><select name="trigger_fqy_rem"
                                                                id="trigger_fqy_rem" class="form-control">
                                                                <option value="" selected="" disabled="">
                                                                    Please
                                                                    select</option>
                                                                <option
                                                                    value="Day"{{ isset($wealth_mas->trigger_fqy_rem) && $wealth_mas->trigger_fqy_rem == 'Day' ? 'selected' : '' }}>
                                                                    Day</option>
                                                                <option
                                                                    value="3 Days"{{ isset($wealth_mas->trigger_fqy_rem) && $wealth_mas->trigger_fqy_rem == '3 Daya' ? 'selected' : '' }}>
                                                                    3 Days</option>
                                                                <option
                                                                    value="Week"{{ isset($wealth_mas->trigger_fqy_rem) && $wealth_mas->trigger_fqy_rem == 'Week' ? 'selected' : '' }}>
                                                                    Week</option>
                                                                <option
                                                                    value="2 Weeks"{{ isset($wealth_mas->trigger_fqy_rem) && $wealth_mas->trigger_fqy_rem == '2 Weeks' ? 'selected' : '' }}>
                                                                    2 Weeks</option>
                                                                <option
                                                                    value="4 Weeks"{{ isset($wealth_mas->trigger_fqy_rem) && $wealth_mas->trigger_fqy_rem == '4 Weeks' ? 'selected' : '' }}>
                                                                    4 Weeks</option>
                                                            </select></span></div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <textarea name="remarks" id="remarks" rows="4" cols="50"
                                                        value="@isset($wealth_mas->remarks) {{ $wealth_mas->remarks }} @endisset">@isset($wealth_mas->remarks) {{ $wealth_mas->remarks }} @endisset</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              
                                <div class="tab-pane fade wealth_finance_tab_new" id="nav-financial" role="tabpanel"
                                    aria-labelledby="nav-profile-tab"> 
                                        @php $length =1; @endphp
                                        @if(count($wealthfinance)>0)
                                            @php $length=count($wealthfinance); @endphp                                       
                                        @endif                  
                                                                    
                                    <div class="wealth_finance_data" id="wealth_finance_data">
                                        @for($i=0; $i<$length; $i++)  
                                            <div class="mas_related wealth_finance_check financial_{{$i +1}}" id="financial_accordion_{{$i +1 }}">
                                               
                                                <div class="new_chnages_finance accordion-items">  
                                                    <input type="hidden" name="financial[{{$i + 1}}][wealth_finance_id]" id="finance_id"
                                                        value="@isset($wealthfinance[$i]->id) {{ $wealthfinance[$i]->id }} @endisset">                                      
                                                    <div class="mas_heading_accordian">
                                                    
                                                            <div class="formAreahalf basic_data">
                                                                <label for="stakeholder_type" class="form-label">Stakeholder
                                                                    Type</label>
                                                                <select name="financial[{{$i +1}}][stakeholder_type]" id="stakeholder_type"
                                                                    class="form-control">
                                                                    <option value="" selected disabled>Choose stakeholder type
                                                                    </option>
                                                                    <option value="Fund CO."
                                                                        {{ isset($wealthfinance[$i]->stakeholder_type) && $wealthfinance[$i]->stakeholder_type == 'Fund CO.' ? 'selected' : '' }}>
                                                                        Fund CO.</option>
                                                                    <option value="Management CO."
                                                                        {{ isset($wealthfinance[$i]->stakeholder_type) && $wealthfinance[$i]->stakeholder_type == 'Management CO.' ? 'selected' : '' }}>
                                                                        Management CO.</option>
                                                                    <option value="Shareholder"
                                                                        {{ isset($wealthfinance[$i]->stakeholder_type) && $wealthfinance[$i]->stakeholder_type == 'Shareholder' ? 'selected' : '' }}>
                                                                        Shareholder</option>
                                                                    <option value="Pass holder"
                                                                        {{ isset($wealthfinance[$i]->stakeholder_type) && $wealthfinance[$i]->stakeholder_type == 'Pass holder' ? 'selected' : '' }}>
                                                                        Pass holder</option>
                                                                </select>
                                                            </div>

                                                            <div class="formAreahalf basic_data">
                                                                <label for="financial_institution_name" class="form-label">Financial
                                                                    Institution Name {{$i + 1}}</label>
                                                                <input type="text" name="financial[{{$i +1}}][financial_institution_name]"
                                                                    id="financial_institution_name"
                                                                    value="@isset($wealthfinance[$i]->financial_institution_name) {{ $wealthfinance[$i]->financial_institution_name }} @endisset"
                                                                    class="form-control">
                                                            </div>
                                                            <button class="btn btn_set edit_new_btn_set" data-toggle="collapse"
                                                                data-target="#financial_collapse{{$i +1}}" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                            </button>                                                  
                                                    
                                                        <div class="cross financial_wealth"><span class="edit_cancel_share remove-financal">x</span></div>
                                                    </div>
                                                    <div id="financial_collapse{{$i +1}}" class="collapse" aria-labelledby="headingOne"
                                                        data-parent="#financial_accordion_{{$i + 1 }}">
                                                        <div class="tab_custom_settings new_test_finance tab_body">
                                                            <div class="tab-inner-text d-flex flex-wrap">
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="poc_name" class="form-label">POC Name</label>
                                                                    <input type="text" name="financial[{{$i +1}}][poc_name]" id="poc_name"
                                                                        value="@isset($wealthfinance[$i]->poc_name) {{ $wealthfinance[$i]->poc_name }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="poc_contact_no" class="form-label">POC Contact
                                                                        Number</label>
                                                                    <input type="text" name="financial[{{$i +1}}][poc_contact_no]" id="poc_contact_no"
                                                                        value="@isset($wealthfinance[$i]->poc_contact_no){{ $wealthfinance[$i]->poc_contact_no }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="poc_email" class="form-label">POC Email</label>
                                                                    <input type="text" name="financial[{{$i +1}}][poc_email]" id="poc_email"
                                                                        value="@isset($wealthfinance[$i]->poc_email){{ $wealthfinance[$i]->poc_email }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="application_submission" class="form-label">Application
                                                                        Submission</label>
                                                                    <select name="financial[{{$i +1}}][application_submission]" id="application_submission"
                                                                        class="js-example-responsive form-control">
                                                                        <option value="" selected disabled>Choose application
                                                                            submission
                                                                        </option>
                                                                        <option
                                                                            value="In progress"{{ isset($wealthfinance[$i]->application_submission) && $wealthfinance[$i]->application_submission == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                        <option
                                                                            value="Done"{{ isset($wealthfinance[$i]->application_submission) && $wealthfinance[$i]->application_submission == 'Done' ? 'selected' : '' }}>Done</option>

                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="account_type" class="form-label">Account Type</label>
                                                                    <select name="financial[{{$i +1}}][account_type]" id="account_type" class="form-control">
                                                                        <option value="" selected disabled>Choose account type
                                                                        </option>
                                                                        <option value="SGD"
                                                                            {{ isset($wealthfinance[$i]->account_type) && $wealthfinance[$i]->account_type == 'SGD' ? 'selected' : '' }}>
                                                                            SGD</option>
                                                                        <option value="USD"
                                                                            {{ isset($wealthfinance[$i]->account_type) && $wealthfinance[$i]->account_type == 'USD' ? 'selected' : '' }}>
                                                                            USD</option>
                                                                        <option value="Multi-currency"
                                                                            {{ isset($wealthfinance[$i]->account_type) && $wealthfinance[$i]->account_type == 'Multi-currency' ? 'selected' : '' }}>
                                                                            Multi-currency</option>
                                                                        <option value="Others"
                                                                            {{ isset($wealthfinance[$i]->account_type) && $wealthfinance[$i]->account_type == 'Others' ? 'selected' : '' }}>
                                                                            Others</option>
                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="account_policy_no" class="form-label">Account/Policy
                                                                        Number</label>
                                                                    <input type="text" name="financial[{{$i +1}}][account_policy_no]" id="account_policy_no"
                                                                        value="@isset($wealthfinance[$i]->account_policy_no)  {{ $wealthfinance[$i]->account_policy_no }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="account_opening_status" class="form-label">Account
                                                                        Opening
                                                                        Status</label>
                                                                    <select name="financial[{{$i +1}}][account_opening_status]" id="account_opening_status"
                                                                        class="js-example-responsive form-control">
                                                                        <option value="" selected disabled>Choose account opening
                                                                            status
                                                                        </option>
                                                                        <option value="Pending"
                                                                            {{ isset($wealthfinance[$i]->account_opening_status) && $wealthfinance[$i]->account_opening_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                        <option value="Approved"
                                                                            {{ isset($wealthfinance[$i]->account_opening_status) && $wealthfinance[$i]->account_opening_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                        <option value="Rejected"
                                                                            {{ isset($wealthfinance[$i]->account_opening_status) && $wealthfinance[$i]->account_opening_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>

                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="current_account_status" class="form-label">Current
                                                                        Account
                                                                        Status</label>
                                                                    <select name="financial[{{$i +1}}][current_account_status]" id="current_account_status"
                                                                        class="js-example-responsive form-control">
                                                                        <option value="" selected disabled>Choose account status
                                                                        </option>
                                                                        <option value="Pending"
                                                                            {{ isset($wealthfinance[$i]->current_account_status) && $wealthfinance[$i]->current_account_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                        <option value="Approved"
                                                                            {{ isset($wealthfinance[$i]->current_account_status) && $wealthfinance[$i]->current_account_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                        <option value="Rejected"
                                                                            {{ isset($wealthfinance[$i]->current_account_status) && $wealthfinance[$i]->current_account_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="money_deposit_status" class="form-label">Money Deposit
                                                                        Status</label>
                                                                    <select name="financial[{{$i +1}}][money_deposit_status]" id="money_deposit_status"
                                                                        class="js-example-responsive form-control">
                                                                        <option value="" selected disabled>Choose money deposit
                                                                            status
                                                                        </option>
                                                                        <option value="In progress"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                                        <option value="Done"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'Done' ? 'selected' : '' }}>Done</option>
                                                                        <option value="N/A"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="intial_deposit_amount" class="form-label">Initial
                                                                        Deposit
                                                                        Amount</label>
                                                                    <div class="dollersec"><span class="doller">$</span>
                                                                        <span class="input"> <input type="text"
                                                                                name="financial[{{$i +1}}][intial_deposit_amount]"
                                                                                value="@isset($wealthfinance[$i]->intial_deposit_amount) {{ $wealthfinance[$i]->intial_deposit_amount }} @endisset"
                                                                                class="form-control"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="online_account_username" class="form-label">Online
                                                                        Account
                                                                        Username</label>
                                                                    <input type="text" name="financial[{{$i +1}}][online_account_username]"
                                                                        id="online_account_username"
                                                                        value="@isset($wealthfinance[$i]->online_account_username) {{ $wealthfinance[$i]->online_account_username }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="online_account_pass" class="form-label">Online Account
                                                                        Password</label>
                                                                    <input type="text" name="financial[{{$i +1}}][online_account_pass]"
                                                                        id="online_account_pass"
                                                                        value="@isset($wealthfinance[$i]->online_account_pass) {{ $wealthfinance[$i]->online_account_pass }} @endisset"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="finacial_remarks" class="form-label">Remarks</label>
                                                                    <textarea name="financial[{{$i +1}}][finacial_remarks]" id="finacial_remarks" rows="4" cols="50"
                                                                        value="@isset($wealthfinance[$i]->finacial_remarks) {{ $wealthfinance[$i]->finacial_remarks }} @endisset"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>                                                                                                                                                                                            
                                                    </div>                                           
                                                </div> 
                                          

                                            </div> 
                                        @endfor   
                                        
                                    </div>    
                                    <div class="btn_check_finance">
                                        <button class='btn saveBtn edit_add_finance' name='edit_add_finance'>Add Financial Institution</button>
                                    </div>                                 
                                </div> 
                                                     
                              
                               
                                <div class="tab-pane fade" id="nav-pass" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <input type="hidden" name="wealth_pass_id"
                                    value="@isset($wealthpass->id) {{ $wealthpass->id }} @endisset">
                                    <div id="pass_accordion" class="mas_related">
                                        <div class="mas_heading_accordian">
                                            <div class="formAreahalf basic_data">
                                                <label for="passholder_shareholder" class="form-label">Is Passholder
                                                    also
                                                    the
                                                    shareholder</label>
                                                <select name="passholder_shareholder" id="passholder_shareholder"
                                                    value="" class="form-control">
                                                    <option value="" selected disabled>Choose is passholder also the shareholder
                                                    </option>
                                                    <option value="Yes"
                                                        {{ isset($wealthpass->passholder_shareholder) && $wealthpass->passholder_shareholder == 'Yes' ? 'selected' : '' }}>
                                                        Yes</option>
                                                    <option
                                                        value="No"{{ isset($wealthpass->passholder_shareholder) && $wealthpass->passholder_shareholder == 'No' ? 'selected' : '' }}>
                                                        No</option>
                                                </select>
                                            </div>
                                            <button class="btn btn_set" data-toggle="collapse"
                                                data-target="#pass_collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div id="pass_collapseOne" class="collapse" aria-labelledby="headingOne"
                                            data-parent="#pass_accordion">
                                            <div class="tab-inner-text d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_holder_name" class="form-label">Pass Holder Name
                                                        1
                                                        (Eng)
                                                    </label>
                                                    <input type="text" name="pass_holder_name" id="pass_holder_name"
                                                        value="@isset($wealthpass->pass_holder_name) {{ $wealthpass->pass_holder_name }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passposrt_name_chinese" class="form-label">Passport
                                                        Full
                                                        Name(Chinese)</label>
                                                    <input type="text" name="passposrt_name_chinese"
                                                        id="passposrt_name_chinese"
                                                        value="@isset($wealthpass->passposrt_name_chinese) {{ $wealthpass->passposrt_name_chinese }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="dob" class="form-label">DOB(DD/MM/YYYY)</label>
                                                    <input type="date" name="dob" id="dob"
                                                        value="@isset($wealthpass->dob) {{ $wealthpass->dob }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="gender" class="form-label">Gender(M/F)</label>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="" selected disabled>Choose gender</option>
                                                        <option value="Male"
                                                            {{ isset($wealthpass->gender) && $wealthpass->gender == 'Male' ? 'selected' : '' }}>
                                                            M
                                                        </option>
                                                        <option value="Female"
                                                            {{ isset($wealthpass->gender) && $wealthpass->gender == 'Female' ? 'selected' : '' }}>
                                                            F
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passport_expiry_date" class="form-label">Passport
                                                        Expiry
                                                        Date(DD/MM/YYYY)</label>
                                                    <input type="date" name="passport_expiry_date"
                                                        id="passport_expiry_date"
                                                        value="@isset($wealthpass->passport_expiry_date) {{ $wealthpass->passport_expiry_date }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passport_no" class="form-label">Passport
                                                        Number</label>
                                                    <input type="text" name="passport_no"
                                                        value="@isset($wealthpass->passport_no) {{ $wealthpass->passport_no }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passport_renewal_reminder" class="form-label">Passport
                                                        Renewal
                                                        Reminder</label>
                                                    <select name="passport_renewal_reminder"
                                                        id="passport_renewal_reminder" class="form-control">
                                                        <option value="" selected="" disabled="">Please
                                                            select</option>
                                                        <option value="90 days before expiry"
                                                            {{ isset($wealthpass->passport_renewal_reminder) && $wealthpass->passport_renewal_reminder == '90 days before expiry' ? 'selected' : '' }}>
                                                            90 days before expiry
                                                        </option>
                                                        <option value="120 days before expiry"
                                                            {{ isset($wealthpass->passport_renewal_reminder) && $wealthpass->passport_renewal_reminder == '120 days before expiry' ? 'selected' : '' }}>
                                                            120 days before expiry
                                                        </option>
                                                        <option value="180 days before expiry"
                                                            {{ isset($wealthpass->passport_renewal_reminder) && $wealthpass->passport_renewal_reminder == '180 days before expiry' ? 'selected' : '' }}>
                                                            180 days before expiry
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passport_country" class="form-label">Passport
                                                        Country</label>
                                                    <input type="text" name="passport_country"
                                                        value="@isset($wealthpass->passport_country) {{ $wealthpass->passport_country }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="passport_tri_frq" class="form-label">Passport Reminder
                                                        Trigger
                                                        Frequency</label>
                                                    <div class="select_box"><span class="every">Every</span><span
                                                            class="select"><select name="passport_tri_frq"
                                                                id="passport_tri_frq" class="form-control">
                                                                <option value="" selected="" disabled="">
                                                                    Please
                                                                    select</option>
                                                                <option value="Day"
                                                                    {{ isset($wealthpass->passport_tri_frq) && $wealthpass->passport_tri_frq == 'Day' ? 'selected' : '' }}>
                                                                    Day</option>
                                                                <option value="3 Days"
                                                                    {{ isset($wealthpass->passport_tri_frq) && $wealthpass->passport_tri_frq == '3 Days' ? 'selected' : '' }}>
                                                                    3 Days</option>
                                                                <option value="Week"
                                                                    {{ isset($wealthpass->passport_tri_frq) && $wealthpass->passport_tri_frq == 'Week' ? 'selected' : '' }}>
                                                                    Week</option>
                                                                <option value="2 Weeks"
                                                                    {{ isset($wealthpass->passport_tri_frq) && $wealthpass->passport_tri_frq == '2 Weeks' ? 'selected' : '' }}>
                                                                    2 Weeks</option>
                                                                <option value="4 Weeks"
                                                                    {{ isset($wealthpass->passport_tri_frq) && $wealthpass->passport_tri_frq == '4 Weeks' ? 'selected' : '' }}>
                                                                    4 Weeks</option>
                                                            </select></span></div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="tin_country_before_app" class="form-label">Tin Country
                                                        Before
                                                        Pass
                                                        Application</label>
                                                    <input type="text" name="tin_country_before_app"
                                                        value="@isset($wealthpass->tin_country_before_app) {{ $wealthpass->tin_country_before_app }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="type_of_tin_before_app" class="form-label">Type of TIN
                                                        Before
                                                        Pass
                                                        Application</label>
                                                    <select name="type_of_tin_before_app" id="type_of_tin_before_app"
                                                        class="form-control">
                                                        <option value=""selected disabled>Choose type of tin
                                                            before
                                                            pass
                                                            application</option>
                                                        <option value="WP"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'WP' ? 'selected' : '' }}>
                                                            WP</option>
                                                        <option value="SP"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'SP' ? 'selected' : '' }}>
                                                            SP</option>
                                                        <option value="EP"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'EP' ? 'selected' : '' }}>
                                                            EP</option>
                                                        <option value="LVTP"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'LVTP' ? 'selected' : '' }}>
                                                            LVTP</option>
                                                        <option value="DP"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'DP' ? 'selected' : '' }}>
                                                            DP</option>
                                                        <option value="NRIC"
                                                            {{ isset($wealthpass->type_of_tin_before_app) && $wealthpass->type_of_tin_before_app == 'NRIC' ? 'selected' : '' }}>
                                                            NRIC</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="tin_no_before_pass_app" class="form-label">TIN Number
                                                        Before
                                                        Pass
                                                        Application</label>
                                                    <input type="text" name="tin_no_before_pass_app"
                                                        value="@isset($wealthpass->tin_no_before_pass_app) {{ $wealthpass->tin_no_before_pass_app }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="phone_no" class="form-label">Phone Number</label>
                                                    <input type="text" name="phone_no"
                                                        value="@isset($wealthpass->phone_no) {{ $wealthpass->phone_no }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" name="email"
                                                        value="@isset($wealthpass->email) {{ $wealthpass->email }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="business_type" class="form-label">Business
                                                        Type</label>
                                                    <select name="business_type" class="form-control">
                                                        <option value="" selected disabled>Choose business type
                                                        </option>
                                                        <option vlaue="FO"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'FO' ? 'selected' : '' }}>FO</option>
                                                            <option vlaue="PIC"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'PIC' ? 'selected' : '' }}>PIC</option>
                                                            <option vlaue="Self-Employment"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'Self-Employment' ? 'selected' : '' }}>Self-Employment</option>
                                                            <option vlaue="Employer Guarantee"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'Employer Guarantee' ? 'selected' : '' }}>Employer Guarantee</option>
                                                            <option vlaue="PR Application"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'PR Application' ? 'selected' : '' }}>PR Application</option>
                                                            <option vlaue="PR Renewal"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'PR Renewal' ? 'selected' : '' }}>PR Renewal</option>
                                                            <option vlaue="Citizen"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                                                            <option vlaue="Others"
                                                            {{ isset($wealthpass->business_type) && $wealthpass->business_type == 'Others' ? 'selected' : '' }}>Others</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="residential_add" class="form-label">Residential
                                                        Address</label>
                                                    <input type="text" name="residential_add"
                                                        value="@isset($wealthpass->residential_add) {{ $wealthpass->residential_add }} @endisset"
                                                        class="form-control"></select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_app_status" class="form-label">Pass Application
                                                        Status</label>
                                                    <select name="pass_app_status" id="pass_app_status"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose application
                                                            status
                                                        </option>
                                                        <option value="Pending"
                                                            {{ isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Approved"
                                                            {{ isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="Rejected"
                                                            {{ isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="relation_with_pass" class="form-label">Relationship
                                                        with
                                                        Pass
                                                        Holder 1</label>
                                                    <select name="relation_with_pass" value=""
                                                        class="form-control">
                                                        <option value="" selected disabled>Choose relationship with pass holder 1</option>
                                                        <option value="Self"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Self' ? 'selected' : '' }}>Self</option>                                                            
                                                        <option value="Parents"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Parents' ? 'selected' : '' }}>Parents</option>    
                                                        <option value="Spouse"
                                                           {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Spouse' ? 'selected' : '' }}>Spouse</option>    
                                                        <option value="Children"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Children' ? 'selected' : '' }}>Children</option>    
                                                        <option value="Relatives"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Relatives' ? 'selected' : '' }}>Relatives</option>    
                                                        <option value="Friend"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Friend' ? 'selected' : '' }}>Friend</option>    
                                                        <option value="Others"
                                                            {{ isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Others' ? 'selected' : '' }}>Others</option>    
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_app_type" class="form-label">Pass Application
                                                        Type</label>
                                                    <select name="pass_app_type" id="pass_app_type"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose pass
                                                            application
                                                        </option>
                                                        <option value="EP"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'EP' ? 'selected' : '' }}>EP</option>
                                                        <option value="SP"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'SP' ? 'selected' : '' }}>SP</option>
                                                        <option value="DP"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'DP' ? 'selected' : '' }}>DP</option>
                                                        <option value="LVTP"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'LVTP' ? 'selected' : '' }}>LVTP</option>
                                                        <option value="WP"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'WP' ? 'selected' : '' }}>WP</option>
                                                        <option value="PR"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'PR' ? 'selected' : '' }}>PR</option>
                                                        <option value="Citizen"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                                                        <option value="Others"
                                                            {{ isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'Others' ? 'selected' : '' }}>Others</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_inssuance" class="form-label">Pass
                                                        Issuance</label>
                                                    <select name="pass_inssuance" id="pass_inssuance"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose Pass Issuance
                                                        </option>
                                                        <option value="In progress"
                                                            {{ isset($wealthpass->pass_inssuance) && $wealthpass->pass_inssuance == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                        <option value="Done"
                                                            {{ isset($wealthpass->pass_inssuance) && $wealthpass->pass_inssuance == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_issuance_date" class="form-label">Pass Issuance
                                                        Date</label>
                                                    <input type="date" name="pass_issuance_date"
                                                        value="@isset($wealthpass->pass_issuance_date) {{ $wealthpass->pass_issuance_date }}  @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_expiry_date" class="form-label">Pass Expiry
                                                        Date</label>
                                                    <input type="date" name="pass_expiry_date"
                                                        value="@isset($wealthpass->pass_expiry_date) {{ $wealthpass->pass_expiry_date }}  @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_renewal_reminder" class="form-label">Pass Renewal
                                                        Reminder</label>
                                                    <select name="pass_renewal_reminder" id="pass_renewal_reminder"
                                                        class="form-control">
                                                        <option value="" selected disabled>Choose pass renewal
                                                            reminder
                                                        </option>
                                                        <option value="90 days before expiry"
                                                            {{ isset($wealthpass->pass_renewal_reminder) && $wealthpass->pass_renewal_reminder == '90 days before expiry' ? 'selected' : '' }}>
                                                            90 days before expiry
                                                        </option>
                                                        <option value="120 days before expiry"
                                                            {{ isset($wealthpass->pass_renewal_reminder) && $wealthpass->pass_renewal_reminder == '120 days before expiry' ? 'selected' : '' }}>
                                                            120 days before expiry
                                                        </option>
                                                        <option value="180 days before expiry"
                                                            {{ isset($wealthpass->pass_renewal_reminder) && $wealthpass->pass_renewal_reminder == '180 days before expiry' ? 'selected' : '' }}>
                                                            180 days before expiry
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="duration" class="form-label">Duration</label>
                                                    <input type="text" name="duration"
                                                        value="@isset($wealthpass->duration) {{ $wealthpass->duration }}  @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="fin_number" class="form-label">FIN Number</label>
                                                    <input type="text" name="fin_number"
                                                        value="@isset($wealthpass->fin_number) {{ $wealthpass->fin_number }}  @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_renewal_frq" class="form-label">Pass Renewal
                                                        Trigger
                                                        Frequency</label>
                                                    <div class="select_box"><span class="every">Every</span><span
                                                            class="select"><select name="pass_renewal_frq"
                                                                id="pass_renewal_frq" class="form-control">
                                                                <option value="" selected="" disabled="">
                                                                    Please
                                                                    select</option>
                                                                <option value="Day"
                                                                    {{ isset($wealthpass->pass_renewal_frq) && $wealthpass->pass_renewal_frq == 'Day' ? 'selected' : '' }}>
                                                                    Day</option>
                                                                <option value="3 Days"
                                                                    {{ isset($wealthpass->pass_renewal_frq) && $wealthpass->pass_renewal_frq == '3 Days' ? 'selected' : '' }}>
                                                                    3 Days</option>
                                                                <option value="Week"
                                                                    {{ isset($wealthpass->pass_renewal_frq) && $wealthpass->pass_renewal_frq == 'Week' ? 'selected' : '' }}>
                                                                    Week</option>
                                                                <option value="2 Weeks"
                                                                    {{ isset($wealthpass->pass_renewal_frq) && $wealthpass->pass_renewal_frq == '2 Weeks' ? 'selected' : '' }}>
                                                                    2 Weeks</option>
                                                                <option value="4 Weeks"
                                                                    {{ isset($wealthpass->pass_renewal_frq) && $wealthpass->pass_renewal_frq == '4 Weeks' ? 'selected' : '' }}>
                                                                    4 Weeks</option>
                                                            </select></span></div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_jon_title" class="form-label">Pass. Job
                                                        Title</label>
                                                    <input type="text" name="pass_jon_title"
                                                        value="@isset($wealthpass->pass_jon_title) {{ $wealthpass->pass_jon_title }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="singpass_set_up" class="form-label">Singpass Set
                                                        Up</label>
                                                    <select name="singpass_set_up"                                                       
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose singpass set</option>
                                                        <option value="In progress" {{isset($wealthpass->singpass_set_up) && $wealthpass->singpass_set_up =="In progress" ? 'selected' : ""}}>In progress</option>   
                                                        <option value="Done"  {{isset($wealthpass->singpass_set_up) && $wealthpass->singpass_set_up =="Done" ? 'selected' : ""}}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="employee_name" class="form-label">Employer's
                                                        Name</label>
                                                    <input type="text" name="employee_name"
                                                        value="@isset($wealthpass->employee_name) {{ $wealthpass->employee_name }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="monthly_sal" class="form-label">Monthly
                                                        Salary(SGD)</label>
                                                    <input type="text" name="monthly_sal"
                                                        value="@isset($wealthpass->monthly_sal) {{ $wealthpass->monthly_sal }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="pass_remarks" class="form-label">Remarks</label>
                                                    <textarea name="pass_remarks" rows="4" cols="50"
                                                        value="@isset($wealthpass->pass_remarks) {{ $wealthpass->pass_remarks }} @endisset"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade wealth_business_tab_new" id="nav-business" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="business_data">
                                        <div id="business_accordion" class="mas_related">
                                            <input type="hidden" name="wealth_business_id"
                                              value="@isset($wealthbuss->id) {{ $wealthbuss->id }} @endisset">
                                            <div class="mas_heading_accordian">
                                                <div class="formAreahalf basic_data">
                                                    <label for="financial_institition_name" class="form-label">Financial
                                                        Institution Name 1</label>
                                                    <input type="text" name="financial_institition_name"
                                                        id="financial_institition_name"
                                                        value="@isset($wealthbuss->financial_institition_name) {{ $wealthbuss->financial_institition_name }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <button class="btn btn_set" data-toggle="collapse"
                                                    data-target="#business_collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div id="business_collapseOne" class="collapse" aria-labelledby="headingOne"
                                                data-parent="#business_accordion">
                                                <div class="tab-inner-text d-flex flex-wrap">
                                                    <div class="formAreahalf basic_data">
                                                        <label for="application_submision" class="form-label">Application
                                                            Submission</label>
                                                        <select name="application_submision" id="application_submision"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose Application
                                                                Submission
                                                            </option>
                                                            <option
                                                                value="In progress"{{ isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                            <option
                                                                value="Done"{{ isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'Done' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_status" class="form-label">Account
                                                            Status</label>
                                                        <select name="business_account_status" id="business_account_status"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose account status
                                                            </option>
                                                            <option value="Pending"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Approved"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Rejected"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_type" class="form-label">Account
                                                            Type</label>
                                                        <select name="business_account_type" class="form-control">
                                                            <option value="" selected disabled>Choose Account Type
                                                            </option>
                                                            <option
                                                                value="Insurance"{{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Insurance' ? 'selected' : '' }}>
                                                                Insurance</option>
                                                            <option value="Investment"
                                                                {{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Investment' ? 'selected' : '' }}>
                                                                Investment</option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Others' ? 'selected' : '' }}>
                                                                Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_policy_no"
                                                            class="form-label">Account/Policy
                                                            Number</label>
                                                        <input type="text" name="business_account_policy_no"
                                                            value="@isset($wealthbuss->business_account_policy_no) {{ $wealthbuss->business_account_policy_no }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" name="product_name"
                                                            value="@isset($wealthbuss->product_name) {{ $wealthbuss->product_name }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="payment_mode" class="form-label">Payment Mode</label>
                                                        <select name="payment_mode" class="form-control">
                                                            <option value="" selected disabled>Choose payment mode
                                                            </option>
                                                            <option
                                                                value="Lump Sum"{{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Lump Sum' ? 'selected' : '' }}>
                                                                Lump Sum</option>
                                                            <option value="Yearly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Yearly' ? 'selected' : '' }}>
                                                                Yearly</option>
                                                            <option value="Half-yearly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Half-yearly' ? 'selected' : '' }}>
                                                                Half-yearly</option>
                                                            <option value="Quarterly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Quarterly' ? 'selected' : '' }}>
                                                                Quarterly</option>
                                                            <option value="Monthly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Monthly' ? 'selected' : '' }}>
                                                                Monthly</option>


                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="currency" class="form-label">Currency</label>
                                                        <select name="currency" class="form-control">
                                                            <option value="" selected disabled>Choose currency
                                                            </option>
                                                            <option value="USD"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'USD' ? 'selected' : '' }}>
                                                                USD
                                                            </option>
                                                            <option value="SGD"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD
                                                            </option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'Others' ? 'selected' : '' }}>
                                                                Others
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="investment_amount" class="form-label">Investment
                                                            Amount/Premium</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="text"
                                                                    name="investment_amount"
                                                                    value="@isset($wealthbuss->investment_amount) {{ $wealthbuss->investment_amount }} @endisset"
                                                                    class="form-control"></span>
                                                        </div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="online_account_user" class="form-label">Online Account
                                                            Username</label>
                                                        <input type="text" name="online_account_user"
                                                            value="@isset($wealthbuss->online_account_user) {{ $wealthbuss->online_account_user }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="online_acc_pass" class="form-label">Online Account
                                                            Password</label>
                                                        <input type="text" name="online_acc_pass"
                                                            value="@isset($wealthbuss->online_acc_pass) {{ $wealthbuss->online_acc_pass }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="subscription" class="form-label">Subscription /
                                                            Inception
                                                            Date</label>
                                                        <input type="date" name="subscription"
                                                            value="@isset($wealthbuss->subscription){{ $wealthbuss->subscription }}@endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_date" class="form-label">Maturity
                                                            Date</label>
                                                        <input type="date" name="maturity_date"
                                                            value="@isset($wealthbuss->maturity_date){{ $wealthbuss->maturity_date }}@endisset"
                                                            class="form-control">

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_duration" class="form-label">Duration</label>
                                                        <input type="text" name="business_duration"
                                                            value="@isset($wealthbuss->business_duration){{ $wealthbuss->business_duration }}@endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_reminder" class="form-label">Maturity
                                                            Reminder</label>
                                                        <select name="maturity_reminder" class="form-control">
                                                            <option value="" selected disabled>Choose maturity
                                                                reminder
                                                            </option>
                                                            <option
                                                                value="90 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '90 days before maturity' ? 'selected' : '' }}>
                                                                90 days before maturity
                                                            </option>
                                                            <option
                                                                value="120 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '120 days before maturity' ? 'selected' : '' }}>
                                                                120 days before
                                                                maturity
                                                            </option>
                                                            <option
                                                                value="180 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '180 days before maturity' ? 'selected' : '' }}>
                                                                180 days before
                                                                maturity
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_reminder_trg" class="form-label">Maturity
                                                            Reminder
                                                            Trigger
                                                            Frequency</label>

                                                        <div class="select_box"><span class="every">Every</span><span
                                                                class="select"><select name="maturity_reminder_trg"
                                                                    id="maturity_reminder_trg" class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Please
                                                                        select</option>
                                                                    <option
                                                                        value="Day"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == 'Day' ? 'selected' : '' }}>
                                                                        Day</option>
                                                                    <option
                                                                        value="3 Days"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '3 Days' ? 'selected' : '' }}>
                                                                        3 Days</option>
                                                                    <option
                                                                        value="Week"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == 'Week' ? 'selected' : '' }}>
                                                                        Week</option>
                                                                    <option
                                                                        value="2 Weeks"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '2 Weeks' ? 'selected' : '' }}>
                                                                        2 Weeks</option>
                                                                    <option value="4 Weeks"
                                                                        {{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '4 Weeks' ? 'selected' : '' }}>
                                                                        4 Weeks</option>
                                                                </select></span></div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commision_status" class="form-label">Commisison
                                                            Status(For
                                                            Admin
                                                            Purpose)
                                                        </label>
                                                        <select name="commision_status" class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                status
                                                            </option>
                                                            <option
                                                                value="Received"{{ isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Received' ? 'selected' : '' }}>Received</option>
                                                            <option value="Pending"
                                                                {{ isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_currency" class="form-label">Commission
                                                            Currency(For Admin
                                                            Purpose)</label>
                                                        <select name="commission_currency" class="form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                currency
                                                            </option>
                                                            <option
                                                                value="USD"{{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'USD' ? 'selected' : '' }}>
                                                                USD</option>
                                                            <option value="SGD"
                                                                {{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD</option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'Others' ? 'selected' : '' }}>
                                                                Others</option>

                                                        </select>

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_amount" class="form-label">Commission
                                                            Amount(For
                                                            Admin
                                                            Purpose)</label>
                                                        <input type="text" name="commission_amount"
                                                            value="@isset($wealthbuss->commission_amount) {{ $wealthbuss->commission_amount }} @endisset"
                                                            class="form-control">
                                                    </div>                                                  
                                                  
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_remarks" class="form-label">Remarks</label>
                                                        <textarea name="business_remarks" rows="4" cols="50"
                                                            value="@isset($wealthbuss->business_remarks) {{ $wealthbuss->business_remarks }} @endisset"></textarea>
                                                    </div>
                                                </div>
                                                
                                                    <div class="redemption_add_table">
                                                        <h3>Redemption Date and Amount</h3>
                                                        {{-- <form name="business_red_table_data" class="business_redemption_tab" id="redemption_table" method="POST"> --}}
                                                           
                                                                <input type="hidden" name="business_tab_id" id="busines_tab_id" class="busines_tab_id" value="@isset($wealthbuss->id) {{$wealthbuss->id}} @endisset">
                                                                <div class="redemption_table_data">
                                                                    <div class="formAreahalf r_table">
                                                                        <label for="net_amount_val" class="form-label">Redemption
                                                                            Date</label>
                                                                        <input type="date" name="business_redemption_date"
                                                                            value=""
                                                                            class="form-control red_date">
                                                                    </div>
                                                                    <div class="formAreahalf r_table">
                                                                        <label for="net_amount_val" class="form-label">Redemption
                                                                            Amount</label>
                                                                        <div class="dollersec"><span class="doller">$</span>
                                                                            <span class="input"> <input type="text"
                                                                                    class="form-control red_amount" name="business_redemption_amount"
                                                                                    id="fo_servicing_fee_amount"
                                                                                    value=""></span>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                              
                                                            <div class="btn_adding_redempton">
                                                                <button class="btn saveBtn add_redemption btn_add_redempt">Add</button>
                                                            </div>
                                                        {{-- </form> --}}
                                                    </div>
                                                    <div class="Redemption_date edit_redemption">
                                                    
                                                        <div class="table">
                                                            <table class="table" id="red_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Redemption Date</th>
                                                                        <th>Redemption Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  
                                                                    @if(isset($wealthbuss->business_redempt) && count($wealthbuss->business_redempt)> 0)
                                                                
                                                                    @foreach($wealthbuss->business_redempt as $redemption_data)
                                                                   
                                                                    <tr>
                                                                        <td>{{date('d/m/Y', strtotime($redemption_data->red_date))}}</td>
                                                                        <td>{{$redemption_data->red_amount}}</td>
                                                                        <td><a href="javascript:void(0);" data-id="{{$redemption_data->id}}" title="Delete" class="btn del_confirm_business"><i class="fa-solid fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @else
                                                                    <tr>
                                                                        <td colspan="3">No record found</td>
                                                                    </tr>
                                                                    @endif
                                                                </tbody>
                                                                </tbody>
                                                            </table>
        
                                                        </div>
                                                    </div>
                                                    <div class="last_net_business">
                                                        <div class="formAreahalf basic_data">
                                                            <label for="net_amount_val" class="form-label">Net Account
                                                                Value</label>
                                                            <div class="dollersec"><span class="doller">$</span>
                                                                <span class="input"> <input type="text"
                                                                        class="form-control" name="net_amount_val"
                                                                        id="net_amount_val"
                                                                        value="@isset($wealthbuss->net_amount_val) {{ $wealthbuss->net_amount_val }} @endisset"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else                               
                                <div class="tab-pane fade show active wealth_business_tab_new" id="nav-business" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="business_data">
                                        <div id="business_accordion" class="mas_related">
                                            <input type="hidden" name="wealth_business_id"
                                            value="@isset($wealthbuss->id) {{ $wealthbuss->id }} @endisset">
                                            <div class="mas_heading_accordian">
                                                <div class="formAreahalf basic_data">
                                                    <label for="financial_institition_name" class="form-label">Financial
                                                        Institution Name 1</label>
                                                    <input type="text" name="financial_institition_name"
                                                        id="financial_institition_name"
                                                        value="@isset($wealthbuss->financial_institition_name) {{ $wealthbuss->financial_institition_name }} @endisset"
                                                        class="form-control">
                                                </div>
                                                <button class="btn btn_set" data-toggle="collapse"
                                                    data-target="#business_collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div id="business_collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#business_accordion">
                                                <div class="tab-inner-text d-flex flex-wrap">
                                                    <div class="formAreahalf basic_data">
                                                        <label for="application_submision" class="form-label">Application
                                                            Submission</label>
                                                        <select name="application_submision" id="application_submision"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose Application
                                                                Submission
                                                            </option>
                                                            <option
                                                                value="In progress"{{ isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'In progress' ? 'selected' : '' }}>In progress</option>
                                                            <option
                                                                value="Done"{{ isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'Done' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_status" class="form-label">Account
                                                            Status</label>
                                                        <select name="business_account_status" id="business_account_status"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose account status
                                                            </option>
                                                            <option value="Pending"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Approved"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Rejected"
                                                                {{ isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_type" class="form-label">Account
                                                            Type</label>
                                                        <select name="business_account_type" class="form-control">
                                                            <option value="" selected disabled>Choose Account Type
                                                            </option>
                                                            <option
                                                                value="Insurance"{{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Insurance' ? 'selected' : '' }}>
                                                                Insurance</option>
                                                            <option value="Investment"
                                                                {{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Investment' ? 'selected' : '' }}>
                                                                Investment</option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Others' ? 'selected' : '' }}>
                                                                Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_policy_no"
                                                            class="form-label">Account/Policy
                                                            Number</label>
                                                        <input type="text" name="business_account_policy_no"
                                                            value="@isset($wealthbuss->business_account_policy_no) {{ $wealthbuss->business_account_policy_no }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" name="product_name"
                                                            value="@isset($wealthbuss->product_name) {{ $wealthbuss->product_name }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="payment_mode" class="form-label">Payment Mode</label>
                                                        <select name="payment_mode" class="form-control">
                                                            <option value="" selected disabled>Choose payment mode
                                                            </option>
                                                            <option
                                                                value="Lump Sum"{{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Lump Sum' ? 'selected' : '' }}>
                                                                Lump Sum</option>
                                                            <option value="Yearly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Yearly' ? 'selected' : '' }}>
                                                                Yearly</option>
                                                            <option value="Half-yearly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Half-yearly' ? 'selected' : '' }}>
                                                                Half-yearly</option>
                                                            <option value="Quarterly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Quarterly' ? 'selected' : '' }}>
                                                                Quarterly</option>
                                                            <option value="Monthly"
                                                                {{ isset($wealthbuss->payment_mode) && $wealthbuss->payment_mode == 'Monthly' ? 'selected' : '' }}>
                                                                Monthly</option>


                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="currency" class="form-label">Currency</label>
                                                        <select name="currency" class="form-control">
                                                            <option value="" selected disabled>Choose currency
                                                            </option>
                                                            <option value="USD"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'USD' ? 'selected' : '' }}>
                                                                USD
                                                            </option>
                                                            <option value="SGD"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD
                                                            </option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->currency) && $wealthbuss->currency == 'Others' ? 'selected' : '' }}>
                                                                Others
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="investment_amount" class="form-label">Investment
                                                            Amount/Premium</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="text"
                                                                    name="investment_amount"
                                                                    value="@isset($wealthbuss->investment_amount) {{ $wealthbuss->investment_amount }} @endisset"
                                                                    class="form-control"></span>
                                                        </div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="online_account_user" class="form-label">Online Account
                                                            Username</label>
                                                        <input type="text" name="online_account_user"
                                                            value="@isset($wealthbuss->online_account_user) {{ $wealthbuss->online_account_user }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="online_acc_pass" class="form-label">Online Account
                                                            Password</label>
                                                        <input type="text" name="online_acc_pass"
                                                            value="@isset($wealthbuss->online_acc_pass) {{ $wealthbuss->online_acc_pass }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="subscription" class="form-label">Subscription /
                                                            Inception
                                                            Date</label>
                                                        <input type="date" name="subscription"
                                                            value="@isset($wealthbuss->subscription){{ $wealthbuss->subscription }}@endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_date" class="form-label">Maturity
                                                            Date</label>
                                                        <input type="date" name="maturity_date"
                                                            value="@isset($wealthbuss->maturity_date){{ $wealthbuss->maturity_date }}@endisset"
                                                            class="form-control">

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_duration" class="form-label">Duration</label>
                                                        <input type="text" name="business_duration"
                                                            value="@isset($wealthbuss->business_duration){{ $wealthbuss->business_duration }}@endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_reminder" class="form-label">Maturity
                                                            Reminder</label>
                                                        <select name="maturity_reminder" class="form-control">
                                                            <option value="" selected disabled>Choose maturity
                                                                reminder
                                                            </option>
                                                            <option
                                                                value="90 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '90 days before maturity' ? 'selected' : '' }}>
                                                                90 days before maturity
                                                            </option>
                                                            <option
                                                                value="120 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '120 days before maturity' ? 'selected' : '' }}>
                                                                120 days before
                                                                maturity
                                                            </option>
                                                            <option
                                                                value="180 days before maturity"{{ isset($wealthbuss->maturity_reminder) && $wealthbuss->maturity_reminder == '180 days before maturity' ? 'selected' : '' }}>
                                                                180 days before
                                                                maturity
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_reminder_trg" class="form-label">Maturity
                                                            Reminder
                                                            Trigger
                                                            Frequency</label>

                                                        <div class="select_box"><span class="every">Every</span><span
                                                                class="select"><select name="maturity_reminder_trg"
                                                                    id="maturity_reminder_trg" class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Please
                                                                        select</option>
                                                                    <option
                                                                        value="Day"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == 'Day' ? 'selected' : '' }}>
                                                                        Day</option>
                                                                    <option
                                                                        value="3 Days"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '3 Days' ? 'selected' : '' }}>
                                                                        3 Days</option>
                                                                    <option
                                                                        value="Week"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == 'Week' ? 'selected' : '' }}>
                                                                        Week</option>
                                                                    <option
                                                                        value="2 Weeks"{{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '2 Weeks' ? 'selected' : '' }}>
                                                                        2 Weeks</option>
                                                                    <option value="4 Weeks"
                                                                        {{ isset($wealthbuss->maturity_reminder_trg) && $wealthbuss->maturity_reminder_trg == '4 Weeks' ? 'selected' : '' }}>
                                                                        4 Weeks</option>
                                                                </select></span></div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commision_status" class="form-label">Commisison
                                                            Status(For
                                                            Admin
                                                            Purpose)
                                                        </label>
                                                        <select name="commision_status" class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                status
                                                            </option>
                                                            <option
                                                                value="Received"{{ isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Received' ? 'selected' : '' }}>Received</option>
                                                            <option value="Pending"
                                                                {{ isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_currency" class="form-label">Commission
                                                            Currency(For Admin
                                                            Purpose)</label>
                                                        <select name="commission_currency" class="form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                currency
                                                            </option>
                                                            <option
                                                                value="USD"{{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'USD' ? 'selected' : '' }}>
                                                                USD</option>
                                                            <option value="SGD"
                                                                {{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD</option>
                                                            <option value="Others"
                                                                {{ isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'Others' ? 'selected' : '' }}>
                                                                Others</option>

                                                        </select>

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_amount" class="form-label">Commission
                                                            Amount(For
                                                            Admin
                                                            Purpose)</label>
                                                        <input type="text" name="commission_amount"
                                                            value="@isset($wealthbuss->commission_amount) {{ $wealthbuss->commission_amount }} @endisset"
                                                            class="form-control">
                                                    </div>

                                                    {{-- <div class="formAreahalf basic_data">
                                                        <label for="net_amount_val" class="form-label">Redemption
                                                            Date</label>
                                                        <input type="date" name="business_redemption_date"
                                                            value="@isset($wealthbuss->business_redemption_date){{ $wealthbuss->business_redemption_date }}@endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="net_amount_val" class="form-label">Redemption
                                                            Amount</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="text"
                                                                    class="form-control" name="business_redemption_amount"
                                                                    id="fo_servicing_fee_amount"
                                                                    value="@isset($wealthbuss->business_redemption_amount) {{ $wealthbuss->business_redemption_amount }} @endisset"></span>
                                                        </div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="net_amount_val" class="form-label">Net Account
                                                            Value</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="text"
                                                                    class="form-control" name="net_amount_val"
                                                                    id="net_amount_val"
                                                                    value="@isset($wealthbuss->net_amount_val) {{ $wealthbuss->net_amount_val }} @endisset"></span>
                                                        </div>
                                                    </div> --}}
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_remarks" class="form-label">Remarks</label>
                                                        <textarea name="business_remarks" rows="4" cols="50"
                                                            value="@isset($wealthbuss->business_remarks) {{ $wealthbuss->business_remarks }} @endisset"></textarea>
                                                    </div>
                                                </div>
                                            
                                                    
                                                <div class="redemption_add_table">
                                                    <h3>Redemption Date and Amount</h3>
                                                    
                                                    <input type="hidden" name="business_tab_id" id="busines_tab_id" class="busines_tab_id" value="@isset($wealthbuss->id) {{$wealthbuss->id}} @endisset">
                                                            <div class="redemption_table_data">
                                                                <div class="formAreahalf r_table">
                                                                    <label for="net_amount_val" class="form-label">Redemption
                                                                        Date</label>
                                                                    <input type="date" name="business_redemption_date"
                                                                        value=""
                                                                        class="form-control red_date">
                                                                </div>
                                                                <div class="formAreahalf r_table">
                                                                    <label for="net_amount_val" class="form-label">Redemption
                                                                        Amount</label>
                                                                    <div class="dollersec"><span class="doller">$</span>
                                                                        <span class="input"> <input type="text"
                                                                                class="form-control red_amount" name="business_redemption_amount"
                                                                                id="fo_servicing_fee_amount"
                                                                                value=""></span>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        
                                                        <div class="btn_adding_redempton">
                                                            <button class="btn saveBtn add_redemption btn_add_redempt">Add</button>
                                                        </div>
                                                    
                                                </div>
                                                <div class="Redemption_date edit_redemption">
                                                
                                                    <div class="table">
                                                        <table class="table" id="red_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Redemption Date</th>
                                                                    <th>Redemption Amount</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                                @if(isset($wealthbuss->business_redempt) && count($wealthbuss->business_redempt)> 0)
                                                            
                                                                @foreach($wealthbuss->business_redempt as $redemption_data)
                                                            
                                                                <tr>
                                                                    <td>{{date('d/m/Y', strtotime($redemption_data->red_date))}}</td>
                                                                    <td>{{$redemption_data->red_amount}}</td>
                                                                    <td><a href="javascript:void(0);" data-id="{{$redemption_data->id}}" title="Delete" class="btn del_confirm_business"><i class="fa-solid fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="3">No record found</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="last_net_business">
                                                    <div class="formAreahalf basic_data">
                                                        <label for="net_amount_val" class="form-label">Net Account
                                                            Value</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="text"
                                                                    class="form-control" name="net_amount_val"
                                                                    id="net_amount_val"
                                                                    value="@isset($wealthbuss->net_amount_val) {{ $wealthbuss->net_amount_val }} @endisset"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                           
                            @endif
                        </div>
                        
                    </div>

                </div>
            </div>

            <div class="lower-bottom">
                <div class="notes-common formContentData">
                    <!-- <form action="javascript:void(0)" method="POST" name="notes" id="notes" class="note_send"> -->
                        <input type="hidden" value="Wealth" name="tbl_name">
                        <input type="hidden" value="{{ $data->id }}" name="application_id">
                        <input type="hidden" value="{{ Auth::user()->name }}" name="created_by_name">
                        <div class="textarea">
                            <label class="form-label mt-5" for="notes">Notes</label>
                            <textarea id="text_notes" name="notes" rows="8" cols="200" placeholder="Type your notes here..."></textarea>
                            <div id="notes_error"></div>
                            <!-- <input type="submit" id="w_notessave_btn"
                                class="btn saveBtn btn saveBtn btn_notes" value="Save">
                            <input type="button" id="notes_cancel" class="btn saveBtn cancelBtn delete" value="Cancel"
                            style="display: none"> -->
                        </div>
                    <!-- </form> -->
                    @foreach ($notes as $note)
                        <div class="notes_show">
                            <p class="desc_notes">{{ $note->notes_description }}</p>
                            <p class="created">{{ \Carbon\Carbon::parse($note->created_at)->format('d/m/Y h:m a') }}</p>
                            <p class="createdby"><b>{{ $note->created_by }}</b></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
        <div class="lower-bottom">
            <div class="card file upload company_file_upload_info formContentData border-0 p-4 ">
                <h3>File Uploads</h3>
                <form action="javascript:void(0);" method="POST" id="file_wealt_upload" name="file_form" class="file_wealt_upload" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="wealth_id" value="{{ $data->id }}">
                    <div class="mb-3">
                        <input type="file" name="wealth_inputFile" class="form-control" id="wealth_inputFile"
                            class="form-control">

                        {{-- <input type="file" name="wealth_file" id="wealth_inputFile" class="form-control"> --}}
                        <div> <span class="text-danger" id="file-input-error"></span></div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn saveBtn file_upload_submit">Upload</button>
                    </div>
                </form>
                <table class="table user_action_log">
                    <thead>
                        <tr>
                            <th scope="col">File Name</th>
                            <th scope="col">Uploaded by</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($file) > 0)
                            @foreach ($file as $files)
                                <tr>
                                    <td>{{ $files->file }}</td>
                                    <td>{{ $files->uploaded_by_name }}</td>
                                    <td>{{ $files->created_at->format('j F Y  g:i a') }}</td>
                                    <td>
                                        <a href="{{ url('file/' . $files->file) }}" download class="link-normal">
                                            <i class="fa-solid fa-download"></i></a>

                                        <a href="javascript:void(0);" class="wealth_file_del_confirm"
                                            data-id="{{ $files->id }}"><i class="fa-solid fa-trash ms-2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="no_tab_data">No file uploaded yet.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="{{ asset('js/wealth_edit.js') }}?v={{ time() }}" type="text/javascript"></script>
    <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            var form = $("#operation_form");
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
            $(document).on('change', '#fo_cpm2_relation', function() {
                if ($(this).val() == "Others") {
                    var tpb_id = $(this).attr('data-id');
                    var tpb_key = $(this).attr('data-key');
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                                                <label for="" class="form-label">Please Specify</label>
                                                <input type="text" class="form-control"
                                                    name="share[` +tpb_id + `][` +tpb_key + `][please_specify]"
                                                    value="">
                                            </div>`           
                    );
                    // ++o;

                } else {
                    $(this).parents().next('.please_specify').remove();
                }


            });
        });
    </script>
@endpush
