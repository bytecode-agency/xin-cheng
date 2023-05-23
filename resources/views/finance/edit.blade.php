@extends('layouts.app')
@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($data->id, 3, '000', STR_PAD_LEFT) }} -
                Edit Application
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
        <button class="btn saveBtn edit_save"><span>Save</span></button>
            <a href="{{ route('finance.show', $data->id) }}"><button
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
    <form action="javascript:void(0);" class="justify-content-start flex-wrap" id="multistep_form_edit">
            @csrf
            <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="finance_id" id="finance_id" value="{{ $data->id }}">
            <input type="hidden" name="business" id="business" value="{{ $data->bus_type }}">
            <input type="hidden" name="client" id="client" value="{{ $data->client_type }}">
            <input type="hidden" name="businessdes" id="businessdes" value="{{ $data->bus_des }}">
            

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
        <div class=" card company_info formContentData border-0 p-4">
            @if ($data->bus_type == 'wealthmanagement' && $data->client_type == 'Corporate')
                <h3>Application Information</h3>
                @foreach ($data->companies as $key => $company)
                <input type="hidden" name="cmp[{{$key}}][c_id]" value="{{$company->id}}">
                <div class="w-100 justify-content-start form-fields company_design p-4">
                    <div class="company_basic_data d-flex flex-wrap">
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_compnay" class="form-label">Company Name {{$key+1}}</label>
                            <input type="text" name="cmp[{{$key}}][fo_company]" id="fo_compnay" class="form-control"
                                value="{{ $company->c_name }}">
                        </div>
                        <div class="formAreahalf">
                        </div>
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_uen" class="form-label ">UEN</label>
                            <input type="text" class="form-control" name="cmp[{{$key}}][fo_uen]" id="fo_uen" value="{{ $company->c_uen }}">
                        </div>
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_company_add" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="cmp[{{$key}}][fo_company_add]" id="fo_company_add" value="{{ $company->c_address }}">
                        </div>
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                            <input type="date" class="form-control" name="cmp[{{$key}}][fo_incorporation_date]"
                            id="fo_incorporation_date" value="{{ $company->c_date }}">
                        </div>
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_company_email" class="form-label">Company Email</label>
                            <input type="text" class="form-control" name="cmp[{{$key}}][fo_company_email]"
                                id="fo_company_email" value="{{ $company->c_email }}">
                        </div>
                        <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_company_pass" class="form-label">Company Password</label>
                            <input type="text" class="form-control" name="cmp[{{$key}}][fo_company_pass]"
                                id="fo_company_pass" value="{{ $company->c_password }}">
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
                                <input type="hidden" name="share[{{$key}}][{{$key1}}][c_id]" id="" value="{{$company->id}}">{{ $company->id}}
                                <input type="hidden" name="share[{{$key}}][{{$key1}}][s_id]" id="" value="{{$shareholder->id}}">{{ $shareholder->id}}
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
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Equity Percentage {{ $company->c_id}}</label>
                                                    <input type="text" name="share[{{$key}}][{{$key1}}][fo_equity]" id="share[{{$key}}][{{$key1}}][fo_equity]" class="form-control" value="{{ $shareholder->fo_equity }}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Full name</label>
                                                    <input type="text" class="form-control" id="share[0][0][pname]" name="share[{{$key}}][{{$key1}}][pname]" value="{{ $shareholder->pname }}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Full Name(chinese)</label>
                                                    <input type="text" class="form-control" id="share[0][0][pnamec]" name="share[{{$key}}][{{$key1}}][pnamec]" value="{{ $shareholder->pnamec}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Renewal Reminder</label>
                                                    <select name="share[{{$key}}][{{$key1}}][prenrem]" id="share[0][0][prenrem]">
                                                      <option value="30" {{ $shareholder->prenrem =='30' ? 'selected' : ''}} > 30 days before expiry</option>
                                                      <option value="60" {{ $shareholder->prenrem =='60' ? 'selected' : ''}} > 60 days before expiry</option>
                                                      <option value="90" {{ $shareholder->prenrem =='90' ? 'selected' : ''}} > 90 days before expiry</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">DOB(DD/MM/YYYY)</label>
                                                    <input type="date" class="form-control" id="share[0][0][pdob]" name="share[{{$key}}][{{$key1}}][pdob]" value="{{ $shareholder->pdob}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                                                    <select name="share[{{$key}}][{{$key1}}][premtf]" id="share[0][0][premtf]">
                                                      <option value="everyweek" {{ $shareholder->premtf =='everyweek' ? 'selected' : ''}} > Every Week</option>
                                                      <option value="everymonth" {{ $shareholder->premtf =='everymonth' ? 'selected' : ''}} > Every Month</option>
                                                    </select>
                                                    <p>{{$shareholder->premtf}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Gender</label>
                                                    <select name="share[{{$key}}][{{$key1}}][pgender]" id="share[0][0][pgender]">
                                                     <option value="Male" {{ $shareholder->pgender =='Male' ? 'selected' : ''}} > Male</option>
                                                     <option value="Female" {{ $shareholder->pgender =='Female' ? 'selected' : ''}}>Female</option>
                                                    </select>
                                                    <p>{{$shareholder->pgender}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Number</label>
                                                    <input type="text" class="form-control" id="share[0][0][pnumber]" name="share[{{$key}}][{{$key1}}][pnumber]" value="{{$shareholder->pnumber}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Expiry Date(DD/MM/YYYY)</label>
                                                    <input type="date" class="form-control" id="share[0][0][pexdate]" name="share[{{$key}}][{{$key1}}][pexdate]" value="{{$shareholder->pexdate}}">
                                                    <p>{{$shareholder->pexdate}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Passport Country</label>
                                                    <input type="text" class="form-control" id="share[0][0][pcountry]" name="share[{{$key}}][{{$key1}}][pcountry]" value="{{$shareholder->pcountry}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="share[0][0][pemail]" name="share[{{$key}}][{{$key1}}][pemail]" value="{{$shareholder->pemail}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Phone No</label>
                                                    <input type="text" class="form-control" id="share[0][0][pphoneno]" name="share[{{$key}}][{{$key1}}][pphoneno]" value="{{$shareholder->pphoneno}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Residential Add.(acc. to add.proof</label>
                                                    <input type="text" class="form-control" id="share[0][0][paddress]" name="share[{{$key}}][{{$key1}}][paddress]" value="{{$shareholder->paddress}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Current TIN country</label>
                                                    <input type="text" class="form-control" id="share[0][0][ptincountry]" name="share[{{$key}}][{{$key1}}][ptincountry]" value="{{$shareholder->ptincountry}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Current TIN number</label>
                                                    <input type="text" class="form-control" id="share[0][0][ptinnumber]" name="share[{{$key}}][{{$key1}}][ptinnumber]" value="{{$shareholder->ptinnumber}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Type of Tin</label>
                                                    <select name="share[{{$key}}][{{$key1}}][ptypetin]" id="share[0][0][ptypetin]">others,please specify
                                                     <option value="EAD" {{ $shareholder->ptypetin =='EAD' ? 'selected' : ''}} > EAD</option>
                                                    </select>
                                                    <p>{{$shareholder->ptypetin}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Job Title</label>
                                                    <input type="text" class="form-control" id="share[0][0][jtitle]" name="share[{{$key}}][{{$key1}}][jtitle]" value="{{$shareholder->jtitle}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                                                    <input type="text" class="form-control" id="share[0][0][msalary]" name="share[{{$key}}][{{$key1}}][msalary]" value="{{$shareholder->msalary}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Relationship With Shareholder</label>
                                                    <select name="share[{{$key}}][{{$key1}}][rl_with_sh]" id="share[0][0][rl_with_sh]" class="fo_shrholder_type">
                                                      <option value="self" {{ $shareholder->rl_with_sh =='self' ? 'selected' : ''}}>Self</option>
                                                    </select>
                                                    <p>{{$shareholder->rl_with_sh}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label class="form-label" for="remarks">Remarks</label>
                                                    <textarea id="share[0][0][premarks]" name="share[{{$key}}][{{$key1}}][premarks]" rows="4" cols="50">{{ $shareholder->premarks}}</textarea>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
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
                                <input type="hidden" name="fin[{{$key}}][{{$key2}}][c_id]" id="" value="{{$company->id}}">{{ $company->id}}
                                <input type="hidden" name="fin[{{$key}}][{{$key2}}][f_id]" id="" value="{{$finance->id}}">{{ $finance->id}}
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
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Financial Institution name</label>
                                                    <input type="text" name="fin[{{$key}}][{{$key2}}][i_name]" id="fin[{{$key}}][{{$key2}}][i_name]" class="form-control" value="{{ $finance->i_name }}">
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Bank Application Submission</label>
                                                    <select name="fin[{{$key}}][{{$key2}}][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                                     <option value="done" {{ $finance->ba_app_sub == 'done' ? 'selected' : '' }} >Done</option>
                                                    </select>
                                                    {{$finance->ba_app_sub}}
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Account Opening Status</label>
                                                    <select name="fin[{{$key}}][{{$key2}}][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                                     <option value="Approved" {{ $finance->ac_open_sta == 'Approved' ? 'selected' : '' }} >Approved</option>
                                                    </select>
                                                    {{ $finance->ac_open_sta }}
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Account Type</label>
                                                    <select name="fin[{{$key}}][{{$key2}}][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                                     <option value="SGD" {{ $finance->ac_type == 'SGD' ? 'selected' : '' }}>SGD</option>
                                                     <option value="USD" {{ $finance->ac_type == 'USD' ? 'selected' : '' }}>USD</option>
                                                    </select>
                                                    <p>{{ $finance->ac_type}}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Account Number</label>
                                                    <input type="text" name="fin[{{$key}}][{{$key2}}][ac_number]" id="fin[{{$key}}][{{$key2}}][ac_number]" class="form-control" value="{{ $finance->ac_number}}">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Bank Account status</label>
                                                    <select name="fin[{{$key}}][{{$key2}}][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                                     <option value="Active" {{ $finance->bank_ac_sta == 'Active' ? 'selected' : '' }}>Active</option>
                                                    </select>
                                                     {{ $finance->bank_ac_sta}}
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <div><textarea id="fin[{{$key}}][{{$key2}}][remarks]" name="fin[{{$key}}][{{$key2}}][remarks]" rows="4" cols="50"> {{ $finance->remarks }}</textarea></div>
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
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Report Submission Item</label>
                                                    <select name="report[{{$key}}][submission]" id="report[0][submission]">
                                                     <option value="Wealth Management-Comission" {{$report['submission'] == 'Wealth Management-Comission' ? 'selected' :''}}>Wealth Management-Comission</option>
                                                     <option value="Wealth Management-AUM fee" {{$report['submission'] == 'Wealth Management-AUM fee' ? 'selected' :''}}>Wealth Management-AUM fee</option>
                                                    </select>
                                                    <p>{{ $report['submission'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Currency</label>
                                                    <select name="report[{{$key}}][currency]" id="report[0][currency]">
                                                    <option value="SGD" {{$report['currency'] == 'SGD' ? 'selected' :''}} >SGD</option>
                                                    <option value="USD" {{$report['currency'] == 'USD' ? 'selected' :''}} >USD</option>
                                                   </select>
                                                    <p>{{ $report['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Submission Frequency</label>
                                                    <select name="report[{{$key}}][subfre]" id="report[0][subfre]">
                                                     <option value="One Time" {{$report['subfre'] == 'One Time' ? 'selected' :''}}>One Time</option>
                                                    </select>
                                                    <p>{{ $report['subfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" name="report[{{$key}}][amount]" id="report[0][amount]" value="{{ $report['amount'] }}">
                                                    <p>{{ $report['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Submission Deadline</label>
                                                    <input type="date" class="form-control" id="report[0][subdead]" name="report[{{$key}}][subdead]" value="{{ $report['subdead'] }}">
                                                    <p>{{ $report['subdead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Submission Reminder Trigger</label>
                                                    <select name="report[{{$key}}][subretri]" id="report[0][subretri]">
                                                     <option value="60" {{$report['subretri'] == '60' ? 'selected' :''}}>60 days before expiry</option>
                                                     <option value="30" {{$report['subretri'] == '30' ? 'selected' :''}}>30 days before expiry</option>
                                                    </select>
                                                    <p>{{ $report['subretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Submission Status</label>
                                                    <select name="report[{{$key}}][substa]" id="report[0][substa]">
                                                      <option value="Recievable" {{$report['substa'] == 'Recievable' ? 'selected' :''}}>Recievable</option>
                                                    </select>
                                                    {{ $report['substa']}}
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Reminder Trigger Frequency</label>
                                                    <select name="report[{{$key}}][subretrfre]" id="report[0][subretrfre]">
                                                     <option value="Every Week" {{$report['subretrfre'] == 'Every Week' ? 'selected' :''}} >Every Week</option>
                                                    </select>
                                                    <p>{{ $report['subretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <div><textarea id="report[0][remarks]" name="report[{{$key}}][remarks]" rows="4" cols="50">{{ $report['remarks'] }} </textarea></div>
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
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Revenue Item</label>
                                                    <select name="payment[{{$key}}][revenue]" id="payment[0][revenue]" value="{{ $payment['revenue'] }}">
                                                     <option value="Wealth Management-Comission" {{$payment['revenue'] == 'Wealth Management-Comission' ? 'selected' :''}} >Wealth Management-Comission</option>
                                                     <option value="Wealth Management-AUM fee" {{$payment['revenue'] == 'Wealth Management-AUM fee' ? 'selected' :''}} >Wealth Management-AUM fee</option>
                                                    </select>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Currency</label>
                                                    <select name="payment[{{$key}}][currency]" id="payment[0][currency]">
                                                     <option value="SGD" {{$payment['currency'] == 'SGD' ? 'selected' :''}} > SGD</option>
                                                     <option value="USD" {{$payment['currency'] == 'USD' ? 'selected' :''}} > USD</option>
                                                    </select>
                                                    <p>{{ $payment['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Payment Frequency</label>
                                                    <select name="payment[{{$key}}][payfre]" id="payment[0][payfre]">
                                                     <option value="One Time" {{$payment['payfre'] == 'One Time' ? 'selected' :''}} > One Time</option>
                                                    </select>
                                                    <p>{{ $payment['payfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" name="payment[{{$key}}][amount]" id="payment[0][amount]" value="{{ $payment['amount'] }}">
                                                    <p>{{ $payment['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Payment Recievable Deadline</label>
                                                    <input type="date" class="form-control" id="payment[0][paredead]" name="payment[{{$key}}][paredead]" value="{{ $payment['paredead'] }}">
                                                    <p>{{ $payment['paredead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Payment Recievable Reminder Frequency</label>
                                                    <select name="payment[{{$key}}][pareretri]" id="payment[0][pareretri]">
                                                     <option value="60" {{$payment['pareretri'] == '60' ? 'selected' :''}}>60 days before expiry</option>
                                                     <option value="30" {{$payment['pareretri'] == '30' ? 'selected' :''}}>30 days before expiry</option>
                                                    </select>
                                                    <p>{{ $payment['pareretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Payment Recievable Status</label>
                                                    <select name="payment[{{$key}}][paresta]" id="payment[0][paresta]">
                                                     <option value="Recievable" {{$payment['paresta'] == 'Recievable' ? 'selected' :''}}>Recievable</option>
                                                    </select>
                                                    {{ $payment['paresta']}}
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Payment Reminder Trigger</label>
                                                    <select name="payment[{{$key}}][paretrfre]" id="payment[0][paretrfre]">
                                                     <option value="Every Week" {{$payment['paretrfre'] == 'Every Week' ? 'selected' :''}}>Every Week</option>
                                                    </select>
                                                    <p>{{ $payment['paretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data company-full_width_Cstm">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <div><textarea id="payment[0][subject]" name="payment[{{$key}}][remarks]" rows="4" cols="50" >{{ $payment['remarks'] }} </textarea></div>
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
                <div class="nfo_personal_data_show d-flex flex-wrap w-100 p-3">
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full Name(Eng)</label>
                        <input type="text" class="form-control w-50" id="pname" name="pname" value="{{ $data->pname}}">
                        <p>{{ $data->pname}}</p>
                    </div>
                    <div class="formAreahalf basic_data " >
                        <label for="" class="form-label">Passport Full Name(Chinese)</label>
                        <input type="text" class="form-control w-50" id="pnamec" name="pnamec" value="{{ $data->pnamec}}">
                        <p>{{ $data->pnamec}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label w-50">Gender</label>
                        <select name="pgender" id="pgender" class="form-label w-50">
                                 <option value="Male" {{$data->pgender == 'Male' ? 'selected' :''}} >Male</option>
                                 <option value="Female" {{$data->pgender == 'Female' ? 'selected' :''}}>Female</option>
                        </select>
                        <p>{{ $data->pgender}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label w-50">DOB</label>
                        <input type="date" class="form-control w-50" id="pdob" name="pdob" value="{{$data->pdob}}">
                        <p>{{ $data->pdob}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Number</label>
                        <input type="text" class="form-control w-50" id="pnumber" name="pnumber" value="{{ $data->pnumber}}">
                        <p>{{ $data->pnumber}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                        <input type="date" class="form-control w-50" id="pexdate" name="pexdate" value="{{ $data->pexdate}}">
                        <p>{{ $data->pexdate}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label w-50">Passport Renewal Reminder</label>
                        <select name="prenrem" id="prenrem" class="form-label w-50">
                                 <option value="30" {{$data->prenrem == '30' ? 'selected' :''}} >30 days before expiry</option>
                                 <option value="60" {{$data->prenrem == '60' ? 'selected' :''}} >60 days before expiry</option>
                                 <option value="90" {{$data->prenrem == '90' ? 'selected' :''}} >90 days before expiry</option>
                        </select>
                        <p>{{ $data->prenrem}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Country</label>
                        <input type="text" class="form-control w-50" id="pcountry" name="pcountry" value="{{ $data->pcountry}}">
                        <p>{{ $data->pcountry}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                        <select name="premtf" id="premtf" class="form-control w-50">
                                 <option value="everyweek" {{$data->premtr == 'everyweek' ? 'selected' :''}} >Every Week</option>
                                 <option value="everymonth" {{$data->premtr == 'everymonth' ? 'selected' :''}} >Every Month</option>
                        </select>
                        <p>{{ $data->premtr}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN Number</label>
                        <input type="text" class="form-control w-50" id="ptinnumber" name="ptinnumber" value="{{ $data->ptinnumber}}">
                        <p>{{ $data->ptinnumber}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN country</label>
                        <input type="text" class="form-control w-50" id="ptincountry" name="ptincountry" value="{{ $data->ptincountry}}">
                        <p>{{ $data->ptincountry}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label w-50">Type of TIN</label>
                        <select name="ptypetin" id="ptypetin" class="form-label w-50">others,please specify
                                 <option value="EAD" {{$data->ptypetin == 'EAD' ? 'selected' :''}}>EAD</option>
                                 <!-- <option value="everymonth">Every Month</option> -->
                        </select>
                        <p>{{ $data->ptypetin}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" class="form-control w-50" id="pphoneno" name="pphoneno" value="{{ $data->pphoneno}}">
                        <p>{{ $data->pphoneno}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">E-mail</label>
                        <input type="text" class="form-control w-50" id="pemail" name="pemail" value="{{ $data->pemail}}">
                        <p>{{ $data->pemail}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Residential Address</label>
                        <input type="text" class="form-control w-50" id="paddress" name="paddress" value="{{ $data->paddress}}">
                        <p>{{ $data->paddress}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Remark</label>
                        <div><textarea id="premarks" class="form-label w-50" name="premarks" rows="4" cols="50">{{ $data->premarks}}</textarea></div>
                        <p>{{ $data->premarks}}</p>
                    </div>
                    <div class="formAreahalf basic_data">
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
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Report Submission Item</label>
                                                    <select name="report[{{$key}}][submission]" id="report[0][submission]">
                                                     <option value="Wealth Management-Comission" {{$report['submission'] == 'Wealth Management-Comission' ? 'selected' :''}}>Wealth Management-Comission</option>
                                                     <option value="Wealth Management-AUM fee" {{$report['submission'] == 'Wealth Management-AUM fee' ? 'selected' :''}}>Wealth Management-AUM fee</option>
                                                    </select>
                                                    <p>{{ $report['submission'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Currency</label>
                                                    <select name="report[{{$key}}][currency]" id="report[0][currency]">
                                                    <option value="SGD" {{$report['currency'] == 'SGD' ? 'selected' :''}} >SGD</option>
                                                    <option value="USD" {{$report['currency'] == 'USD' ? 'selected' :''}} >USD</option>
                                                   </select>
                                                    <p>{{ $report['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Submission Frequency</label>
                                                    <select name="report[{{$key}}][subfre]" id="report[0][subfre]">
                                                     <option value="One Time" {{$report['subfre'] == 'One Time' ? 'selected' :''}}>One Time</option>
                                                    </select>
                                                    <p>{{ $report['subfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" name="report[{{$key}}][amount]" id="report[0][amount]" value="{{ $report['amount'] }}">
                                                    <p>{{ $report['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Submission Deadline</label>
                                                    <input type="date" class="form-control" id="report[0][subdead]" name="report[{{$key}}][subdead]" value="{{ $report['subdead'] }}">
                                                    <p>{{ $report['subdead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Submission Reminder Trigger</label>
                                                    <select name="report[{{$key}}][subretri]" id="report[0][subretri]">
                                                     <option value="60" {{$report['subretri'] == '60' ? 'selected' :''}}>60 days before expiry</option>
                                                     <option value="30" {{$report['subretri'] == '30' ? 'selected' :''}}>30 days before expiry</option>
                                                    </select>
                                                    <p>{{ $report['subretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Submission Status</label>
                                                    <select name="report[{{$key}}][substa]" id="report[0][substa]">
                                                      <option value="Recievable" {{$report['substa'] == 'Recievable' ? 'selected' :''}}>Recievable</option>
                                                    </select>
                                                    {{ $report['substa']}}
                                                </div>
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Reminder Trigger Frequency</label>
                                                    <select name="report[{{$key}}][subretrfre]" id="report[0][subretrfre]">
                                                     <option value="Every Week" {{$report['subretrfre'] == 'Every Week' ? 'selected' :''}} >Every Week</option>
                                                    </select>
                                                    <p>{{ $report['subretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <div><textarea id="report[0][remarks]" name="report[{{$key}}][remarks]" rows="4" cols="50">{{ $report['remarks'] }} </textarea></div>
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
                                                    <select name="payment[{{$key}}][revenue]" id="payment[0][revenue]" value="{{ $payment['revenue'] }}">
                                                     <option value="Wealth Management-Comission" {{$payment['revenue'] == 'Wealth Management-Comission' ? 'selected' :''}} >Wealth Management-Comission</option>
                                                     <option value="Wealth Management-AUM fee" {{$payment['revenue'] == 'Wealth Management-AUM fee' ? 'selected' :''}} >Wealth Management-AUM fee</option>
                                                    </select>
                                                    <p>{{ $payment['revenue'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Currency</label>
                                                    <select name="payment[{{$key}}][currency]" id="payment[0][currency]">
                                                     <option value="SGD" {{$payment['currency'] == 'SGD' ? 'selected' :''}} > SGD</option>
                                                     <option value="USD" {{$payment['currency'] == 'USD' ? 'selected' :''}} > USD</option>
                                                    </select>
                                                    <p>{{ $payment['currency'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Payment Frequency</label>
                                                    <select name="payment[{{$key}}][payfre]" id="payment[0][payfre]">
                                                     <option value="One Time" {{$payment['payfre'] == 'One Time' ? 'selected' :''}} > One Time</option>
                                                    </select>
                                                    <p>{{ $payment['payfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" name="payment[{{$key}}][amount]" id="payment[0][amount]" value="{{ $payment['amount'] }}">
                                                    <p>{{ $payment['amount'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Payment Recievable Deadline</label>
                                                    <input type="date" class="form-control" id="payment[0][paredead]" name="payment[{{$key}}][paredead]" value="{{ $payment['paredead'] }}">
                                                    <p>{{ $payment['paredead'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Payment Recievable Reminder Frequency</label>
                                                    <select name="payment[{{$key}}][pareretri]" id="payment[0][pareretri]">
                                                     <option value="60" {{$payment['pareretri'] == '60' ? 'selected' :''}}>60 days before expiry</option>
                                                     <option value="30" {{$payment['pareretri'] == '30' ? 'selected' :''}}>30 days before expiry</option>
                                                    </select>
                                                    <p>{{ $payment['pareretri'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Payment Recievable Status</label>
                                                    <select name="payment[{{$key}}][paresta]" id="payment[0][paresta]">
                                                     <option value="Recievable" {{$payment['paresta'] == 'Recievable' ? 'selected' :''}}>Recievable</option>
                                                    </select>
                                                    {{ $payment['paresta']}}
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Payment Reminder Trigger</label>
                                                    <select name="payment[{{$key}}][paretrfre]" id="payment[0][paretrfre]">
                                                     <option value="Every Week" {{$payment['paretrfre'] == 'Every Week' ? 'selected' :''}}>Every Week</option>
                                                    </select>
                                                    <p>{{ $payment['paretrfre'] }}</p>
                                                </div>
                                                <div class="formAreahalf basic_data ">
                                                    <label for="" class="form-label">Remarks</label>
                                                    <div><textarea id="payment[0][subject]" name="payment[{{$key}}][remarks]" rows="4" cols="50" >{{ $payment['remarks'] }} </textarea></div>
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

    </form>

    <div class="card formContentData border-0 p-4 ">
            <h3>Notes</h3>
            <div class="textarea">
                <textarea id="wealth_notes" name="wealth_notes" rows="8" cols="200"
                    placeholder="Type your notes here..."></textarea>
                <div id="notes_error"></div>
                <input type="button" id="w_notessave_btn" class="btn saveBtn btn saveBtn btn_notes wealth_notes_btn"
                    value="Save">
            </div>
    </div>

    <div class="card company_file_upload_info formContentData border-0 p-4 ">
            <h3>File Uploads</h3>
            <form action="javascript:void(0);" method="POST" id="file_wealt_upload" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="wealth_id" value="{{ $data->id }}">
                <div class="mb-3">
                    <input type="file" name="file" id="inputFile" class="form-control">
                    <span class="text-danger" id="file-input-error"></span>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn saveBtn">Upload</button>
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


                </tbody>
            </table>
    </div>

    <div class="card formContentData border-0 p-4 ">
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


                                                                              //update ajax
        $(document).on('click', '.edit_save', function(e) {
        alert('j');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

           e.preventDefault();

            $.ajax({
             url: "{{ route('finance.update') }}",
              method: 'POST',
              data: $('#multistep_form_edit').serialize(),
              success:function(response)
              {
                // alert('u');
                console.log(response);
                                const el = document.createElement('div')
                                el.innerHTML =
                                    "You can view Application List <a class='view-application' href='{{ route('finance.allapps') }}'>here</a>"
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
                                    $('#multistep_form_edit')[0].reset();
                                    window.location="{{ route('finance.show', $data->id) }}"
                                })
              },
              error: function(data) {
                alert('ajax error');
                console.log(data);
              }
            });

            
     });
    </script>
@endpush
