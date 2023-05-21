@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add Operation Application</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('operation.index') }}">Operation</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Form card data -->
    <div class="dataAreaMain">
        <form action="{{ route('operation.save') }}" method="post" id="operation_form"
            class='d-flex justify-content-start flex-wrap application_details'>
            @csrf
            <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="uid" value="{{ Auth::user()->id }}">

            <fieldset id="start_field" class="w-100 justify-content-start flex-wrap form-fields pass_input_fields">
                <div class="card formContentData border-0 p-4">



                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active">
                                    <a href="#">1</a>
                                    <p> Pass Related </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">2</a>
                                    <p> Company Related </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">3</a>
                                    <p> PR Related </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">4</a>
                                    <p> Complete </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="passholder_section" class="card_potentials_fg passholder_section">
                        <div id="pass_design" class="w-100 d-flex justify-content-start flex-wrap form-fields pass_design">
                            <!-- <div class="col-sm-10" id="dynamicAddRemove2"> -->

                            <div class="accordion-item pass_acc_it">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">

                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>

                                </h2>
                                <div class="formAreahalf">
                                    <label class="form-label" for="">Pass Holder Name 1 (Eng)</label>

                              

                                </div>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">

                                    <div class="accordion-body d-flex flex-wrap">

                                        <div class="formAreahalf">
                                            <label for="bustype" class="form-label"> Business Type </label>
                                            {{-- <input type="text" class="form-control" name="pass[0][bus_type]"> --}}
                                            <select name="pass[0][bus_type]" class="select_class" data-id="0">
                                                <option value="" selected>Please select
                                                </option>
                                                <option value="FO">FO</option>
                                                <option value="PIC">PIC</option>
                                                <option value="Self-employment">Self-employment</option>
                                                <option value="Employer Guarantee">Employer Guarantee</option>
                                                <option value="PR application">PR application</option>
                                                <option value="PR renewal">PR renewal</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>

                                            </select>
                                          
                                        </div>
                                        <div class="formAreahalf others others_hide_show others_alignment" style="display:none;">
                                            <label class="form-label" for=""></label>
                                        </div>
                                      
                                        <div class="formAreahalf ">
                                            <label for="passapptype" class="form-label"> Pass Application Type </label>
                                            <select name="pass[0][pass_app_type]" class="select_class_pass_app_type"
                                                data-id="0">
                                                <option value="" selected>Please select
                                                </option>
                                                <option value="EP">EP</option>
                                                <option value="SP">SP</option>
                                                <option value="DP">DP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="WP">WP</option>
                                                <option value="PR">PR</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>



                                            </select>

                                        </div>
                                        <div class="formAreahalf others_pass_app others_alignment" style="display:none;">
                                            <label class="form-label" for=""></label>

                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Does passholder need to set up
                                                company?
                                            </label>
                                            <select name="pass[0][passhol_setup]" id="set_company" class="set_company">
                                                <option value="" selected>Please select
                                                </option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>

                                            </select>

                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Is the passholder also the
                                                shareholder? </label>
                                            <select name="pass[0][passhol_sharehol]" id="also_shareholder"
                                                class="also_shareholder">
                                                {{-- <option value="" selected >
                                                </option>
                                                <option value="Yes">Yes</option> --}}

                                            </select>

                                        </div>



                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Pass Holder Name 1 (Eng)</label>

                                            <input type="text" class="form-control" id="passhol_name"
                                                name="pass[0][passhol_name]">

                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Passport Full Name
                                                (Chinese)</label>

                                            <input type="text" class="form-control" id="gendcname[0][subject]"
                                                name="pass[0][passport_name]">

                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                                            <input type="date" class="form-control" name="pass[0][pass_dob]"
                                                id="pass_holder_dob">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="gender" class="form-label">Gender (M/F)</label>
                                            <select class="" name="pass[0][pass_gender]" id="gender">
                                                <option value="">Please select</option>
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Passport Expiry Date
                                                (DD/MM/YYYY)</label>
                                            <input type="date" class="form-control" name="pass[0][pass_exp_dob]"
                                                id="passport_exp_date">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Passport Number</label>

                                            <input type="text" class="form-control" id="passport_no"
                                                name="pass[0][passport_number]">

                                        </div>
                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Passport Country</label>

                                            <input type="text" class="form-control" id="passport_cnt"
                                                name="pass[0][passport_country]">

                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label"> Passport Renewal
                                                Reminder</label>
                                            <select name="pass[0][passport_ren_rem]" id="passport_ren_rem">
                                                <option value="">Please select </option>
                                                <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="180 days before expiry">180 days before expiry</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">TIN Number Before Pass
                                                Application</label>

                                            <input type="text" class="form-control" id="tin_number"
                                                name="pass[0][passport_tin_number]">

                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label">Passport Reminder Trigger
                                                Frequency</label>
                                            <div class="select_box"><span class="every">Every</span><span
                                                    class="select"><select name="pass[0][passport_rem_fre]"
                                                        id="passport_rem_trg_fre">
                                                        <option value="">Please select
                                                        </option>
                                                        <option value="Day">Day</option>
                                                        <option value="3 Days">3 Days</option>
                                                        <option value="Week">Week</option>
                                                        <option value="2 Weeks">2 Weeks</option>
                                                        <option value="4 Weeks">4 Weeks</option>
                                                    </select></span></div>
                                            {{-- <div class="select_box"><span class="every">Every</span><span class="select"><select
                                                name="pass[0][passport_rem_fre]" id="passport_rem_trg_fre" class="form-control">
                                                <option value="" selected="" disabled="">Please select passport reminder trigger</option>
                                                <option value="Day">Day</option>
                                                <option value="3 Days">3 Days</option>
                                                <option value="Every Week">Every Week</option>                                               
                                            </select></span></div> --}}
                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">E-mail</label>
                                            <input type="email" class="form-control" id="p_email"
                                                name="pass[0][email]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">TIN Country Before Pass
                                                Application</label>

                                            <input type="text" class="form-control"
                                                name="pass[0][passport_tin_country]" id="tin_cnt">

                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Phone Number</label>

                                            <input type="text" class="form-control" id="ph_num"
                                                name="pass[0][phno]">

                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="passapptype" class="form-label"> Type of TIN Before Pass
                                                Application</label>
                                            <select name="pass[0][pass_tin_type]" id="type_of_tin">
                                                <option value="" selected>Please select
                                                </option>
                                                <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>

                                            </select>

                                        </div>

                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">FIN Number</label>

                                            <input type="text" class="form-control" id="fin_number"
                                                name="pass[0][finno]">

                                        </div>
                                        <div class="formAreahalf ">
                                            <label class="form-label" for="">Residential Address</label>
                                            <input type="text" class="form-control" id="res_add"
                                                name="pass[0][res_add]">
                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="passapptype" class="form-label"> Pass Application Status
                                            </label>
                                            <select name="pass[0][pass_app_sts]"  class="js-example-responsive form-control">
                                                <option value="" selected>Please select
                                                </option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="passapptype" class="form-label"> Pass Issuance </label>
                                            <select name="pass[0][pass_iss]"  class="js-example-responsive form-control">
                                                <option value="" selected>Please select pass issuance
                                                </option>
                                                <option value="In progress">In progress</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Pass Issuance Date </label>
                                            <input type="date" class="form-control" name="pass[0][pass_iss_date]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Pass Expiry Date </label>
                                            <input type="date" class="form-control" name="pass[0][pass_exp_date]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Duration </label>
                                            <input type="text" class="form-control" name="pass[0][duration]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label"> Pass Renewal Frequency</label>
                                            <select name="pass[0][pass_ren_fre]" id="renewlrem">
                                                <option value="">Please select</option>
                                                <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="120 days before expiry">180 days before expiry</option>

                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label"> Pass Renewal Reminder</label>
                                            <select name="pass[0][pass_ren_rem]" id="renewlrem">
                                                <option value="">Please select pass renewal reminder</option>
                                                <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="120 days before expiry">180 days before expiry</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label">Pass Renewal Trigger
                                                Frequency</label>
                                            <div class="select_box"><span class="every">Every</span><span
                                                    class="select"><select name="pass[0][pass_ren_ter_fre]"
                                                        id="renewlfre">
                                                        <option value="">Please select
                                                        </option>
                                                        <option value="Day">Day</option>
                                                        <option value="3 Days">3 Days</option>
                                                        <option value="Week">Week</option>
                                                        <option value="2 Weeks">2 Weeks</option>
                                                        <option value="4 Weeks">4 Weeks</option>
                                                    </select></span></div>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Pass Job Title </label>
                                            <input type="text" class="form-control" id="p_job_title"
                                                name="pass[0][pass_job_title]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label ">Singpass Setup</label>
                                            <select name="pass[0][singpass_setup]" id="renewlfre" class="js-example-responsive form-control">
                                                <option value="">Please select</option>
                                                <option value="In progress">In progress</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label"> 1st PR Application Reminder
                                            </label>
                                            <select name="pass[0][pr_app_rem]" id="renewlrem">
                                                <option value="">Please select</option>
                                                <option value="N/A">N/A</option>
                                                <option value="180 days after pass issuance date">180 days after pass
                                                    issuance date</option>
                                                <option value="270 days after pass issuance date">270 days after pass
                                                    issuance date</option>
                                                <option value="365 days after pass issuance date">365 days after pass
                                                    issuance date</option>
                                                <option value="540 days after pass issuance date">540 days after pass
                                                    issuance date</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label"> Relationship With Pass Holder
                                                1</label>
                                            <select name="pass[0][rel_pass_hol]" id="rel_pass_holder"
                                                class="select_class_rel_share" data-id="0">
                                                <option value="">Please select
                                                </option>
                                                <option value="Self">Self</option>
                                                <option value="Parents">Parents</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Children">Children</option>
                                                <option value="Relatives">Relatives</option>
                                                <option value="Friend">Friend</option>
                                                <option value="Others (please specify)">Other (please specify)</option>
                                            </select>
                                        </div>

                                        <div class="formAreahalf others_rel_share others_alignment" style="display:none;">
                                            <label class="form-label" for=""></label>
                                        </div>
                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Employer's Name </label>
                                            <input type="text" class="form-control" name="pass[0][emp_name]">
                                        </div>

                                        <div class="formAreahalf ">
                                            <label for="" class="form-label"> Monthly Salary (SGD)</label>
                                            <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="number" class="form-control" name="pass[0][month_sal]"
                                                id="month_salary"></span></div>
                                        </div>

                                        <div class="formAreahalf">
                                            <label class="form-label" for="remarks">Remarks</label>
                                            <textarea id="addbg[0][genremarks]" name="pass[0][p_remarks]" rows="4" cols="50"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div id="appended_passholder_div">
                    </div>
                    <div class="text-center pt-4 " id="add-pass-holder_btn_div">
                        <button type="button" id="add-pass-holder" class="btn saveBtn btn_design add-pass-holder"
                            name="add-pass-holder">Add
                            Pass Holder</button>
                    </div>
                    {{-- style="display:none;"  --}}
                    <div class="text-center pt-4" id="append_div_btn">
                        <button type="button" id="next1" class="btn saveBtn next-step next1">Next</button>
                        <button type="button" id="reset1" class="btn cancelBtn saveBtn">Reset</button>
                    </div>
                </div>

            </fieldset>

            <fieldset id="FO_company" class="w-100 justify-content-start flex-wrap form-fields" style="display:none">
                <div class="card formContentData border-0 p-4">

                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Pass Related </p>
                                </li>
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Related</p>
                                </li>
                                <li class="list-group-item" id="3">
                                    <a href="#">3</a>
                                    <p> PR Related </p>
                                </li>
                                <li class="list-group-item" id="4">
                                    <a href="#">4</a>
                                    <p> Complete</p>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <div id="fo_company" class="compnies_holder">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="accordion-item pass_acc_it ">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOnefive">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOnefive" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOnefive">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div class="formAreahalf company-full_width_Cstm">
                                    <label for="fo_compnay" class="form-label">Company Name 1</label>
                                    <input type="text" name="cmp[0][fo_company]" id="fo_compnay" class="form-control"
                                        value="" required>
                                </div>


                                <div id="panelsStayOpen-collapseOnefive" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOnefive">

                                    <div class="accordion-body d-flex flex-wrap">


                                        <div class="formAreahalf">
                                            <label for="fo_uen" class="form-label">UEN</label>
                                            <input type="text" class="form-control" name="cmp[0][fo_uen]"
                                                id="fo_uen" required>
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_company_add" class="form-label">Company Address</label>
                                            <input type="text" class="form-control" name="cmp[0][fo_company_add]"
                                                id="fo_company_add" required>
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_incorporation_date" class="form-label">Incorporation
                                                Date</label>
                                            <input type="date" class="form-control"
                                                name="cmp[0][fo_incorporation_date]" id="fo_incorporation_date" required>
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_company_email" class="form-label">Company Email</label>
                                            <input type="text" class="form-control" name="cmp[0][fo_company_email]"
                                                id="fo_company_email" required>
                                        </div>
                                        <div class="formAreahalf">
                                            <label for="fo_company_pass" class="form-label">Company Password</label>
                                            <input type="text" class="form-control" name="cmp[0][fo_company_pass]"
                                                id="fo_company_pass" required>
                                        </div>



                                    </div>

                                </div>

                            </div>
                            <div id="appended_company_div">
                            </div>

                        </div>


                    </div>

                    <div class="text-center pt-4 " id="add_company_btn_div">
                        <button type="button" id="add_company" class="btn saveBtn btn_design add_company"
                            name="add-company">Add
                            Company</button>
                    </div>

                    <div class="text-center pt-4 " id="append_div_btn">
                        <button type="button" id="next2" class="btn saveBtn next-step next2">Next</button>
                        <button type="button" id="reset2" class="btn cancelBtn saveBtn">Reset</button>
                    </div>
                </div>








            </fieldset>



            <fieldset id="FO_shareholder" class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder">
            </fieldset>
            <fieldset id="FO_shareholder_extra"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder_extra">
            </fieldset>



            <fieldset id="FO_financial" class="w-100 justify-content-start flex-wrap form-fields wealth FO_financial">
            </fieldset>
            <fieldset id="FO_financial_extra"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_financial_extra">
            </fieldset>



            <fieldset id="FO_pr" class="w-100 justify-content-start flex-wrap form-fields wealth FO_pr pr_form_class">
            </fieldset>
            <fieldset id="FO_Pass_PR" class="w-100 justify-content-start flex-wrap form-fields wealth FO_Pass_PR">
            </fieldset>









            {{-- <fieldset id="com_shareholder" class="w-100 justify-content-start flex-wrap form-fields"
                style="display:none">
          

            </fieldset> --}}











        </form>

    </div>




