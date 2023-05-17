<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Full Name(Chinese)</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">DOB(DD/MM/YYYY)</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Gender(M/F)</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Expiry
        Date(dd/mm/yyyy)</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Number</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Renewal Reminder</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Country</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Passport Reminder Trigger
        Frequency</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Tin Country Before Pass
        Application</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Type of TIN Before Pass
        Application</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">TIN Number Before Pass
        Application</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Phone Number</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Email</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Business Type</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Residential Address</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Application Status</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Relationship with Pass Holder</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Application Type</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Issuance</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Issuance Date</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Expiry Date</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Renewal Reminder</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Duration</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">FIN Number</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass Renewal Trigger
        Frequency</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Pass. Job Title</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Singpass Set Up</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Employer's Name</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Monthly Salary(SGD)</label>
    <p></p>
</div>
<div class="formAreahalf basic_data">
    <label for="" class="form-label">Remarks</label>
    <p></p>
</div>







<div class="tab-content border_styling" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-mas-financial" role="tabpanel"
        aria-labelledby="nav-home-tab">
        @foreach ($company['company_fi'] as $fi)
            <div id="financial_accordion" class="mas_related">
                <div class="mas_heading_accordian d-flex flex-wrap">

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Poc Name</label>
                        <p>{{ $fi['poc_name'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Financial Institution
                            Name</label>
                        <p>{{ $fi['poc_name'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">POC Email</label>
                        <p>{{ $fi['poc_email'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">POC Contact
                            Number</label>
                        <p>{{ $fi['poc_cno'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Account Type</label>
                        <p>{{ $fi['acc_type'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Application
                            Submission</label>
                        <p>{{ $fi['app_sub'] }}</p>
                    </div>

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Account Opening
                            Status</label>
                        <p>{{ $fi['acc_opn_sts'] }}</p>
                    </div>

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Account/Policy Number
                        </label>
                        <p>{{ $fi['acc_pol_no'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Money Deposit
                            Status</label>
                        <p>{{ $fi['money_dep_sts'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Account Current
                            Status</label>
                        <p>{{ $fi['acc_crt_sts'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Online Account
                            Username</label>
                        <p>{{ $fi['on_acc_usr_nam'] }}</p>
                    </div>

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Online Account
                            Password</label>
                        <p>{{ $fi['on_acc_usr_pass'] }}</p>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Maturity Date</label>
                        <p>{{ $fi['mat_date'] }}</p>
                    </div>

                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Remarks</label>
                        <p>{{ $fi['remarks'] }}</p>
                    </div>




                </div>
            </div>
        @endforeach
    </div>
</div>






.custom_operation_edit form#operation_form_edit .application_info .card .accordion-item.pass_acc_it >.formAreahalf.basic_data {
    padding: 20px 20px 0;
    margin: 0 0 20px;
    display: none;
}

.custom_operation_edit form#operation_form_edit .application_info .card .accordion-item.pass_acc_it.closed {
    padding: 20px;
}

.custom_operation_edit form#operation_form_edit .application_info .card .accordion-item.pass_acc_it.closed >.formAreahalf.basic_data {
    padding: 0;
    display: block;
}

.application_info .tabbing_wealth_four .tab-content div#appended_passholder_div h2 button.accordion-button {
    right: 80px !important;
}


4012 line
form#operation_form_edit .application_info .tabbing_wealth_four .tab-content .form-fields h2 button.accordion-button {
    position: absolute;
    right: 30px;
    top: 34px;
}