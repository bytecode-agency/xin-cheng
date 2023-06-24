
                                                <div class="tab-inner-text d-flex flex-wrap">
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_holder_name" class="form-label pass_holder_name_lableJs" id="pass_holder_name_lable">Pass Holder Name
                                                            (Eng)
                                                        </label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][pass_holder_name]" id="pass_holder_name"
                                                            value="@isset($passholder_item->pass_holder_name) {{ $passholder_item->pass_holder_name }} @endisset"
                                                            class="form-control pass_holder_nameJs">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passposrt_name_chinese" class="form-label">Passport
                                                            Full
                                                            Name(Chinese)</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][passposrt_name_chinese]"
                                                            id="passposrt_name_chinese"
                                                            value="@isset($passholder_item->passposrt_name_chinese) {{ $passholder_item->passposrt_name_chinese }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="dob" class="form-label">DOB (DD/MM/YYYY)</label>
                                                        <input type="date" name="passholder[{{$passholder_key}}][dob]" id="dob"
                                                            value="{{$passholder_item->dob ?? ''}}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="gender" class="form-label">Gender(M/F)</label>
                                                        <select name="passholder[{{$passholder_key}}][gender]" id="gender" class="form-control">
                                                            <option value="" selected disabled>Choose gender</option>
                                                            <option value="Male"
                                                                {{ isset($passholder_item->gender) && $passholder_item->gender == 'Male' ? 'selected' : '' }}>
                                                                M
                                                            </option>
                                                            <option value="Female"
                                                                {{ isset($passholder_item->gender) && $passholder_item->gender == 'Female' ? 'selected' : '' }}>
                                                                F
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passport_expiry_date" class="form-label">Passport
                                                            Expiry
                                                            Date(DD/MM/YYYY)</label>
                                                        <input type="date" name="passholder[{{$passholder_key}}][passport_expiry_date]"
                                                            id="passport_expiry_date"
                                                            value="{{$passholder_item->passport_expiry_date ?? ''}}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passport_no" class="form-label">Passport
                                                            Number</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][passport_no]"
                                                            value="@isset($passholder_item->passport_no) {{ $passholder_item->passport_no }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passport_renewal_reminder" class="form-label">Passport
                                                            Renewal
                                                            Reminder</label>
                                                        <select name="passholder[{{$passholder_key}}][passport_renewal_reminder]"
                                                            id="passport_renewal_reminder" class="form-control">
                                                            <option value="" selected="" disabled="">Please
                                                                select</option>
                                                            <option value="90 days before expiry"
                                                                {{ isset($passholder_item->passport_renewal_reminder) && $passholder_item->passport_renewal_reminder == '90 days before expiry' ? 'selected' : '' }}>
                                                                90 days before expiry
                                                            </option>
                                                            <option value="120 days before expiry"
                                                                {{ isset($passholder_item->passport_renewal_reminder) && $passholder_item->passport_renewal_reminder == '120 days before expiry' ? 'selected' : '' }}>
                                                                120 days before expiry
                                                            </option>
                                                            <option value="180 days before expiry"
                                                                {{ isset($passholder_item->passport_renewal_reminder) && $passholder_item->passport_renewal_reminder == '180 days before expiry' ? 'selected' : '' }}>
                                                                180 days before expiry
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passport_country" class="form-label">Passport
                                                            Country</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][passport_country]"
                                                            value="@isset($passholder_item->passport_country) {{ $passholder_item->passport_country }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="passport_tri_frq" class="form-label">Passport Reminder
                                                            Trigger
                                                            Frequency</label>
                                                        <div class="select_box"><span class="every">Every</span><span
                                                                class="select"><select name="passholder[{{$passholder_key}}][passport_tri_frq]"
                                                                    id="passport_tri_frq" class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Please
                                                                        select</option>
                                                                    <option value="Day"
                                                                        {{ isset($passholder_item->passport_tri_frq) && $passholder_item->passport_tri_frq == 'Day' ? 'selected' : '' }}>
                                                                        Day</option>
                                                                    <option value="3 Days"
                                                                        {{ isset($passholder_item->passport_tri_frq) && $passholder_item->passport_tri_frq == '3 Days' ? 'selected' : '' }}>
                                                                        3 Days</option>
                                                                    <option value="Week"
                                                                        {{ isset($passholder_item->passport_tri_frq) && $passholder_item->passport_tri_frq == 'Week' ? 'selected' : '' }}>
                                                                        Week</option>
                                                                    <option value="2 Weeks"
                                                                        {{ isset($passholder_item->passport_tri_frq) && $passholder_item->passport_tri_frq == '2 Weeks' ? 'selected' : '' }}>
                                                                        2 Weeks</option>
                                                                    <option value="4 Weeks"
                                                                        {{ isset($passholder_item->passport_tri_frq) && $passholder_item->passport_tri_frq == '4 Weeks' ? 'selected' : '' }}>
                                                                        4 Weeks</option>
                                                                </select></span></div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="tin_country_before_app" class="form-label">Tin Country
                                                            Before
                                                            Pass
                                                            Application</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][tin_country_before_app]"
                                                            value="@isset($passholder_item->tin_country_before_app) {{ $passholder_item->tin_country_before_app }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="type_of_tin_before_app" class="form-label">Type of TIN
                                                            Before
                                                            Pass
                                                            Application</label>
                                                        <select name="passholder[{{$passholder_key}}][type_of_tin_before_app]" id="type_of_tin_before_app"
                                                            class="form-control">
                                                            <option value=""selected disabled>Choose type of tin
                                                                before
                                                                pass
                                                                application</option>
                                                            <option value="WP"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'WP' ? 'selected' : '' }}>
                                                                WP</option>
                                                            <option value="SP"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'SP' ? 'selected' : '' }}>
                                                                SP</option>
                                                            <option value="EP"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'EP' ? 'selected' : '' }}>
                                                                EP</option>
                                                            <option value="LVTP"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'LVTP' ? 'selected' : '' }}>
                                                                LVTP</option>
                                                            <option value="DP"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'DP' ? 'selected' : '' }}>
                                                                DP</option>
                                                            <option value="NRIC"
                                                                {{ isset($passholder_item->type_of_tin_before_app) && $passholder_item->type_of_tin_before_app == 'NRIC' ? 'selected' : '' }}>
                                                                NRIC</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="tin_no_before_pass_app" class="form-label">TIN Number
                                                            Before
                                                            Pass
                                                            Application</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][tin_no_before_pass_app]"
                                                            value="@isset($passholder_item->tin_no_before_pass_app) {{ $passholder_item->tin_no_before_pass_app }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="phone_no" class="form-label">Phone Number</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][phone_no]"
                                                            value="@isset($passholder_item->phone_no) {{ $passholder_item->phone_no }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][email]"
                                                            value="@isset($passholder_item->email) {{ $passholder_item->email }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="business_type" class="form-label">Business
                                                            Type</label>
                                                        <select id="business_type" name="passholder[{{$passholder_key}}][business_type]" class="form-control">
                                                            <option value="" selected disabled>Choose business type
                                                            </option>
                                                            <option vlaue="FO"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'FO' ? 'selected' : '' }}>FO</option>
                                                                <option vlaue="PIC"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'PIC' ? 'selected' : '' }}>PIC</option>
                                                                <option vlaue="Self-Employment"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'Self-Employment' ? 'selected' : '' }}>Self-Employment</option>
                                                                <option vlaue="Employer Guarantee"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'Employer Guarantee' ? 'selected' : '' }}>Employer Guarantee</option>
                                                                <option vlaue="PR Application"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'PR Application' ? 'selected' : '' }}>PR Application</option>
                                                                <option vlaue="PR Renewal"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'PR Renewal' ? 'selected' : '' }}>PR Renewal</option>
                                                                <option vlaue="Citizen"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                                                                <option vlaue="Others"
                                                                {{ isset($passholder_item->business_type) && $passholder_item->business_type == 'Others' ? 'selected' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                    @if (isset($passholder_item->business_type) && $passholder_item->business_type == 'Others')
                                                        <div class="formAreahalf basic_data please_specify">
                                                            <label for="" class="form-label">Others, please specify</label>
                                                            <input type="text" class="form-control"
                                                                    name="passholder[{{$passholder_key}}][business_type_specify]"
                                                                    value="{{ isset($passholder_item->business_type_specify) ? $passholder_item->business_type_specify : '' }}">


                                                        </div>
                                                    @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="residential_add" class="form-label">Residential
                                                            Address</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][residential_add]"
                                                            value="@isset($passholder_item->residential_add) {{ $passholder_item->residential_add }} @endisset"
                                                            class="form-control"></select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_app_status" class="form-label">Pass Application
                                                            Status</label>
                                                        <select name="passholder[{{$passholder_key}}][pass_app_status]" id="pass_app_status"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose application
                                                                status
                                                            </option>
                                                            <option value="Pending"
                                                                {{ isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Approved"
                                                                {{ isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Rejected"
                                                                {{ isset($passholder_item->pass_app_status) && $passholder_item->pass_app_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="relation_with_pass" class="form-label">Relationship
                                                            with
                                                            Pass
                                                            Holder 1</label>
                                                        <select  name="passholder[{{$passholder_key}}][relation_with_pass]" value=""
                                                            class="form-control relationship_with_passholderJs" data-passholder_id="{{$passholder_key}}">
                                                            <option value="" selected disabled>Choose relationship with pass holder 1</option>
                                                            <option value="Self"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Self' ? 'selected' : '' }}>Self</option>
                                                            <option value="Parents"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Parents' ? 'selected' : '' }}>Parents</option>
                                                            <option value="Spouse"
                                                            {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Spouse' ? 'selected' : '' }}>Spouse</option>
                                                            <option value="Children"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Children' ? 'selected' : '' }}>Children</option>
                                                            <option value="Relatives"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Relatives' ? 'selected' : '' }}>Relatives</option>
                                                            <option value="Friend"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Friend' ? 'selected' : '' }}>Friend</option>
                                                            <option value="Others"
                                                                {{ isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Others' ? 'selected' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                    @if (isset($passholder_item->relation_with_pass) && $passholder_item->relation_with_pass == 'Others')
                                                        <div class="formAreahalf basic_data please_specifyJs">
                                                            <label for="" class="form-label">Others, please specify</label>
                                                            <input type="text" class="form-control"
                                                                    name="passholder[{{$passholder_key}}][relation_with_pass_specify]"
                                                                    value="{{ isset($passholder_item->relation_with_pass_specify) ? $passholder_item->relation_with_pass_specify : '' }}">


                                                        </div>
                                                    @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_app_type" class="form-label">Pass Application
                                                            Type</label>
                                                        <select id= "pass_app_type" name="passholder[{{$passholder_key}}][pass_app_type]" id="pass_app_type"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose pass
                                                                application
                                                            </option>
                                                            <option value="EP"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'EP' ? 'selected' : '' }}>EP</option>
                                                            <option value="SP"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'SP' ? 'selected' : '' }}>SP</option>
                                                            <option value="DP"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'DP' ? 'selected' : '' }}>DP</option>
                                                            <option value="LVTP"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'LVTP' ? 'selected' : '' }}>LVTP</option>
                                                            <option value="WP"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'WP' ? 'selected' : '' }}>WP</option>
                                                            <option value="PR"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'PR' ? 'selected' : '' }}>PR</option>
                                                            <option value="Citizen"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                                                            <option value="Others"
                                                                {{ isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'Others' ? 'selected' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                    @if (isset($passholder_item->pass_app_type) && $passholder_item->pass_app_type == 'Others')
                                                        <div class="formAreahalf basic_data please_specify">
                                                            <label for="" class="form-label">Others, please specify</label>
                                                            <input type="text" class="form-control"
                                                                    name="passholder[{{$passholder_key}}][pass_app_type_specify]"
                                                                    value="{{ isset($passholder_item->pass_app_type_specify) ? $passholder_item->pass_app_type_specify : '' }}">


                                                        </div>
                                                    @endif
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_inssuance" class="form-label">Pass
                                                            Issuance</label>
                                                        <select name="passholder[{{$passholder_key}}][pass_inssuance]" id="pass_inssuance"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose Pass Issuance
                                                            </option>
                                                            <option value="Progress"
                                                                {{ isset($passholder_item->pass_inssuance) && $passholder_item->pass_inssuance == 'Progress' ? 'selected' : '' }}>Progress</option>
                                                            <option value="Done"
                                                                {{ isset($passholder_item->pass_inssuance) && $passholder_item->pass_inssuance == 'Done' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_issuance_date" class="form-label">Pass Issuance Date (DD/MM/YYYY)</label>
                                                            <input type="date" name="passholder[{{$passholder_key}}][pass_issuance_date]"
                                                            value="{{$passholder_item->pass_issuance_date ?? ''}}"
                                                            class="form-control pass_issuanceDateJs" placeholder="dd/mm/yyyy">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_expiry_date" class="form-label">Pass Expiry Date (DD/MM/YYYY)</label>
                                                        <input type="date" name="passholder[{{$passholder_key}}][pass_expiry_date]"
                                                        value="{{$passholder_item->pass_expiry_date ?? ''}}"
                                                        class="form-control pass_expiryDateJs" placeholder="dd/mm/yyyy">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_renewal_reminder" class="form-label">Pass Renewal
                                                            Reminder</label>
                                                        <select name="passholder[{{$passholder_key}}][pass_renewal_reminder]" id="pass_renewal_reminder"
                                                            class="form-control">
                                                            <option value="" selected disabled>Choose pass renewal
                                                                reminder
                                                            </option>
                                                            <option value="90 days before expiry"
                                                                {{ isset($passholder_item->pass_renewal_reminder) && $passholder_item->pass_renewal_reminder == '90 days before expiry' ? 'selected' : '' }}>
                                                                90 days before expiry
                                                            </option>
                                                            <option value="120 days before expiry"
                                                                {{ isset($passholder_item->pass_renewal_reminder) && $passholder_item->pass_renewal_reminder == '120 days before expiry' ? 'selected' : '' }}>
                                                                120 days before expiry
                                                            </option>
                                                            <option value="180 days before expiry"
                                                                {{ isset($passholder_item->pass_renewal_reminder) && $passholder_item->pass_renewal_reminder == '180 days before expiry' ? 'selected' : '' }}>
                                                                180 days before expiry
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="duration" class="form-label">Duration</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][duration]"
                                                            value="@isset($passholder_item->duration) {{ $passholder_item->duration }}  @endisset"
                                                            class="form-control pass_durationJs" readonly>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="fin_number" class="form-label">FIN Number</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][fin_number]"
                                                            value="@isset($passholder_item->fin_number) {{ $passholder_item->fin_number }}  @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_renewal_frq" class="form-label">Pass Renewal
                                                            Trigger
                                                            Frequency</label>
                                                        <div class="select_box"><span class="every">Every</span><span
                                                                class="select"><select name="passholder[{{$passholder_key}}][pass_renewal_frq]"
                                                                    id="pass_renewal_frq" class="form-control">
                                                                    <option value="" selected="" disabled="">
                                                                        Please
                                                                        select</option>
                                                                    <option value="Day"
                                                                        {{ isset($passholder_item->pass_renewal_frq) && $passholder_item->pass_renewal_frq == 'Day' ? 'selected' : '' }}>
                                                                        Day</option>
                                                                    <option value="3 Days"
                                                                        {{ isset($passholder_item->pass_renewal_frq) && $passholder_item->pass_renewal_frq == '3 Days' ? 'selected' : '' }}>
                                                                        3 Days</option>
                                                                    <option value="Week"
                                                                        {{ isset($passholder_item->pass_renewal_frq) && $passholder_item->pass_renewal_frq == 'Week' ? 'selected' : '' }}>
                                                                        Week</option>
                                                                    <option value="2 Weeks"
                                                                        {{ isset($passholder_item->pass_renewal_frq) && $passholder_item->pass_renewal_frq == '2 Weeks' ? 'selected' : '' }}>
                                                                        2 Weeks</option>
                                                                    <option value="4 Weeks"
                                                                        {{ isset($passholder_item->pass_renewal_frq) && $passholder_item->pass_renewal_frq == '4 Weeks' ? 'selected' : '' }}>
                                                                        4 Weeks</option>
                                                                </select></span></div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_jon_title" class="form-label">Pass. Job
                                                            Title</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][pass_jon_title]"
                                                            value="@isset($passholder_item->pass_jon_title) {{ $passholder_item->pass_jon_title }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="singpass_set_up" class="form-label">Singpass Set
                                                            Up</label>
                                                        <select name="passholder[{{$passholder_key}}][singpass_set_up]"
                                                            class="js-example-responsive form-control">
                                                            <option value="" selected disabled>Choose singpass set</option>
                                                            <option value="Progress" {{isset($passholder_item->singpass_set_up) && $passholder_item->singpass_set_up =="Progress" ? 'selected' : ""}}>Progress</option>
                                                            <option value="Done"  {{isset($passholder_item->singpass_set_up) && $passholder_item->singpass_set_up =="Done" ? 'selected' : ""}}>Done</option>
                                                        </select>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="employee_name" class="form-label">Employer's
                                                            Name</label>
                                                        <input type="text" name="passholder[{{$passholder_key}}][employee_name]"
                                                            value="@isset($passholder_item->employee_name) {{ $passholder_item->employee_name }} @endisset"
                                                            class="form-control">
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="monthly_sal" class="form-label">Monthly
                                                            Salary(SGD)</label>

                                                        <div class="dollersec"><span class="doller">$</span>
                                                            <span class="input"> <input type="integer" name="passholder[{{$passholder_key}}][monthly_sal]" value="@isset($passholder_item->monthly_sal) {{ $passholder_item->monthly_sal }} @endisset"
                                                            class="form-control"></span>
                                                        </div>
                                                    </div>
                                                    <div class="formAreahalf basic_data">
                                                        <label for="pass_remarks" class="form-label">Remarks</label>
                                                        <textarea name="passholder[{{$passholder_key}}][pass_remarks]" rows="4" cols="50"
                                                            value="@isset($passholder_item->pass_remarks) {{ $passholder_item->pass_remarks }} @endisset">@isset($passholder_item->pass_remarks) {{ $passholder_item->pass_remarks }} @endisset</textarea>
                                                    </div>
                                                </div>