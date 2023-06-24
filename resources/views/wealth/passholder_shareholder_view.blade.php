                                    <div id="pass_collapse{{$passholder_key}}" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#pass_accordion_{{$passholder_key}}">
                                        <div class="tab-inner-passhold d-flex flex-wrap">
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Current TIN Country</label>
                                                <p>
                                                    @isset($passholder_item->tin_country_before_app)
                                                        {{ $passholder_item->tin_country_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Type of TIN</label>
                                                <p>
                                                    @isset($passholder_item->type_of_tin_before_app)
                                                        {{ $passholder_item->type_of_tin_before_app }}
                                                    @else
                                                        -
                                                    @endisset
                                                </p>
                                            </div>
                                            <div class="formAreahalf basic_data">
                                                <label for="" class="form-label">Current TIN Number</label>
                                                <p>
                                                    @isset($passholder_item->tin_no_before_pass_app)
                                                        {{ $passholder_item->tin_no_before_pass_app }}
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