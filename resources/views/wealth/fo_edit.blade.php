<h3>Company Information</h3>
<div class="wealth company_show">
    @foreach ($data->companies as $key => $company)
        <div id="accordion-{{ $key }}" class="accordion-item" data-companyid={{ $key }}>
            <div class="card">
               
                <div class="card-header" id="headingOne">
                    {{-- <span class="edit_cancel_company cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span>  --}}
                    <div class="cross"><span class="edit_cancel_company remove-input-field">x</span></div>   
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Company Name {{ $key + 1 }}</label>
                        <input type="hidden" name="cmp[{{ $key }}][id]" id="fo_company_id" class="form-control"
                            value="{{ $company->id }}">
                        <input type="text" name="cmp[{{ $key }}][name]" id="fo_compnay" class="form-control"
                            value="{{ $company->name }}">
                        <button class="btn btn_set" data-toggle="collapse" data-target="#collapseOne{{ $key }}"
                            aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div id="collapseOne{{ $key }}" class="collapse show company_share"
                    aria-labelledby="headingOne" data-parent="#accordion-{{ $key }}">
                    <div class="card-body d-flex flex-wrap">
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Address</label>
                            <input type="text" name="cmp[{{ $key }}][address]" id="fo_compnay"
                                class="form-control" value="{{ $company->address }}">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">UEN</label>
                            <input type="text" name="cmp[{{ $key }}][uen]" id="fo_compnay"
                                class="form-control" value="{{ $company->uen }}">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="fo_compnay_{{$key}}" class="form-label">Incorporation Date</label> 
                            <input type="text" name="cmp[{{ $key }}][incorporate_date]" id="fo_compnay_{{$key}}"
                                class="form-control datepicker" value="{{ $company->incorporate_date }}" placeholder="dd/mm/yy">
                        </div>
                       @if( $key != 0)
                        <div class="formAreahalf basic_data"> 
                            <label for="" class="form-label">Relationship with Company 1</label> 
                            <select class="form-control" name="cmp[{{$key}}][relationship]" id="fo_relationship">
                            <option value="" selected disabled="">Choose Relationship with Company</option>
                            <option value="Self" {{isset($company->relationship) && $company->relationship == 'Self' ? 'selected' : ''  }}>Self</option>
                            <option value="Subsidiary" {{isset($company->relationship) && $company->relationship == 'Subsidiary' ? 'selected' : ''  }}>Subsidiary</option>
                            </select> 
                        </div>
                        @endif
                      
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Email</label>
                            <input type="text" name="cmp[{{ $key }}][company_email]" id="fo_compnay"
                                class="form-control" value="{{ $company->company_email }}">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Password</label>
                            <input type="text" name="cmp[{{ $key }}][company_pass]" id="fo_compnay"
                                class="form-control" value="{{ $company->company_pass }}">
                        </div>

                    </div>
                    @foreach ($company->shareholder as $key2 => $shareholder)
                        <div id="shareholder-accordion-{{ $key2 }}" class="sharehold_length">
                            <div class="card shareholder">
                                <div class="card-header" id="headingOne_shareholder">
                                    <div class="cross"><span class="edit_cancel_share remove-input-field">x</span></div>                                   
                                    <div class="formAreahalf basic_data">
                                        <label for="" class="form-label">Shareholder
                                            #{{ $key2 + 1 }}</label>
                                        <button class="btn btn_set" data-toggle="collapse"
                                            data-target="#collapseOneS{{ $key2 }}"
                                            aria-expanded="true" aria-controls="collapseOneS">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            
                                        </button>
                                        <div class="shareholder_div_accrodion_show">

                                            <div class="formAreahalf basic_data edit_equity_percentage">
                                                <label for="" class="form-label">Equity Percentage</label>
                                                <input type="hidden" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][id]"
                                                    value="{{ $shareholder->id }}">
                                                    <div class="dollersec percentage_input"><span class="input"><input type="text"
                                                        name="share[{{ $key }}][{{ $key2 }}][equity_percentage]" id="equity_shareholder"
                                                        class="equity_shareholders form-control" value="{{ $shareholder->equity_percentage }}"></span><span class="pecentage_end">%</span></div>
                                             
                                            </div>
                                            @if ($shareholder->shareholder_type == 'Company' || $shareholder->shareholder_type == 'Personal')
                                                <div class="formAreahalf basic_data">
                                                    <label for="fo_shrholder_type" class="form-label">Shareholder
                                                        Type</label>
                                                    <select
                                                        name="share[{{ $key }}][{{ $key2 }}][shareholder_type]"
                                                        id="fo_shrholder_type" class="edit_shrholder_type">
                                                        <option value="" selected disabled>Please select
                                                            shareholder
                                                            type
                                                        </option>
                                                        <option value="Company"
                                                            {{ $shareholder->shareholder_type == 'Company' ? 'selected' : '' }}>
                                                            Company</option>
                                                        <option value="Personal"
                                                            {{ $shareholder->shareholder_type == 'Personal' ? 'selected' : '' }}>
                                                            Personal</option>
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseOneS{{ $key2 }}" class="collapse show"
                                    aria-labelledby="headingOne_shareholder" data-parent="#shareholder-accordion-{{ $key2 }}">
                                    <div class="card-body d-flex flex-wrap sharetype_data">

                                        @if ($shareholder->shareholder_type == 'Company')
                                       
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Company Name</label>
                                                {{-- <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][shareholder_company_name]"
                                                    value="{{ $shareholder->shareholder_company_name }}"> --}}
                                                    <select name="share[{{ $key }}][{{ $key2 }}][shareholder_company_name]" class="form-control">
                                                       @foreach($data->companies as $c_key => $n_company)
                                                             @if(($c_key+1) > ($key2))
                                                                 <option value="{{$n_company->name}}">  {{$n_company->name}}</option>
                                                             @endif
                                                       @endforeach
                                                    </select>
                                            </div>
                                        @else
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Full
                                                    Name(Eng)</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][pass_name_eng]"
                                                    value="{{ $shareholder->pass_name_eng }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Full
                                                    Name(Chinese)</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][pass_name_chinese]"
                                                    value="{{ $shareholder->pass_name_chinese }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Renewal
                                                    Reminder</label>

                                                <select
                                                    name="share[{{ $key }}][{{ $key2 }}][passport_renew]"
                                                    id="fo_cpm2_pass_renew" class="form-control">
                                                    <option value="" selected disabled>Choose Passport Renewal
                                                        Reminder</option>
                                                    <option value="90 days before expiry"
                                                        {{ $shareholder->passport_renew == '90 days before expiry' ? 'selected' : '' }}>
                                                        90 days before expiry
                                                    </option>
                                                    <option value="120 days before expiry"
                                                        {{ $shareholder->passport_renew == '120 days before expiry' ? 'selected' : '' }}>
                                                        120 days before expiry
                                                    </option>
                                                    <option value="180 days before expiry"
                                                        {{ $shareholder->passport_renew == '180 days before expiry' ? 'selected' : '' }}>
                                                        180 days before expiry
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">DOB</label>
                                                <input type="text" class="form-control datepicker"
                                                    name="share[{{ $key }}][{{ $key2 }}][dob]"
                                                    value="{{ $shareholder->dob }}" placeholder="dd/mm/yy">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Reminder Trigger
                                                    Frequency</label>
                                                <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select
                                                            name="share[{{ $key }}][{{ $key2 }}][passport_trg_fqy]"
                                                            id="fo_cpm2_pass_frq" class="form-control">
                                                            <option value="" selected="" disabled="">
                                                                Please select</option>
                                                            <option value="Day"
                                                                {{ $shareholder->passport_trg_fqy == 'Day' ? 'selected' : '' }}>
                                                                Day</option>
                                                            <option value="3 Days"
                                                                {{ $shareholder->passport_trg_fqy == '3 Days' ? 'selected' : '' }}>
                                                                3 Days</option>
                                                            <option value="Week"
                                                                {{ $shareholder->passport_trg_fqy == 'Week' ? 'selected' : '' }}>
                                                                Week</option>
                                                            <option value="2 Weeks"
                                                                {{ $shareholder->passport_trg_fqy == '2 Weeks' ? 'selected' : '' }}>
                                                                2 Weeks</option>
                                                            <option value="4 Weeks"
                                                                {{ $shareholder->passport_trg_fqy == '4 Weeks' ? 'selected' : '' }}>
                                                                4 Weeks</option>
                                                        </select></span>
                                                </div>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Gender</label>
                                                <select class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][gender]"
                                                    value="{{ $shareholder->gender }}">
                                                    <option value="" selected disabled>Choose gender</option>
                                                    <option value="Male"
                                                        {{ $shareholder->gender == 'Male' ? 'selected' : '' }}>M
                                                    </option>
                                                    <option value="Female"
                                                        {{ $shareholder->gender == 'Female' ? 'selected' : '' }}>F
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Number</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][passport_no]"
                                                    value="{{ $shareholder->passport_no }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Expiry
                                                    Date(DD/MM/YYYY)</label>
                                                <input type="text" class="form-control datepicker"
                                                    name="share[{{ $key }}][{{ $key2 }}][passport_exp_date]"
                                                    value="{{ $shareholder->passport_exp_date }}" placeholder="dd/mm/yy">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Country</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][passport_country]"
                                                    value="{{ $shareholder->passport_country }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">E-mail</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][email]"
                                                    value="{{ $shareholder->email }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][phone]"
                                                    value="{{ $shareholder->phone }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Residential
                                                    Address</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][residential_address]"
                                                    value="{{ $shareholder->residential_address }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Current TIN
                                                    country</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][tin_country]"
                                                    value="{{ $shareholder->tin_country }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Current TIN
                                                    Number</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][tin_no]"
                                                    value="{{ $shareholder->tin_no }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Type of TIN</label>
                                                <select
                                                    name="share[{{ $key }}][{{ $key2 }}][type_of_tin]"
                                                    id="fo_cpm2_tin_type" class="form-control">
                                                    <option value="" selected disabled>Choose Type of TIN
                                                    </option>
                                                    <option vlaue="WP"
                                                        {{ $shareholder->type_of_tin == 'WP' ? 'selected' : '' }}>WP
                                                    </option>
                                                    <option vlaue="SP"
                                                        {{ $shareholder->type_of_tin == 'SP' ? 'selected' : '' }}>SP
                                                    </option>
                                                    <option vlaue="EP"
                                                        {{ $shareholder->type_of_tin == 'EP' ? 'selected' : '' }}>EP
                                                    </option>
                                                    <option vlaue="LTVP"
                                                        {{ $shareholder->type_of_tin == 'LTVP' ? 'selected' : '' }}>
                                                        LTVP
                                                    </option>
                                                    <option vlaue="DP"
                                                        {{ $shareholder->type_of_tin == 'DP' ? 'selected' : '' }}>DP
                                                    </option>
                                                    <option vlaue="NRIC"
                                                        {{ $shareholder->type_of_tin == 'NRIC' ? 'selected' : '' }}>
                                                        NRIC
                                                    </option>
                                                </select>

                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Job Title</label>
                                                <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][job_title]"
                                                    value="{{ $shareholder->job_title }}">
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Monthly Salary in the
                                                    company(SGD)</label>
                                                    <div class="dollersec"><span class="doller">$</span> <input type="text" class="form-control"
                                                    name="share[{{ $key }}][{{ $key2 }}][monthly_sal]"
                                                    value="{{ $shareholder->monthly_sal }}"></div>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Relationship With
                                                    Shareholder</label>
                                                <select
                                                    name="share[{{ $key }}][{{ $key2 }}][relation_with_shareholder]"
                                                    id="fo_cpm2_relation" class="form-control" data-id="{{ $key }}" data-key="{{ $key2 }}">
                                                    <option value="" selected disabled>Choose Relationship with
                                                        shareholder</option>
                                                    <option value="Self"
                                                        {{ $shareholder->relation_with_shareholder == 'Self' ? 'selected' : '' }}>
                                                        Self
                                                    </option>
                                                    <option value="Parents"
                                                        {{ $shareholder->relation_with_shareholder == 'Parents' ? 'selected' : '' }}>
                                                        Parents</option>
                                                    <option value="Spouse"
                                                        {{ $shareholder->relation_with_shareholder == 'Spouse' ? 'selected' : '' }}>
                                                        Spouse</option>
                                                    <option value="Children"
                                                        {{ $shareholder->relation_with_shareholder == 'Children' ? 'selected' : '' }}>
                                                        Children</option>
                                                    <option value="Relatives"
                                                        {{ $shareholder->relation_with_shareholder == 'Relatives' ? 'selected' : '' }}>
                                                        Relatives</option>
                                                    <option value="Friend"
                                                        {{ $shareholder->relation_with_shareholder == 'Friend' ? 'selected' : '' }}>
                                                        Friend</option>
                                                    <option value="Others"
                                                        {{ $shareholder->relation_with_shareholder == 'Others' ? 'selected' : '' }}>
                                                        Others</option>
                                                </select>

                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn saveBtn edit_add_shareholder" style="float:right" name="edit_add_shoulder"
                        id="edit_add_share" data-id={{ $key2 }}>Add
                        Shareholder</button>
                </div>
            </div>
        </div>
    @endforeach

    <button class="btn saveBtn edit__add_com" id="edit_add_company" name="edit_add_company"
        data-id={{ $key }}>Add
        Company</button>

</div>
