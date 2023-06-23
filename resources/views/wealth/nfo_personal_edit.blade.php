<h3> Personal Information</h3>
<div class="nfo_personal_edit d-flex flex-wrap">
    <div class="formAreahalf">
        <label for="nfo_pass_name" class="form-label">Passport Full Name (Eng)</label>
        <input type="text" class="form-control" name="nfo_pass_name" id="nfo_pass_name"
            value="{{ $basic_data->pass_name_eng }}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
        <input type="text" class="form-control" name="nfo_pass_name_chinese" id="nfo_pass_name_chinese"
            value="{{ $basic_data->pass_name_chinese }}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_gender" class="form-label">Gender (M/F)</label>
        <select class="form-control" name="nfo_gender" id="nfo_gender">
            <option value="" selected disabled>Choose Gender</option>
            <option value="Male" {{ $basic_data->gender == 'Male' ? 'selected' : '' }}>M</option>
            <option value="Female" {{ $basic_data->gender == 'Female' ? 'selected' : '' }}>F</option>
        </select>
    </div>
    <div class="formAreahalf">
        <label for="nfo_dob" class="form-label">DOB (DD/MM/YYYY)</label>
        <input type="date" name="nfo_dob" id="nfo_dob" class="form-control" value="{{$basic_data->dob}}" placeholder="dd/mm/yyyy">

    </div>
    <div class="formAreahalf">
        <label for="nfo_pass_number" class="form-label">Passport Number</label>
        <input type="text" class="form-control" name="nfo_pass_number" id="nfo_pass_number" value="{{$basic_data->passport_no}}">

    </div>
    <div class="formAreahalf">
        <label for="nfo_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
        <input type="date" class="form-control" name="nfo_pass_exp" id="nfo_pass_exp" value="{{$basic_data->passport_exp_date}}" placeholder="dd/mm/yyyy">

    </div>
    <div class="formAreahalf">
        <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
        <select class="form-control" name="nfo_pass_reminder" id="nfo_pass_reminder">
            <option value="" selected disabled>Choose Passport Renewal Reminder</option>
            <option value="90 days before expiry" {{$basic_data->passport_renew == "90 days before expiry" ? 'selected' : ""}}>90 days before expiry</option>
            <option value="120 days before expiry" {{$basic_data->passport_renew == "120 days before expiry" ? 'selected' : ""}}>120 days before expiry</option>
            <option value="180 days before expiry" {{$basic_data->passport_renew == "180 days before expiry" ? 'selected' : ""}}>180 days before expiry</option>
        </select>
    </div>
    <div class="formAreahalf">
        <label for="nfo_pass_country" class="form-label">Passport Country</label>
        <input type="text" class="form-control" name="nfo_pass_country" id="nfo_pass_country" value="{{$basic_data->passport_country}}">
    </div>

    <div class="formAreahalf">
        <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
        <div class="select_box"><span class="every">Every</span><span class="select">
                <select name="nfo_pass_trg_frq" id="nfo_pass_trg_frq" class="form-control">
                    <option value="" selected="" disabled="">Please select</option>
                    <option value="Day" {{$basic_data->passport_trg_fqy == "Day" ? "selected" : ""}}>Day</option>
                    <option value="3 Days" {{$basic_data->passport_trg_fqy == "3 Days" ? "selected" : ""}}>3 Days</option>
                    <option value="Week" {{$basic_data->passport_trg_fqy == "Week" ? "selected" : ""}}>Week</option>
                    <option value="2 Weeks" {{$basic_data->passport_trg_fqy == "2 Weeks" ? "selected" : ""}}>2 Weeks</option>
                    <option value="4 Weeks" {{$basic_data->passport_trg_fqy == "4 Weeks" ? "selected" : ""}}>4 Weeks</option>
                </select></span></div>
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
        <input type="text" class="form-control" name="nfo_tin_number" id="nfo_tin_number" value="{{$basic_data->tin_no}}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
        <input type="text" class="form-control" name="nfo_tin_ctry" id="nfo_tin_ctry" value="{{$basic_data->tin_country}}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_no_before_app" class="form-label">TIN Number Before Pass Application </label>
        <input type="text" class="form-control" name="nfo_tin_no_before_app" id="nfo_tin_no_before_app" value="{{$basic_data->tin_before_application}}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_type" class="form-label">Type of TIN</label>
        <select class="form-control" name="nfo_tin_type" id="nfo_tin_type">
            <option value="" selected disabled>Choose Type of TIN</option>
            <option value="WP" {{$basic_data->type_of_tin == "WP" ? "selected" :""}}>WP</option>
            <option value="SP" {{$basic_data->type_of_tin == "SP" ? "selected" :""}}>SP</option>
            <option value="EP" {{$basic_data->type_of_tin == "EP" ? "selected" :""}}>EP</option>
            <option value="LTVP" {{$basic_data->type_of_tin == "LTVP" ? "selected" :""}}>LTVP</option>
            <option value="DP" {{$basic_data->type_of_tin == "DP" ? "selected" :""}}>DP</option>
            <option value="NRIC" {{$basic_data->type_of_tin == "NRIC" ? "selected" :""}}>NRIC</option>
        </select>
    </div>
    <div class="formAreahalf">
        <label for="nfo_email" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="nfo_email" id="nfo_email"  value="{{$basic_data->email}}">
        <span class="emailserror" style="color:red;"></span>
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_country_before_app" class="form-label">TIN Country Before Pass Application
        </label>
        <input type="text" class="form-control" name="nfo_tin_country_before_app"
            id="nfo_tin_country_before_app" value="{{$basic_data->tin_country_before_app}}">
    </div>

    <div class="formAreahalf">
        <label for="nfo_residential_Add" class="form-label">Residential Address</label>
        <input type="text" class="form-control" name="nfo_residential_Add" id="nfo_residential_Add" value="{{$basic_data->residential_address}}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_tin_type_before_app" class="form-label">Type of TIN Before Pass
            Application</label>
        <select type="text" class="form-control" name="nfo_tin_type_before_app" id="nfo_tin_type_before_app">
            <option value="" selected disabled>Choose Type of TIN Before Pass
                Application</option>
            <option value="WP" {{$basic_data->type_pin_before_app == "WP" ? 'selected' : ""}}>WP</option>
            <option value="SP" {{$basic_data->type_pin_before_app == "SP" ? 'selected' : ""}}>SP</option>
            <option value="EP" {{$basic_data->type_pin_before_app == "EP" ? 'selected' : ""}}>EP</option>
            <option value="LVTP" {{$basic_data->type_pin_before_app == "LVTP" ? 'selected' : ""}}>LVTP</option>
            <option value="DP" {{$basic_data->type_pin_before_app == "DP" ? 'selected' : ""}}>DP</option>
            <option value="NRIC" {{$basic_data->type_pin_before_app == "NRIC" ? 'selected' : ""}}>NRIC</option>
        </select>
    </div>
    <div class="formAreahalf">
        <label for="nfo_employer_ind" class="form-label">Employer's Industry</label>
        <input type="text" class="form-control" name="nfo_employer_ind" id="nfo_employer_ind" value="{{$basic_data->employer_industry}}">
    </div>

    <div class="formAreahalf">
        <label for="nfo_phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="nfo_phone_number" id="nfo_phone_number" value="{{$basic_data->phone}}">
    </div>

    <div class="formAreahalf">
        <label for="nfo_current_job_title" class="form-label">Current Job Title</label>
        <input type="text" class="form-control" name="nfo_current_job_title" id="nfo_current_job_title" value="{{$basic_data->job_title}}">
    </div>
    <div class="formAreahalf">
        <label for="nfo_emp_name" class="form-label">Employer's Name</label>
        <input type="text" class="form-control" name="nfo_emp_name" id="nfo_emp_name" value="{{$basic_data->employer_name}}">
    </div>
</div>
