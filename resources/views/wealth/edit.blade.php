@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
    </div>
    <div class="filterBtn viewSave d-flex align-items-center justify-content-end">
        <button class="btn saveBtn edit_save"><span>Save</span></button>
        <a href="{{ route('wealth.show', $data->id) }}"><button
            class="btn saveBtn cancelBtn"><span>Cancel</span></button></a>
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
                        @if (isset($basic_data->type_of_fo) && $basic_data->type_of_fo == 'Others')
                            <div class="formAreahalf basic_data please_specify">
                                <label for="" class="form-label">Others, please specify</label>
                                @if (isset($basic_data->type_of_fo_specify))
                                <p>{{ $basic_data->type_of_fo_specify }}</p>
                                @else-
                                @endif

                            </div>
                        @endif
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Date of contract (DD/MM/YYYY)</label>
                            <input type="date" class="form-control" name="date_of_contract"
                                        value="{{$basic_data->date_of_contract ?? ''}}" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Client Type</label>
                            <p>{{ $data->client_type }}</p>
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
                            <label for="" class="form-label">Created By</label>
                            <p>{{ $data->users->name }}</p>
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
                            <label for="" class="form-label">One Time Servicing Fee Amount</label>
                            <div class="dollersec"><span class="doller">$</span>
                                <span class="input"> <input type="integer" class="form-control" name="servicing_fee"
                                        id="fo_servicing_fee_amount" value="{{ $basic_data->servicing_fee }}"></span>
                            </div>
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
                            <label for="" class="form-label">Annual Servicing Fee Amount</label>
                            <div class="dollersec"><span class="doller">$</span>
                                <span class="input"> <input type="integer" class="form-control" name="annual_servicing_fee"
                                        value="{{ $basic_data->annual_servicing_fee }}"></span>
                            </div>
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
                            <label for="" class="form-label">Annual Servicing Fee Due Date (DD/MM/YYYY)</label>

                            <input type="date" class="form-control" name="annual_fee_due_date"
                                        value="{{$basic_data->annual_fee_due_date ?? ''}}" placeholder="dd/mm/yyyy">

                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Annual Servicing Fee Due Reminder</label>
                            <select
                                name="annual_fee_due_reminder"
                                id="annual_fee_due_reminder" class="form-control">
                                    <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                                    <option value="30 day before due"
                                        {{ $basic_data->annual_fee_due_reminder == '30 day before due' ? 'selected' : '' }}>
                                        30 Days before due
                                    </option>
                                    <option value="60 day before due"
                                        {{ $basic_data->annual_fee_due_reminder == '60 day before due' ? 'selected' : '' }}>
                                        60 Days before due
                                    </option>

                                </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Annual Servicing Fee Due Reminder Trigger Frequency</label>
                            <select class="js-example-responsive form-control" name="annual_fee_due_reminder_trigger">
                                <option value="" selected="" disabled="">Please select</option>
                                <option value="Day"
                                    {{ isset($basic_data->annual_fee_due_reminder_trigger) && $basic_data->annual_fee_due_reminder_trigger == 'Day' ? 'selected' : '' }} >
                                    Day
                                </option>
                                <option value="3 Days"
                                    {{ isset($basic_data->annual_fee_due_reminder_trigger) && $basic_data->annual_fee_due_reminder_trigger == '3 Daya' ? 'selected' : '' }}>
                                    3 Days
                                </option>
                                <option value="Week"
                                    {{ isset($basic_data->annual_fee_due_reminder_trigger) && $basic_data->annual_fee_due_reminder_trigger == 'Week' ? 'selected' : '' }}>
                                    Week
                                </option>
                                <option  value="2 Weeks"
                                    {{ isset($basic_data->annual_fee_due_reminder_trigger) && $basic_data->annual_fee_due_reminder_trigger == '2 Weeks' ? 'selected' : '' }}>
                                    2 Weeks
                                </option>
                                <option value="4 Weeks"
                                    {{ isset($basic_data->annual_fee_due_reminder_trigger) && $basic_data->annual_fee_due_reminder_trigger == '4 Weeks' ? 'selected' : '' }}>
                                    4 Weeks
                                </option>
                            </select>
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
            <div class="card company_info formContentData border-0 p-4 companyFormJs">

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
                                        aria-controls="nav-profile" aria-selected="false">Financial Institution Related</button>
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
                                                    <input type="tel" name="tax_advisor_no" id="tax_advisor_no"
                                                        value="@isset($wealth_mas->tax_advisor_no) {{ $wealth_mas->tax_advisor_no }} @endisset"
                                                        class="form-control" maxlength="14">
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
                                                        <option value="Progress"
                                                            {{ isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'Progress' ? 'selected' : '' }}>Progress</option>
                                                        <option value="Done"
                                                            {{ isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'Done' ? 'selected' : '' }}>Done</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="deck_submission" class="form-label">Legal
                                                        Opinion</label>
                                                    <select name="deck_submission" id="deck_submission"
                                                        class="js-example-responsive form-control">
                                                        <option value="" selected disabled>Choose Legal Opinion
                                                        </option>
                                                        <option value="Pending"
                                                            {{ isset($wealth_mas->deck_submission) && $wealth_mas->deck_submission == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Received"
                                                            {{ isset($wealth_mas->deck_submission) && $wealth_mas->deck_submission == 'Received' ? 'selected' : '' }}>Received</option>
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
                                                            value="Progress"{{ isset($wealth_mas->presentation_deck) && $wealth_mas->presentation_deck == 'Progress' ? 'selected' : '' }}>Progress</option>
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
                                                            value="Progress"{{ isset($wealth_mas->tax_advisor_name) && $wealth_mas->masnet_account == 'Progress' ? 'selected' : '' }}>Progress</option>
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
                                                            value="Progress"{{ isset($wealth_mas->final_submission) && $wealth_mas->final_submission == 'Progress' ? 'selected' : '' }}>Progress</option>
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
                                                    <label for="commencement_date" class="form-label">Commencement Date (DD/MM/YYYY)</label>
                                                    <input type="date" name="commencement_date" id="commencement_date"
                                                        value="{{$wealth_mas->commencement_date ?? ''}}"
                                                        class="form-control" placeholder="dd/mm/yyyy">

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
                                                        Deadline (DD/MM/YYYY)</label>
                                                    <input type="date" name="annual_declaration_deadline"
                                                        id="annual_declaration_deadline"
                                                        value="{{$wealth_mas->annual_declaration_deadline ?? ''}}"
                                                        class="form-control" placeholder="dd/mm/yyyy">
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
                                                    <label for="trigger_fqy_rem" class="form-label">Annual Declaration Reminder Trigger Frequency</label>
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
                                                            <button class="btn btn_set edit_new_btn_set collapsed" data-toggle="collapse"
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
                                                                            value="Progress"{{ isset($wealthfinance[$i]->application_submission) && $wealthfinance[$i]->application_submission == 'Progress' ? 'selected' : '' }}>Progress</option>
                                                                        <option
                                                                            value="Done"{{ isset($wealthfinance[$i]->application_submission) && $wealthfinance[$i]->application_submission == 'Done' ? 'selected' : '' }}>Done</option>

                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="application_submission_date" class="form-label">Application Submission Date</label>
                                                                    <input type="date" name="financial[{{$i +1}}][application_submission_date]" id="application_submission_date"
                                                                        value="{{$wealthfinance[$i]->application_submission_date ?? ''}}"
                                                                        class="form-control" placeholder="dd/mm/yyyy">
                                                                </div>
                                                                @if(!empty($wealthfinance[$i]->account_type) && isJson($wealthfinance[$i]->account_type) )
                                                                @php
                                                                    $account_type =json_decode($wealthfinance[$i]->account_type);
                                                                    $api = 1;
                                                                @endphp
                                                                    @foreach($account_type as $ap)
                                                                        <div class="formAreahalf basic_data">
                                                                            <label for="account_type" class="form-label">Account Type {{$api}}</label>
                                                                            <select name="financial[{{$i +1}}][account_type][]" id="account_type" class="form-control" data-id= "{{$i +1}}">
                                                                                <option value="" selected disabled>Choose account type
                                                                                </option>
                                                                                <option value="SGD"
                                                                                    {{ isset($ap) && $ap == 'SGD' ? 'selected' : '' }}>
                                                                                    SGD</option>
                                                                                <option value="USD"
                                                                                    {{ isset($ap) && $ap == 'USD' ? 'selected' : '' }}>
                                                                                    USD</option>
                                                                                <option value="Multi-currency"
                                                                                    {{ isset($ap) && $ap == 'Multi-currency' ? 'selected' : '' }}>
                                                                                    Multi-currency</option>
                                                                                <option value="Others"
                                                                                    {{ isset($ap) && $ap == 'Others' ? 'selected' : '' }}>
                                                                                    Others</option>
                                                                            </select>
                                                                            @if ($api == 1)
                                                                                <input type="button" class="btn saveBtn add_account_type" value="Add Account Type" data-id="{{($i + 1)}}" data-aclick="{{count($account_type)}}">
                                                                            @endif
                                                                            @php $api++; @endphp
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                @php
                                                                    $ap = (!empty($wealthfinance) && !empty($wealthfinance[$i]->account_type)) ? $wealthfinance[$i]->account_type : "";

                                                                    $api = 1;
                                                                @endphp
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="account_type" class="form-label">Account Type {{$api}}</label>
                                                                        <select name="financial[{{$i +1}}][account_type][]" id="account_type" class="form-control" data-id= "{{$i +1}}">
                                                                            <option value="" selected disabled>Choose account type
                                                                            </option>
                                                                            <option value="SGD"
                                                                                {{ isset($ap) && $ap == 'SGD' ? 'selected' : '' }}>
                                                                                SGD</option>
                                                                            <option value="USD"
                                                                                {{ isset($ap) && $ap == 'USD' ? 'selected' : '' }}>
                                                                                USD</option>
                                                                            <option value="Multi-currency"
                                                                                {{ isset($ap) && $ap == 'Multi-currency' ? 'selected' : '' }}>
                                                                                Multi-currency</option>
                                                                            <option value="Others"
                                                                                {{ isset($ap) && $ap == 'Others' ? 'selected' : '' }}>
                                                                                Others</option>
                                                                        </select>
                                                                        @if ($api == 1)
                                                                            <input type="button" class="btn saveBtn add_account_type" value="Add Account Type" data-id="{{($i + 1)}}" data-aclick="{{($api +1)}}">
                                                                        @endif
                                                                    </div>
                                                                @endif

                                                                @if (isset($wealthfinance[$i]->account_type) && $wealthfinance[$i]->account_type == 'Others')
                                                                    @if(!empty($wealthfinance[$i]->account_type) && isJson($wealthfinance[$i]->account_type) )
                                                                        @php
                                                                            $account_type_specify = json_decode($wealthfinance[$i]->account_type_specify); $apsi = 1;
                                                                        @endphp
                                                                        @foreach($account_type_specify as $aps)
                                                                                <div class="formAreahalf basic_data please_specify">
                                                                                    <label for="" class="form-label">Others, please specify{{$apsi}}</label>
                                                                                    <input type="text" class="form-control"
                                                                                            name="financial[{{$i +1}}][account_type_specify][]"
                                                                                            value="{{ isset($aps) ? $aps : '' }}">


                                                                                </div>
                                                                            @php $apsi++; @endphp
                                                                        @endforeach
                                                                    @else
                                                                        @php
                                                                            $aps = $wealthfinance[$i]->account_type_specify; $apsi = 1;
                                                                        @endphp
                                                                            <div class="formAreahalf basic_data please_specify">
                                                                                <label for="" class="form-label">Others, please specify{{$apsi}}</label>
                                                                                <input type="text" class="form-control"
                                                                                        name="financial[{{$i +1}}][account_type_specify][]"
                                                                                        value="{{ isset($aps) ? $aps : '' }}">


                                                                            </div>
                                                                    @endif
                                                                @endif

                                                                @if(!empty($wealthfinance[$i]->account_policy_no) && isJson($wealthfinance[$i]->account_policy_no) )

                                                                    @php
                                                                        $account_policy_no =json_decode($wealthfinance[$i]->account_policy_no);
                                                                        $apni = 1;
                                                                    @endphp
                                                                    @foreach($account_policy_no as $apn)
                                                                        <div class="formAreahalf basic_data">
                                                                            <label for="account_policy_no" class="form-label">Account/Policy
                                                                                Number{{$apni}}</label>
                                                                            <input type="text" name="financial[{{$i +1}}][account_policy_no][]" id="account_policy_no"
                                                                                value="@isset($apn)  {{ $apn }} @endisset"
                                                                                class="form-control">
                                                                        </div>
                                                                        @php $apni++; @endphp
                                                                    @endforeach
                                                                @else
                                                                    @php
                                                                    $apn = (!empty($wealthfinance) && !empty($wealthfinance[$i]->account_policy_no)) ? $wealthfinance[$i]->account_policy_no : "";

                                                                        $apni = 1;
                                                                    @endphp
                                                                    <div class="formAreahalf basic_data">
                                                                        <label for="account_policy_no" class="form-label">Account/Policy
                                                                            Number{{$apni}}</label>
                                                                        <input type="text" name="financial[{{$i +1}}][account_policy_no][]" id="account_policy_no"
                                                                            value="@isset($apn)  {{ $apn }} @endisset"
                                                                            class="form-control">
                                                                    </div>
                                                                @endif
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
                                                                        <option value="Progress"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'Progress' ? 'selected' : '' }}>Progress</option>
                                                                        <option value="Done"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'Done' ? 'selected' : '' }}>Done</option>
                                                                        <option value="N/A"
                                                                            {{ isset($wealthfinance[$i]->money_deposit_status) && $wealthfinance[$i]->money_deposit_status == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="intial_deposit_amount" class="form-label">Initial Deposit Currency</label>
                                                                    <select name="financial[{{$i +1}}][intial_deposit_currency]" id="intial_deposit_currency"
                                                                        class="js-example-responsive form-control">
                                                                        <option value="" selected disabled>Choose money deposit
                                                                            Currency
                                                                        </option>
                                                                        <option value="SGD"
                                                                            {{ isset($wealthfinance[$i]->intial_deposit_currency) && $wealthfinance[$i]->intial_deposit_currency == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                                        <option value="USD"
                                                                            {{ isset($wealthfinance[$i]->intial_deposit_currency) && $wealthfinance[$i]->intial_deposit_currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                                        <option value="Mult-currency"
                                                                            {{ isset($wealthfinance[$i]->intial_deposit_currency) && $wealthfinance[$i]->intial_deposit_currency == 'Mult-currency' ? 'selected' : '' }}>Mult-currency</option>
                                                                        <option value="Others"
                                                                        {{ isset($wealthfinance[$i]->intial_deposit_currency) && $wealthfinance[$i]->intial_deposit_currency == 'Others' ? 'selected' : '' }}>Others</option>

                                                                    </select>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="intial_deposit_amount" class="form-label">Initial
                                                                        Deposit
                                                                        Amount</label>
                                                                    <div class="dollersec"><span class="doller">$</span>
                                                                        <span class="input"> <input type="integer"
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
                                                                        value="@isset($wealthfinance[$i]->finacial_remarks) {{ $wealthfinance[$i]->finacial_remarks }} @endisset">@isset($wealthfinance[$i]->finacial_remarks) {{ $wealthfinance[$i]->finacial_remarks }} @endisset</textarea>
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
                                    <div id="pass_accordion" class="passholders_itemsJs">
                                        @foreach($wealthpass as $passholder_key => $passholder_item)
                                        @php $passholder_key++; @endphp
                                        <div id="passholder_item{{$passholder_key}}" class="mas_related passholder_itemJs">
                                        <input type="hidden" name="passholder[{{$passholder_key}}][wealth_pass_id]" value="{{$passholder_item->id}}" class="passholder_idJs">
                                            <div class="mas_heading_accordian">
                                                <div class="formAreahalf basic_data">
                                                    <label for="passholder_shareholder" class="form-label">Is Passholder
                                                        also
                                                        the
                                                        shareholder</label>
                                                    <select name="passholder[{{$passholder_key}}][passholder_shareholder]" id="passholder_shareholder" data-key="{{$passholder_key}}"
                                                        class="form-control shareholdersJs">
                                                        <option value="" selected disabled>Choose is passholder also the shareholder
                                                        </option>
                                                        <option value="Yes"
                                                            {{ isset($passholder_item->passholder_shareholder) && $passholder_item->passholder_shareholder == 'Yes' ? 'selected' : '' }}>
                                                            Yes</option>
                                                        <option
                                                            value="No"{{ isset($passholder_item->passholder_shareholder) && $passholder_item->passholder_shareholder == 'No' ? 'selected' : '' }}>
                                                            No</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn_set edit_new_btn_set" data-toggle="collapse"
                                                    data-target="#pass_collapse_{{$passholder_key}}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                                <div class="cross financial_wealth"><span class="edit_cancel_share remove_item delete_passholderJs" data-id="{{$passholder_key}}" data-passholder_id="{{$passholder_item->id}}">x</span></div>
                                            </div>
                                            @if($passholder_item->passholder_shareholder == 'Yes')
                                            <div id="pass_collapse_{{$passholder_key}}" class="collapse" aria-labelledby="headingOne" data-parent="#pass_accordion">
                                                @include('wealth.passholder_shareholder')
                                            </div>
                                            @else
                                            <div id="pass_collapse_{{$passholder_key}}" class="collapse" aria-labelledby="headingOne" data-parent="#pass_accordion">
                                                @include('wealth.passholder')
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="btn_check_finance">
                                        <button class='btn saveBtn' id="add_passholder">Add Passholder</button>
                                    </div>
                                </div>

                                <div class="tab-pane fade wealth_business_tab_new" id="nav-business" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="business_data business_itemsJs">
                                    @foreach($wealthbuss as $business_item_key => $business_item)
                                        @include('wealth.business_item')
                                    @endforeach
                                    </div>
                                    <div class="btn_check_finance">
                                        <button class='btn saveBtn' id="add_business_item">Add Business</button>
                                    </div>
                                </div>
                            @else
                                <div class="tab-pane fade show active wealth_business_tab_new" id="nav-business" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <div class="business_data business_itemsJs">
                                    @foreach($wealthbuss as $business_item_key => $business_item)
                                        @include('wealth.business_item')
                                    @endforeach
                                    </div>
                                    <div class="btn_check_finance">
                                        <button class='btn saveBtn' id="add_business_item">Add Business</button>
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
                        <div class="notes_show" id="note{{$note->id }}">
                        <div class="cross"><span class="note_remove" data-Id="{{ $note->id }}">x</span></div>
                            <p class="desc_notes">{{ $note->notes_description }}</p>
                            <p class="created">{{ $note->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</p>
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
                <!-- <span class="fileUploadType">.jpg, .png, .pdf, .doc, .ppt or .zip format. Max file size 100 MB</span> -->
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
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
                                        <td><a href="{{asset('file/'.$files->file)}}" target="_blank" >{{ $files->file }}</a></td>
                                        <td>{{ $files->uploaded_by_name }}</td>
                                        <td>{{ $files->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td>
                                        <td>
                                            <a href="{{ url('file/' . $files->file) }}" download class="link-normal">
                                                <i class="fa-solid fa-download"></i></a>

                                            <a href="javascript:void(0);" class="wealth_file_del_confirm"
                                                data-id="{{ $files->id }}"><i class="fa-solid fa-trash"></i></a>
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
            $(document).on('change', '#account_type', function() {
                if ($(this).val() == "Others") {
                    var tpb_id = $(this).attr('data-id');
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                                                <label for="" class="form-label">Please Specify</label>
                                                <input type="text" class="form-control"
                                                    name="financial[` +tpb_id + `][account_type_specify]"
                                                    value="">
                                            </div>`
                    );
                    // ++o;

                } else {
                    $(this).parents().next('.please_specify').remove();
                }


            });


            $(document).on('change', '#currency', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="currency_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });
            $(document).on('change', '#commission_currency', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="commission_currency_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });
            $(document).on('change', '#business_type', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="business_type_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });
            $(document).on('change', '#relation_with_pass', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="relation_with_pass_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });
            $(document).on('change', '#pass_app_type', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="pass_app_type_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });
            // $(document).on('change', '.business_account_status', function() {
            //     if ($(this).val() == "Others") {
            //         $(this).parent().after(
            //             `<div class="formAreahalf basic_data please_specify">
            //                 <label for="" class="form-label">Please Specify</label>
            //                 <input type="text" class="form-control"
            //                     name="business_account_status_specify"
            //                     value="">
            //             </div>`
            //         );

            //     } else {
            //         $(this).parents().next('.please_specify').remove();
            //     }

            // });
            $(document).on('change', '.business_account_type', function() {
                if ($(this).val() == "Others") {
                    $(this).parent().after(
                        `<div class="formAreahalf basic_data please_specify">
                            <label for="" class="form-label">Please Specify</label>
                            <input type="text" class="form-control"
                                name="business_account_type_specify"
                                value="">
                        </div>`
                    );

                } else {
                    $(this).parents().next('.please_specify').remove();
                }

            });

            $(document).on('click', '.add_account_type', function() {
                var akey = $(this).data('id');
                var aclick = $(this).data('aclick');
                $(this).data('aclick',(aclick+1));
                let str = ''
                if(aclick > 2){
                    let str = ''
                    $(".test").css({"display": "none"});
                    for(let i = 2; i <= aclick; i++){
                        if(!str){
                            str = strFun(i, akey)
                        } else {
                            str = str + strFun(i, akey)
                        }
                    }
                    $(this).parent().after(str);
                } else {
                    let str = strFun(2, 1)
                    $(this).parent().after(str);
                }
            });
            const callBack = (o) => {
                let substr = o.name.substr(0,11)
                console.log(substr);
                const emailValue = document.getElementsByName(substr + '[email]')[0].value
                document.getElementsByName('email')[0].value = emailValue

                const passposrt_name_chinese = document.getElementsByName(substr + '[pass_name_chinese]')[0].value
                document.getElementsByName('passposrt_name_chinese')[0].value = passposrt_name_chinese


                const phone = document.getElementsByName(substr + '[phone]')[0].value
                document.getElementsByName('phone_no')[0].value = phone

                const gender = document.getElementsByName(substr + '[gender]')[0].value
                document.getElementsByName('gender')[0].value = gender

                const passport_exp_date = document.getElementsByName(substr + '[passport_exp_date]')[0].value
                document.getElementsByName('passport_expiry_date')[0].value = passport_exp_date.split("/").reverse().join("-")

                const passport_no = document.getElementsByName(substr + '[passport_no]')[0].value
                document.getElementsByName('passport_no')[0].value = passport_no

                const passport_country = document.getElementsByName(substr + '[passport_country]')[0].value
                document.getElementsByName('passport_country')[0].value = passport_country

                const passport_renew = document.getElementsByName(substr + '[passport_renew]')[0].value
                document.getElementsByName('pass_renewal_reminder')[0].value = passport_renew

                const dob = document.getElementsByName(substr + '[passport_exp_date]')[0].value
                document.getElementsByName('dob')[0].value = dob.split("/").reverse().join("-")

                const residential_address = document.getElementsByName(substr + '[residential_address]')[0].value
                document.getElementsByName('residential_add')[0].value = residential_address

                const passport_trg_fqy = document.getElementsByName(substr + '[passport_trg_fqy]')[0].value
                document.getElementsByName('pass_renewal_frq')[0].value = passport_trg_fqy

                const monthly_sal = document.getElementsByName(substr + '[monthly_sal]')[0].value
                document.getElementsByName('monthly_sal')[0].value = passport_trg_fqy

                const job_title = document.getElementsByName(substr + '[job_title]')[0].value
                document.getElementsByName('pass_jon_title')[0].value = passport_trg_fqy
            }
            const strFun = (i, key) => {
                return `
                <div class="formAreahalf basic_data test">
                            <label for="account_type" class="form-label">Account Type `+i+`</label>
                            <select name="financial[`+key+`][account_type][]" id="account_type" class="form-control">
                            <option value="" selected disabled>Choose account type
                            </option>
                            <option value="SGD">
                                SGD</option>
                            <option value="USD">
                                USD</option>
                            <option value="Multi-currency">
                                Multi-currency</option>
                            <option value="Others">
                                Others</option>
                        </select>
                    </div>
                        <div class="formAreahalf basic_data test">
                        <label for="account_policy_no" class="form-label">Account/Policy
                                Number `+i+`</label>
                            <input type="text" name="financial[`+key+`][account_policy_no][]" id="account_policy_no"
                            value=""
                            class="form-control">
                    </div>
                    `
            }
            $('body').on('change', '.pass_holder_nameJs', function() {
                const arr = document.getElementsByClassName('pass_name_eng')
                for(let i = 0; i < arr.length; i++){
                    if(arr[i].value == $(this).val()){
                        //callBack(arr[i])
                    }
                }
            });
            // $('body').on('change', '.shareholdersJs', function() {
            //     var passholder_key = $(this).attr('data-key');
            //     if ($(this).val() == "Yes") {
            //          var htmpass=`<select class="form-control pass_holder_nameJs" id="pass_holder_name"
            //                     name="passholder[`+passholder_key+`]['pass_holder_name']">`;
            //         var pass_name_eng_arr = $('.pass_name_eng').map(function () {
            //             return this.value;
            //         }).get();
            //         var option_values= "";
            //         $.each(pass_name_eng_arr, function(key, value) {
            //              htmpass += `<option value="`+value+`">`+value+`</option>`;
            //         });
            //         htmpass += `</select>`;

            //         $('.pass_holder_name_lableJs').next('.pass_holder_nameJs').remove();
            //         $('.pass_holder_name_lableJs').after(htmpass);
            //         // callBack(document.getElementsByClassName('pass_name_eng')[0])

            //     } else {
            //         var htmpass = `<input type="text" name="passholder[`+passholder_key+`]['pass_holder_name']" id="pass_holder_name" class="form-control pass_holder_nameJs">`;
            //         $('.pass_holder_name_lableJs').next('.pass_holder_nameJs').remove();
            //         $('.pass_holder_name_lableJs').after(htmpass);
            //     }

            // });


        });

        $('#business_account_type').select2({
            placeholder: 'Select Account Types',
            allowClear: true
        });


        $('body').on('click' , '.delete_passholderJs' , function(){
            var id            = $(this).attr('data-id');
            var passholder_id = $(this).attr('data-passholder_id');
            if(passholder_id){
                swal({
                    title: "Are you sure you want to delete this passholder ?",
                    text: "You will not be able to retrieve this passholder again.",
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
                        var url = "{{ route('wealth.delete.passholder', ':id') }}";
                        url = url.replace(':id', passholder_id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                passholder_id: passholder_id,
                            },
                            cache: false,
                            success: function(response) {
                                swal(
                                    "Success!",
                                    "Passholder has been deleted successfully!",
                                    "success",
                                );
                                $('#passholder_item' + id).remove();
                            },
                            failure: function(response) {
                                swal(
                                    "Internal Error",
                                    "Oops, your passholder was not deleted.",
                                    "error"
                                )
                            }
                        });
                    }
                });
            }else{
                $('#passholder_item' + id).remove();
            }
        });

        $('body').on('change' , '.shareholdersJs' , function(){
            var item_id       = $(this).attr('data-key');
            var passholder_id = $(this).closest('.passholder_itemJs').find('.passholder_idJs').val();
            var value         = $(this).val();
            triggerLoader();
            $.ajax({
                type: "POST",
                url: "{{route('wealth.passrelated.item.view')}}",
                data: {
                    '_token'        : '{{csrf_token()}}',
                    'item_id'       : item_id,
                    'passholder_id' : passholder_id,
                    'value'         : value
                },
                error: function(request,status,errorThrown){
                    removeLoader();
                },
                success: function(response) {
                    if(response.view){
                        $('#pass_collapse_' + item_id).empty();
                        $('#pass_collapse_' + item_id).html(response.view);
                    }
                    removeLoader();
                }
            });
        });
    </script>
@endpush
