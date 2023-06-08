@extends('layouts.app')
@push('css')
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
                    @if ($data->business_type == 'Non-FO' && $data->client_type == 'Personal')
                        {{ $basic_data->pass_name_eng }}
                    @endif
                @endif
            </h2>
        </div>
    </div>

    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex col-6 justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('wealth.index') }}">Wealth</a></li>
                {{-- <li>{{ Breadcrumbs::render('wealth.show') }}</li> --}}
                @if (count($data->companies) > 0)
                    <li>{{ Breadcrumbs::render('wealth.show', $data, $companyName) }}</li>
                @else
                    @php $client_name = ''; @endphp
                    @if ($data->business_type == 'Non-FO' && $data->client_type == 'Personal')
                        @php $companyName= $basic_data->pass_name_eng; @endphp
                        <li>{{ Breadcrumbs::render('wealth.show', $data, $companyName) }}</li>
                    @endif
                @endif
            </ul>
        </div>

    </div>
    <div class="filterBtn viewSave d-flex col-6 ms-auto align-items-center justify-content-end">
        <a href="javascript:void(0)" class="me-3 print-icon"><img src="{{ url('/images/Vector.svg') }}"
                alt="print Icon"></a>
        <a href="{{ route('wealth.edit', $data->id) }}"><button class="btn saveBtn"><span>Edit</span></button></a>
        <button class="btn saveBtn cancelBtn del_confirm" data-id="{{ $data->id }}"><span>Delete</span></button>
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
                        <p> @isset($basic_data->type_of_fo) {{ $basic_data->type_of_fo }} @endisset</p>
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
                        <label for="" class="form-label">Date of contract DD/MM/YYYY</label>
                        <p>{{ convertDate($basic_data->date_of_contract,"d/m/Y") }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Client Type</label>
                        <p>{{ $data->client_type }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Client Status</label>
                        <p class="active-btn @if ($data->client_status == 'Dormant') Dormant @endif">
                            {{ $data->client_status }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Created By</label>
                        <p>{{ $data->users->name }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">One-time Servicing Fee Currency</label>
                        <p>{{ $basic_data->servicing_fee_currency }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">One-Time Servicing Fee Amount</label>
                        <p>$ {{ $basic_data->servicing_fee }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">One-Time Servicing Fee Status</label>
                        <p class="@if($basic_data->servicing_fee_status == 'Pending') active-btn Dormant @elseif($basic_data->servicing_fee_status == 'Received') active-btn @else  @endif">
                            {{ $basic_data->servicing_fee_status }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Currency</label>
                        <p>{{ $basic_data->annual_fee_currency }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Amount</label>
                        <p>$ {{ $basic_data->annual_servicing_fee }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Status</label>
                        <p class="@if($basic_data->annual_fee_status == 'Pending') active-btn Dormant @elseif($basic_data->annual_fee_status == 'Received') active-btn @else  @endif">
                            {{ $basic_data->annual_fee_status }}</p>
                    </div>

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Due Date DD/MM/YYYY</label>
                        <p>{{ convertDate($basic_data->annual_fee_due_date,"d/m/Y") }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Due Remainder</label>
                        <p> {{ $basic_data->annual_fee_due_reminder }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Annual Servicing Fee Due Remainder Trigger Frequency</label>
                        <p> {{ $basic_data->annual_fee_due_reminder_trigger }}</p>
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
                        <p class="active-btn  @if ($data->client_status == 'Dormant') Dormant @endif">{{ $data->client_status }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="card company_info formContentData border-0 p-4">
            @if ($data->business_type == 'FO' || ($data->business_type == 'Non-FO' && $data->client_type == 'Corporate'))
                <h3>Company Information</h3>
                @foreach ($data->companies as $key => $company)
                    <div id="accordion" class="accordion-item company_accordian_set">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label">Company Name {{ $key + 1 }}</label>
                                    <p>{{ $company->name }}</p>
                                    <button class="btn btn_set collapsed" data-toggle="collapse"
                                        data-target="#collapseOne{{ $key }}" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body d-flex flex-wrap">
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Company Address</label>
                                        <p>{{ $company->address }}</p>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">UEN</label>
                                        <p>{{ $company->uen }}</p>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Incorporation Date</label>
                                        <p>{{ convertDate($company->incorporate_date,"d/m/Y") }}</p>
                                    </div>

                                    <div class="formAreahalf basic_data">
                                        @if ($key != 0)
                                            <label for="" class="form-label">Relationship with Company 1</label>
                                            <p>{{ $company->relationship }}</p>
                                        @endif
                                    </div>

                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Company Email</label>
                                        <p>{{ $company->company_email }}</p>
                                    </div>
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Company Password</label>
                                        <p>{{ $company->company_pass }}</p>
                                    </div>

                                </div>
                                @foreach ($company->shareholder as $key2 => $shareholder)
                                    <div id="shareholder_accordion" class="share_accordian_set">
                                        <div class="card shareholder">
                                            <div class="card-header" id="headingOne_shareholder">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Shareholder
                                                        #{{ $key2 + 1 }}</label>
                                                    <button class="btn btn_set collapsed" data-toggle="collapse"
                                                        data-target="#collapseOneS{{ $key2 }}"
                                                        aria-expanded="true" aria-controls="collapseOneS">
                                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </button>
                                                    @if ($data->business_type)
                                                        @if (isset($shareholder->shareholder_type) && $shareholder->shareholder_type == 'Company')
                                                            <div class="shareholder_div_accrodion_show">
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Equity
                                                                        Percentage</label>
                                                                    <p>{{ $shareholder->equity_percentage }} <span
                                                                            class="pecentage_end">%</span></p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Shareholder
                                                                        Type</label>
                                                                    <p>{{ $shareholder->shareholder_type }}</p>
                                                                </div>
                                                            </div>
                                                        @elseif (isset($shareholder->shareholder_type) && $shareholder->shareholder_type == 'Personal')
                                                            <div class="shareholder_div_accrodion_show">
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Equity
                                                                        Percentage</label>
                                                                    <p>{{ $shareholder->equity_percentage }} <span
                                                                            class="pecentage_end">%</span></p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Shareholder
                                                                        Type</label>
                                                                    <p>{{ $shareholder->shareholder_type }}</p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="shareholder_div_accrodion_show">
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Equity
                                                                        Percentage</label>
                                                                    <p>{{ $shareholder->equity_percentage }} <span
                                                                            class="pecentage_end">%</span></p>
                                                                </div>
                                                                <div class="formAreahalf basic_data">
                                                                    <label for="" class="form-label">Passport Full
                                                                        Name(Eng)
                                                                    </label>
                                                                    <p>{{ $shareholder->pass_name_eng }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="collapseOneS{{ $key2 }}" class="collapse"
                                                aria-labelledby="headingOne" data-parent="#shareholder_accordion">
                                                <div class="card-body d-flex flex-wrap">

                                                    @if (isset($shareholder->shareholder_type) && $shareholder->shareholder_type == 'Company')
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Company
                                                                Name</label>
                                                            <p>{{ $shareholder->shareholder_company_name }}</p>
                                                        </div>
                                                    @elseif(isset($shareholder->shareholder_type) && $shareholder->shareholder_type == 'Personal')
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full
                                                                Name(Eng)</label>
                                                            <p>{{ $shareholder->pass_name_eng }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full
                                                                Name(Chinese)</label>
                                                            <p>{{ $shareholder->pass_name_chinese }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Renewal
                                                                Reminder</label>
                                                            <p>{{ $shareholder->passport_renew }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                                            <p>
                                                            {{ convertDate($shareholder->dob,"d/m/Y") }}
                                                            </p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Reminder
                                                                Trigger
                                                                Frequency</label>
                                                            <p><span class="every">Every</span>
                                                                {{ $shareholder->passport_trg_fqy }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Gender</label>
                                                            <p>{{ $shareholder->gender }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Number</label>
                                                            <p>{{ $shareholder->passport_no }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Expiry
                                                                Date(DD/MM/YYYY)</label>
                                                            <p>
                                                            {{ convertDate($shareholder->passport_exp_date,"d/m/Y") }}
                                                            </p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Country</label>
                                                            <p>{{ $shareholder->passport_country }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">E-mail</label>
                                                            <p>{{ $shareholder->email }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Phone
                                                                Number</label>
                                                            <p>{{ $shareholder->phone }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Residential
                                                                Address</label>
                                                            <p>{{ $shareholder->residential_address }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Current TIN
                                                                country</label>
                                                            <p>{{ $shareholder->tin_country }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Current TIN
                                                                Number</label>
                                                            <p>{{ $shareholder->tin_no }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Type of
                                                                TIN</label>
                                                            <p>{{ $shareholder->type_of_tin }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Job Title</label>
                                                            <p>{{ $shareholder->job_title }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary (SGD)</label>
                                                            <p>{{ $shareholder->monthly_sal }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Company</label>
                                                            <p>{{ $shareholder->company }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary w.e.f. (DD/MM/YYYY)</label>
                                                            <p>{{ convertDate($shareholder->monthly_salary_wef,'d/m/y') }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Relationship With
                                                                Shareholder 1</label>
                                                            <p>{{ $shareholder->relation_with_shareholder }}</p>
                                                        </div>
                                                        @if (isset($shareholder->relation_with_shareholder) && $shareholder->relation_with_shareholder == 'Others')
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Others, please specify</label>
                                                                @if (isset($shareholder->rel_share_specify))
                                                                {{ $shareholder->rel_share_specify }} @else-
                                                                @endif
                                                                </p>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Full
                                                                Name(Chinese)</label>
                                                            <p>{{ $shareholder->pass_name_chinese }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Gender</label>
                                                            <p>{{ $shareholder->gender }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                                            <p>
                                                            {{ convertDate($shareholder->dob,"d/m/Y") }}
                                                            </p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Phone
                                                                Number</label>
                                                            <p>{{ $shareholder->phone }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">E-mail</label>
                                                            <p>{{ $shareholder->email }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Number</label>
                                                            <p>{{ $shareholder->passport_no }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport
                                                                Country</label>
                                                            <p>{{ $shareholder->passport_country }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Expiry
                                                                Date(DD/MM/YYYY)</label>
                                                            <p>
                                                            {{ convertDate($shareholder->passport_exp_date,"d/m/Y") }}
                                                            </p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Renewal
                                                                Reminder</label>
                                                            <p>{{ $shareholder->passport_renew }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Passport Reminder
                                                                Trigger
                                                                Frequency</label>
                                                            <p><span class="every">Every</span>
                                                                {{ $shareholder->passport_trg_fqy }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Residential
                                                                Address</label>
                                                            <p>{{ $shareholder->residential_address }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Current TIN
                                                                country</label>
                                                            <p>{{ $shareholder->tin_country }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Type of
                                                                TIN</label>
                                                            <p>{{ $shareholder->type_of_tin }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Current TIN
                                                                Number</label>
                                                            <p>{{ $shareholder->tin_no }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Company</label>
                                                            <p>{{ $shareholder->company }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Job Title</label>
                                                            <p>{{ $shareholder->job_title }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary (SGD)</label>
                                                            <p>{{ $shareholder->monthly_sal }}</p>
                                                        </div>
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Monthly Salary w.e.f. (DD/MM/YYYY)</label>
                                                            <p>{{ convertDate($shareholder->monthly_salary_wef,'d/m/y') }}</p>
                                                        </div>

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Relationship With
                                                                Shareholder 1</label>
                                                            <p>{{ $shareholder->relation_with_shareholder }}</p>
                                                        </div>
                                                        @if (isset($shareholder->relation_with_shareholder) && $shareholder->relation_with_shareholder == 'Others')
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Others, please specify</label>
                                                                @if (isset($shareholder->rel_share_specify))
                                                                {{ $shareholder->rel_share_specify }} @else-
                                                                @endif
                                                                </p>
                                                            </div>
                                                        @endif
                                                        <!-- devPoint -->
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="nfo_personal_head">Personal Information</h3>
                <div class="nfo_personal_data_show d-flex flex-wrap">
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full Name(Eng)</label>
                        <p>{{ $basic_data->pass_name_eng }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full Name(Chinese)</label>
                        <p>{{ $basic_data->pass_name_chinese }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Gender</label>
                        <p>{{ $basic_data->gender }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                        <p>
                        {{ convertDate($basic_data->dob,"d/m/Y") }}
                        </p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Number</label>
                        <p> {{ $basic_data->passport_no }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Expiry Date(DD/MM/YYYY)</label>
                        <p>
                            {{ convertDate($basic_data->passport_exp_date,"d/m/Y") }}
                        </p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Renewal Reminder</label>
                        <p>{{ $basic_data->passport_renew }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Country</label>
                        <p>{{ $basic_data->passport_country }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                        <p><span class="every">Every</span> {{ $basic_data->passport_trg_fqy }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN Number</label>
                        <p>{{ $basic_data->tin_no }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN country</label>
                        <p>{{ $basic_data->tin_country }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">TIN Number Before Pass Application</label>
                        <p>{{ $basic_data->tin_before_application }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Type of TIN</label>
                        <p>{{ $basic_data->type_of_tin }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">E-mail</label>
                        <p>{{ $basic_data->email }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">TIN Country Before Pass Application</label>
                        <p>{{ $basic_data->tin_country_before_app }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Residential Address</label>
                        <p>{{ $basic_data->residential_address }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Type of TIN Before Pass Application</label>
                        <p>{{ $basic_data->type_pin_before_app }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Employer's Industry</label>
                        <p>{{ $basic_data->employer_industry }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Phone Number</label>
                        <p>{{ $basic_data->phone }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current Job Title</label>
                        <p>{{ $basic_data->job_title }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Employer's Name</label>
                        <p>{{ $basic_data->employer_name }}</p>
                    </div>
                </div>
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
                                    data-bs-target="#nav-pass" type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Pass
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
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Account Status</label>
                                            <p
                                                class="@if (isset($wealth_mas->account_status) && $wealth_mas->account_status == 'Active') active-btn @elseif(isset($wealth_mas->account_status) && $wealth_mas->account_status == 'Dormant') active-btn Dormant @else '' @endif">
                                                @isset($wealth_mas->account_status)
                                                    {{ $wealth_mas->account_status }}
                                                @else
                                                    -
                                                @endisset
                                            </p>
                                        </div>
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Tax Advisor Name</label>
                                            <p>
                                                @isset($wealth_mas->tax_advisor_name)
                                                    {{ $wealth_mas->tax_advisor_name }}
                                                @else
                                                    -
                                                @endisset
                                            </p>
                                        </div>
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="mas_collapseOne" class="collapse show " aria-labelledby="headingOne"
                                        data-parent="#mas_accordion">
                                        <div class="tab-data-inner-account d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Tax Advisor Email</label>
                                                <p>
                                                    @isset($wealth_mas->tax_advisor_email)
                                                        {{ $wealth_mas->tax_advisor_email }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Tax Advisor Contact
                                                    Number</label>
                                                <p>
                                                    @isset($wealth_mas->tax_advisor_no)
                                                        {{ $wealth_mas->tax_advisor_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Kickstart to Tax
                                                    Advisor</label>
                                                <p
                                                    class="@if (isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'In progress') active-blue @elseif(isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'Done') active-btn @else '' @endif">
                                                    @isset($wealth_mas->kickstart_tax_advisor)
                                                        {{ $wealth_mas->kickstart_tax_advisor }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Legal Opinion</label>
                                                <p
                                                    class="@if (isset($wealth_mas->deck_submission) && $wealth_mas->deck_submission == 'In progress') active-blue @elseif(isset($wealth_mas->kickstart_tax_advisor) && $wealth_mas->kickstart_tax_advisor == 'Done') active-btn @else '' @endif">

                                                    @isset($wealth_mas->deck_submission)
                                                        {{ $wealth_mas->deck_submission }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Presentation Deck
                                                    (Final)
                                                </label>
                                                <p
                                                    class="@if (isset($wealth_mas->presentation_deck) && $wealth_mas->presentation_deck == 'In progress') active-blue @elseif(isset($wealth_mas->presentation_deck) && $wealth_mas->presentation_deck == 'Done') active-btn @else '' @endif">

                                                    @isset($wealth_mas->presentation_deck)
                                                        {{ $wealth_mas->presentation_deck }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">MASNET Account
                                                    Opening</label>
                                                <p
                                                    class="@if (isset($wealth_mas->masnet_account) && $wealth_mas->masnet_account == 'In progress') active-blue @elseif(isset($wealth_mas->masnet_account) && $wealth_mas->masnet_account == 'Done') active-btn @else '' @endif">

                                                    @isset($wealth_mas->masnet_account)
                                                        {{ $wealth_mas->masnet_account }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Preliminary Approval</label>
                                                <p
                                                    class="@if (isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Pending') active-blue @elseif(isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Approved') active-btn @elseif(isset($wealth_mas->preliminary_approval) && $wealth_mas->preliminary_approval == 'Rejected') active-btn Dormant @else '' @endif">

                                                    @isset($wealth_mas->preliminary_approval)
                                                        {{ $wealth_mas->preliminary_approval }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Final Approval</label>
                                                <p
                                                    class="@if (isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Pending') active-blue @elseif(isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Approved') active-btn @elseif(isset($wealth_mas->final_approval) && $wealth_mas->final_approval == 'Rejected') active-btn Dormant @else '' @endif">

                                                    @isset($wealth_mas->final_approval)
                                                        {{ $wealth_mas->final_approval }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Final Submission</label>
                                                <p
                                                    class="@if (isset($wealth_mas->final_submission) && $wealth_mas->final_submission == 'In progress') active-blue @elseif(isset($wealth_mas->final_submission) && $wealth_mas->final_submission == 'Done') active-btn @else '' @endif">

                                                    @isset($wealth_mas->final_submission)
                                                        {{ $wealth_mas->final_submission }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">OIC Name</label>
                                                <p>
                                                    @isset($wealth_mas->oic_name)
                                                        {{ $wealth_mas->oic_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">MASNET Username</label>
                                                <p>
                                                    @isset($wealth_mas->masnet_username)
                                                        {{ $wealth_mas->masnet_username }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">MASNET Password</label>
                                                <p>
                                                    @isset($wealth_mas->masnet_password)
                                                        {{ $wealth_mas->masnet_password }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Institution Code</label>
                                                <p>
                                                    @isset($wealth_mas->institution_code)
                                                        {{ $wealth_mas->institution_code }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Declaration Frequency</label>
                                                <p>
                                                    @isset($wealth_mas->declaration_frequency)
                                                        {{ $wealth_mas->declaration_frequency }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commencement Date</label>
                                                <p>
                                                    @isset($wealth_mas->commencement_date)
                                                        {{ convertDate($wealth_mas->commencement_date,'d/m/Y') }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Reminder Notification</label>
                                                <p>
                                                    @isset($wealth_mas->reminder_notification)
                                                        {{ $wealth_mas->reminder_notification }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Annual Declaration
                                                    Deadline</label>
                                                <p>
                                                    @isset($wealth_mas->annual_declaration_deadline)
                                                        {{ convertDate($wealth_mas->annual_declaration_deadline,'d/m/Y') }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Internal Account
                                                    Manager</label>
                                                <p>
                                                    @isset($wealth_mas->internal_account_manager)
                                                        {{ $wealth_mas->internal_account_manager }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Annual Declaration Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($wealth_mas->trigger_fqy_rem)
                                                        <span class="every">Every</span> {{ $wealth_mas->trigger_fqy_rem }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarksdfdfddf</label>
                                                <p>
                                                    @isset($wealth_mas->remarks)
                                                        {{ $wealth_mas->remarks }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="nav-financial" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                    @php $length =1;@endphp
                                        @if(count($wealth_finance)>0)
                                        @php $length=count($wealth_finance); @endphp
                                        @endif
                                    @for($i=0; $i<$length; $i++)

                                    <div id="financial_accordion_{{$i}}" class="mas_related">
                                        <div class="mas_heading_accordian d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Stakeholder Type</label>
                                                <p>
                                                    @isset($wealth_finance[$i]->stakeholder_type)
                                                        {{ $wealth_finance[$i]->stakeholder_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Financial Institution
                                                    Name</label>
                                                <p>
                                                    @isset($wealth_finance[$i]->stakeholder_type)
                                                        {{ $wealth_finance[$i]->financial_institution_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <button class="btn btn_set collapsed" data-toggle="collapse"
                                                data-target="#financial_collapseOne{{$i}}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div id="financial_collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne"
                                            data-parent="#financial_accordion_{{$i}}">
                                            <div class="tab-data-financial d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">POC Name</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->poc_name)
                                                            {{ $wealth_finance[$i]->poc_name }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">POC Contact Number</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->poc_contact_no)
                                                            {{ $wealth_finance[$i]->poc_contact_no }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">POC Email</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->poc_email)
                                                            {{ $wealth_finance[$i]->poc_email }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="application_submission_date" class="form-label">Application
                                                        Submission Date</label>

                                                        @isset($wealth_finance[$i]->application_submission_date)
                                                            {{ $wealth_finance[$i]->application_submission_date }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Application
                                                        Submission </label>
                                                    <p
                                                        class="@if (isset($wealth_finance[$i]->application_submission) && $wealth_finance[$i]->application_submission == 'In progress') active-blue @elseif(isset($wealth_finance[$i]->application_submission) && $wealth_finance[$i]->application_submission == 'Done') active-btn @else '' @endif">

                                                        @isset($wealth_finance[$i]->application_submission)
                                                            {{ $wealth_finance[$i]->application_submission }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                @if(!empty($wealth_finance[$i]->account_type) && isJson($wealth_finance[$i]->account_type) )
                                                    @php
                                                        $account_type =json_decode($wealth_finance[$i]->account_type);
                                                        $api = 1;
                                                    @endphp
                                                    @foreach($account_type as $ap)
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Account Type</label>
                                                            <p>
                                                                @isset($ap)
                                                                    {{ $ap }}
                                                                @else
                                                                    -
                                                                @endisset
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @else

                                                @endif
                                                @if(!empty($wealth_finance[$i]->account_type) && isJson($wealth_finance[$i]->account_type) )

                                                        @if (isset($wealth_finance[$i]->account_type) && $wealth_finance[$i]->account_type == 'Others')
                                                            @foreach($account_type_specify as $aps)
                                                            <div class="formAreahalf basic_data">
                                                                <label for="" class="form-label">Others, please specify</label>
                                                                @if (isset($aps))
                                                                    {{ $aps }}
                                                                @else
                                                                    -
                                                                @endif
                                                                </p>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                @elseif (isset($wealth_finance[$i]->account_type) && $wealth_finance[$i]->account_type == 'Others')

                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Others, please specify</label>
                                                            @if (isset($wealth_finance[$i]->account_type_specify))
                                                            {{ $wealth_finance[$i]->account_type_specify }} @else-
                                                            @endif
                                                            </p>
                                                        </div>
                                                @endif

                                                @if(!empty($wealth_finance[$i]->account_policy_no) && isJson($wealth_finance[$i]->account_policy_no) )

                                                    @php
                                                        $account_policy_no =json_decode($wealth_finance[$i]->account_policy_no);
                                                        $apni = 1;
                                                    @endphp
                                                    @foreach($account_policy_no as $apn)
                                                        <div class="formAreahalf basic_data">
                                                            <label for="" class="form-label">Account/Policy Number</label>
                                                            <p>
                                                                @isset($apn)
                                                                    {{ $apn }}
                                                                @else
                                                                    -
                                                                @endisset
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="formAreahalf basic_data">
                                                        <label for="" class="form-label">Account/Policy Number</label>
                                                        <p>
                                                            @isset($wealth_finance[$i]->account_policy_no)
                                                                {{ $wealth_finance[$i]->account_policy_no }}
                                                            @else
                                                                -
                                                            @endisset
                                                        </p>
                                                    </div>
                                                @endif
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Account Opening
                                                        Status</label>
                                                    <p
                                                        class="@if (isset($wealth_finance[$i]->account_opening_status) && $wealth_finance[$i]->account_opening_status == 'Pending') active-blue @elseif(isset($wealth_finance[$i]->account_opening_status) && $wealth_finance[$i]->account_opening_status == 'Approved') active-btn @elseif(isset($wealth_finance[$i]->account_opening_status) && $wealth_finance[$i]->account_opening_status == 'Rejected') active-btn Dormant @else '' @endif">

                                                        @isset($wealth_finance[$i]->account_opening_status)
                                                            {{ $wealth_finance[$i]->account_opening_status }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Current Account
                                                        Status</label>
                                                    <p
                                                        class="@if (isset($wealth_finance[$i]->current_account_status) && $wealth_finance[$i]->current_account_status == 'Pending') active-blue @elseif(isset($wealth_finance[$i]->current_account_status) && $wealth_finance[$i]->current_account_status == 'Approved') active-btn @elseif(isset($wealth_finance[$i]->current_account_status) && $wealth_finance[$i]->current_account_status == 'Rejected') active-btn Dormant @else '' @endif">

                                                        @isset($wealth_finance[$i]->current_account_status)
                                                            {{ $wealth_finance[$i]->current_account_status }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Money Deposit Status</label>
                                                    <p
                                                        class="@if (isset($wealth_finance[$i]->money_deposit_status) && $wealth_finance[$i]->money_deposit_status == 'In progress') active-blue @elseif(isset($wealth_finance[$i]->money_deposit_status) && $wealth_finance[$i]->money_deposit_status == 'Done') active-btn @else '' @endif">

                                                        @isset($wealth_finance[$i]->money_deposit_status)
                                                            {{ $wealth_finance[$i]->money_deposit_status }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Initial Deposit Currency</label>

                                                        @isset($wealth_finance[$i]->intial_deposit_currency)
                                                            {{ $wealth_finance[$i]->intial_deposit_currency }}
                                                        @else
                                                            -
                                                        @endisset

                                                </div>

                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Initial Deposit
                                                        Amount</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->intial_deposit_amount)
                                                        <span class="doller">$</span>{{ $wealth_finance[$i]->intial_deposit_amount }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Online Account Username</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->online_account_username)
                                                            {{ $wealth_finance[$i]->online_account_username }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Online Account
                                                        Password</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->online_account_pass)
                                                            {{ $wealth_finance[$i]->online_account_pass }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>
                                                        @isset($wealth_finance[$i]->finacial_remarks)
                                                            {{ $wealth_finance[$i]->finacial_remarks }}
                                                        @else
                                                            -
                                                        @endisset
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor



                            </div>


                            <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div id="pass_accordion" class="mas_related">
                                    <div class="mas_heading_accordian">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Is Passholder also the
                                                shareholder</label>
                                            <p>
                                                @isset($wealthpass->passholder_shareholder)
                                                    {{ $wealthpass->passholder_shareholder }}
                                                @else
                                                    -
                                                @endisset
                                            </p>
                                        </div>
                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                            data-target="#pass_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="pass_collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#pass_accordion">
                                        <div class="tab-inner-passhold d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Holder Name 1
                                                    (Eng)</label>
                                                <p>
                                                    @isset($wealthpass->pass_holder_name)
                                                        {{ $wealthpass->pass_holder_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Full
                                                    Name(Chinese)</label>
                                                <p>
                                                    @isset($wealthpass->passposrt_name_chinese)
                                                        {{ $wealthpass->passposrt_name_chinese }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($wealthpass->dob)
                                                        {{ convertDate($wealthpass->dob,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Gender(M/F)</label>
                                                <p>
                                                    @isset($wealthpass->gender)
                                                        {{ $wealthpass->gender }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Expiry
                                                    Date(DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($wealthpass->passport_expiry_date)
                                                        {{ convertDate($wealthpass->passport_expiry_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Number</label>
                                                <p>
                                                    @isset($wealthpass->wealthpass->passport_no)
                                                        {{ $wealthpass->passport_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Renewal
                                                    Reminder</label>
                                                <p>
                                                    @isset($wealthpass->passport_renewal_reminder)
                                                        {{ $wealthpass->passport_renewal_reminder }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Country</label>
                                                <p>
                                                    @isset($wealthpass->passport_country)
                                                        {{ $wealthpass->passport_country }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($wealthpass->passport_tri_frq)
                                                        <span class="Every">Every</span> {{ $wealthpass->passport_tri_frq }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Tin Country Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($wealthpass->tin_country_before_app)
                                                        {{ $wealthpass->tin_country_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Type of TIN Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($wealthpass->type_of_tin_before_app)
                                                        {{ $wealthpass->type_of_tin_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">TIN Number Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($wealthpass->tin_no_before_pass_app)
                                                        {{ $wealthpass->tin_no_before_pass_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Phone Number</label>
                                                <p>
                                                    @isset($wealthpass->phone_no)
                                                        {{ $wealthpass->phone_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Email</label>
                                                <p>
                                                    @isset($wealthpass->email)
                                                        {{ $wealthpass->email }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Business Type</label>
                                                <p>
                                                    @isset($wealthpass->business_type)
                                                        {{ $wealthpass->business_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthpass->business_type) && $wealthpass->business_type == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($wealthpass->business_type_specify))
                                                    {{ $wealthpass->business_type_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Residential Address</label>
                                                <p>
                                                    @isset($wealthpass->residential_add)
                                                        {{ $wealthpass->residential_add }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Application
                                                    Status</label>
                                                <p
                                                    class="@if (isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Pending') active-blue @elseif(isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Approved') active-btn @elseif(isset($wealthpass->pass_app_status) && $wealthpass->pass_app_status == 'Rejected') active-btn Dormant @else '' @endif">
                                                    @isset($wealthpass->pass_app_status)
                                                        {{ $wealthpass->pass_app_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Relationship with Pass Holder
                                                    1</label>
                                                <p>
                                                    @isset($wealthpass->relation_with_pass)
                                                        {{ $wealthpass->relation_with_pass }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthpass->relation_with_pass) && $wealthpass->relation_with_pass == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($wealthpass->relation_with_pass_specify))
                                                    {{ $wealthpass->relation_with_pass_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Application Type</label>
                                                <p>
                                                    @isset($wealthpass->pass_app_type)
                                                        {{ $wealthpass->pass_app_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthpass->pass_app_type) && $wealthpass->pass_app_type == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($wealthpass->pass_app_type_specify))
                                                    {{ $wealthpass->pass_app_type_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance</label>
                                                <p
                                                    class="@if (isset($wealthpass->pass_inssuance) && $wealthpass->pass_inssuance == 'In progress') active-blue @elseif(isset($wealthpass->pass_inssuance) && $wealthpass->pass_inssuance == 'Done') active-btn @else '' @endif">

                                                    @isset($wealthpass->pass_inssuance)
                                                        {{ $wealthpass->pass_inssuance }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance Date</label>
                                                <p>
                                                    @isset($wealthpass->pass_issuance_date)
                                                        {{ convertDate($wealthpass->pass_issuance_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Expiry Date</label>
                                                <p>
                                                    @isset($wealthpass->pass_expiry_date)
                                                        {{ convertDate($wealthpass->pass_expiry_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Reminder</label>
                                                <p>
                                                    @isset($wealthpass->passholder_shareholder)
                                                        {{ $wealthpass->passholder_shareholder }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Duration</label>
                                                <p>
                                                    @isset($wealthpass->duration)
                                                        {{ $wealthpass->duration }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">FIN Number</label>
                                                <p>
                                                    @isset($wealthpass->fin_number)
                                                        {{ $wealthpass->fin_number }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($wealthpass->pass_renewal_frq)
                                                        <span class="every">Every</span> {{ $wealthpass->pass_renewal_frq }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass. Job Title</label>
                                                <p>
                                                    @isset($wealthpass->pass_jon_title)
                                                        {{ $wealthpass->pass_jon_title }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Singpass Set Up</label>
                                                <p
                                                    class="@if (isset($wealthpass->singpass_set_up) && $wealthpass->singpass_set_up == 'In progress') active-blue @elseif(isset($wealthpass->singpass_set_up) && $wealthpass->singpass_set_up == 'Done') active-btn @else '' @endif">
                                                    @isset($wealthpass->singpass_set_up)
                                                        {{ $wealthpass->singpass_set_up }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Employer's Name</label>
                                                <p>
                                                    @isset($wealthpass->employee_name)
                                                        {{ $wealthpass->employee_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Monthly Salary(SGD)</label>
                                                <p>
                                                    @isset($wealthpass->monthly_sal)
                                                        {{ $wealthpass->monthly_sal }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarks</label>
                                                <p>
                                                    @isset($wealthpass->pass_remarks)
                                                        {{ $wealthpass->pass_remarks }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade " id="nav-business" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <div id="business_accordion" class="mas_related">
                                    <div class="mas_heading_accordian">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Financial Institution Name</label>
                                            <p>
                                                @isset($wealthbuss->financial_institition_name)
                                                    {{ $wealthbuss->financial_institition_name }}
                                                @else
                                                    -
                                                @endisset
                                            </p>
                                        </div>
                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                            data-target="#business_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="business_collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#business_accordion">

                                        <div class="tab-cstm-data-inner d-flex flex-wrap ">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Application Submission</label>
                                                <p
                                                    class="@if (isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'In progress') active-blue @elseif(isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'Done') active-btn @else '' @endif">

                                                    @isset($wealthbuss->application_submision)
                                                        {{ $wealthbuss->application_submision }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account Status</label>
                                                <p
                                                    class="@if (isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Pending') active-blue @elseif(isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Approved') active-btn @elseif(isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Rejected') active-btn Dormant @else '' @endif">

                                                    @isset($wealthbuss->business_account_status)
                                                        {{ $wealthbuss->business_account_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account Type</label>
                                                <p>
                                                    @isset($wealthbuss->business_account_type)
                                                        {{ $wealthbuss->business_account_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthbuss->business_account_type) && $wealthbuss->business_account_type == 'Others')
                                                    <div class="formAreahalf basic_data please_specify">
                                                        <label for="" class="form-label">Others, please specify</label>
                                                        @if (isset($wealthbuss->business_account_type_specify))
                                                        {{ $wealthbuss->business_account_type_specify  }}
                                                        @else -

                                                        @endif

                                                    </div>
                                                @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account/Policy Number</label>
                                                <p>
                                                    @isset($wealthbuss->business_account_policy_no)
                                                        {{ $wealthbuss->business_account_policy_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Product Name</label>
                                                <p>
                                                    @isset($wealthbuss->product_name)
                                                        {{ $wealthbuss->product_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Payment Mode</label>
                                                <p>
                                                    @isset($wealthbuss->payment_mode)
                                                        {{ $wealthbuss->payment_mode }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Currency</label>
                                                <p>
                                                    @isset($wealthbuss->currency)
                                                        {{ $wealthbuss->currency }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthbuss->currency) && $wealthbuss->currency == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($wealthbuss->currency_specify))
                                                    {{ $wealthbuss->currency_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Investment Amount/Premium</label>
                                                <p>
                                                    @isset($wealthbuss->investment_amount)
                                                      <span class="doller">$ {{ $wealthbuss->investment_amount }}</span>
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Online Account Username</label>
                                                <p>
                                                    @isset($wealthbuss->online_account_user)
                                                        {{ $wealthbuss->online_account_user }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Online Account Password</label>
                                                <p>
                                                    @isset($wealthbuss->online_acc_pass)
                                                        {{ $wealthbuss->online_acc_pass }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Subscription / Inception
                                                    Date</label>
                                                <p>
                                                    @isset($wealthbuss->subscription)
                                                        {{ convertDate($wealthbuss->subscription,'d/m/Y') }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Date</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_date)
                                                        {{ convertDate($wealthbuss->maturity_date,'d/m/Y') }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Duration</label>
                                                <p>
                                                    @isset($wealthbuss->business_duration)
                                                        {{ $wealthbuss->business_duration }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Reminder</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_reminder)
                                                        {{ $wealthbuss->maturity_reminder}}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_reminder_trg)
                                                        <span class="every">Every</span>
                                                        {{ $wealthbuss->maturity_reminder_trg }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commisison Status (For Admin
                                                    Purpose)
                                                </label>
                                                <p
                                                    class="@if (isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Pending') active-blue @elseif(isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Received') active-btn @elseif(isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Rejected') active-btn Dormant @else '' @endif">

                                                    @isset($wealthbuss->commision_status)
                                                        {{ $wealthbuss->commision_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commission Currency (For Admin
                                                    Purpose)</label>
                                                <p>
                                                    @isset($wealthbuss->commission_currency)
                                                        {{ $wealthbuss->commission_currency }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($wealthbuss->commission_currency) && $wealthbuss->commission_currency == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($wealthbuss->commission_currency_specify))
                                                    {{ $wealthbuss->commission_currency_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commission Amount (For Admin
                                                    Purpose)</label>
                                                <p>
                                                    @isset($wealthbuss->commission_amount)
                                                        {{ $wealthbuss->commission_amount }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Net Account Value</label>
                                                <p>
                                                    @isset($wealthbuss->net_amount_val)
                                                        {{ $wealthbuss->net_amount_val }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarks</label>
                                                <p>
                                                    @isset($wealthbuss->business_remarks)
                                                        {{ $wealthbuss->business_remarks }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>

                                            <div class="Redemption_date">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Redemption Date and
                                                        Amount</label>
                                                </div>
                                                <div class="table">
                                                    <table class="table">
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
                                                                <td>{{ convertDate($redemption_data->red_date,"d/m/Y") }}</td>
                                                                <td>{{$redemption_data->red_amount}}</td>
                                                                <td><a href="#" data-id="" title="Delete" class="btn"><i class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="3">No record found</td>
                                                            </tr>
                                                            @endif

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="tab-pane fade show active" id="nav-business" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <div id="business_accordion" class="mas_related">
                                    <div class="mas_heading_accordian">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Financial Institution Name</label>
                                            <p>
                                                @isset($wealthbuss->financial_institition_name)
                                                    {{ $wealthbuss->financial_institition_name }}
                                                @else
                                                    -
                                                @endisset
                                            </p>
                                        </div>
                                        <button class="btn btn_set collapsed" data-toggle="collapse"
                                            data-target="#business_collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div id="business_collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#business_accordion">

                                        <div class="tab-cstm-data-inner d-flex flex-wrap ">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Application Submission</label>
                                                <p
                                                    class="@if (isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'In progress') active-blue @elseif(isset($wealthbuss->application_submision) && $wealthbuss->application_submision == 'Done') active-btn @else '' @endif">

                                                    @isset($wealthbuss->application_submision)
                                                        {{ $wealthbuss->application_submision }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account Status</label>
                                                <p
                                                    class="@if (isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Pending') active-blue @elseif(isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Approved') active-btn @elseif(isset($wealthbuss->business_account_status) && $wealthbuss->business_account_status == 'Rejected') active-btn Dormant @else '' @endif">

                                                    @isset($wealthbuss->business_account_status)
                                                        {{ $wealthbuss->business_account_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account Type</label>
                                                <p>
                                                    @isset($wealthbuss->business_account_type)
                                                        {{ $wealthbuss->business_account_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Account/Policy Number</label>
                                                <p>
                                                    @isset($wealthbuss->business_account_policy_no)
                                                        {{ $wealthbuss->business_account_policy_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Product Name</label>
                                                <p>
                                                    @isset($wealthbuss->product_name)
                                                        {{ $wealthbuss->product_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Payment Mode</label>
                                                <p>
                                                    @isset($wealthbuss->payment_mode)
                                                        {{ $wealthbuss->payment_mode }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Currency</label>
                                                <p>
                                                    @isset($wealthbuss->currency)
                                                        {{ $wealthbuss->currency }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Investment Amount/Premium</label>
                                                <p>
                                                    @isset($wealthbuss->investment_amount)
                                                       <span class="doller">$ {{ $wealthbuss->investment_amount }}</span>
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Online Account Username</label>
                                                <p>
                                                    @isset($wealthbuss->online_account_user)
                                                        {{ $wealthbuss->online_account_user }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Online Account Password</label>
                                                <p>
                                                    @isset($wealthbuss->online_acc_pass)
                                                        {{ $wealthbuss->online_acc_pass }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Subscription / Inception
                                                    Date</label>
                                                <p>
                                                    @isset($wealthbuss->subscription)
                                                        {{ convertDate($wealthbuss->subscription,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Date</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_date)
                                                        {{ convertDate($wealthbuss->maturity_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Duration</label>
                                                <p>
                                                    @isset($wealthbuss->business_duration)
                                                        {{ $wealthbuss->business_duration }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Reminder</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_reminder)
                                                        {{ $wealthbuss->maturity_reminder }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Maturity Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($wealthbuss->maturity_reminder_trg)
                                                        <span class="every">Every</span>
                                                        {{ $wealthbuss->maturity_reminder_trg }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commisison Status (For Admin
                                                    Purpose)
                                                </label>
                                                <p
                                                    class="@if (isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Pending') active-blue @elseif(isset($wealthbuss->commision_status) && $wealthbuss->commision_status == 'Received') active-btn @else '' @endif">

                                                    @isset($wealthbuss->commision_status)
                                                        {{ $wealthbuss->commision_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commission Currency (For Admin
                                                    Purpose)</label>
                                                <p>
                                                    @isset($wealthbuss->commission_currency)
                                                        {{ $wealthbuss->commission_currency }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Commission Amount (For Admin
                                                    Purpose)</label>
                                                <p>
                                                    @isset($wealthbuss->commission_amount)
                                                        {{ $wealthbuss->commission_amount }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Net Account Value</label>
                                                <p>
                                                    @isset($wealthbuss->net_amount_val)
                                                        {{ $wealthbuss->net_amount_val }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarks</label>
                                                <p>
                                                    @isset($wealthbuss->business_remarks)
                                                        {{ $wealthbuss->business_remarks }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>

                                            <div class="Redemption_date">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Redemption Date and
                                                        Amount</label>
                                                </div>
                                                <div class="table">
                                                    <table class="table">
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
                                                                <td>{{ convertDate($redemption_data->red_date,"d/m/Y") }}</td>
                                                                <td>{{$redemption_data->red_amount}}</td>
                                                                <td><a href="#" data-id="" title="Delete" class="btn"><i class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="3">No record found</td>
                                                            </tr>
                                                            @endif

                                                        </tbody>
                                                    </table>

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
            <label class="form-label mt-5" for="text_notes">Notes</label>
                <!-- <form action="javascript:void(0)" method="POST" name="notess" id="notes" class="note_send">
                    <input type="hidden" value="Wealth" name="tbl_name">
                    <input type="hidden" value="{{ $data->id }}" name="application_id">
                    <input type="hidden" value="{{ Auth::user()->name }}" name="created_by_name">
                    {{-- <input type="hidden" name="crreated_by" value="{{ Auth::user()->id }}"> --}}

                    <div class="textarea">
                        <label class="form-label mt-5" for="text_notes">Notes</label>
                        <textarea id="text_notes" name="notes" rows="8" cols="150" placeholder="Type your notes here..."></textarea>
                        <input type="submit" class="btn saveBtn btn_notes" value="Save">
                        <input type="button" id="notes_cancel" class="btn saveBtn cancelBtn delete" value="Cancel"
                            style="display: none">
                    </div>
                </form> -->
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

            <div class="card file upload ">
                <h3>File Uploads</h3>
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
                                @if (count($file) > 0)
                                    @foreach ($file as $files)
                                        <tr>
                                            <td><a href="{{asset('file/'.$files->file)}}" target="_blank" >{{ $files->file }}</a></td>
                                            <td>{{ $files->uploaded_by_name }}</td>
                                            <td>{{ convertDate($files->created_at,'d/m/Y g:i A') }}</td>
                                            <td> <a href="{{ url('file/' . $files->file) }}" download class="link-normal">
                                                    {{-- <img src="{{ url('images/download_icon.svg') }}" alt="delete-icon"> --}}
                                                    <i class="fa-solid fa-download"></i></a>
                                                <a href="javascript:void(0);" class="wealth_file_del_confirm p-0"
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

            <div class="card file company_info formContentData border-0 p-4"
                style="background: #fff; padding-bottom: 10px !important;">
                <h3>Action Log</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table table_yellow user_action_log">
                            <thead>
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Made by</th>
                                    <th scope="col">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($action_log as $activity)
                                    <tr>
                                        <td>{{ $activity->message }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="print_screen" style="display:none;">
        <div class="print-holder">
            <div class="page page_1">
                <table class="header-table" style="padding: 30px;">
                    <tr class="first-row-cstm">
                        <td>
                            <table class="header-table">
                                <tr>
                                    <td style="width:20%;">
                                        <img src="{{ url('/images/logo.png') }}" alt="logo"
                                            style="width:100px;">
                                    </td>
                                    <td>
                                        <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                            <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                            <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="second-row-cstm">
                        <td>
                            <table style="width:80%; margin:0 auto;">
                                <tr>
                                    <td style="width:25%; text-align:right; color:#000;">
                                        <hr / style="background-color:#000; ">
                                    </td>
                                    <td style="text-align:center; width:40%">
                                        <div class="text-center line-cstm"
                                            style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                            Basic Information</div>
                                    </td>
                                    <td style="width:25%; text-align:left; color:#000;">
                                        <hr / style="background-color:#000; ">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="third-row-cstm">
                        <td>
                            <table style="width:100%; margin:0 auto;">
                                @if ($data->business_type == 'FO')
                                    <tr>
                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Company(s)</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">
                                                {{ $companyName }}</span>
                                        </td>

                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Business Type</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $data->business_type }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Client Type</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $data->client_type }}</span>
                                        </td>

                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Type of FO</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $basic_data->type_of_fo }}</span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Created By</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $data->users->name }}</span>
                                        </td>

                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Client status</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $data->client_status }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">One-Time Servicing Fee Amount</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">$
                                                {{ $basic_data->servicing_fee }}</span>
                                        </td>



                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">One-Time Servicing Fee Currency</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $basic_data->servicing_fee_currency }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Annual Servicing Fee Currency</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $basic_data->annual_fee_currency }}</span>
                                        </td>

                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">One Time Servicing Fee Status</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $basic_data->servicing_fee_status }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Annual Servicing Fee Status</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">{{ $basic_data->annual_fee_status }}</span>
                                        </td>

                                        <td style="width:50%; padding-top:20px;">
                                            <b style="font-size:15px; color:#010101">Annual Servicing Fee Amount</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
											 display:block; padding-top:7px;">$
                                                {{ $basic_data->annual_servicing_fee }}</span>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Company(s)</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
                                         display:block; padding-top:7px;">
                                                {{ $companyName }}</span>
                                        </td>

                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Business Type</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
                                         display:block; padding-top:7px;">{{ $data->business_type }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Client Type</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
                                         display:block; padding-top:7px;">
                                                {{ $data->client_type }}</span>
                                        </td>

                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Created By</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
                                         display:block; padding-top:7px;">{{ $data->users->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;">
                                            <b style="font-size:15px; color:#010101">Client Status</b>
                                            <span
                                                style="font-size:15px; font-weight:400; color:#010101 ;
                                         display:block; padding-top:7px;">
                                                {{ $data->client_status }}</span>
                                        </td>


                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>


                    {{-- Company --}}
                    @if ($data->business_type == 'FO' || ($data->business_type == 'Non-FO' && $data->client_type == 'Corporate'))
                        @foreach ($data->companies as $key => $company)
                            <tr class="fourth-row-cstm">
                                <td style="padding:10px 0;">
                                    <table style="width:80%; margin:0 auto;">
                                        <tr>
                                            <td style="width:25%; text-align:right; color:#000;">
                                                <hr / style="background-color:#000; ">
                                            </td>
                                            <td style="text-align:center; width:42%">
                                                <div class="text-center line-cstm"
                                                    style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                                    Company Infomation</div>
                                            </td>
                                            <td style="width:25%; text-align:left; color:#000;">
                                                <hr / style="background-color:#000; ">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="third-row-cstm">
                                <td>
                                    <table style="width:100%; margin:0 auto;" border="0">
                                        <tr>
                                            <td style="padding:15px 0px 0;">
                                                <b style="width:50%;color:#000; font-size:15px ; font-weight:700;">
                                                    Company Name {{ $key + 1 }}
                                                </b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ $company->name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;color:#000; font-size:15px ; padding-top:26px;">
                                                <b>Company Address</b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ $company->address }}</span>
                                            </td>
                                            <td style="width:50%;color:#000; font-size:15px ; padding-top:26px;">
                                                <b>UEN</b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ $company->uen }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width:50%;color:#000; font-size:15px ; padding-top:26px;">
                                                <b>Incorporation Date</b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ convertDate($company->incorporate_date,"d/m/Y")  }}</span>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td style="width:50%;color:#000; font-size:15px ;padding-top:26px;">
                                                <b>Company Email</b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ $company->company_email }}</span>
                                            </td>
                                            <td style="width:50%;color:#000; font-size:15px ;  padding-top:26px;">
                                                <b>Company Password</b>
                                                <span
                                                    style="padding-top:12px; display:block;">{{ $company->company_pass }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            {{-- Shareholder` --}}
                            @foreach ($company->shareholder as $key2 => $shareholder)
                                <tr class="fourth-row-cstm">
                                    <td style="padding-top:15px">
                                        <table style="width:100%; margin:0 auto;" border="1">
                                            <tr>
                                                <td
                                                    style="width:50%;color:#000; font-size:21px ; font-weight:700; padding:13px 15px 0;">
                                                    Shareholder #{{ $key2 + 1 }}
                                                </td>
                                            </tr>
                                            @if (isset($shareholder->shareholder_type) && $shareholder->shareholder_type == 'Company')
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Equity Percentage</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->equity_percentage }}
                                                            <span class="pecentage_end">%</span></span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Shareholder Type</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->shareholder_type }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Company Name</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->shareholder_company_name }}</span>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Equity Percentage</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->equity_percentage }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Full Name (Eng)</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->pass_name_eng }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Full Name (Chinese)</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->pass_name_chinese }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Renewal Reminder</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->passport_renew }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Gender</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->gender }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Reminder
                                                            Trigger
                                                            Frequency</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->passport_trg_fqy }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Expiry Date (DD/MM/YYYY)</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ convertDate($shareholder->passport_exp_date,'d/m/Y') }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Number</b>
                                                        <span
                                                            style="padding-top:12px; display:block;">{{ $shareholder->passport_no }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                                        <b>E-mail </b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->email }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Passport Country</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->passport_country }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                                        <b>Residential Add.</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->residential_address }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Phone Number</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->phone }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                                        <b>Current TIN Number</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->tin_no }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Current TIN Country</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->tin_country }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                                        <b>Job Title</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->job_title }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Type of TIN</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->type_of_tin }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                                        <b>Relationship with shareholder</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->relation_with_shareholder }}</span>
                                                    </td>
                                                    <td
                                                        style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                                        <b>Monthly Salary in Company</b>
                                                        <span
                                                            style="padding-top:12px; padding-bottom:10px; display:block;">{{ $shareholder->monthly_sal }}</span>
                                                    </td>
                                                </tr>
                                            @endif

                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr class="fourth-row-cstm">
                            <td style="padding-top:15px">
                                <table style="width:100%; margin:0 auto;" border="1">
                                    <tr class="fourth-row-cstm">
                                        <td style="padding:10px 0;">
                                            <table style="width:80%; margin:0 auto;">
                                                <tr>
                                                    <td style="width:25%; text-align:right; color:#000;">
                                                        <hr / style="background-color:#000; ">
                                                    </td>
                                                    <td style="text-align:center; width:42%">
                                                        <div class="text-center line-cstm"
                                                            style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                                            Personal Infomation</div>
                                                    </td>
                                                    <td style="width:25%; text-align:left; color:#000;">
                                                        <hr / style="background-color:#000; ">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Passport Full Name (Eng)</b>
                                            <span
                                                style="padding-top:12px; display:block;">{{ $basic_data->pass_name_eng }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Passport Full Name (Chinese)</b>
                                            <span
                                                style="padding-top:12px; display:block;">{{ $basic_data->pass_name_chinese }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Gender</b>
                                            <span
                                                style="padding-top:12px; display:block;">{{ $basic_data->gender }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>DOB(DD/MM/YYYY)</b>
                                            <span style="padding-top:12px; display:block;">
                                                {{ convertDate($basic_data->dob,"d/m/Y") }}
                                        </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Passport Expiry Date (DD/MM/YYYY)</b>
                                            <span
                                                style="padding-top:12px; display:block;">{{ convertDate($basic_data->passport_exp_date,'d/m/Y') }}
                                            </span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Passport Number</b>
                                            <span
                                                style="padding-top:12px; display:block;">{{ $basic_data->passport_no }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Passport Renewal Reminder </b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->passport_renew }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Passport Country</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->passport_country }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Passport Reminder Trigger Frequency</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->passport_trg_fqy }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Current TIN Number</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->tin_no }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Current TIN Country</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->tin_country }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>TIN Number before pass application</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->tin_before_application }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Type of TIN</b>

                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->type_of_tin }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px;">
                                            <b>Email</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->email }}</span>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>TIN Country before pass application</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->tin_country_before_app }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Residential Address</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->residential_address }}</span>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Phone Number</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->phone }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Employer's Industry</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->employer_industry }}</span>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Employer's Name</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->employer_name }}</span>
                                        </td>
                                        <td
                                            style="width:50%;color:#000; font-size:15px ; padding-left:15px; padding-top:20px; ">
                                            <b>Current Job Title</b>
                                            <span
                                                style="padding-top:12px; padding-bottom:10px; display:block;">{{ $basic_data->job_title }}</span>
                                        </td>

                                    </tr>


                                </table>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            {{-- Application Information --}}
            @if ($data->business_type == 'FO')
                {{-- MAS Related --}}
                <div class="page page_6" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                            <table class="header-table">
                                <tr>
                                    <td style="width:20%;">
                                        <img src="{{ url('/images/logo.png') }}" alt="logo"
                                            style="width:100px;">
                                    </td>
                                    <td>
                                        <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                            <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                            <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:30px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:23%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                MAS Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="forth-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:15px;">
                                            <b>Account Status</b>
                                            <span style="padding-top:15px; display:block;">Active</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:15px;">
                                            <b>Tax Advisor Name</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Tax Advisor Email</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Tax Advisor Conatact Number</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Kickstart to Tax Advisor</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Legal Opinion</b>
                                            <span style="padding-top:15px; display:block;">Singapore</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Presentation Deck(Final)</b>
                                            <span style="padding-top:15px; display:block;">None</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>MASNET Account Opening</b>
                                            <span style="padding-top:15px; display:block;">Others, please specify: EAD
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Preliminary Approval</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Final Approval</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Final Submission</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>OIC Name</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>MASNET Username</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>MASNET Password</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Institution Code</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Declaration Frequency</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Commencement Date</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Reminder Notification</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Annual Declaration Deadline</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Internal Account Manager</b>
                                            <span style="padding-top:15px;  display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Trigger Frequency Reminder</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                    </table>

                </div>
                {{-- Financial --}}
                <div class="page page_7" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:30px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:8%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:38%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:20px 0;">
                                                Financial Institution Related</div>
                                        </td>
                                        <td style="width:8%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="forth-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Stakeholder Type</b>
                                            <span style="padding-top:25px; display:block;">Fund CO</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:13px;">
                                            <b>Financial Institution Name 1</b>
                                            <span style="padding-top:25px; display:block;">DBS bank Ltd</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>POC Name</b>
                                            <span style="padding-top:25px; display:block;">abc</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>POC Contact Number</b>
                                            <span style="padding-top:25px; display:block;">9123456789</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>POC Email</b>
                                            <span style="padding-top:25px; display:block;">9123456789</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Application Submission</b>
                                            <span style="padding-top:25px; display:block;">Singapore</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Account Type</b>
                                            <span style="padding-top:25px; display:block;">None</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Account(Policy Number)</b>
                                            <span style="padding-top:25px; display:block;">Others, please specify: EAD
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Account Opening Status</b>
                                            <span style="padding-top:25px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Current Account Status</b>
                                            <span style="padding-top:25px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Money Deposit Status</b>
                                            <span style="padding-top:25px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Intial Deposit Amount</b>
                                            <span style="padding-top:25px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Username</b>
                                            <span style="padding-top:25px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Password</b>
                                            <span style="padding-top:25px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:25px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">

                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                    </table>

                </div>
                {{-- Pass Related --}}
                <div class="page page_8" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:30px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:23%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                Pass Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="forth-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:15px;">
                                            <b>Pass Holder Name 1 (Eng)</b>
                                            <span style="padding-top:15px; display:block;">Active</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:15px;">
                                            <b>Passport Full Name (Chinese)</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Gender(M/F)</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>DOB(DD/MM/YYYY)</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Passpport Number</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Passport Expiry Date(DD/MM/YYYY) </b>
                                            <span style="padding-top:15px; display:block;">Singapore</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Passport Renewal Reminder </b>
                                            <span style="padding-top:15px; display:block;">None</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Passport Country </b>
                                            <span style="padding-top:15px; display:block;">Others, please specify: EAD
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Passport Reminder Trigger Frequency</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>TIN Number Before Pass Application</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Tin Country Before Pass Application</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Email</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Type of TIN Before Pass Application</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Residential Address</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Phone Number</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Application Status</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Business Type</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Application Type</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Relationship with Pass Holder 1</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>FIN Number</b>
                                            <span style="padding-top:15px;  display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Issuace</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Renewal Reminder</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Issuace Date</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Expiry Date</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Job Title</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Pass Renewal Trigger Frequency</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Duration</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Singpass Set Up</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Monthly Salary</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr> --}}

                                </table>
                            </td>
                        </tr>

                    </table>

                </div>
                {{-- Business Related --}}
                <div class="page page_9" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:20px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:23%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                Pass Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="forth-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Pass. Job Title</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:10px;">
                                            <b>Pass renewal Trigger Frequency</b>
                                            <span style="padding-top:15px; display:block;">Every Week</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Duration </b>
                                            <span style="padding-top:15px; display:block;">5 Year</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:10px;">
                                            <b>Singpass Set Up</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Monthly salary (SGD)</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b></b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:10px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b></b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="five-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:28%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                Business Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="six-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Financial Institution Name 1</b>
                                            <span style="padding-top:15px; display:block;">DBS bank Ltd</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:10px;">
                                            <b>Account Status</b>
                                            <span style="padding-top:15px; display:block;">Approved</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Application Submission</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Account/Policy Number</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Account Type</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>PAyment Mode</b>
                                            <span style="padding-top:15px; display:block;">Singapore</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Product Name</b>
                                            <span style="padding-top:15px; display:block;">None</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Investment Amount Premium</b>
                                            <span style="padding-top:15px; display:block;">Others, please specify: EAD
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Username</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Password</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Currency</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Maturity Date</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Subscription/Inception Date</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Maturity Reminder</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Duration</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Monthly Reminder Trigger Frequency</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>

                </div>

                <div class="page page_10" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:25px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td style="padding:0 0 20px;">
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:28%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                Business Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="forth-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Commission Currency (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;">SGD</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:10px;">
                                            <b>Commission Status (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:10px;">
                                            <b>Commission Amount (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="five-row-cstm">
                            <td style="padding-top:30px;">
                                <table style="width:100%; margin:0 auto;">
                                    <tr>
                                        <th
                                            style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                            Redemption Date
                                        </th>
                                        <th
                                            style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                            Redemption Amount
                                        </th>
                                        <th
                                            style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                            Net Account Value
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="width:30%; color:#000; padding:16px;">
                                            30/03/2021
                                        </td>
                                        <td style="width:30%; color:#000; padding:16px;">
                                            $13,000
                                        </td>
                                        <td style="width:30%; color:#000; padding:16px;">
                                            $16,625
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
            @else
                {{-- Business Related --}}
                <div class="page page_9" style="page-break-before: always;">
                    <table class="header-table">
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $companyName }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">{{ $data->client_type }} ({{ $data->business_type }})</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:43%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:20px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:5%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="five-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                        <td style="width:10%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:28%">
                                            <div class="text-center line-cstm"
                                                style="font-size:17px; color:#010101; font-weight:500; padding:10px 0;">
                                                Business Related</div>
                                        </td>
                                        <td style="width:10%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="width:20%; text-align:right; color:#000;">

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="six-row-cstm">
                            <td>
                                <table style="width:100%; margin:0 auto;" border="0">
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Financial Institution Name 1</b>
                                            <span style="padding-top:15px; display:block;">DBS bank Ltd</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:10px;">
                                            <b>Account Status</b>
                                            <span style="padding-top:15px; display:block;">Approved</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Application Submission</b>
                                            <span style="padding-top:15px; display:block;">abc</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Account/Policy Number</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Account Type</b>
                                            <span style="padding-top:15px; display:block;">9123456789</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Payment Mode</b>
                                            <span style="padding-top:15px; display:block;">Singapore</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:13px;">
                                            <b>Product Name</b>
                                            <span style="padding-top:15px; display:block;">None</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Investment Amount Premium</b>
                                            <span style="padding-top:15px; display:block;">Others, please specify: EAD
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Username</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Online Account Password</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Currency</b>
                                            <span style="padding-top:15px;  display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Maturity Date</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Subscription/Inception Date</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Maturity Reminder</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Duration</b>
                                            <span style="padding-top:15px; display:block;">Self</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:13px;">
                                            <b>Monthly Reminder Trigger Frequency</b>
                                            <span style="padding-top:15px; display:block;">$30,000.00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Commission Currency (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;">SGD</span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;  padding-top:10px;">
                                            <b>Commission Status (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%;color:#000; font-size:15px ; padding-top:10px;">
                                            <b>Remarks</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                        <td style="width:50%;color:#000; font-size:15px ;padding-top:10px;">
                                            <b>Commission Amount (For Admin Purpose)</b>
                                            <span style="padding-top:15px; display:block;"></span>
                                        </td>
                                    </tr>
                                    <tr class="five-row-cstm">
                                        <td style="padding-top:30px;">
                                            <table style="width:100%; margin:0 auto;">
                                                <tr>
                                                    <th
                                                        style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                                        Redemption Date
                                                    </th>
                                                    <th
                                                        style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                                        Redemption Amount
                                                    </th>
                                                    <th
                                                        style="width:30%; color:#6B7280; padding:16px; background:#F9FAFB; border-bottom:1px solid #ddd;">
                                                        Net Account Value
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td style="width:30%; color:#000; padding:16px;">
                                                        30/03/2021
                                                    </td>
                                                    <td style="width:30%; color:#000; padding:16px;">
                                                        $13,000
                                                    </td>
                                                    <td style="width:30%; color:#000; padding:16px;">
                                                        $16,625
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>

                </div>
            @endif

        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
            $("#text_notes").keyup(function() {
            $("#notes_cancel").show();
            });

            $("#notes_cancel").click(function() {
            $("#text_notes").val('');
            $("#notes_cancel").hide();
            });

        $('body').on('click', '.del_confirm', function() {
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
                    var url = "{{ route('wealth.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            wealth: id,
                        },
                        cache: false,
                        success: function(response) {
                            swal({
                                title: "Success!",
                                text: "Account deleted successfully",
                                icon: "success",
                                buttons: true,
                                buttons: {
                                    cancel: false,
                                    confirm: {
                                        text: 'OK',
                                        className: 'btn btn-danger'
                                    },
                                },
                            }).then((result) => {
                                window.location =
                                    "{{ route('wealth.index') }}";
                            })
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
        $('.print-icon').on('click', function() {
            $('#print_screen').show();
            $("#print_screen").print({
                addGlobalStyles: false,
                stylesheet: "{{ url('/css/print.css?v=' . time()) }}",
                rejectWindow: true,
                noPrintSelector: ".no-print",
                iframe: true,
                append: null,
                prepend: null
            });
            $('#print_screen').hide();
        });
        $('body').on('click', '.wealth_file_del_confirm', function() {
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
                    var url = "/wealth-deletefile/" + id;
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
                                window.location.reload();
                            })
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