@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var form = $("#operation_form");
            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
            $(document).on('change', '.select_class', function() {
                if ($(this).val() == "Others (please specify)") {

                    // $(this).(".others").html(
                    //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                    // );
                    // $(".hide").click(function() {
                    //     $("p").hide();
                    // });
                    $(this).parents('.accordion-body').find('.others_hide_show').show();
                    // $(".others_hide_show").show();
                    // $(".others_hide_show").click(function() {
                    //     $("p").show();
                    // });
                    var tpb_id = $(this).attr('data-id');
                    $(this).parents('.accordion-body').find('.others').append(
                        '<div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="drp_spc" name="pass[' +
                        tpb_id + '][bus_type_specify]"></span></div>'
                    );
                    // ++o;

                } else {
                    $(this).parents('.accordion-body').find('.others').html('');
                    // $(".others_hide_show").hide();
                    $(this).parents('.accordion-body').find('.others_hide_show').hide();
                }


            });

            $(document).on('change', '.select_class_pass_app_type', function() {

                if ($(this).val() == "Others (please specify)") {
                    // $(this).(".others").html(
                    //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                    // );
                    // $(".others_pass_app").show();
                    $(this).parents('.accordion-body').find('.others_pass_app').show();
                    var tpb_id = $(this).attr('data-id');
                    $(this).parents('.accordion-body').find('.others_pass_app').append(
                        '<div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="drp_spc" name="pass[' +
                        tpb_id + '][rel_pass_hol_specify]" ></span></div>'
                    );
                    // ++o;

                } else {
                    $(this).parents('.accordion-body').find('.others_pass_app').html('');
                    // $(".others_pass_app").hide();
                    $(this).parents('.accordion-body').find('.others_pass_app').hide();
                }


            });

            $(document).on('change', '.select_class_rel_share', function() {

                if ($(this).val() == "Others (please specify)") {
                    // $(".others_rel_share").show();
                    $(this).parents('.accordion-body').find('.others_rel_share').show();
                    // alert('o');
                    // $(this).(".others").html(
                    //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                    // );
                    var tpb_id = $(this).attr('data-id');
                    $(this).parents('.accordion-body').find('.others_rel_share').append(
                        '<div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="pass[' +
                        tpb_id + '][rel_pass_hol_specify]" ></span></div>'
                    );
                    // ++o;

                } else {
                    $(this).parents('.accordion-body').find('.others_rel_share').html('');
                    // $(".others_rel_share").hide();
                    $(this).parents('.accordion-body').find('.others_rel_share').hide();
                }


            });

            $(document).on('change', '.others_Relationship_share_class', function() {
                // alert('ijij');

                if ($(this).val() == "Others (please specify)") {
                    // alert('jok');
                    //    alert('o');
                    // $(this).(".others").html(
                    //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                    // );
                    var tpb_id = $(this).attr('data-id');

                    var cmp_id_data = $(this).attr('data-id-cmp');
                    //    alert(cmp_id_data);
                    $(this).parents('.accordion-body').find('.others_Relationship_share').show();
                    $(this).parents('.accordion-body').find('.others_Relationship_share').append(
                        '<div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="share[' +
                        cmp_id_data + '][' +
                        tpb_id + '][p_rel_share_specific]"></span></div>'
                    );
                    // ++o;

                } else {
                    // alert('no');
                    $(this).parents('.accordion-body').find('.others_Relationship_share').html('');
                    $(this).parents('.accordion-body').find('.others_Relationship_share').hide();
                }


            });


            $(document).on('change', '.select_acc_type_class', function() {
                // alert('ijij');

                if ($(this).val() == "Others (please specify)") {

                    var tpb_id = $(this).attr('data-id');

                    var cmp_id_data = $(this).attr('data-id-cmp');
                    $(this).parents('.accordion-body').find('.others_acc_type').show();
                    //    alert(cmp_id_data);
                    $(this).parents('.accordion-body').find('.others_acc_type').append(
                        '<div class="select_box"><span class="every">Others, please specify: </span><span class="select"><input type="text" class="form-control sds" id="id_rel_pass_hol_specify" name="fi[' +
                        cmp_id_data + '][' +
                        tpb_id + '][acc_type_specific]"></span></div>'
                    );
                    // ++o;

                } else {
                    // alert('no');
                    $(this).parents('.accordion-body').find('.others_acc_type').html('');
                    $(this).parents('.accordion-body').find('.others_acc_type').hide();
                }


            });

            $(document).on('change', '.p_sts', function() {
                // alert('abc');

              if ($(this).val() == "Rejected") {
             $(this).parents('.accordion-body').find('.p_status_div_default').hide();
             $(this).parents('.accordion-body').find('.p_status_div').show();
  
   
                  } 
                  else {
  
            $(this).parents('.accordion-body').find('.p_status_div_default').show();
             $(this).parents('.accordion-body').find('.p_status_div').hide();
  
                }


                   });



            $('body').on('change', ".set_company", function() {
                // alert('hiuh');
                // alert(document.getElementById('set_company').value);

                if ($(this).val() == "No") {
                    // alert('no');
                    // $("#client").append('<option>Select</option>');
                    $(this).parents('.accordion-body').find("#also_shareholder").html(
                        '<option value="No" selected>No</option>'
                    );

                }
                if ($(this).val() == "Yes") {
                    // alert('yes');
                    // $("#client").append('<option>Select</option>');
                    $(this).parents('.accordion-body').find("#also_shareholder").html(
                        '<option value="" selected>Please Select</option><option value="Yes">Yes</option><option value="No">No</option>'
                    );

                }
            });
            $('body').on('click', ".add-pass-holder", function() {
            
                //   alert('dd');
                ++p;
                $("#passholder_section .pass_design").last().append(`<div id="dynamicAddRemove"
                            class="w-100 d-flex justify-content-start flex-wrap form-fields parent_field` + p + `">   
                          
                            
                            <div class="accordion-item pass_acc_it ">
                                <div class="cross"><span class="remove-input-field" data-id=".parent_field` + p + `">x</span></div>
                                <h2 class="accordion-header" id="panelsStayOpen-heading` + p + `">
                                
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapse` + p + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapse` + p + `">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div class="formAreahalf ">
                            <label class="form-label" for="">Pass Holder Name ` + (p + 1 )+ ` (Eng)</label>

                         

                        </div>
                                <div id="panelsStayOpen-collapse` + p + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-heading` + p + `">
                     <div class="accordion-body d-flex flex-wrap">

                        <div class="formAreahalf ">
                            <label for="bustype" class="form-label"> Business Type </label>
                          
                                <select name="pass[` + p + `][bus_type]" class="select_class" data-id="` + p + `"> 
                                <option value="" selected >Please select
                                </option>
                           

                                <option value="FO">FO</option>
                                                <option value="PIC">PIC</option>
                                                <option value="Self-employment">Self-employment</option>
                                                <option value="Employer Guarantee">Employer Guarantee</option>
                                                <option value="PR application">PR application</option>
                                                <option value="PR renewal">PR renewal</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                                </select>

                        </div>
                        <div class="formAreahalf others others_hide_show others_alignment" style="display:none;">
                            <label class="form-label" for=""></label>
                        </div>
                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Application Type </label>
                            <select name="pass[` + p +
                    `][pass_app_type]" class="select_class_pass_app_type" data-id="` + p + `"> 
                                <option value="" selected >Please select pass application type
                                </option>
                                <option value="EP">EP</option>
                                                <option value="SP">SP</option>
                                                <option value="DP">DP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="WP">WP</option>
                                                <option value="PR">PR</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                
                            </select>
                         
                        </div>
                        <div class="formAreahalf others_pass_app others_alignment" style="display:none;">
                            
                            <label class="form-label" for=""></label>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Does passholder need to set up company? </label>
                            <select name="pass[` + p + `][passhol_setup]" class="set_company" id="set_company">
                                <option value="" selected >Please select
                                </option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Is the passholder also the shareholder? </label>
                            <select name="pass[` + p + `][passhol_sharehol]" id="also_shareholder" class="also_shareholder">                            
                              
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Pass Holder Name ` + (p + 1 )+ ` (Eng)</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passhol_name]" id="passhol_name">

                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Full Name (Chinese)</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_name]">

                        </div>
                      
                        <div class="formAreahalf ">
                            <label for="" class="form-label">  DOB (DD/MM/YYYY)</label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_dob]" id="pass_holder_dob">
                        </div>

                        <div class="formAreahalf ">
                            <label for="gender" class="form-label">Gender (M/F)</label>
                            <select class="" name="pass[` + p + `][pass_gender]" id="gender">
                                <option value=""></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Passport Expiry Date (DD/MM/YYYY)</label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_exp_dob]">
                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_number]" id="passport_no" >

                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Passport Country</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_country]" id="passport_cnt">

                        </div>
                      

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Passport  Renewal Reminder</label>
                            <select name="pass[` + p + `][passport_ren_rem]" id="passport_ren_rem" >
                                <option value="">Please select</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">TIN Number Before Pass Application</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_tin_number]" id="tin_number">

                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label">Passport Reminder Trigger Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select name="pass[` + p + `][passport_rem_fre]" id="passport_rem_trg_fre">
                                <option value="">Please select</option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                            </select></span></div>
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">E-mail</label>
                            <input type="email" class="form-control" 
                                name="pass[` + p + `][email]" id="p_email">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">TIN Country Before Pass Application</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][passport_tin_country]" id="tin_cnt">

                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">Phone Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][phno]" id="ph_num">

                        </div>


                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Type of TIN Before Pass Application</label>
                            <select name="pass[` + p + `][pass_tin_type]" id="type_of_tin">
                                <option value="" selected >Please select type of TIN before pass application
                                </option>
                                <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>
                                
                            </select>
                         
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="">FIN Number</label>

                            <input type="text" class="form-control" 
                                name="pass[` + p + `][finno]">

                        </div>


                        <div class="formAreahalf ">
                            <label class="form-label" for="">Residential Address</label>
                            <input type="text" class="form-control" 
                                name="pass[` + p + `][res_add]" id="res_add">
                        </div>


                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Application Status </label>
                            <select name="pass[` + p + `][pass_app_sts]"  class="js-example-responsive form-control">
                                <option value="" selected >Please select application status
                                </option>
                                <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                            </select> 
                        </div>

                        <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Pass Issuance </label>
                            <select name="pass[` + p + `][pass_iss]"  class="js-example-responsive form-control">
                                <option value="" selected >Please select pass issuance
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select> 
                        </div>


                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Issuance Date </label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_iss_date]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Expiry Date </label>
                            <input type="date" class="form-control"  name="pass[` + p + `][pass_exp_date]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Duration </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][duration]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Pass Renewal Frequency</label>
                            <select name="pass[` + p + `][pass_ren_fre]" >
                                <option value="">Please select pass renewal reminder</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                <option value="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Pass Renewal Reminder</label>
                            <select name="pass[` + p + `][pass_ren_rem]" >
                                <option value="">Please select pass renewal reminder</option>
                                <option value="90 days before expiry">90 days before expiry</option>
                                <option value="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label">Pass Renewal Trigger Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select name="pass[` + p + `][pass_ren_ter_fre]" id="renewlfre">
                                <option value="">Please select </option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                            </select></span></div>
                        </div>


                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Pass Job Title </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][pass_job_title]" id="p_job_title">
                        </div> 

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label ">Singpass Setup</label>
                            <select name="pass[` + p + `][singpass_setup]" class="js-example-responsive form-control>
                                <option value="">Please select</option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> 1st PR Application Reminder </label>
                            <select name="pass[` + p + `][pr_app_rem]" >
                                <option value="">Please select</option>
                                <option value="N/A">N/A</option>
                                <option value="180 days after pass issuance date">180 days after pass issuance date</option>
                                <option value="270 days after pass issuance date">270 days after pass issuance date</option>
                                <option value="365 days after pass issuance date">365 days after pass issuance date</option>
                                <option value="540 days after pass issuance date">540 days after pass issuance date</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="clienttype" class="form-label"> Relationship With Pass Holder ` + ( p+1 ) + `</label>
                            <select name="pass[` + p +
                    `][rel_pass_hol]" id="rel_pass_holder" class="select_class_rel_share" data-id="` +
                    p + `" id="rel_pass_holder">
                                <option value="">Please select</option>
                                <option value="Self">Self</option>
                                                <option value="Parents">Parents</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Children">Children</option>
                                                <option value="Relatives">Relatives</option>
                                                <option value="Friend">Friend</option>
                                                <option value="Others (please specify)">Other (please specify)</option>
                            </select>
                        </div>
                        <div class="formAreahalf others_rel_share others_alignment" style="display:none;">
                            <label class="form-label" for=""></label>
                                    </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Employer's Name </label>
                            <input type="text" class="form-control"  name="pass[` + p + `][emp_name]">
                        </div> 

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Monthly Salary (SGD)</label>
                            <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="text" class="form-control"  name="pass[` + p + `][month_sal]" id="month_salary"></span></div>
                        </div> 

                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea  name="pass[` + p + `][p_remarks]" rows="4" cols="50"></textarea>
                        </div>
                            </div></div>
                            </div></div>`


                )
                $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
            });

            var form_count = 1,
                form_count_form, next_form, total_forms;
            total_forms = $("fieldset").length;
            var form = $("#multistep_form");

            function setProgressBar(curStep) {
                var data = $('#' + curStep).addClass("active");
            };

            var p = 0;

            $(document).on('click', '.remove-input-field', function() {
                var id = $(this).attr('data-id');
                // console.log(id);
                $(this).parents(id).remove();
            });





            $('#reset1').click(function() {

                $("#start_field input[type != button],select,textarea").each(function(key, value) {
                    $(this).val("");
                });
                    $(".others_hide_show").hide();
                       $(".others_pass_app").hide();
                           $(".others_pass_app").hide();

            })
            $('#reset2').click(function() {

                $("#FO_company input[type != button],select,textarea").each(function(key, value) {
                    $(this).val("");
                });
                $('.others_Relationship_share').hide();

            })

            // $('#previous_cmp').click(function() {
            //  alert('guhuhuih');
            //     $('#FO_shareholder_extra').hide();
            //     $('#FO_company').show();


            // })

            jQuery('body').on('click', '#previous_cmp', function() {
                // alert();
                --btn_click;
                $("#next2").addClass("firstnext");
                $('#FO_shareholder_extra').hide();
                $('#FO_company').show();

                $(this).parents('fieldset').hide();
               

                // $(this).closest('fieldset').prev().show();
            });

            // $('#previous2').click(function () {
            //     $('#start_field').show();
            //     $('#appended_company_div').html("");
            // })

            $('#next1').click(function() {

// alert('next');

                set_company = $('select[id=set_company]').map(function() {
                    return this.value;
                }).get();
                var n = $("select[id=set_company]").length;
                console.log(n);





                if (jQuery.inArray("Yes", set_company) == -1) {
                    // alert('next1');
                    // if (document.getElementById('set_company').value == "No") {
                    arr_p = $('input[id=passhol_name]').map(function() {
                        return this.value;
                    }).get();

                    pr_no = 0;

                    btn_click_p++;
                    var isLastElement1_p = arr_p.length;


                    let btn_id_p = "";
                    if (btn_click_p == isLastElement1_p) {
                        btn_id_p = "next6";
                    } else {
                        btn_id_p = "next4";
                    }


                    $('#start_field').hide();

                    $('.FO_Pass_PR').append(`
                    <div class="full_div">
                            <div class="card formContentData border-0 p-4">
                                <div class="Personal_Details company_space">
                                    <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                                    <div class="number_main">
                                <ul class="list-group list-group-horizontal" id="nav_list">
                                    <li class="list-group-item active" id="1">
                                        <a href="#">1</a>
                                        <p> Pass Related </p>
                                    </li>
                                    <li class="list-group-item active" id="2">
                                        <a href="#">2</a>
                                        <p> Company Related</p>
                                    </li>
                                    <li class="list-group-item active" id="3">
                                        <a href="#">3</a>
                                        <p> PR Related </p>
                                    </li>
                                    <li class="list-group-item" id="4">
                                        <a href="#">4</a>
                                        <p> Complete</p>
                                    </li>
                                </ul>
                            </div>

                                </div>
                                <div class="First-heading_ heading_name">
                                        <h4>Pass Holder ` + [btn_click_p] + `</h4>
                                        <h6>` + arr_p[btn_click_p - 1] + `</h6>
                                    </div>
                                <div id="fo_pr" class="pr pr_form_class">
                                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                        <div class="accordion-item pass_acc_it ">
                                
                                <h2 class="accordion-header" id="panelsStayOpen-headingno` + btn_click_p + `">
                               
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseno` + btn_click_p + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseno` + btn_click_p + `">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div class="formAreahalf">
                                        <label for="" class="form-label">1st Time PR Application Date</label>
                                      
                                    </div>
                                <div id="panelsStayOpen-collapseno` + btn_click_p + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingno` + btn_click_p + `">
                             <div class="accordion-body d-flex flex-wrap">

                                        <div class="formAreahalf">
                                        <label for="" class="form-label">1st Time PR Application Date</label>
                                        <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][application_date]"
                                            id="">
                                    </div>
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">Application Dependent</label>
                                        <select name="pr[` + (btn_click_p - 1) + `][0][application_dep]" id="">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="None">None</option>
                                        <option value="Spouse only">Spouse only</option>
                                        <option value="Children only">Children only</option>
                                        <option value="Spouse and Children">Spouse and Children</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">Pass Application Status</label>
                                        <select name="pr[` + (btn_click_p - 1) + `][0][application_sts]" id="p_sts" class="p_sts js-example-responsive form-control">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                
                                    <div class="formAreahalf p_status_div_default">
                                        <label for="" class="form-label">PR Approval Date</label>
                                        <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) +
                        `][0][approval_date]"
                                            id="">
                                    </div>
                                    <div class="formAreahalf p_status_div_default">
                                        <label for="" class="form-label">REP Expiry Date</label>
                                        <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][rep_expiry_date]"
                                            id="">
                                    </div>
                                    <div class="formAreahalf p_status_div_default">
                                        <label for="" class="form-label">REP Renewal Reminder</label>
                                        <select name="pr[` + (btn_click_p - 1) + `][0][rep_ren_rem]" id="">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="90 days before REP expiry">90 days before REP expiry</option>
                                            <option value="180 days before REP expiry">180 days before REP expiry</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf p_status_div" style="display:none">
                                    <label for="" class="form-label">PR Rejection Date</label>
                                    <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][rejection_date]"
                                        id="">
                                </div>
                              
                                <div class="formAreahalf p_status_div" style="display:none">
                                    <label for="" class="form-label">Re Submission Reminder</label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][re_sub_rem]" id="">
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        
                                    </select>
                                </div>
                                <div class="formAreahalf p_status_div" style="display:none;" >
                                    <label for="" class="form-label">Re Submission Status </label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][re_sub_sts]" id="abc" class="js-example-responsive form-control">
                                        <option value="">Please select</option>
                                        <option value="Done">Done</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        
                                    </select>

                                </div>
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">REP Renewal Trigger Frequency</label>
                                        <select name="pr[` + (btn_click_p - 1) + `][0][rep_ren_trg_fre]" id="">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                        </select>
                                    </div>
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">Re-Submission Trigger Frequency</label>
                                        <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[` + (btn_click_p - 1) + `][0][re_sub_trg_fre]" id="">
                                            <option value="" selected >Please select
                                            </option>
                                            <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option></select></span></div>
                                            

                                     
                                    </div>
                                    <div class="formAreahalf">
                                        <label class="form-label" for="remarks">Remarks</label>
                                        <textarea id="" name="pr[` + (btn_click_p - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                                    </div>


                                        <div id="appended_user_pr_pass_selcection_div"
                                            class="w-100 d-flex justify-content-start flex-wrap"></div>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                               
                            </div>
                       
                            <div id="appended_pr_div" class="appended_pr_div">
                                </div>
                                <div class="text-center pt-4 add_potentia add_potential" id="add_pr_btn_div">
                                    <button type="button" id="add_pr" class="btn saveBtn btn_design add_pr"
                                        name="add-pr" data-id="` + btn_click_p + `" >Add
                                        Application Attempt</button>
                                </div>
                                <div class="text-center pt-4 " id="append_div_btn">
                                <button type="button" id="next5" class="btn saveBtn ` + btn_id_p + `" data-id="` +
                        btn_click_p +
                        `">Next</button>
                                <button type="button" id="previous4" class="btn saveBtn cancelBtn previouss" data-id="` +
                        btn_click_p + `">Back</button>
                            </div>
                            </div>
                          </div>`);
                          $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

                } else {
                    // (document.getElementById('set_company').value == "Yes") {
                    let next = $('#' + this.id).closest('fieldset').next('fieldset').attr('id');
                    $('#' + next).show();
                    $('#start_field').hide();
                    $('#FO_company').show();



                }



                // }

            });


            var c = 0;
            $('.add_company').click(function() {
                ++c;
                // var C = c + 1;
                var C = $('.compnies_holder').find('.accordion-body').length + 1;

                $('#appended_company_div').last().append(
                    ` <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design parent_field2` +
                    c + `">
                    <div class="accordion-item pass_acc_it ">
                        
                        <h2 class="accordion-header" id="panelsStayOpen-heading` + c + `">
                            <div class="formAreahalf company-full_width_Cstm">
                                <label for="fo_compnay" class="form-label">Company Name ` + C +
                    `</label>
                               <input type="text" name="cmp[` + c +
                    `][fo_company]" id="fo_compnay" class="form-control"
                                   value="">
                           </div>
                  
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse` +
                    c +
                    `" aria-expanded="true" aria-controls="panelsStayOpen-collapse` + c + `">
                            <i class="fa fa-arrows-v" aria-hidden="true"></i>
                          </button>
                        
                        </h2>
                        <div class="cross"><span class="remove-input" data-id=".parent_field2` + c + `">x</span></div>
                        <div id="panelsStayOpen-collapse` + c +
                    `" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading` +
                    c + `">
                          <div class="accordion-body">

                 
                    
                          
                            <div class="formAreahalf">
                                <label for="fo_uen" class="form-label">UEN</label>
                                <input type="text" class="form-control" name="cmp[` + c + `][fo_uen]" id="fo_uen">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_company_add" class="form-label">Company Address</label>
                                <input type="text" class="form-control" name="cmp[` + c + `][fo_company_add]"
                                    id="fo_company_add">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                                <input type="date" class="form-control" name="cmp[` + c + `][fo_incorporation_date]"
                                    id="fo_incorporation_date">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_company_email" class="form-label">Company Email</label>
                                <input type="text" class="form-control" name="cmp[` + c + `][fo_company_email]"
                                    id="fo_company_email">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_company_pass" class="form-label">Company Password</label>
                                <input type="text" class="form-control" name="cmp[` + c + `][fo_company_pass]"
                                    id="fo_company_pass">
                            </div>

                        </div>

                    </div>

                          </div>
                        </div>
                      `)
            });
            $(document).on('click', '.remove-input', function() {
                var id = $(this).attr('data-id');
                $(this).parents(id).remove();
                var c = 1;
                $('.compnies_holder .accordion-item').each(function(index) {
                    $(this).find('.accordion-header label').html('Company Name ' + c);
                    c++;
                });

            });
            







            var btn_click =0;
            var arr = "";
            $('body').on('click', '.next2', function() {
                var form = $("#operation_form");
                form.validate({
                    rules: {
                        'cmp[][]': {
                            required: true
                        },                    
                    },
            });
        if (form.valid() === true) {
            // alert('yes');

                // alert(btn_click);
                // alert('yes');
                arr = $('input[id=fo_compnay]').map(function() {
                    return this.value;
                }).get();
                // console.log(arr);

                also_share = $('select[id=also_shareholder]').map(function() {
                    return this.value;
                }).get();

                set_company = $('select[id=set_company]').map(function() {
                    return this.value;
                }).get();

                pass_holder_name_eng = $('input[id=passhol_name]').map(function() {
                    return this.value;
                }).get();
                console.log(pass_holder_name_eng);

                p_gen = $('select[id=gender]').map(function() {
                    return this.value;
                }).get();
                console.log(p_gen);

                p_dob = $('input[id=pass_holder_dob]').map(function() {
                    return this.value;
                }).get();

                p_no = $('input[id=passport_no]').map(function() {
                    return this.value;
                }).get();

                p_cnt = $('input[id=passport_cnt]').map(function() {
                    return this.value;
                }).get();
                console.log(p_cnt);

                p_tin_cnt = $('input[id=tin_cnt]').map(function() {
                    return this.value;
                }).get();

                p_exp_date = $('input[id=passport_exp_date]').map(function() {
                    return this.value;
                }).get();

                p_ren_rem = $('select[id=passport_ren_rem]').map(function() {
                    return this.value;
                }).get();

                p_rem_trg_fre = $('select[id=passport_rem_trg_fre]').map(function() {
                    return this.value;
                }).get();

                p_type_tin = $('select[id=type_of_tin]').map(function() {
                    return this.value;
                }).get();


                p_rel_share = $('select[id=rel_pass_holder]').map(function() {
                    return this.value;
                }).get();

                if (p_rel_share == "Others (please specify)") {
                    // alert('yes');
                    p_rel_share_specify = $('input[id=id_rel_pass_hol_specify]').map(function() {
                        return this.value;
                    }).get();
                    // ext= p_rel_share_specify;
                    // alert(p_rel_share_specify);
                } else {
                    // alert('no');
                    p_rel_share_specify = " ";
                }

                p_tin_num = $('input[id=tin_number]').map(function() {
                    return this.value;
                }).get();

                p_ph_no = $('input[id=ph_num]').map(function() {
                    return this.value;
                }).get();
                p_fin_num = $('input[id=fin_number]').map(function() {
                    return this.value;
                }).get();
                p_res_add = $('input[id=res_add]').map(function() {
                    return this.value;
                }).get();
                p_month_sal = $('input[id=month_salary]').map(function() {
                    return this.value;
                }).get();

                p_job_title = $('input[id=p_job_title]').map(function() {
                    return this.value;
                }).get();
                p_email = $('input[id=p_email]').map(function() {
                    return this.value;
                }).get();

                // console.log(also_share, pass_holder_name_eng);

                $('#FO_company').hide();


                btn_id = "next3";
                sh_no = 0;
                var p_name = "";
                ++btn_click;
              
                // console.log("btn_click--" + btn_click);
                // console.log("arr---" + arr[btn_click - 1]);
             
                $(this).parents('fieldset').hide();
                // $('#FO_financial_extra').hide();
                // $(this).parents('div.full_div_share').hide();
                $('.FO_shareholder_extra').css('display', 'block');
                $('.FO_shareholder_extra').children('.full_div_share').hide();

                // if ($("#next2.firstnext").length) {
                //     alert('hikj');
                //     $('#FO_shareholder_extra').show();
                //     $('.FO_shareholder_extra').show();
                //     $(this).parents('fieldset').show();
                //     $('#FO_company').hide();
                // }
                // else
                {
                    // alert('append');
                $('.FO_shareholder_extra').append(`
                <div class="full_div_share ">
                        <div class="card formContentData border-0 p-4">
                            <div class="Personal_Details company_space">
                                <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                                <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Pass Related </p>
                                </li>
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Related</p>
                                </li>
                                <li class="list-group-item" id="3">
                                    <a href="#">3</a>
                                    <p> PR Related </p>
                                </li>
                                <li class="list-group-item" id="4">
                                    <a href="#">4</a>
                                    <p> Complete</p>
                                </li>
                            </ul>
                        </div>
                         </div>
                         <div class="First-heading_ heading_name">
                                    <h4>Company Name ` + [btn_click] + `</h4>
                                    <h6>` + arr[btn_click - 1] + `</h6>
                                </div>
                         <div class="each_shareholder"></div>
                         <div id="appended_shareholder_div" class="appended_shareholder_div each_shareholder">
                            </div>
                       
                       
                            <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                                <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
                                    name="add-shareholder" data-id="` + btn_click + `" >Add
                                    shareholder</button>
                            </div>
                     
                        <div class="text-center pt-4 " id="append_div_btn">
                            <button type="button" id="next3" class="btn saveBtn ` + btn_id + `" data-id="` +
                    btn_click +
                    `">Next</button>
                            <button type="button" id="previous_cmp" class="btn saveBtn cancelBtn previouss" data-id="` +
                    btn_click + `">Back</button>
                        </div>  </div></div>`)}
                var also = 0;
                $.each(also_share, function(key, value) {
                    // alert(key + ": " + value);

                    if (value == "Yes") {
                        ++also;
                        // btn_click++;
                        // alert('yes');
                        // console.log(pass_holder_name_eng[key]);
                        //     pass_holder_name_eng[key] = $('input[id=passhol_name]').map(function() {
                        // return this.value;
                        // }).get();
                      var ghty= `<div class="formAreahalf others_alignment others_al_extra">
                                      <label for="clienttype" class="form-label"></label><div class="select_box"><span class="every">Others, please specify: </span><span class="select">
        <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][` +
                            (also - 1) + `][p_rel_share_specific]" value="` +
                            p_rel_share_specify[key] + `"></span></div>
                                </div>`;

                        $(".FO_shareholder_extra .each_shareholder").last().append(`
               
                            <div id="fo_shareholder" class="sharehold">
                                <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                    <div class="Share_holder-w sub-heading">
                                        <h4>Shareholder # ` + also + `</h4>
                                    </div>

                                    <div class="accordion-item pass_acc_it ">
                                        
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne123` + also + `">

                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne123` + also + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>

                                </h2>
                                <div id="panelsStayOpen-collapseOne123` + also + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne123` + also +
                            `">
                                    <div class="accordion-body d-flex flex-wrap">


                                    <div class="formAreahalf">
                                      <label for="eqtper" class="form-label"> Equity percentage </label>
                                      <div class="dollersec percentage_input"><span class="input"><input type="text" class="form-control" name="share[` + (
                                btn_click - 1) + `][` +
                            (also - 1) + `][eqt_per]"></span><span class="pecentage_end">%</span></div>
                                  </div>


                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

                                      <input type="text" class="form-control" 
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) +
                            `][passhol_name]" value="` + pass_holder_name_eng[key] + `">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Full Name
                                          (Chinese)</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) + `][passport_name]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (btn_click - 1) +
                            `][` + (also - 1) + `][shareholder_dob]" value="` + p_dob[key] + `" >
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="gender" class="form-label">Gender (M/F)</label>
                                      <select class="" name="share[` + (btn_click - 1) + `][` + (also - 1) + `][shareholder_gender]" id="sign">
                                      
                                          <option value="` + p_gen[key] + `">` + p_gen[key] + `</option>
                                       
                                      </select>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) +
                            `][passport_number]"  value="` + p_no[key] + `">

                                  </div>
                               
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Country</label>
                                  
                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) +
                            `][passport_country]" value="` +
                            p_cnt + `">

                                  </div>
                                 
                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Passport Expiry Date
                                          (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (btn_click - 1) +
                            `][` + (also - 1) + `][pass_exp_dob]" value="` + p_exp_date[key] + `">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Passport Renewal
                                          Reminder</label>
                                      <select name="share[` + (btn_click - 1) + `][` + (also - 1) + `][passport_ren_rem]" id="renewlrem">
                                         
                                          <option value="` + p_ren_rem[key] + `">` + p_ren_rem[key] + `</option>
                                      </select>
                                  </div>
         
                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label">Passport Reminder Trigger
                                          Frequency</label>
                                          <div class="select_box"><span class="every">Every</span><span
                                                        class="select"><select name="share[` + (btn_click - 1) + `][` + (also - 1) + `][passport_rem_fre]" id="renewlfre">
                                         
                                          <option value="` + p_rem_trg_fre[key] + `">` + p_rem_trg_fre[key] + `</option>
                                      </select></span></div>
                                  </div>
                 
                            
                                  <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Type of TIN </label>
                            <select name="share[` + (btn_click - 1) + `][` + (also - 1) + `][tintype]">
                               
                                <option value="` + p_type_tin[key] + `">` + p_type_tin[key] + `</option>
                                
                            </select>
                         
                        </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) + `][tinno]" value="` +
                            p_tin_num[key] + `">

                                  </div>
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Country</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) + `][tincnt] " value="` +
                            p_tin_cnt[key] + `">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Phone Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) + `][phno]" value="` +
                            p_ph_no[key] + `">

                                  </div>
                              
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][` + (also - 1) + `][res_add]" value="` +
                            p_res_add[key] + `">
                                  </div>
                              
                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> E-mail </label>
                                      <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][` +
                            (also - 1) + `][email]"  value="` +
                            p_email[key] + `" >
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Job Title </label>
                                      <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][` +
                            (also - 1) + `][job_title]" value="` +
                            p_job_title[key] + `">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
                                      <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="text" class="form-control" name="share[` + (btn_click - 1) +
                            `][` + (also - 1) + `][month_sal]" value="` + p_month_sal[key] + `"></span></div>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Relationship With Share Holder
                                          1</label>
                                      <select name="share[` + (btn_click - 1) + `][` + (also - 1) + `][rel_share_hol]" id="renewlrem">
                                        <option value="` + p_rel_share[key] + `">` + p_rel_share[key] + `</option>
                                      </select>
                                  </div>
                                  
                                  `  + (p_rel_share[key]=="Others (please specify)" ? ghty : '') + `
               
                        
                                  <div class="formAreahalf">
                                      <label class="form-label" for="remarks">Remarks</label>
                                      <textarea id="addbg[0][genremarks]" name="share[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                                  </div>
                                  </div>
                                </div>
                                  </div>
                        
                                    <div id="appended_user_shareholder_cmp2_selcection_div"
                                        class="w-100 d-flex justify-content-start flex-wrap"></div>
                                </div>
                            </div>
                         
                           `);
                    }
                    //         else {
                    //             if (set_company[key] == "Yes") {
                    //                 $(".FO_shareholder_extra .each_shareholder").last().append(`

                //    <div id="fo_shareholder" class="sharehold">
                //        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                //            <div class="Share_holder-w sub-heading">
                //                <h4>Shareholder # 1</h4>
                //            </div>
                //            <div class="formAreahalf">
                //                           <label for="eqtper" class="form-label"> Equity percentage </label>
                //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][eqt_per]">
                //                       </div>


                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

                //                           <input type="text" class="form-control" 
                //                               name="share[` + (btn_click - 1) + `][0][passhol_name]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Passport Full Name
                //                               (Chinese)</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][passport_name]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                //                           <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][shareholder_dob]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="gender" class="form-label">Gender (M/F)</label>
                //                           <select class="" name="share[` + (btn_click - 1) + `][0][shareholder_gender]" id="sign">
                //                               <option value=""></option>
                //                               <option value="Male">M</option>
                //                               <option value="Male">F</option>
                //                           </select>
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Passport Number</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][passport_number]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Passport Country</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][passport_country]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="" class="form-label"> Passport Expiry Date
                //                               (DD/MM/YYYY)</label>
                //                           <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][pass_exp_dob]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="clienttype" class="form-label"> Passport Renewal
                //                               Reminder</label>
                //                           <select name="share[` + (btn_click - 1) + `][0][passport_ren_rem]" id="renewlrem">
                //                               <option value="">Please select passport renewal reminder</option>
                //                               <option value="90 days">90 days</option>
                //                           </select>
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="clienttype" class="form-label">Passport Reminder Trigger
                //                               Frequency</label>
                //                           <select name="share[` + (btn_click - 1) + `][0][passport_rem_fre]" id="renewlfre">
                //                               <option value="">Please select passport reminder trigger
                //                                   frequency</option>
                //                               <option value="Every Week">Every Week</option>
                //                           </select>
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Type of Tin</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][tintype]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Current Tin Number</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][tinno]">

                //                       </div>
                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Current Tin Country</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][tincnt]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Phone Number</label>

                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][phno]">

                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
                //                           <input type="text" class="form-control" id="gendcname[0][subject]"
                //                               name="share[` + (btn_click - 1) + `][0][res_add]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="" class="form-label"> E-mail </label>
                //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][email]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="" class="form-label"> Job Title </label>
                //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][job_title]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
                //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][month_sal]">
                //                       </div>

                //                       <div class="formAreahalf ">
                //                           <label for="clienttype" class="form-label"> Relationship With Share Holder
                //                               1</label>
                //                           <select name="share[` + (btn_click - 1) + `][0][rel_share_hol]" id="renewlrem">
                //                               <option value="">Please select relationship with pass share
                //                               </option>
                //                               <option value="Self">Self</option>
                //                           </select>
                //                       </div>

                //                       <div class="formAreahalf">
                //                           <label class="form-label" for="remarks">Remarks</label>
                //                           <textarea id="addbg[0][genremarks]" name="share[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                //                       </div>


                //            <div id="appended_user_shareholder_cmp2_selcection_div"
                //                class="w-100 d-flex justify-content-start flex-wrap"></div>
                //        </div>
                //    </div>

                //   `);
                    //                 also = 1;
                    //             }

                    //         }





                });


                if (jQuery.inArray("Yes", also_share) == -1) {
                    $(".FO_shareholder_extra .each_shareholder").last().append(`
               
               <div id="fo_shareholder" class="sharehold">
                   <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                       <div class="Share_holder-w sub-heading">
                           <h4>Shareholder # 1</h4>
                       </div>

                       <div class="accordion-item pass_acc_it ">
                       
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne123` + btn_click + `">

                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne123` + btn_click + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>

                                </h2>
                                <div id="panelsStayOpen-collapseOne123` + btn_click + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne123` + btn_click +
                        `">
                                    <div class="accordion-body d-flex flex-wrap">

                       <div class="formAreahalf">
                                      <label for="eqtper" class="form-label"> Equity percentage </label>
                                      <div class="dollersec percentage_input"><span class="input"><input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][eqt_per]">
                                      </span><span class="pecentage_end">%</span></div></div>

                       


                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

                                      <input type="text" class="form-control" 
                                          name="share[` + (btn_click - 1) + `][0][passhol_name]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Full Name
                                          (Chinese)</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][passport_name]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][shareholder_dob]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="gender" class="form-label">Gender (M/F)</label>
                                      <select class="" name="share[` + (btn_click - 1) + `][0][shareholder_gender]" id="sign">
                                          <option value=""></option>
                                          <option value="M">M</option>
                                          <option value="F">F</option>
                                      </select>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][passport_number]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Country</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][passport_country]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Passport Expiry Date
                                          (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][pass_exp_dob]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Passport Renewal
                                          Reminder</label>
                                      <select name="share[` + (btn_click - 1) + `][0][passport_ren_rem]" id="renewlrem">
                                          <option value="">Please select passport renewal reminder</option>
                                          <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="180 days before expiry">180 days before expiry</option>
                                      </select>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label">Passport Reminder Trigger
                                          Frequency</label>
                                          <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="share[` + (btn_click - 1) + `][0][passport_rem_fre]" id="renewlfre">
                                          <option value="">Please select
                                              </option>
                                              <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                      </select></span></div>
                                  </div>

                            
                                  <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Type of TIN </label>
                            <select name="share[` + (btn_click - 1) + `][0][tintype]">
                               <option value="" selected>Please select</option>
                               <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>
                                
                            </select>
                         
                        </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][tinno]">

                                  </div>
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Country</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][tincnt]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Phone Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][phno]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                          name="share[` + (btn_click - 1) + `][0][res_add]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> E-mail </label>
                                      <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][email]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Job Title </label>
                                      <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][job_title]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
                                      <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][month_sal]"></span></div>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Relationship With Share Holder
                                          1</label>
                                      <select name="share[` + (btn_click - 1) +
                        `][0][rel_share_hol]" id="renewlrem" class="others_Relationship_share_class" data-id="0" data-id-cmp="` +
                        (btn_click - 1) + `">
                                          <option value="">Please select
                                          </option>
                                          <option value="Self">Self</option>
                                                <option value="Parents">Parents</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Children">Children</option>
                                                <option value="Relatives">Relatives</option>
                                                <option value="Friend">Friend</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                      </select>
                                  </div>
                                  <div class="formAreahalf others_Relationship_share others_alignment" style="display: none;">
                                    <label class="form-label" for=""></label>
                                  </div>

                                  <div class="formAreahalf">
                                      <label class="form-label" for="remarks">Remarks</label>
                                      <textarea id="addbg[0][genremarks]" name="share[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                                  </div>
</div></div></div>
           
                       <div id="appended_user_shareholder_cmp2_selcection_div"
                           class="w-100 d-flex justify-content-start flex-wrap"></div>
                   </div>
               </div>
            
              `);
                    also = 1;

                }
                sh_no = also;


                // if (document.getElementById('set_company').value == "Yes" && document
                //     .getElementById(
                //         'also_shareholder').value == "Yes") {

                //     // text += cars[i] + "<br>";

                //     // alert('yes');
                //     // $p_name = document.getElementsByClassName('passhol_name').value;
                //     // // alert($p_name);
                //     p_gen = document.getElementById('gender').value;
                //     p_dob = document.getElementById('pass_holder_dob').value;
                //     // alert($p_gen);
                //     p_no = document.getElementById('passport_no').value;
                //     // alert( $p_no);
                //     p_cnt = document.getElementById('passport_cnt').value;
                //     // alert( $p_cnt);
                //     p_tin_cnt = document.getElementById('tin_cnt').value;
                //     p_exp_date = document.getElementById('passport_exp_date').value;
                //     p_ren_rem = document.getElementById('passport_ren_rem').value;
                //     p_rem_trg_fre = document.getElementById('passport_rem_trg_fre').value;
                //     p_type_tin = document.getElementById('type_of_tin').value;
                //     // alert($p_type_tin);
                //     p_tin_num = document.getElementById('tin_number').value;
                //     p_ph_no = document.getElementById('ph_num').value;
                //     p_fin_num = document.getElementById('fin_number').value;
                //     p_res_add = document.getElementById('res_add').value;
                //     p_month_sal = document.getElementById('month_salary').value;



                // alert(btn_click);

                //     if (document.getElementById('set_company').value == "Yes" && document.getElementById(
                //             'also_shareholder').value == "No") {
                //                 sh_no=1;

                //         $('.FO_shareholder_extra').append(`
            //     <div class="full_div ">
            //             <div class="card formContentData border-0 p-4">
            //                 <div class="Personal_Details company_space">
            //                     <div class="First-heading_">
            //                         <h4>Company Name ` + [btn_click] + `</h4>
            //                         <h6>` + arr[btn_click - 1] + `</h6>
            //                     </div>
            //                     <div class="number_main">
            //                 <ul class="list-group list-group-horizontal" id="nav_list">
            //                     <li class="list-group-item active" id="1">
            //                         <a href="#">1</a>
            //                         <p> Pass Related </p>
            //                     </li>
            //                     <li class="list-group-item active" id="2">
            //                         <a href="#">2</a>
            //                         <p> Company Related</p>
            //                     </li>
            //                     <li class="list-group-item" id="3">
            //                         <a href="#">3</a>
            //                         <p> Pr Related </p>
            //                     </li>
            //                     <li class="list-group-item" id="4">
            //                         <a href="#">4</a>
            //                         <p> Complete</p>
            //                     </li>
            //                 </ul>
            //             </div>

            //                 </div>
            //                 <div id="fo_shareholder" class="sharehold">
            //                     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
            //                         <div class="Share_holder-w sub-heading">
            //                             <h4>Shareholder #1</h4>
            //                         </div>
            //                         <div class="formAreahalf">
            //                           <label for="eqtper" class="form-label"> Equity percentage </label>
            //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][eqt_per]">
            //                       </div>


            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

            //                           <input type="text" class="form-control" 
            //                               name="share[` + (btn_click - 1) + `][0][passhol_name]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Passport Full Name
            //                               (Chinese)</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][passport_name]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
            //                           <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][shareholder_dob]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="gender" class="form-label">Gender (M/F)</label>
            //                           <select class="" name="share[` + (btn_click - 1) + `][0][shareholder_gender]" id="sign">
            //                               <option value=""></option>
            //                               <option value="Male">M</option>
            //                               <option value="Male">F</option>
            //                           </select>
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Passport Number</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][passport_number]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Passport Country</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][passport_country]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="" class="form-label"> Passport Expiry Date
            //                               (DD/MM/YYYY)</label>
            //                           <input type="date" class="form-control" name="share[` + (btn_click - 1) + `][0][pass_exp_dob]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="clienttype" class="form-label"> Passport Renewal
            //                               Reminder</label>
            //                           <select name="share[` + (btn_click - 1) + `][0][passport_ren_rem]" id="renewlrem">
            //                               <option value="">Please select passport renewal reminder</option>
            //                               <option value="90 days">90 days</option>
            //                           </select>
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="clienttype" class="form-label">Passport Reminder Trigger
            //                               Frequency</label>
            //                           <select name="share[` + (btn_click - 1) + `][0][passport_rem_fre]" id="renewlfre">
            //                               <option value="">Please select passport reminder trigger
            //                                   frequency</option>
            //                               <option value="Every Week">Every Week</option>
            //                           </select>
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Type of Tin</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][tintype]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Current Tin Number</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][tinno]">

            //                       </div>
            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Current Tin Country</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][tincnt]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Phone Number</label>

            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][phno]">

            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
            //                           <input type="text" class="form-control" id="gendcname[0][subject]"
            //                               name="share[` + (btn_click - 1) + `][0][res_add]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="" class="form-label"> E-mail </label>
            //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][email]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="" class="form-label"> Job Title </label>
            //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][job_title]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
            //                           <input type="text" class="form-control" name="share[` + (btn_click - 1) + `][0][month_sal]">
            //                       </div>

            //                       <div class="formAreahalf ">
            //                           <label for="clienttype" class="form-label"> Relationship With Share Holder
            //                               1</label>
            //                           <select name="share[` + (btn_click - 1) + `][0][rel_share_hol]" id="renewlrem">
            //                               <option value="">Please select relationship with pass share
            //                               </option>
            //                               <option value="Self">Self</option>
            //                           </select>
            //                       </div>

            //                       <div class="formAreahalf">
            //                           <label class="form-label" for="remarks">Remarks</label>
            //                           <textarea id="addbg[0][genremarks]" name="share[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
            //                       </div>

            //                         <div id="appended_user_shareholder_cmp2_selcection_div"
            //                             class="w-100 d-flex justify-content-start flex-wrap"></div>
            //                     </div>
            //                 </div>
            //                 <div id="appended_shareholder_div" class="appended_shareholder_div">
            //                 </div>
            //                 <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
            //                     <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
            //                         name="add-shareholder" data-id="` + btn_click + `" >Add
            //                         shareholder</button>
            //                 </div>
            //             </div>
            //             <div class="text-center pt-4 " id="append_div_btn">
            //                 <button type="button" id="next3" class="btn saveBtn ` + btn_id + `" data-id="` +
                //             btn_click + `">Next</button>
            //                 <button type="button" id="previous3" class="btn saveBtn cancelBtn previouss" data-id="` +
                //             btn_click + `">Back</button>
            //             </div></div>`);
                //     }
            }
            else{
                // alert('no');

            }
            });



            $('body').on('click', '.next3', function() {
                fi_no = 0;
                // arr = $('input[id=fo_compnay]').map(function() {
                //     return this.value;
                // }).get();
                var isLastElement1 = arr.length;
                // alert(isLastElement1);
                btn_click = $(this).attr('data-id');
                // console.log(btn_click);
                let btn_id = "";
                if (btn_click == isLastElement1) {
                    btn_id = "next4";
                } else {
                    btn_id = "next2";
                }
                $('#FO_company').hide();
                $(this).parents('fieldset').find('.full_div').hide();
                $('#FO_shareholder_extra').hide();
                $('.FO_financial_extra').css('display', 'block');
                $('.FO_financial_extra').children('.full_div_financial').hide();
                $('.FO_financial_extra').append(`
                <div class="full_div_financial ">
                        <div class="card formContentData border-0 p-4">
                            <div class="Personal_Details company_space">
                                <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                                <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Pass Related </p>
                                </li>
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Related</p>
                                </li>
                                <li class="list-group-item" id="3">
                                    <a href="#">3</a>
                                    <p> PR Related </p>
                                </li>
                                <li class="list-group-item" id="4">
                                    <a href="#">4</a>
                                    <p> Complete</p>
                                </li>
                            </ul>
                        </div>

                            </div>
                            <div class="First-heading_ heading_name">
                                    <h4>Company Name ` + [btn_click] + `</h4>
                                    <h6>` + arr[btn_click - 1] + `</h6>
                                </div>
                            <div id="fo_financial" class="financial">
                                <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                    <div class="accordion-item pass_acc_it ">
                       
                       <h2 class="accordion-header" id="panelsStayOpen-headingOne123o` + btn_click + `">

                           <button class="accordion-button" type="button" data-bs-toggle="collapse"
                               data-bs-target="#panelsStayOpen-collapseOne123o` + btn_click + `" aria-expanded="true"
                               aria-controls="panelsStayOpen-collapseOne">
                               <i class="fa fa-arrows-v" aria-hidden="true"></i>
                           </button>

                       </h2>
                       <div class="formAreahalf">
                            <label for="" class="form-label">Financial Institution Name ` + (btn_click) + `</label>
                           
                        </div>
                       <div id="panelsStayOpen-collapseOne123o` + btn_click + `" class="accordion-collapse collapse show"
                           aria-labelledby="panelsStayOpen-headingOne123o` + btn_click + `">
                           <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                            <label for="" class="form-label">POC Name</label>
                            <input type="text" name="fi[` + (btn_click - 1) + `][0][poc_name]" id="" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Financial Institution Name ` + (btn_click) + `</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][fi_name]" id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">POC Email</label>
                            <input type="email" class="form-control" name="fi[` + (btn_click - 1) + `][0][poc_email]"
                                id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">POC Contact Number</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][poc_cno]" id="">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Type</label>
                            <select name="fi[` + (btn_click - 1) +
                    `][0][acc_type]" id="" class="select_acc_type_class" data-id="0" data-id-cmp="` + (
                        btn_click - 1) + `">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                                <option value="Multi-currency">Multi-currency</option>
                                <option value="Others (please specify)">Others (please specify)</option>

                            </select>
                        </div>
                        <div class="formAreahalf others_acc_type" style="display: none;">
                          
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Application Submission</label>
                            <select name="fi[` + (btn_click - 1) + `][0][app_sub]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Opening Status</label>
                            <select name="fi[` + (btn_click - 1) + `][0][acc_opn_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Account/Policy Number</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][acc_pol_no]" id="">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Money Deposit Status</label>
                            <select name="fi[` + (btn_click - 1) + `][0][money_dep_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Current Status</label>
                            <select name="fi[` + (btn_click - 1) + `][0][acc_crt_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Online Account Username</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][on_acc_usr_nam]" id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Online Account Password</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][on_acc_usr_pass]" id="">
                        </div>

                        <div class="formAreahalf">
                            <label for="" class="form-label">Maturity Date</label>
                            <input type="date" class="form-control" name="fi[` + (btn_click - 1) + `][0][mat_date]"
                                id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Initial Deposit Amount</label>
                            <input type="text" class="form-control" name="fi[` + (btn_click - 1) + `][0][in_dep_amt]" id="">
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="" name="fi[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                        </div>
        
                                    <div id="appended_user_financial_cmp2_selcection_div"
                                        class="w-100 d-flex justify-content-start flex-wrap"></div>
                                </div>
                            </div> </div> </div>

                            </div>
                            <div id="appended_financial_div" class="appended_financial_div">
                            </div>
                            <div class="text-center pt-4 add_potentia add_potential" id="add_financial_btn_div">
                                <button type="button" id="add_financial" class="btn saveBtn btn_design add_financial"
                                    name="add-financial" data-id="` + btn_click + `" >Add
                                    Financial Institution</button>
                            </div>
                            <div class="text-center pt-4 " id="append_div_btn">
                            <button type="button" id="next4" class="btn saveBtn ` + btn_id + `" data-id="` +
                    btn_click + `">Next</button>
                            <button type="button" id="previous5" class="btn saveBtn cancelBtn previouss" data-id="` +
                    btn_click + `">Back</button>
                        </div
                        </div>
                   </div>`);
                   $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
            });


            $('body').on('click', '.add_shareholder', function() {

                var arr_id = $(this).attr('data-id');
                //++sh_no;
                var sh_no = $('.appended_shareholder_div.each_shareholder .sharehold').length + 1;
                // alert(arr_id);
                // $(this).closest('#appended_shareholder_div').append(
                $(this).parents('fieldset').find('.appended_shareholder_div').append(
                    `<div id="fo_shareholder" class="sharehold share` + sh_no + `">\
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                           
                            <div class="Share_holder-w sub-heading">\
                                <h4>Shareholder #` + (sh_no) + `</h4>\
                            </div>\   
                            <div class="accordion-item pass_acc_it ">
                                <span class="cancel_shareholder"><i class="fa fa-times remove_share"  data-id="share` +
                    sh_no + `" aria-hidden="true"></i></span> \
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne1234` + sh_no + `">

                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne1234` + sh_no + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>

                                </h2>
                                <div id="panelsStayOpen-collapseOne1234` + sh_no + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne123` + sh_no +
                    `">
                                    <div class="accordion-body d-flex flex-wrap">

                            <div class="formAreahalf">
                                      <label for="eqtper" class="form-label"> Equity percentage </label>
                                      <div class="dollersec percentage_input"><span class="input"> <input type="text" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][eqt_per]"></span><span class="pecentage_end">%</span></div>
                                  </div>

                           


                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Pass Holder Full Name (Eng)</label>

                                      <input type="text" class="form-control" 
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][passhol_name]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Full Name
                                          (Chinese)</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][passport_name]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][shareholder_dob]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="gender" class="form-label">Gender (M/F)</label>
                                      <select class="" name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][shareholder_gender]" id="sign">
                                          <option value=""></option>
                                          <option value="M">M</option>
                                          <option value="F">F</option>
                                      </select>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][passport_number]">

                                  </div>
                               
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Passport Country</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][passport_country]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Passport Expiry Date
                                          (DD/MM/YYYY)</label>
                                      <input type="date" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][pass_exp_dob]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Passport Renewal
                                          Reminder</label>
                                      <select name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][passport_ren_rem]" id="renewlrem">
                                          <option value="">Please select passport renewal reminder</option>
                                          <option value="90 days before expiry">90 days before expiry</option>
                                                <option value="120 days before expiry">120 days before expiry</option>
                                                <option value="180 days before expiry">180 days before expiry</option>
                                      </select>
                                  </div>
         
                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label">Passport Reminder Trigger
                                          Frequency</label>
                                          <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="share[` + (arr_id - 1) + `][` + (sh_no -
                        1) + `][passport_rem_fre]" id="renewlfre">
                                          <option value="">Please select</option>
                                          <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                      </select></span></div>
                                  </div>
                 
                            
                                  <div class="formAreahalf ">
                            <label for="passapptype" class="form-label"> Type of TIN </label>
                            <select name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][tintype]">
                               <option value="" selected>Please select</option>
                               <option value="WP">WP</option>
                                                <option value="SP">SP</option>
                                                <option value="EP">EP</option>
                                                <option value="LVTP">LVTP</option>
                                                <option value="DP">DP</option>
                                                <option value="NRIC">NRIC</option>
                                
                            </select>
                         
                        </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][tinno]">

                                  </div>
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Current Tin Country</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][tincnt]">

                                  </div>

                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Phone Number</label>

                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][phno]">

                                  </div>
                              
                                  <div class="formAreahalf ">
                                      <label class="form-label" for="">Residential Add.(according to Add.proof)</label>
                                      <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="share[` + (arr_id - 1) + `][` + (sh_no - 1) + `][res_add]">
                                  </div>
                              
                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> E-mail </label>
                                      <input type="text" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][email]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Job Title </label>
                                      <input type="text" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][job_title]">
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="" class="form-label"> Monthly Salary in the company (SGD)</label>
                                      <div class="dollersec"><span class="doller">$</span><span
                                                class="input"><input type="text" class="form-control" name="share[` + (arr_id - 1) + `][` +
                    (sh_no - 1) + `][month_sal]"></span></div>
                                  </div>

                                  <div class="formAreahalf ">
                                      <label for="clienttype" class="form-label"> Relationship With Share Holder
                                          1</label>
                                      <select name="share[` + (arr_id - 1) + `][` + (sh_no - 1) +
                    `][rel_share_hol]" id="renewlrem" class="others_Relationship_share_class" data-id="` +
                    (sh_no - 1) + `" data-id-cmp="` + (arr_id - 1) + `">
                                          <option value="">Please select
                                          </option>
                                          <option value="Self">Self</option>
                                                <option value="Parents">Parents</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Children">Children</option>
                                                <option value="Relatives">Relatives</option>
                                                <option value="Friend">Friend</option>
                                                <option value="Others (please specify)">Others (please specify)</option>
                                      </select>
                                  </div>
                                  <div class="formAreahalf others_Relationship_share" style="display:none;">
                        
                                  </div>

                                  <div class="formAreahalf">
                                      <label class="form-label" for="remarks">Remarks</label>
                                      <textarea id="addbg[0][genremarks]" name="share[` + (arr_id - 1) + `][` + (
                        sh_no - 1) + `][remarks]" rows="4" cols="50"></textarea>
                                  </div>
                                </div>
                            </div>
                        </div>
                            



                            <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                            </div>\
                        </div></div>`
                );

            });
            $(document).on('click', '.remove_share', function() {

                var id = $(this).attr('data-id');
                $(this).parents('.appended_shareholder_div').find('.' + id + '').remove();

                var c = 1;
                $('.appended_shareholder_div.each_shareholder .sharehold').each(function(index) {
                    $(this).find('.sub-heading h4').html('Shareholder #' + c);
                    c++;
                });

            });
            $(document).on('click', '#previous4', function() {

                $("#FO_financial_extra").hide();
                $("#FO_shareholder_extra").show();
                set_company = $('select[id=set_company]').map(function() {
                    return this.value;
                }).get();
                // if (jQuery.inArray("Yes", set_company) == -1) {

                //     // btn_click_p--;
                    
                //     $("#FO_Pass_PR").hide();
                //     $("#start_field").show();
                // }
                // else{
                //     $("#FO_financial_extra").hide();
                // $("#FO_shareholder_extra").show();
                // }
            });

            $(document).on('click', '#previous5', function() {
                $("#FO_financial_extra").hide();
                $("#FO_shareholder_extra").show();
            })


            $('body').on('click', '.add_financial', function() {
                // alert('app submission');

                var arr_id = $(this).attr('data-id');
                fi_no++;
                //  alert(arr_id);
                // $(this).closest('#appended_shareholder_div').append(
                $(this).parents('fieldset').find('.appended_financial_div').append(
                    `<div id="fo_financial" class="financial fi` + fi_no + `">\
                     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                         
                         <div class="accordion-item pass_acc_it ">
                            <span class="cancel_financial cancel_pr"><i class="fa fa-times remove_fi" data-id="fi` +
                    fi_no + `" aria-hidden="true"></i></span> \  
                       <h2 class="accordion-header" id="panelsStayOpen-headingOne123ok` + fi_no + `">
                        <div class="formAreahalf">
                            <label for="" class="form-label">Financial Institution Name ` + (fi_no + 1) + `</label>
                           
                        </div>
                           <button class="accordion-button" type="button" data-bs-toggle="collapse"
                               data-bs-target="#panelsStayOpen-collapseOne123ok` + fi_no + `" aria-expanded="true"
                               aria-controls="panelsStayOpen-collapseOne">
                               <i class="fa fa-arrows-v" aria-hidden="true"></i>
                           </button>

                       </h2>
                       <div id="panelsStayOpen-collapseOne123ok` + fi_no + `" class="accordion-collapse collapse show"
                           aria-labelledby="panelsStayOpen-headingOne123ok` + fi_no + `">
                           <div class="accordion-body d-flex flex-wrap">
                         
                         <div class="formAreahalf">
                            <label for="" class="form-label">POC Name</label>
                            <input type="text" name="fi[` + (arr_id - 1) + `][` + fi_no + `][poc_name]" id="" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label FinancialInstitutionName">Financial Institution Name ` + (fi_no + 1) + `</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][fi_name]" id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">POC Email</label>
                            <input type="email" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][poc_email]"
                                id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">POC Contact Number</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][poc_cno]" id="">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Type</label>
                            <select name="fi[` + (arr_id - 1) + `][` + fi_no +
                    `][acc_type]" id="" class="select_acc_type_class" data-id="` + fi_no +
                    `" data-id-cmp="` + (arr_id - 1) + `">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                                <option value="Multi-currency">Multi-currency</option>
                                <option value="Others (please specify)">Others (please specify)</option>
                            </select>
                        </div>
                        <div class="formAreahalf others_acc_type" style="display:none;">
                          
                        </div>
                       
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Application Submission</label>
                            <select name="fi[` + (arr_id - 1) + `][` + fi_no + `][app_sub]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select>

                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Opening Status</label>
                            <select name="fi[` + (arr_id - 1) + `][` + fi_no + `][acc_opn_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>

                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Account/Policy Number</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][acc_pol_no]" id="">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Money Deposit Status</label>
                            <select name="fi[` + (arr_id - 1) + `][` + fi_no + `][money_dep_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Account Current Status</label>
                            <select name="fi[` + (arr_id - 1) + `][` + fi_no + `][acc_crt_sts]" id="" class="js-example-responsive form-control">
                                <option value="" selected >Please select
                                </option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Online Account Username</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][on_acc_usr_nam]" id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Online Account Password</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][on_acc_usr_pass]" id="">
                        </div>

                        <div class="formAreahalf">
                            <label for="" class="form-label">Maturity Date</label>
                            <input type="date" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][mat_date]"
                                id="">
                        </div>
                        <div class="formAreahalf">
                            <label for="" class="form-label">Initial Deposit Amount</label>
                            <input type="text" class="form-control" name="fi[` + (arr_id - 1) + `][` + fi_no + `][in_dep_amt]" id="">
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="" name="fi[` + (arr_id - 1) + `][` + fi_no + `][remarks]" rows="4" cols="50"></textarea>
                        </div>
                


                         <div id="appended_user_financial_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                         </div>\
                         </div>
                        </div>
                    </div>
                     </div></div>`
                );
                $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

            });
            $(document).on('click', '.remove_fi', function() {
                // alert('id');
                var id = $(this).attr('data-id');
                // alert(id);
                // console.log(id);
                $(this).parents('.appended_financial_div').find('.' + id + '').remove();
                var c = 1; 
                $('.financial .accordion-item').each(function(index) {
                    $(this).find('.accordion-header label').html('Financial Institution Name ' + c);
                    $(this).find('.FinancialInstitutionName').html('Financial Institution Name ' + c);
                    
                    c++;
                    // console.log(c);
                });
            });
            


            var btn_click_p = 0;
            var arr_p = "";
            $('body').on('click', '.next4', function() {
                // alert('click');
                arr_p = $('input[id=passhol_name]').map(function() {
                    return this.value;
                }).get();
                console.log(arr_p.length);
                // console.log(btn_click_p);
                console.log(arr_p[0]);
                // console.log(arr_p[1]);
                pr_no = 0;

                btn_click_p++;
                // alert(btn_click_p);
                var isLastElement1_p = arr_p.length;

                $('#FO_company').hide();
                $('#FO_financial_extra').hide();
                // $("#FO_Pass_PR").show();


                let btn_id_p = "";
                if (btn_click_p == isLastElement1_p) {
                
                    btn_id_p = "next6";
                } else {
           
                    btn_id_p = "next4";
                }



                // alert(btn_click);
                $(this).parents('div.full_divs').hide();
                // $(this).parents('fieldset').find('.full_div').hide();
                if ($("#next4.lastnext").length) {
                     $("#FO_Pass_PR").show();
                }
                else
                {
                 
                $('.FO_Pass_PR').append(`
                <div class="full_divs">
                        <div class="card formContentData border-0 p-4">
                            <div class="Personal_Details company_space">
                                <div class="First-heading_">
                            <h4> Add New Application</h4>
                        </div>
                                <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Pass Related </p>
                                </li>
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Related</p>
                                </li>
                                <li class="list-group-item active" id="3">
                                    <a href="#">3</a>
                                    <p> PR Related </p>
                                </li>
                                <li class="list-group-item" id="4">
                                    <a href="#">4</a>
                                    <p> Complete</p>
                                </li>
                            </ul>
                        </div>

                            </div>
                            <div class="First-heading_ heading_name">
                                    <h4>Pass Holder ` + [btn_click_p] + `</h4>
                                    <h6>` + arr_p[btn_click_p - 1] + `</h6>
                                </div>
                            <div id="fo_pr" class="pr pr_form_class">
                                <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                                    <div class="accordion-item pass_acc_it ">
                                
                                <h2 class="accordion-header" id="panelsStayOpen-headingno` + btn_click_p + `">
                                
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseno` + btn_click_p + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseno` + btn_click_p + `">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div class="formAreahalf">
                                    <label for="" class="form-label">1st Time PR Application Date</label>
                                   
                                </div>
                                <div id="panelsStayOpen-collapseno` + btn_click_p + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingno` + btn_click_p + `">
                     <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                                    <label for="" class="form-label">1st Time PR Application Date</label>
                                    <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][application_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Application Dependent</label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][application_dep]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="None">None</option>
                                        <option value="Spouse only">Spouse only</option>
                                        <option value="Children only">Children only</option>
                                        <option value="Spouse and Children">Spouse and Children</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Pass Application Status</label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][application_sts]" id="p_sts" class="p_sts js-example-responsive form-control">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">PR Approval Date</label>
                                    <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][approval_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">REP Expiry Date</label>
                                    <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][rep_expiry_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">REP Renewal Reminder</label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][rep_ren_rem]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                    </select>
                                </div>
                              
                                    <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">PR Rejection Date</label>
                                    <input type="date" class="form-control" name="pr[` + (btn_click_p - 1) + `][0][rejection_date]"
                                        id="">
                                </div>
                              
                                <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">Re Submission Reminder</label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][re_sub_rem]" id="">
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        
                                    </select>
                                </div>
                                <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">Re Submission Status </label>
                                    <select name="pr[` + (btn_click_p - 1) + `][0][re_sub_sts]" id="" class="js-example-responsive">
                                        <option value="">Please select</option>
                                        <option value="Done">Done</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        
                                    </select>
                                </div>

                                <div class="formAreahalf ">
                                    <label for="" class="form-label">REP Renewal Trigger Frequency</label>
                                    <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[` + (btn_click_p - 1) + `][0][rep_ren_trg_fre]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                    </select></span></div>
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Re-Submission Trigger Frequency</label>
                                    <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[` + (btn_click_p - 1) + `][0][re_sub_trg_fre]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>

                                    </select></span></div>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea id="" name="pr[` + (btn_click_p - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                                </div>


                                    <div id="appended_user_pr_pass_selcection_div"
                                        class="w-100 d-flex justify-content-start flex-wrap"></div>
                                </div>
                            </div>
                           
                         </div> 
                         <div id="appended_pr_div" class="appended_pr_div">
                            </div>
                    </div>
                            <div class="text-center pt-4 add_potentia add_potential" id="add_pr_btn_div">
                                <button type="button" id="add_pr" class="btn saveBtn btn_design add_pr"
                                    name="add-pr" data-id="` + btn_click_p + `" >Add
                                    Application Attempt</button>
                            </div>
                        
                        </div>
                        <div class="text-center pt-4 " id="append_div_btn">
                            <button type="button" id="next5" class="btn saveBtn ` + btn_id_p + `" data-id="` +
                    btn_click_p + `">Next</button>
                            <button type="button" id="previous6" class="btn saveBtn cancelBtn previouss" data-id="` +
                    btn_click_p + `">Back</button>
                        </div></div> </div>`);
                        $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });
                    }
            });

            $(document).on('click', '#previous6', function() {
                --btn_click_p;
                $("#FO_Pass_PR").hide();
                $("#FO_financial_extra").show();
                $("#next4").addClass("lastnext");
                
            });

            $('body').on('click', '.add_pr', function() {

                var arr_id = $(this).attr('data-id');
                pr_no++;
                //  alert(arr_id);
                // $(this).closest('#appended_shareholder_div').append(
                $(this).parents('fieldset').find('.appended_pr_div').append(
                    `<div id="fo_pr" class="pr_form_class prr` + pr_no + `">\
                     <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                         
                         <div class="accordion-item pass_acc_it ">
                            <span class="cancel_pr"><i class="fa fa-times remove_pr" data-id="prr` + pr_no + `" aria-hidden="true"></i></span> \ 
                                <h2 class="accordion-header" id="panelsStayOpen-headingnoyes` + pr_no + `">
                                    <div class="formAreahalf">
                                    <label for="" class="form-label">1st Time PR Application Date</label>
                                  
                                </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapsenoyes` + pr_no + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapsenoyes` + pr_no + `">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapsenoyes` + pr_no + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingnoyes` + pr_no + `">
                     <div class="accordion-body d-flex flex-wrap">

                    
                        <div class="formAreahalf">
                                    <label for="" class="form-label">1st Time PR Application Date</label>
                                    <input type="date" class="form-control" name="pr[` + (arr_id - 1) + `][` + pr_no + `][application_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Application Dependent</label>
                                    <select name="pr[` + (arr_id - 1) + `][` + pr_no + `][application_dep]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="None">None</option>
                                        <option value="Spouse only">Spouse only</option>
                                        <option value="Children only">Children only</option>
                                        <option value="Spouse and Children">Spouse and Children</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Pass Application Status</label>
                                    <select name="pr[` + (arr_id - 1) + `][` + pr_no + `][application_sts]" id="p_sts" class="p_sts js-example-responsive form-control">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                              
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">PR Approval Date</label>
                                    <input type="date" class="form-control" name="pr[` + (arr_id - 1) + `][` + pr_no + `][approval_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">REP Expiry Date</label>
                                    <input type="date" class="form-control" name="pr[` + (arr_id - 1) + `][` +
                    pr_no + `][rep_expiry_date]"
                                        id="">
                                </div>
                                <div class="formAreahalf p_status_div_default">
                                    <label for="" class="form-label">REP Renewal Reminder</label>
                                    <select name="pr[` + (arr_id - 1) + `][` + pr_no + `][rep_ren_rem]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                    </select>
                                </div>
                                <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">PR Rejection Date</label>
                                    <input type="date" class="form-control" name="pr[` + (arr_id - 1) + `][` + pr_no + `][rejection_date]"
                                        id="">
                                </div>
                              
                                <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">Re Submission Reminder</label>
                                    <select name="pr[` + (arr_id - 1) + `][` + pr_no + `][re_sub_rem]" id="" >
                                        <option value="180 days before REP expiry">180 days before REP expiry</option>
                                        <option value="90 days before REP expiry">90 days before REP expiry</option>
                                        
                                    </select>
                                </div>
                                <div class="formAreahalf p_status_div" style="display: none">
                                    <label for="" class="form-label">Re Submission Status </label>
                                    <select name="pr[` + (arr_id - 1) + `][` + pr_no + `][re_sub_sts]" id="" class="js-example-responsive">
                                        <option value="">Please select</option>
                                        <option value="Done">Done</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        
                                    </select>
                                </div>
                               
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">REP Renewal Trigger Frequency</label>
                                    <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[` + (arr_id - 1) + `][` + pr_no + `][rep_ren_trg_fre]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                    </select></span></div>
                                </div>
                                <div class="formAreahalf ">
                                    <label for="" class="form-label">Re-Submission Trigger Frequency</label>
                                    <div class="select_box"><span class="every">Every</span><span
                                                class="select"><select name="pr[` + (arr_id - 1) + `][` + pr_no + `][re_sub_trg_fre]" id="">
                                        <option value="" selected >Please select
                                        </option>
                                        <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>

                                    </select></span></div>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea id="" name="pr[` + (arr_id - 1) + `][` + pr_no + `][remarks]" rows="4" cols="50"></textarea>
                                </div>


                         <div id="appended_user_financial_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                         </div>\
                         </div>
                        </div>
                    </div>
                     </div></div>`
                );
                $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

            });
            $(document).on('click', '.remove_pr', function() {
              
                var id = $(this).attr('data-id');
             
                $(this).parents('.appended_pr_div').find('.' + id + '').remove();
            });

 
        });


        $(document).on('click', '.next6', function(e) {
            // alert('nj');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('operation.store') }}",
                type: "POST",
                data: $('#operation_form').serialize(),
                success: function(result) {
                    console.log(result.input.view_id);
                 
                    const el = document.createElement('div')
                    el.innerHTML =
                    `<p>You can view Application <a href='/operation-view/` +
                        result.input.view_id + `'>here</a>`
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
                        $('#operation_form')[0].reset();
                        window.location = "{{ route('operation.create') }}";
                    })
                },
                error: function(result) {
                    // alert('error');
                }
            });
        });
    </script>
@endpush
