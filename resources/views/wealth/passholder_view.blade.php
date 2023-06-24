                                    <div id="pass_collapse{{$passholder_key}}" class="collapse" aria-labelledby="headingOne" data-parent="#pass_accordion_{{$passholder_key}}">
                                        <div class="tab-inner-passhold d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Holder Name 1
                                                    (Eng)</label>
                                                <p>
                                                    @isset($passholder_item->pass_holder_name)
                                                        {{ $passholder_item->pass_holder_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Full
                                                    Name(Chinese)</label>
                                                <p>
                                                    @isset($passholder_item->passposrt_name_chinese)
                                                        {{ $passholder_item->passposrt_name_chinese }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">DOB (DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($passholder_item->dob)
                                                        {{date('d/m/Y' , strtotime($passholder_item->dob))}}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Gender(M/F)</label>
                                                <p>
                                                    @isset($passholder_item->gender)
                                                        {{ $passholder_item->gender }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Expiry
                                                    Date(DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($passholder_item->passport_expiry_date)
                                                        {{date('d/m/Y' , strtotime($passholder_item->passport_expiry_date))}}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Number</label>
                                                <p>
                                                    @isset($passholder_item->passport_no)
                                                        {{ $passholder_item->passport_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Renewal
                                                    Reminder</label>
                                                <p>
                                                    @isset($passholder_item->passport_renewal_reminder)
                                                        {{ $passholder_item->passport_renewal_reminder }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Country</label>
                                                <p>
                                                    @isset($passholder_item->passport_country)
                                                        {{ $passholder_item->passport_country }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Passport Reminder Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($passholder_item->passport_tri_frq)
                                                        <span class="Every">Every</span> {{ $passholder_item->passport_tri_frq }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Tin Country Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($passholder_item->tin_country_before_app)
                                                        {{ $passholder_item->tin_country_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Type of TIN Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($passholder_item->type_of_tin_before_app)
                                                        {{ $passholder_item->type_of_tin_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">TIN Number Before Pass
                                                    Application</label>
                                                <p>
                                                    @isset($passholder_item->tin_no_before_pass_app)
                                                        {{ $passholder_item->tin_no_before_pass_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Phone Number</label>
                                                <p>
                                                    @isset($passholder_item->phone_no)
                                                        {{ $passholder_item->phone_no }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Email</label>
                                                <p>
                                                    @isset($passholder_item->email)
                                                        {{ $passholder_item->email }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Business Type</label>
                                                <p>
                                                    @isset($passholder_item->business_type)
                                                        {{ $passholder_item->business_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($passholder_item->business_type) && $passholder_item->business_type == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($passholder_item->business_type_specify))
                                                    {{ $passholder_item->business_type_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Residential Address</label>
                                                <p>
                                                    @isset($passholder_item->residential_add)
                                                        {{ $passholder_item->residential_add }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Application
                                                    Status</label>
                                                <p
                                                    class="@if (isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Pending') active-blue @elseif(isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Approved') active-btn @elseif(isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Rejected') active-btn Dormant @else '' @endif">
                                                    @isset($passholder_item->pass_app_status)
                                                        {{ $passholder_item->pass_app_status }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Relationship with Pass Holder
                                                    1</label>
                                                <p>
                                                    @isset($passholder_item->relation_with_pass)
                                                        {{ $passholder_item->relation_with_pass }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($passholder_item->relation_with_pass_specify))
                                                    {{ $passholder_item->relation_with_pass_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Application Type</label>
                                                <p>
                                                    @isset($passholder_item->pass_app_type)
                                                        {{ $passholder_item->pass_app_type }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            @if (isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'Others')
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Others, please specify</label>
                                                    @if (isset($passholder_item->pass_app_type_specify))
                                                    {{ $passholder_item->pass_app_type_specify }} @else-
                                                    @endif
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance</label>
                                                <p
                                                    class="@if (isset($passholder_item->pass_inssuance) && $passholder_item->pass_inssuance == 'Progress') active-blue @elseif(isset($passholder_item->pass_inssuance) && $passholder_item->pass_inssuance == 'Done') active-btn @else '' @endif">

                                                    @isset($passholder_item->pass_inssuance)
                                                        {{ $passholder_item->pass_inssuance }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Issuance Date (DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($passholder_item->pass_issuance_date)
                                                        {{ convertDate($passholder_item->pass_issuance_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Expiry Date (DD/MM/YYYY)</label>
                                                <p>
                                                    @isset($passholder_item->pass_expiry_date)
                                                        {{ convertDate($passholder_item->pass_expiry_date,"d/m/Y") }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Reminder</label>
                                                <p>
                                                    @isset($passholder_item->passholder_shareholder)
                                                        {{ $passholder_item->passholder_shareholder }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Duration</label>
                                                <p>
                                                    @isset($passholder_item->duration)
                                                        {{ $passholder_item->duration }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">FIN Number</label>
                                                <p>
                                                    @isset($passholder_item->fin_number)
                                                        {{ $passholder_item->fin_number }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass Renewal Trigger
                                                    Frequency</label>
                                                <p>
                                                    @isset($passholder_item->pass_renewal_frq)
                                                        <span class="every">Every</span> {{ $passholder_item->pass_renewal_frq }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Pass. Job Title</label>
                                                <p>
                                                    @isset($passholder_item->pass_jon_title)
                                                        {{ $passholder_item->pass_jon_title }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Singpass Set Up</label>
                                                <p
                                                    class="@if (isset($passholder_item->singpass_set_up) && $passholder_item->singpass_set_up == 'Progress') active-blue @elseif(isset($passholder_item->singpass_set_up) && $passholder_item->singpass_set_up == 'Done') active-btn @else '' @endif">
                                                    @isset($passholder_item->singpass_set_up)
                                                        {{ $passholder_item->singpass_set_up }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Employer's Name</label>
                                                <p>
                                                    @isset($passholder_item->employee_name)
                                                        {{ $passholder_item->employee_name }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Monthly Salary(SGD)</label>
                                                <p>
                                                    @isset($passholder_item->monthly_sal)
                                                        {{ $passholder_item->monthly_sal }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Remarks</label>
                                                <p>
                                                    @isset($passholder_item->pass_remarks)
                                                        {{ $passholder_item->pass_remarks }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                        </div>
                                    </div>