                                        <div id="business_accordion_{{$business_item_key}}" class="mas_related business_itemJs" data-bussines_item_key="{{$business_item_key}}">
                                            <input type="hidden" name="business[{{$business_item_key}}][wealth_business_id]"
                                              value="@isset($business_item->id) {{ $business_item->id }} @endisset" class="business_idJs">
                                            <div class="mas_heading_accordian">
                                                <div class="formAreahalf basic_data">
                                                    <label for="financial_institition_name" class="form-label">Financial
                                                        Institution Name {{$business_item_key + 1}}</label>
                                                    <input type="text" name="business[{{$business_item_key}}][financial_institition_name]"
                                                        id="financial_institition_name"
                                                        value="@isset($business_item->financial_institition_name) {{ $business_item->financial_institition_name }} @endisset"
                                                        class="form-control">
                                                </div>

                                                <button class="btn btn_set edit_new_btn_set" data-toggle="collapse"
                                                    data-target="#business_collapse_{{$business_item_key}}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </button>
                                                <div class="cross financial_wealth"><span class="edit_cancel_share remove_item delete_business_itemJs" data-id="{{$business_item_key}}">x</span></div>
                                            </div>
                                            <div id="business_collapse_{{$business_item_key}}" class="collapse" aria-labelledby="headingOne"
                                                data-parent="#business_accordion_{{$business_item_key}}">
                                                <div class="tab-inner-text d-flex flex-wrap">
                                                <div class="formAreahalf basic_data">
                                                        <label for="online_account_user" class="form-label">Online Account
                                                            Username</label>
                                                        <input type="text" name="business[{{$business_item_key}}][online_account_user]"
                                                            value="@isset($business_item->online_account_user) {{ $business_item->online_account_user }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="online_acc_pass" class="form-label">Online Account
                                                            Password</label>
                                                        <input type="text" name="business[{{$business_item_key}}][online_acc_pass]"
                                                            value="@isset($business_item->online_acc_pass) {{ $business_item->online_acc_pass }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="account_types_containerJs" style="width:100%;">
                                                        <div class="account_typesJs">
                                                        @if(!empty($business_item->accountTypes) && count($business_item->accountTypes))
                                                            @foreach($business_item->accountTypes as $account_type_item_key => $account_type_item)
                                                                @include('wealth.business_account_type')
                                                            @endforeach
                                                        @else
                                                            @include('wealth.business_account_type')
                                                        @endif
                                                        </div>
                                                        <input type="button" class="btn saveBtn add_account_typeJs" value="Add Account Type" data-id="1" style="margin:0 0 40px 0">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="application_submision" class="form-label">Application
                                                            Submission</label>
                                                        <select name="business[{{$business_item_key}}][application_submision]" id="application_submision"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose Application
                                                                Submission
                                                            </option>
                                                            <option
                                                                value="Progress"{{ isset($business_item->application_submision) && $business_item->application_submision == 'Progress' ? 'selected' : '' }}>Progress</option>
                                                            <option
                                                                value="Done"{{ isset($business_item->application_submision) && $business_item->application_submision == 'Done' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_account_status" class="form-label">Account
                                                            Status</label>
                                                        <select name="business[{{$business_item_key}}][business_account_status]" id="business_account_status"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose account status
                                                            </option>
                                                            <option value="Pending"
                                                                {{ isset($business_item->business_account_status) && $business_item->business_account_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Approved"
                                                                {{ isset($business_item->business_account_status) && $business_item->business_account_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Rejected"
                                                                {{ isset($business_item->business_account_status) && $business_item->business_account_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" name="business[{{$business_item_key}}][product_name]"
                                                            value="@isset($business_item->product_name) {{ $business_item->product_name }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="currency" class="form-label">Currency</label>
                                                        <select id="currency" name="business[{{$business_item_key}}][currency]" class="form-control">
                                                            <option value="" selected disabled>Choose currency
                                                            </option>
                                                            <option value="USD"
                                                                {{ isset($business_item->currency) && $business_item->currency == 'USD' ? 'selected' : '' }}>
                                                                USD
                                                            </option>
                                                            <option value="SGD"
                                                                {{ isset($business_item->currency) && $business_item->currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD
                                                            </option>
                                                            <option value="Others"
                                                                {{ isset($business_item->currency) && $business_item->currency == 'Others' ? 'selected' : '' }}>
                                                                Others
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @if (isset($business_item->currency) && $business_item->currency == 'Others')
                                                        <div class="formAreahalf basic_data please_specify">
                                                            <label for="" class="form-label">Others, please specify</label>
                                                            <input type="text" class="form-control"
                                                                    name="business[{{$business_item_key}}][currency_specify]"
                                                                    value="{{ isset($business_item->currency_specify) ? $business_item->currency_specify : '' }}">


                                                        </div>
                                                    @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="investment_amount" class="form-label">Investment
                                                            Amount/Premium</label>
                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="integer"
                                                                    name="business[{{$business_item_key}}][investment_amount]"
                                                                    value="@isset($business_item->investment_amount) {{ $business_item->investment_amount }} @endisset"
                                                                    class="form-control"></span>
                                                        </div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="payment_mode" class="form-label">Payment Mode</label>
                                                        <select name="business[{{$business_item_key}}][payment_mode]" class="form-control">
                                                            <option value="" selected disabled>Choose payment mode
                                                            </option>
                                                            <option
                                                                value="Lump Sum"{{ isset($business_item->payment_mode) && $business_item->payment_mode == 'Lump Sum' ? 'selected' : '' }}>
                                                                Lump Sum</option>
                                                            <option value="Yearly"
                                                                {{ isset($business_item->payment_mode) && $business_item->payment_mode == 'Yearly' ? 'selected' : '' }}>
                                                                Yearly</option>
                                                            <option value="Half-yearly"
                                                                {{ isset($business_item->payment_mode) && $business_item->payment_mode == 'Half-yearly' ? 'selected' : '' }}>
                                                                Half-yearly</option>
                                                            <option value="Quarterly"
                                                                {{ isset($business_item->payment_mode) && $business_item->payment_mode == 'Quarterly' ? 'selected' : '' }}>
                                                                Quarterly</option>
                                                            <option value="Monthly"
                                                                {{ isset($business_item->payment_mode) && $business_item->payment_mode == 'Monthly' ? 'selected' : '' }}>
                                                                Monthly</option>


                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="subscription" class="form-label">Subscription /
                                                            Inception
                                                            Date</label>
                                                        <input type="date" name="business[{{$business_item_key}}][subscription]"
                                                            value="{{$business_item->subscription ?? ''}}"
                                                            class="form-control subsInsDateJs">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_date" class="form-label">Maturity
                                                            Date</label>
                                                        <input type="date" name="business[{{$business_item_key}}][maturity_date]"
                                                            value="{{$business_item->maturity_date ?? ''}}"
                                                            class="form-control maturityDateJs">

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_duration" class="form-label">Duration</label>
                                                        <input type="text" name="business[{{$business_item_key}}][business_duration]"
                                                            value="@isset($business_item->business_duration){{ $business_item->business_duration }}@endisset"
                                                            class="form-control durationJs" readonly>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="maturity_reminder" class="form-label">Maturity
                                                            Reminder</label>
                                                        <select name="business[{{$business_item_key}}][maturity_reminder]" class="form-control">
                                                            <option value="" selected disabled>Choose maturity
                                                                reminder
                                                            </option>
                                                            <option
                                                                value="90 days before maturity"{{ isset($business_item->maturity_reminder) && $business_item->maturity_reminder == '90 days before maturity' ? 'selected' : '' }}>
                                                                90 days before maturity
                                                            </option>
                                                            <option
                                                                value="120 days before maturity"{{ isset($business_item->maturity_reminder) && $business_item->maturity_reminder == '120 days before maturity' ? 'selected' : '' }}>
                                                                120 days before
                                                                maturity
                                                            </option>
                                                            <option
                                                                value="180 days before maturity"{{ isset($business_item->maturity_reminder) && $business_item->maturity_reminder == '180 days before maturity' ? 'selected' : '' }}>
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
                                                                class="select"><select name="business[{{$business_item_key}}][maturity_reminder_trg]"
                                                                    id="maturity_reminder_trg" class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Please
                                                                        select</option>
                                                                    <option
                                                                        value="Day"{{ isset($business_item->maturity_reminder_trg) && $business_item->maturity_reminder_trg == 'Day' ? 'selected' : '' }}>
                                                                        Day</option>
                                                                    <option
                                                                        value="3 Days"{{ isset($business_item->maturity_reminder_trg) && $business_item->maturity_reminder_trg == '3 Days' ? 'selected' : '' }}>
                                                                        3 Days</option>
                                                                    <option
                                                                        value="Week"{{ isset($business_item->maturity_reminder_trg) && $business_item->maturity_reminder_trg == 'Week' ? 'selected' : '' }}>
                                                                        Week</option>
                                                                    <option
                                                                        value="2 Weeks"{{ isset($business_item->maturity_reminder_trg) && $business_item->maturity_reminder_trg == '2 Weeks' ? 'selected' : '' }}>
                                                                        2 Weeks</option>
                                                                    <option value="4 Weeks"
                                                                        {{ isset($business_item->maturity_reminder_trg) && $business_item->maturity_reminder_trg == '4 Weeks' ? 'selected' : '' }}>
                                                                        4 Weeks</option>
                                                                </select></span></div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_currency" class="form-label">Commission
                                                            Currency(For Admin
                                                            Purpose)</label>
                                                        <select id="commission_currency" name="business[{{$business_item_key}}][commission_currency]" class="form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                currency
                                                            </option>
                                                            <option
                                                                value="USD"{{ isset($business_item->commission_currency) && $business_item->commission_currency == 'USD' ? 'selected' : '' }}>
                                                                USD</option>
                                                            <option value="SGD"
                                                                {{ isset($business_item->commission_currency) && $business_item->commission_currency == 'SGD' ? 'selected' : '' }}>
                                                                SGD</option>
                                                            <option value="Others"
                                                                {{ isset($business_item->commission_currency) && $business_item->commission_currency == 'Others' ? 'selected' : '' }}>
                                                                Others</option>

                                                        </select>

                                                    </div>
                                                    @if (isset($business_item->commission_currency) && $business_item->commission_currency == 'Others')
                                                    <div class="formAreahalf basic_data please_specify">
                                                        <label for="" class="form-label">Others, please specify</label>
                                                        <input type="text" class="form-control"
                                                                name="business[{{$business_item_key}}][commission_currency_specify]"
                                                                value="{{ isset($business_item->commission_currency_specify) ? $business_item->commission_currency_specify : '' }}">

                                                    </div>
                                                @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commission_amount" class="form-label">Commission
                                                            Amount(For
                                                            Admin
                                                            Purpose)</label>
                                                        <input type="integer" name="business[{{$business_item_key}}][commission_amount]"
                                                            value="@isset($business_item->commission_amount) {{ $business_item->commission_amount }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="commision_status" class="form-label">Commisison
                                                            Status(For
                                                            Admin
                                                            Purpose)
                                                        </label>
                                                        <select name="business[{{$business_item_key}}][commision_status]" class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose commission
                                                                status
                                                            </option>
                                                            <option
                                                                value="Received"{{ isset($business_item->commision_status) && $business_item->commision_status == 'Received' ? 'selected' : '' }}>Received</option>
                                                            <option value="Pending"
                                                                {{ isset($business_item->commision_status) && $business_item->commision_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_remarks" class="form-label">Remarks</label>
                                                        <textarea name="business[{{$business_item_key}}][business_remarks]" rows="4" cols="50"
                                                            value="@isset($business_item->business_remarks) {{ $business_item->business_remarks }} @endisset">@isset($business_item->business_remarks) {{ $business_item->business_remarks }} @endisset</textarea>
                                                    </div>
                                                </div>

                                                    <div class="redemption_add_table redemptionDAJs">
                                                        <h3>Redemption Date and Amount</h3>
                                                        {{-- <form name="business_red_table_data" class="business_redemption_tab" id="redemption_table" method="POST"> --}}

                                                                <input type="hidden" name="business[{{$business_item_key}}][business_tab_id]" id="busines_tab_id" class="busines_tab_id" value="@isset($business_item->id) {{$business_item->id}} @endisset">
                                                                <div class="redemption_table_data">
                                                                    <div class="formAreahalf r_table">
                                                                        <label for="business[{{$business_item_key}}][net_amount_val]" class="form-label">Redemption
                                                                            Date</label>
                                                                        <input type="date" name="business[{{$business_item_key}}][business_redemption_date]"
                                                                            value=""
                                                                            class="form-control red_date redDateJs">
                                                                    </div>
                                                                    <div class="formAreahalf r_table">
                                                                        <label for="net_amount_val" class="form-label">Redemption
                                                                            Amount</label>
                                                                        <div class="dollersec"><span class="doller">$</span>
                                                                            <span class="input"> <input type="integer"
                                                                                    class="form-control red_amount redAmountJs" name="business[{{$business_item_key}}][business_redemption_amount]"
                                                                                    id="fo_servicing_fee_amount"
                                                                                    value="" maxlength="12"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <div class="btn_adding_redempton">
                                                                <button class="btn saveBtn add_redemption btn_add_redempt addRedButtonJs" disabled>Add</button>
                                                            </div>
                                                        {{-- </form> --}}
                                                    </div>
                                                    <div class="Redemption_date edit_redemption">

                                                        <div class="table">
                                                            <table class="table redTableJs" id="red_table_{{$business_item_key}}">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Redemption Date</th>
                                                                        <th>Redemption Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @if(isset($business_item->business_redempt) && count($business_item->business_redempt)> 0)

                                                                    @foreach($business_item->business_redempt as $redemption_data)

                                                                    <tr>
                                                                        <td>{{date('d/m/Y', strtotime($redemption_data->red_date))}}</td>
                                                                        <td>${{$redemption_data->red_amount}}</td>
                                                                        <td><a href="javascript:void(0);" data-id="{{$redemption_data->id}}" title="Delete" class="btn del_confirm_business"><i class="fa-solid fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @else
                                                                    <!-- <tr>
                                                                        <td colspan="3">No record found</td>
                                                                    </tr> -->
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
                                                                <span class="input"> <input type="integer"
                                                                        class="form-control" name="business[{{$business_item_key}}][net_amount_val]"
                                                                        id="net_amount_val"
                                                                        value="@isset($business_item->net_amount_val) {{ $business_item->net_amount_val }} @endisset"   maxlength="12"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>