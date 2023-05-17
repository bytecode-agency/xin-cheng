@extends('layouts.app')
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
                @if (count($data->companies) > 0)
                    @foreach ($data->companies as $key => $cmp_name)
                        {{ $cmp_name->name }}
                    @endforeach
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
                <li><a href="">Finance</a></li>
                {{-- <li>{{ Breadcrumbs::render('wealth.show') }}</li> --}}
                {{-- <li>{{ Breadcrumbs::render('wealth.show', $data) }}</li> --}}
            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="javascript:void(0)" class="me-3 print-icon"><img src="{{ url('/images/Vector.svg') }}"
                    alt="print Icon"></a>
            <a href="{{ route('finance.edit', $data->id) }}"><button class="btn saveBtn"><span>Edit</span></button></a>
            <button class="btn saveBtn cancelBtn del_confirm" data-id="{{ $data->id }}"><span>Delete</span></button>
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
                        <label for="" class="form-label">Client(s)</label>
                        <p>{{ $data->pname }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Business Type</label>
                        <p>{{ $data->bus_type }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Client Type</label>
                        <p>{{ $data->client_type }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Created By</label>
                        <p>{{ $data->created_by }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Client Status</label>
                        <div class="active-btn">Active</div>
                    </div>
            </div>
        </div>
        <div class="card company_info formContentData border-0 p-4">
            @if ($data->bus_type == 'wealthmanagement' && $data->client_type == 'Corporate')
                <h3>Application Information</h3>
                @foreach ($data->companies as $key => $company)

                <div class="w-100 justify-content-start form-fields company_design p-4">
                    <div class="company_basic_data d-flex flex-wrap">
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_compnay" class="form-label">Company Name {{$key+1}}</label>
                            <p>{{ $company->c_name }}</p>
                        </div>
                        <div class="formAreahalf">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_uen" class="form-label">UEN</label>
                            <p>{{ $company->c_uen }}</p>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_add" class="form-label">Company Address</label>
                            <p>{{ $company->c_address }}</p>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                            <p>{{ $company->c_date }}</p>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_email" class="form-label">Company Email</label>
                            <p>{{ $company->c_email }}</p>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_pass" class="form-label">Company Password</label>
                            <p>{{ $company->c_password }}</p>
                        </div>
                        <div class="formAreahalf">
                        </div>
                    </div>

                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-mas{{$key}}" type="button" role="tab" aria-controls="nav-home"
                                 aria-selected="true">
                                 Shareholders</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-financial{{$key}}" type="button" role="tab"
                                 aria-controls="nav-profile" aria-selected="false">Financial Institution
                                    </button>
                      </div>
                    </nav>
                    <div class="tab-content border_styling" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-mas{{$key}}" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                @foreach($company->shareholders as $key1 =>$shareholder)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap w-100 justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2>Shareholders #{{$key1+1}}</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOne{{$key}}{{$key1+1}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                        
                                        <div id="mas_collapseOne{{$key}}{{$key1+1}}" class="collapse " aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Equity Percentage</label>
                                                    <p>{{ $shareholder->fo_equity }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Full name</label>
                                                    <p>{{ $shareholder->pname }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Full Name(chinese)</label>
                                                    <p>{{ $shareholder->pnamec}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Renewal Reminder</label>
                                                    <p>{{ $shareholder->prenrem}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">DOB(DD/MM/YYYY)</label>
                                                    <p>{{ $shareholder->pdob}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                                                    <p>{{$shareholder->premtf}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Gender</label>
                                                    <p>{{$shareholder->pgender}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Number</label>
                                                    <p>{{$shareholder->pnumber}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Expiry Date(DD/MM/YYYY)</label>
                                                    <p>{{$shareholder->pexdate}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Passport Country</label>
                                                    <p>{{$shareholder->pcountry}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Email</label>
                                                    <p>{{$shareholder->pemail}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Phone No</label>
                                                    <p>{{$shareholder->pphoneno}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Residential Add.(acc. to add.proof</label>
                                                    <p>{{$shareholder->paddress}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Current TIN country</label>
                                                    <p>{{$shareholder->ptincountry}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Current TIN number</label>
                                                    <p>{{$shareholder->ptinnumber}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Type of Tin</label>
                                                    <p>{{$shareholder->ptypetin}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Job Title</label>
                                                    <p>{{$shareholder->jtitle}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                                                    <p>{{$shareholder->msalary}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Relationship With Shareholder</label>
                                                    <p>{{$shareholder->rl_with_sh}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{$shareholder->premarks}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        
                            <div class="tab-pane fade " id="nav-financial{{$key}}" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                
                                @foreach ($company->financial as $key2 => $finance)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap w-100 justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2>Financial Institution #{{ $key2 + 1 }}</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOne{{$key}}{{$key2+1}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                        
                                        <div id="mas_collapseOne{{$key}}{{$key2+1}}" class="collapse " aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Financial Institution name</label>
                                                    <p>{{ $finance->i_name }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Bank Application Submission</label>
                                                    <div class="active-btn">Done</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Account Opening Status</label>
                                                    <div class="active-btn">Approved</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Account Type</label>
                                                    <p>{{ $finance->ac_type}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Account Number</label>
                                                    <p>{{ $finance->ac_number}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Bank Account status</label>
                                                    <div class="active-btn">Active</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{ $finance->remarks }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        
                            
                    </div>
    
                </div>                
            
                @endforeach
            
                <nav class="w-100">
                      <div class="nav nav-tabs" id="nav-tab3" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-payment" type="button" role="tab" aria-controls="nav-home"
                                 aria-selected="true">
                                 Payment Recievable Item</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-report" type="button" role="tab"
                                 aria-controls="nav-profile" aria-selected="false">Report Submission Item
                                    </button>
                      </div>
                </nav>
                
                <div class="tab-content border_styling w-100" id="nav-tabContent">
                            <div class="tab-pane fade w-100" id="nav-report" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                @foreach($report_rep as $key =>$report)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap  justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2> Report</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOnereport{{$key}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                    
                                        <div id="mas_collapseOnereport{{$key}}" class="collapse show w-100" aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Report Submission Item</label>
                                                    <p>{{ $report['submission'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Currency</label>
                                                    <p>{{ $report['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Frequency</label>
                                                    <p>{{ $report['subfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Amount</label>
                                                    <p>{{ $report['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Deadline</label>
                                                    <p>{{ $report['subdead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Reminder Trigger</label>
                                                    <p>{{ $report['subretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Status</label>
                                                    <div class="active-btn">Submitted</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Reminder Trigger Frequency</label>
                                                    <p>{{ $report['subretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{ $report['remarks'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade w-100 show active" id="nav-payment" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                @foreach($payment_rep as $key =>$payment)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap  justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2>Payment</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOnereport{{$key}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                    
                                        <div id="mas_collapseOnereport{{$key}}" class="collapse show w-100" aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Revenue Item</label>
                                                    <p>{{ $payment['revenue'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Currency</label>
                                                    <p>{{ $payment['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Frequency</label>
                                                    <p>{{ $payment['payfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Amount</label>
                                                    <p>{{ $payment['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Deadline</label>
                                                    <p>{{ $payment['paredead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Reminder Trigger</label>
                                                    <p>{{ $payment['pareretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Status</label>
                                                    <div class="active-btn">Submitted</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Trigger Frequency</label>
                                                    <p>{{ $payment['paretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{ $payment['remarks'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                </div>

            @else
                <h3>Personal Information</h3>
                <div class="nfo_personal_data_show d-flex flex-wrap">
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full Name(Eng)</label>
                        <p>{{ $data->pname}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full Name(Chinese)</label>
                        <p>{{ $data->pnamec}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Gender</label>
                        <p>{{ $data->pgender}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">DOB</label>
                        <p>{{ $data->pdob}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Number</label>
                        <p>{{ $data->pnumber}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                        <p>{{ $data->pexdate}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Renewal Reminder</label>
                        <p>{{ $data->prenrem}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Country</label>
                        <p>{{ $data->pcountry}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                        <p>{{ $data->premtr}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN Number</label>
                        <p>{{ $data->ptinnumber}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN country</label>
                        <p>{{ $data->ptincountry}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Type of TIN</label>
                        <p>{{ $data->ptypetin}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Phone Number</label>
                        <p>{{ $data->pphoneno}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">E-mail</label>
                        <p>{{ $data->pemail}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Residential Address</label>
                        <p>{{ $data->paddress}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Remark</label>
                        <p>{{ $data->premarks}}</p>
                    </div>
                </div>

                
            @endif
            
        </div>

        @if ($data->bus_type == 'wealthmanagement' && $data->client_type == 'Personal')
        <div class="card company_info formContentData border-0 p-4">
             <h3>Application Information</h3>
                <nav class="w-100">
                      <div class="nav nav-tabs" id="nav-tab3" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-payment" type="button" role="tab" aria-controls="nav-home"
                                 aria-selected="true">
                                 Payment Recievable Item</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-report" type="button" role="tab"
                                 aria-controls="nav-profile" aria-selected="false">Report Submission Item
                                    </button>
                      </div>
                </nav>
                
                <div class="tab-content border_styling w-100" id="nav-tabContent">
                            <div class="tab-pane fade w-100" id="nav-report" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                @foreach($report_rep as $key =>$report)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap  justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2> Report</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOnereport{{$key}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                    
                                        <div id="mas_collapseOnereport{{$key}}" class="collapse show w-100" aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Report Submission Item</label>
                                                    <p>{{ $report['submission'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Currency</label>
                                                    <p>{{ $report['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Frequency</label>
                                                    <p>{{ $report['subfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Amount</label>
                                                    <p>{{ $report['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Deadline</label>
                                                    <p>{{ $report['subdead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Reminder Trigger</label>
                                                    <p>{{ $report['subretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Status</label>
                                                    <div class="active-btn">Submitted</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Reminder Trigger Frequency</label>
                                                    <p>{{ $report['subretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{ $report['remarks'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade w-100 show active" id="nav-payment" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                @foreach($payment_rep as $key =>$payment)
                                <div id="mas_accordion" class="mas_related">
                                    <div class="mas_heading_accordian d-flex flex-wrap  justify-content-start form-fields company_design p-4">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label"><h2>Payment</h2></label>
                                            <p></p>
                                        </div>
                                        <h1 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="btn btn_set" data-toggle="collapse" data-target="#mas_collapseOnereport{{$key}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                        </button>
                                        </h1>
                                    
                                        <div id="mas_collapseOnereport{{$key}}" class="collapse show w-100" aria-labelledby="headingOne"
                                            data-parent="#mas_accordion">
                                            <div class="tab-data-inner-account d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Revenue Item</label>
                                                    <p>{{ $payment['revenue'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Currency</label>
                                                    <p>{{ $payment['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Frequency</label>
                                                    <p>{{ $payment['payfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Amount</label>
                                                    <p>{{ $payment['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Deadline</label>
                                                    <p>{{ $payment['paredead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Reminder Trigger</label>
                                                    <p>{{ $payment['pareretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Recievable Status</label>
                                                    <div class="active-btn">Submitted</div>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Payment Trigger Frequency</label>
                                                    <p>{{ $payment['paretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <p>{{ $payment['remarks'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                </div>
        </div>
        @endif

       

        <div class="card company_info formContentData border-0 p-4 ">
            <h3>Notes</h3>
            <textarea id="wealth_notes" name="wealth_notes" rows="8" cols="150" placeholder="Type your notes here..."
                readonly></textarea>
        </div>
        <div class="card company_info formContentData border-0 p-4 ">
            <h3>File Uploads</h3>
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
                    <tr>
                        <td>abc.jpg</td>
                        <td>Super Admin</td>
                        <td>7 April 2023 01:00 pm</td>
                        <td><i class="fa fa-download" aria-hidden="true"></i>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>   

        <div class="card company_info formContentData border-0 p-4 ">
            <h3>Action Log</h3>
            <table class="table user_action_log">
                <thead>
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Made by</th>
                        <th scope="col">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($action_log as $activity) --}}
                    <tr>
                        {{-- <td>{{ $activity->message }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->created_at->format('j F Y  g:i a') }}</td> --}}
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>

    </div>
    <div id="print_screen" style="display:none;">
        <div class="print-holder">
            <div class="page page_1">
                <table class="header-table">
                    <tr>
                        <td>
                            <img src="https://xincheng-dev.sftechnologiesstage.co/images/logo.png" alt="logo">
                        </td>
                        <td>
                            <table border="0">
                                <tr>
                                    <td colspan="2" class="main-heading center">
                                        {{ $data->id }}- @foreach ($data->companies as $company_name)
                                            {{ $company_name->name }}
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table border="0">
                    <tr>
                        <td colspan="2" class="sub-heading center">Basic Information</td>
                    </tr>
                    <tr>
                        <td class="heading">Client</td>
                        <td class="heading">Created By</td>
                    </tr>
                    <tr>
                        <td class="value">120 - Jack Ma</td>
                        <td class="value">Super Admin</td>
                    </tr>
                    <tr>
                        <td class="heading">Client Status</td>
                    </tr>
                    <tr>
                        <td class="value">Active</td>
                    </tr>
                </table>

                <table border="0">
                    <tr>
                        <td colspan="2" class="sub-heading center">Application Information</td>
                    </tr>
                    <tr>
                        <td class="heading">Business Type</td>
                        <td class="heading">Client Type</td>
                    </tr>
                    <tr>
                        <td class="value">B2B</td>
                        <td class="value">Personal</td>
                    </tr>
                    <tr>
                        <td class="heading">Client's Full Name</td>
                        <td class="heading">Country of Client</td>
                    </tr>
                    <tr>
                        <td class="value">Jack Ma</td>
                        <td class="value" data-val='Country'>Singpur</td>
                    </tr>
                </table>

                <span class="break-page"></span>
            </div>
            <div class="page page_2">
                <table class="header-table">
                    <tr>
                        <td>
                            <img src="https://xincheng-dev.sftechnologiesstage.co/images/logo.png" alt="logo">
                        </td>
                        <td>
                            <table border="0">
                                <tr>
                                    <td colspan="2" class="main-heading center">120 -
                                        Jack Ma</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="main-heading center">Sales</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="border">
                    <tr>
                        <td colspan="2" class="sub-heading center">Application Information</td>
                    </tr>
                    <tr>
                        <td class="heading">Business Type</td>
                        <td class="heading">Client Type</td>
                    </tr>
                    <tr>
                        <td class="value">B2B</td>
                        <td class="value">Personal</td>
                    </tr>
                    <tr>
                        <td class="heading">Client's Full Name</td>
                        <td class="heading">Country of Client</td>
                    </tr>
                    <tr>
                        <td class="value">Jack Ma</td>
                        <td class="value" data-val='Country'>Singpur</td>
                    </tr>
                </table>

                <table class="border">
                    <tr>
                        <td colspan="2" class="sub-heading center">Application Information</td>
                    </tr>
                </table>

                <table class="border">
                    <tr>
                        <td>
                            <table class="border">
                                <tr>
                                    <td colspan="2" class="sub-heading center">Application Information</td>
                                </tr>
                                <tr>
                                    <td class="heading">Business Type</td>
                                    <td class="heading">Client Type</td>
                                </tr>
                                <tr>
                                    <td class="value">B2B</td>
                                    <td class="value">Personal</td>
                                </tr>
                                <tr>
                                    <td class="heading">Client's Full Name</td>
                                    <td class="heading">Country of Client</td>
                                </tr>
                                <tr>
                                    <td class="value">Jack Ma</td>
                                    <td class="value" data-val='Country'>Singpur</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="heading">Business Type</td>
                        <td class="heading">Client Type</td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
        integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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
                    var url = "{{ route('finance.destroy', ':id') }}";
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
                                    "{{ route('finance.allapps') }}";
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
    </script>
@endpush
