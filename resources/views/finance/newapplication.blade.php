@extends('layouts.app')
@section('content')
    <style>
        body .append-div-css {
            padding: 0 130px !important;
            justify-content: space-between !important;

        }
    </style>
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add Finance Application</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="">Finance</a></li>
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
    <div class="dataAreaMain finance-veiw-cstm wealth_application finance-section-form">

        <form action="javascipt:void(0);" method="post" id="multistep_form" class='d-flex justify-content-start flex-wrap '>
            @csrf
            <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="uid" value="{{ Auth::user()->id }}">



            <fieldset id="FO_start_field" class="w-100 justify-content-start flex-wrap form-fields wealth FO_start_field">
                <div class="card formContentData border-0 p-4 wealth_companies_change">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Business Details</h4>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Business Details </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">2</a>
                                    <p> Personal Information </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">3</a>
                                    <p> Payment Recievable Item </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">4</a>
                                    <p> Report Submission Item</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">5</a>
                                    <p> Complete </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <!-- <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                                                                                                                                                                                                                                                                                                                            <label for="fo_compnay" class="form-label">Revenue Item 1</label>
                                                                                                                                                                                                                                                                                                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                                                                                                                                                                                                                                                                                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                                                                                                                                                                                                                                                                                                                                aria-controls="panelsStayOpen-collapseThree">
                                                                                                                                                                                                                                                                                                                                                <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                                                                                                                                                                                                                                                                                                            </button>

                                                                                                                                                                                                                                                                                                                                        </h2> -->
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">


                                <div id="fo_company">
                                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">

                                        <div class="formAreahalf ">
                                            <label for="clienttype" class="form-label">Client Type</label>
                                            <select class="" name="client" id="client">
                                                <option value="" selected>Please select client type</option>
                                                <option value="Personal">Personal</option>
                                                <option value="Corporate">Corporate</option>
                                            </select>
                                            <span id="clienterror" style="color:red"></span>
                                        </div>

                                        <div class="formAreahalf">
                                            <label for="bustype" class="form-label">Business Type</label>
                                            <select class="" name="business" id="business">
                                            </select>
                                            <span id="businesserror" style="color:red"></span>
                                        </div>

                                        <div class="formAreahalf">
                                            <label for="bustype" class="form-label">Business Description</label>
                                            <input type="text" name="businessdes" id="businessdes"
                                                class="form-control" />
                                            <span id="businessdeserror" style="color:red"></span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next" class="btn saveBtn next-step next">Next</button>
                    <button type="button" style="display:none;" id="previous"
                        class="btn saveBtn cancelBtn previous">Back</button>
                </div>

            </fieldset>



            <fieldset id="FO_personaldetails"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_personaldetails" style="display:none;">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details">
                        <div class="First-heading_">
                            <h4> Personal Details</h4>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active">
                                    <a href="#">1</a>
                                    <p> Business Details </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">2</a>
                                    <p> Personal Information </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">3</a>
                                    <p> Payment Recievable Item </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">4</a>
                                    <p> Report Submission Item</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">5</a>
                                    <p> Complete </p>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div id="append_div_form" class="ghyu w-100 d-flex justify-content-start flex-wrap form-fields">
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" class="form-control" id="pname" name="pname">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (chinese)</label>
                            <input type="text" class="form-control" id="pnamec" name="pnamec">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Gender(M/F)</label>
                            <select name="pgender" id="pgender">
                                <option selected value="">Please select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="pdob" class="form-label">DOB(DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="pdob" name="pdob">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="pnumber" name="pnumber">
                        </div>
                        <div class="formAreahalf ">
                            <label for="pexdate" class="form-label">Passport Expiry Date (DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="pexdate" name="pexdate">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Renewal Reminder</label>
                            <select name="prenrem" id="prenrem">
                                <option value="" selected>Please select</option>
                                <option value="30">30 days before expiry</option>
                                <option value="60">60 days before expiry</option>
                                <option value="90">90 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" id="pcountry" name="pcountry">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                            <select name="premtf" id="premtf">
                                <option value="" selected>Please select</option>
                                <option value="everyweek">Every Week</option>
                                <option value="everymonth">Every Month</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" id="ptinnumber" name="ptinnumber">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Country</label>
                            <input type="text" class="form-control" id="ptincountry" name="ptincountry">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Type of TIN</label>
                            <select name="ptypetin" id="ptypetin">others,please specify
                                <option value="" selected>Please select</option>
                                <option value="EAD">EAD</option>
                                <!-- <option value="everymonth">Every Month</option> -->
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="pphoneno" name="pphoneno">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">E mail</label>
                            <input type="text" class="form-control" id="pemail" name="pemail">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Residential Address</label>
                            <input type="text" class="form-control" id="paddress" name="paddress">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="premarks" name="premarks" rows="4" cols="50"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next2" class="btn saveBtn next-step next2">Next</button>
                    <button type="button" id="previous2" class="btn saveBtn cancelBtn previous">Back</button>
                </div>

            </fieldset>


            <fieldset id="main_class_payment"
                class="w-100 justify-content-start flex-wrap form-fields wealth main_class_payment" style="display:none;">

                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Payment Details</h4>

                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active">
                                    <a href="#">1</a>
                                    <p> Business Details </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">2</a>
                                    <p> Personal Information </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">3</a>
                                    <p> Payment Recievable Item </p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">4</a>
                                    <p> Report Submission Item</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">5</a>
                                    <p> Complete </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_shareholder" class="sharehold">
                        <div class="company_design Revunue">
                            <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">

                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Revunue Item 1</label>
                                    <select name="payment[0][revenue]" id="payment[0][revenue]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                        <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                                    </select>
                                </div>

                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Currency</label>
                                    <select name="payment[0][currency]" id="payment[0][currency]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="SGD">SGD</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Payment Frequency</label>
                                    <select name="payment[0][payfre]" id="payment[0][payfre]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="One Time">One Time</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Amount</label>
                                    <input type="text" class="form-control" name="payment[0][amount]"
                                        id="payment[0][amount]">
                                </div>

                                <div class="formAreahalf ">
                                    <label class="form-label" for="dcname">Payment Recievable Deadline</label>
                                    <input type="date" class="form-control" id="payment[0][paredead]"
                                        name="payment[0][paredead]">
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Payment Recievable Reminder Trigger</label>
                                    <select name="payment[0][pareretri]" id="payment[0][pareretri]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="60">60 days before expiry</option>
                                        <option value="30">30 days before expiry</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label class="form-label" for="passcountry">Payment Recievable Status</label>
                                    <select name="payment[0][paresta]" id="payment[0][paresta]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Recievable">Recievable</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label class="form-label" for="passcountry">Payment Reminder Trigger Frequency</label>
                                    <select name="payment[0][paretrfre]" id="payment[0][paretrfre]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Every Week">Every Week</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea id="payment[0][subject]" name="payment[0][remarks]" rows="4" cols="50"> </textarea>
                                </div>
                                <div id="appended_user_shareholder_cmp2_selcection_div"
                                    class="w-100 d-flex justify-content-start flex-wrap"></div>
                            </div>
                        </div>
                    </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_payment" class="btn saveBtn btn_design add_payment"
                            name="add_payment">Add Payment Recievable Item</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">

                    <button type="button" id="next3" class="btn saveBtn next3" data-id="1">Next</button>
                    <button type="button" style="display: block;" id="#previous2"
                        class="btn saveBtn cancelBtn previous">Back</button>
                </div>

            </fieldset>



            <fieldset class="main_class_fp w-100 justify-content-start flex-wrap form-fields wealth"
                id="main_class_report" style="display:none;">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Report Detail</h4>

                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active">
                                    <a href="#">1</a>
                                    <p> Business Details </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">2</a>
                                    <p> Personal Information </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">3</a>
                                    <p> Payment Recievable Item </p>
                                </li>
                                <li class="list-group-item active">
                                    <a href="#">4</a>
                                    <p> Report Submission Item</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">5</a>
                                    <p> Complete </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_shareholder" class="report_submission">
                        <div class="company_design reports">
                            <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">
                                <div class="Share_holder-w sub-heading">

                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Report Submission Item 1</label>
                                    <select name="report[0][submission]" id="report[0][submission]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                        <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                                    </select>
                                </div>

                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Currency</label>
                                    <select name="report[0][currency]" id="report[0][currency]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="SGD">SGD</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Submission Frequency</label>
                                    <select name="report[0][subfre]" id="report[0][subfre]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="One Time">One Time</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Amount</label>
                                    <input type="text" class="form-control" name="report[0][amount]"
                                        id="report[0][amount]">
                                </div>

                                <div class="formAreahalf ">
                                    <label class="form-label" for="dcname">Submission Deadline</label>
                                    <input type="date" class="form-control" id="report[0][subdead]"
                                        name="report[0][subdead]">
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="buscurr">Submission Reminder Trigger</label>
                                    <select name="report[0][subretri]" id="report[0][subretri]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="60">60 days before expiry</option>
                                        <option value="30">30 days before expiry</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label class="form-label" for="passcountry">Submission Status</label>
                                    <select name="report[0][substa]" id="report[0][substa]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Recievable">Recievable</option>
                                    </select>
                                </div>
                                <div class="formAreahalf ">
                                    <label class="form-label" for="passcountry">Submission Reminder Trigger
                                        Frequency</label>
                                    <select name="report[0][subretrfre]" id="report[0][subretrfre]">
                                        <option value="" selected>Please select
                                        </option>
                                        <option value="Every Week">Every Week</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea id="report[0][remarks]" name="report[0][remarks]" rows="4" cols="50"> </textarea>
                                </div>
                                <div id="appended_user_shareholder_cmp2_selcection_div"
                                    class="w-100 d-flex justify-content-start flex-wrap"></div>
                            </div>
                        </div>
                    </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_report" class="btn saveBtn btn_design add_report"
                            name="add_">Add Report Submission Item</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next4" class="btn saveBtn next4" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous"
                        data-id="1">Back</button>
                </div>
            </fieldset>



            <fieldset id="main_class_company"
                class="w-100 justify-content-start flex-wrap form-fields wealth wealth_companies" style="display:none">
                <div class="card formContentData border-0 p-4 wealth_companies_change">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Details</h4>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                                <li class="list-group-item active" id="1">
                                    <a href="#">1</a>
                                    <p> Business Details </p>
                                </li>
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Details </p>
                                </li>
                                <li class="list-group-item" id="3">
                                    <a href="#">3</a>
                                    <p> Shareholder </p>
                                </li>
                                <li class="list-group-item" id="4">
                                    <a href="#">4</a>
                                    <p> Complete</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_company">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                            <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item" id="accordion-1">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">

                                        <div class="formAreahalf company-full_width_Cstm">
                                            <label for="fo_compnay" class="form-label">Company Name 1</label>
                                            <input type="text" name="cmp[0][fo_company]" id="fo_compnay"
                                                class="form-control" value="">
                                        </div>
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">

                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    </h2>



                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body d-flex flex-wrap">

                                            <div class="formAreahalf">
                                                <label for="fo_uen" class="form-label">UEN</label>
                                                <input type="text" class="form-control" name="cmp[0][fo_uen]"
                                                    id="fo_uen">
                                            </div>
                                            <div class="formAreahalf">
                                                <label for="fo_company_add" class="form-label">Company Address</label>
                                                <input type="text" class="form-control" name="cmp[0][fo_company_add]"
                                                    id="fo_company_add">
                                            </div>
                                            <div class="formAreahalf">
                                                <label for="fo_incorporation_date" class="form-label">Incorporation
                                                    Date</label>
                                                <input type="date" class="form-control"
                                                    name="cmp[0][fo_incorporation_date]" id="fo_incorporation_date">
                                            </div>
                                            <div class="formAreahalf">
                                                <label for="fo_company_email" class="form-label">Company Email</label>
                                                <input type="text" class="form-control"
                                                    name="cmp[0][fo_company_email]" id="fo_company_email">
                                            </div>
                                            <div class="formAreahalf">
                                                <label for="fo_company_pass" class="form-label">Company Password</label>
                                                <input type="text" class="form-control" name="cmp[0][fo_company_pass]"
                                                    id="fo_company_pass">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="appended_company_div">
                        <div id="fo_company" data-id="0">
                            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                                <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                                    <span class="cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <div class="accordion-item accordian-items-comp" id="accordion-2">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                            <div class="formAreahalf company-full_width_Cstm">
                                                <label for="fo_compnay" class="form-label">Company Name 2</label>
                                                <input type="text" name="cmp[1][fo_company]" id="fo_compnay"
                                                    class="form-control" value="">
                                            </div>
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseOne1" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseOne">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                        </h2>

                                        <div id="panelsStayOpen-collapseOne1" class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingOne">
                                            <div class="accordion-body d-flex flex-wrap">

                                                <div class="formAreahalf">
                                                    <label for="fo_uen" class="form-label">UEN</label>
                                                    <input type="text" class="form-control" name="cmp[1][fo_uen]"
                                                        id="fo_uen">
                                                </div>
                                                <div class="formAreahalf">
                                                    <label for="fo_company_add" class="form-label">Company Address</label>
                                                    <input type="text" class="form-control"
                                                        name="cmp[1][fo_company_add]" id="fo_company_add">
                                                </div>
                                                <div class="formAreahalf">
                                                    <label for="fo_incorporation_date" class="form-label">Incorporation
                                                        Date</label>
                                                    <input type="date" class="form-control"
                                                        name="cmp[1][fo_incorporation_date]" id="fo_incorporation_date">
                                                </div>
                                                <div class="formAreahalf">
                                                    <label for="fo_company_email" class="form-label">Company Email</label>
                                                    <input type="text" class="form-control"
                                                        name="cmp[1][fo_company_email]" id="fo_company_email">
                                                </div>
                                                <div class="formAreahalf">
                                                    <label for="fo_company_pass" class="form-label">Company
                                                        Password</label>
                                                    <input type="text" class="form-control"
                                                        name="cmp[1][fo_company_pass]" id="fo_company_pass">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_company_btn_div">
                        <button type="button" id="add_company" class="btn saveBtn btn_design add_company"
                            name="add-company">Add
                            Company</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next2company" class="btn saveBtn next2">Next</button>
                    <button type="button" id="previous2company" class="btn saveBtn cancelBtn previous">Back</button>
                </div>
            </fieldset>


            <fieldset id="FO_shareholder" class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder">
            </fieldset>

            <fieldset id="FO_shareholder_extra"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder_extra">
            </fieldset>


            <fieldset id="FO_institution" class="w-100 justify-content-start flex-wrap form-fields wealth FO_institution">
            </fieldset>

            <fieldset id="FO_institution_extra"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_institution_extra">

            </fieldset>

            <fieldset id="FO_payment" class="w-100 justify-content-start flex-wrap form-fields wealth FO_payment">
            </fieldset>

            <fieldset id="FO_report" class="w-100 justify-content-start flex-wrap form-fields wealth FO_report">
            </fieldset>


            <fieldset id="FO_financial_extra"
                class="w-100 justify-content-start flex-wrap form-fields wealth FO_financial_extra">

            </fieldset>


            <fieldset id="FO_pr" class="w-100 justify-content-start flex-wrap form-fields wealth FO_pr">
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

            // $("body").on('keyup', '#equity_shareholder', function(evt){
            //     alert('y');
            //     $(this).attr('value',$(this).val());
            //     equity_percentage_checks();
            // });

            function equity_percentage_checks() {
                // alert('d');
                var company = document.querySelectorAll('.full_div');
                // alert(company.length);
                for (index = 0; index < company.length; index++) {
                    var id = '';
                    id = $(company[index]).attr('id');
                    // alert(id);
                    var eqty_precentage = document.getElementById(id).querySelectorAll('#equity_shareholder');
                    // alert(eqty_precentage);
                    let percentage = 0;
                    for (per = 0; per < eqty_precentage.length; per++) {
                        percentage += parseInt($(eqty_precentage[per]).attr('value'));

                    }
                    if (percentage >= 100) {
                        // alert('h');
                        console.log('ghty');
                        $('#' + id).find("#add_shareholder").addClass("disable");
                        $('#' + id).find("#add_shareholder").attr('disabled', 'disabled');
                        //    $(".saveBtn").addClass("disable");
                    } else {
                        $('#' + id).find("#add_shareholder").removeClass("disable");
                        $('#' + id).find("#add_shareholder").prop("disabled", false);
                    }
                    if (percentage == 100) {

                        $(".next3").removeClass("disable");
                        $(".fo_form_sub").removeClass("disable");
                        $(".next3").prop("disabled", false);
                        $(".fo_form_sub").prop("disabled", false);
                    } else {

                        $(".next3").addClass("disable");
                        $(".fo_form_sub").addClass("disable");
                        $(".next3").attr('disabled', 'disabled');
                        $(".fo_form_sub").attr('disabled', 'disabled');
                    }
                }
            }

            $("#client").change(function() {
                // alert('k');
                // var option = document.getElementById("bussiness").options;
                if (document.getElementById('client').value == "Personal") {
                    $("#business").html(
                        '<option value="" selected >Please select business type</option><option value="wealthmanagement">Wealth Management</option>'
                    );

                }
                if (document.getElementById('client').value == "Corporate") {
                    $("#business").html(
                        '<option value="" selected >Please select business type</option><option value="wealthmanagement">Wealth Management</option>'
                    );

                }


            });


            $('#next').click(function() {
                // alert('bhb');

                if ($('#client').val() == null) {
                    $('#clienterror').html('This field is required');
                    // $('#client').after('<span class="error" style="color:red">This field is required</span>');
                } else {
                    $('#clienterror').html('');
                }

                if ($('#business').val() == null) {
                    $('#businesserror').html('This field is required');
                } else {
                    $('#businesserror').html('');
                }
                if ($('#businessdes').val() == "") {
                    $('#businessdeserror').html('This field is required');
                } else {
                    $('#businessdeserror').html('');
                }

                if (($('#client').val() == "Personal") && ($('#business').val() == "wealthmanagement") && (
                        $('#businessdes').val() != "")) {
                    $('#FO_personaldetails').show();
                    $('#start_field').hide();
                    $('#FO_start_field').hide();
                    // $('#FO_shareholder_extra').hide();

                }
                if (($('#client').val() == "Corporate") && ($('#business').val() == "wealthmanagement") && (
                        $('#businessdes').val() != "")) {
                    // alert('jj');
                    $('#main_class_company').show();
                    $('#start_field').hide();
                    $('#FO_start_field').hide();
                    // $('#FO_shareholder_extra').hide();

                    var i = 1;
                    $('.add_company').click(function() {
                        i++;
                        // $('#appended_company_div').append($('#fo_company').html());
                        $('#appended_company_div').append(
                            `
            <div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                        <span class="cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span> \

                            <div class="accordion-item accordian-items-comp" id="accordion-1">



                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                 <div class="formAreahalf company-full_width_Cstm">
                            <label for="fo_compnay" class="form-label">Company Name ` + (i + 1) + `
                            </label>
                            <input type="text" name="cmp[` + i + `][fo_company]" id="fo_compnay" class="form-control"
                                value="">
                        </div>
                      {{-- <div class="cross"><span class="remove-input-field" data-id=".parent_field1">x</span></div> --}}
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne` + i + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne` + i + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                            <label for="fo_uen" class="form-label">UEN</label>
                            <input type="text" class="form-control" name="cmp[` + i + `][fo_uen]" id="fo_uen">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_add" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="cmp[` + i + `][fo_company_add]" id="fo_company_add">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                            <input type="date" class="form-control" name="cmp[` + i + `][fo_incorporation_date]"
                                id="fo_incorporation_date">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_email" class="form-label">Company Email</label>
                            <input type="text" class="form-control" name="cmp[` + i + `][fo_company_email]"
                                id="fo_company_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_company_pass" class="form-label">Company Password</label>
                            <input type="text" class="form-control" name="cmp[` + i + `][fo_company_pass]"
                                id="fo_company_pass">
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                        )
                    });

                    $('body').on('click', '.cancel_company', function() {
                        $(this).parents('#fo_company').remove();
                    });


                }

            });



            $('#next2company').click(function() {
                //    alert('g');
                $('#main_class_company').hide();
                arr = $('input[id=fo_compnay]').map(function() {
                    return this.value;
                }).get();

                $('#FO_company').hide();
                //   alert(arr);
                if (arr.length >= 2) {
                    $('.FO_shareholder').css("display", "block");
                    $('.FO_shareholder').html(`<div class="full_div"><div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6>` + arr[0] + `</h6>
                            <span class="investment">DEF Investments Pte Ltd</span>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                   <div id="fo_shareholder">

                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="Share_holder-w sub-heading">\
                                  <h4>Shareholder #1 </h4>\
                                </div>\
                                   <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>

                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">
                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[0][0][equity_percentage]" id="equity_shareholder" class="form-control" value="">%
                            </div>
                            <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" class="form-control" id="share[0][0][pname]" name="share[0][0][pname]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (chinese)</label>
                            <input type="text" class="form-control" id="share[0][0][pnamec]" name="share[0][0][pnamec]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Renewal Reminder</label>
                            <select name="share[0][0][prenrem]" id="share[0][0][prenrem]">
                                 <option selected value="">Please select</option>
                                 <option value="30">30 days before expiry</option>
                                 <option value="60">60 days before expiry</option>
                                 <option value="90">90 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="pdob" class="form-label">DOB(DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pdob]" name="share[0][0][pdob]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                            <select name="share[0][0][premtf]" id="share[0][0][premtf]">
                                 <option value="" selected >Please select</option>
                                 <option value="everyweek">Every Week</option>
                                 <option value="everymonth">Every Month</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Gender(M/F)</label>
                            <select name="share[0][0][pgender]" id="share[0][0][pgender]">
                                 <option value="" selected >Please select</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="share[0][0][pnumber]" name="share[0][0][pnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="pexdate" class="form-label">Passport Expiry Date (DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pexdate]" name="share[0][0][pexdate]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" id="share[0][0][pcountry]" name="share[0][0][pcountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">E mail</label>
                            <input type="text" class="form-control" id="share[0][0][pemail]" name="share[0][0][pemail]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="share[0][0][pphoneno]" name="share[0][0][pphoneno]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Residential Address(acc. to add proof)</label>
                            <input type="text" class="form-control" id="share[0][0][paddress]" name="share[0][0][paddress]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Country</label>
                            <input type="text" class="form-control" id="share[0][0][ptincountry]" name="share[0][0][ptincountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" id="share[0][0][ptinnumber]" name="share[0][0][ptinnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Type of TIN</label>
                            <select name="share[0][0][ptypetin]" id="share[0][0][ptypetin]">others,please specify
                                 <option selected value="" >Please select</option>
                                 <option value="EAD">EAD</option>
                                 <!-- <option value="everymonth">Every Month</option> -->
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="share[0][0][jtitle]" name="share[0][0][jtitle]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" id="share[0][0][msalary]" name="share[0][0][msalary]">
                        </div>
                        <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Relationship with shareholder 1</label>
                                <select name="share[0][0][rl_with_sh]" id="share[0][0][rl_with_sh]" class="fo_shrholder_type">
                                    <option value="" selected >Please select shareholder type</option>
                                    <option value="self">self</option>
                                </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="" for="remarks">Remarks</label>
                            <textarea id="share[0][0][premarks]" name="share[0][0][premarks]" rows="4" cols="50"></textarea>
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
                            name="add-shareholder">Add
                            shareholder</button>
                    </div>
                </div>

                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next4company" class="btn saveBtn next4company" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>
                </div>`);
                } else {
                    $('.FO_shareholder').css("display", "block");
                    $('.FO_shareholder').html(`<div class="full_div sfd" id="comp_1"><div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6>` + arr + `</h6>
                            <span class="investments">DEF Investments Pte Ltd</span>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>

                    <div id="fo_shareholder" class="sharehold">

                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                            <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
        <div class="accordion-item accordian-items-comp" id="accordion-1">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder #1</h4>
                            </div>
                            </h2>
                            <div class="accordion-body d-flex flex-wrap">
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[0][0][equity_percentage]" id="equity_shareholder" class="form-control" value="">%
                            </div>
                            <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" class="form-control" id="share[0][0][pname]" name="share[0][0][pname]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (chinese)</label>
                            <input type="text" class="form-control" id="share[0][0][pnamec]" name="share[0][0][pnamec]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Renewal Reminder</label>
                            <select name="share[0][0][prenrem]" id="share[0][0][prenrem]">
                                 <option selected value="" >Please select</option>
                                 <option value="30">30 days before expiry</option>
                                 <option value="60">60 days before expiry</option>
                                 <option value="90">90 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="pdob" class="form-label">DOB(DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pdob]" name="share[0][0][pdob]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                            <select name="share[0][0][premtf]" id="share[0][0][premtf]">
                                 <option selected value="" >Please select</option>
                                 <option value="everyweek">Every Week</option>
                                 <option value="everymonth">Every Month</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Gender(M/F)</label>
                            <select name="share[0][0][pgender]" id="share[0][0][pgender]">
                                 <option selected value="" >Please select</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="share[0][0][pnumber]" name="share[0][0][pnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="pexdate" class="form-label">Passport Expiry Date (DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pexdate]" name="share[0][0][pexdate]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" id="share[0][0][pcountry]" name="share[0][0][pcountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">E mail</label>
                            <input type="text" class="form-control" id="share[0][0][pemail]" name="share[0][0][pemail]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="share[0][0][pphoneno]" name="share[0][0][pphoneno]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Residential Address(acc. to add proof)</label>
                            <input type="text" class="form-control" id="share[0][0][paddress]" name="share[0][0][paddress]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Country</label>
                            <input type="text" class="form-control" id="share[0][0][ptincountry]" name="share[0][0][ptincountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" id="share[0][0][ptinnumber]" name="share[0][0][ptinnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Type of TIN</label>
                            <select name="share[0][0][ptypetin]" id="share[0][0][ptypetin]">others,please specify
                                 <option selected value="" >Please select</option>
                                 <option value="EAD">EAD</option>
                                 <!-- <option value="everymonth">Every Month</option> -->
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="share[0][0][jtitle]" name="share[0][0][jtitle]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" id="share[0][0][msalary]" name="share[0][0][msalary]">
                        </div>
                        <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Relationship with shareholder 1</label>
                                <select name="share[0][0][rl_with_sh]" id="share[0][0][rl_with_sh]" class="fo_shrholder_type">
                                    <option value="" selected >Please select shareholder type</option>
                                    <option value="self">self</option>
                                </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="" for="remarks">Remarks</label>
                            <textarea id="share[0][0][premarks]" name="share[0][0][premarks]" rows="4" cols="50"></textarea>
                        </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
                        </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
                            name="add-shareholder">Add
                            shareholder</button>
                    </div>

--}



                <div class="text-center pt-4 " id="append_div_btn">

                    <button type="button" id="next4company" class="btn saveBtn fo_form_sub" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div></div>`);

                }


            });




            var btn_click = "";
            $('body').on('click', '.next4company', function() {
                // alert('t');
                // $('#FO_shareholder').hide();

                sh_no = 0;
                var share_hold = $('input[id=fo_pass_name]').map(function() {
                    return this.value;
                }).get();
                var isLastElement1 = arr.length - 1;
                btn_click = $(this).attr('data-id');
                // alert(btn_click);
                // $.each(arr, function(key, value) {
                let btn_id = "";
                if (btn_click == isLastElement1) {
                    btn_id = "fo_form_sub";
                } else {
                    btn_id = "next4company";
                }
                btn_click++;
                $(this).parents('fieldset').find('.full_div').hide();
                $('.FO_shareholder_extra').append(`
        <div class="full_div">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name ` + [btn_click] + `</h4>
                            <h6></h6>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Detail </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                   <div id="fo_shareholder">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">

                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="Share_holder-w sub-heading">
                                  <h4>Shareholder #1 </h4>
                                </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne` + sh_no + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne` + sh_no + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">
                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[` + (btn_click - 1) + `][0][equity_percentage]" id="fo_equity" class="form-control" value="">%
                            </div>
                            <div class="formAreahalf ">
                            <label for="" class="form-label">Shareholder Type</label>
                            <select name="share[` + (btn_click - 1) + `][0][stype]" id="s_holder_type]">
                                 <option selected value="-1" >Please select</option>
                                 <option selected value="Person" >Person</option>
                            </select>
                        </div>
                            <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" class="form-control" id="share[0][0][pname]" name="share[` + (
                        btn_click - 1) + `][0][pname]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (chinese)</label>
                            <input type="text" class="form-control" id="share[0][0][pnamec]" name="share[` + (
                        btn_click - 1) + `][0][pnamec]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="pdob" class="form-label">DOB(DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pdob]" name="share[` + (btn_click -
                        1) + `][0][pdob]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Renewal Reminder</label>
                            <select name="share[` + (btn_click - 1) + `][0][prenrem]" id="share[0][0][prenrem]">
                                 <option selected value="" >Please select</option>
                                 <option value="30">30 days before expiry</option>
                                 <option value="60">60 days before expiry</option>
                                 <option value="90">90 days before expiry</option>
                            </select>
                        </div>


                        <div class="formAreahalf ">
                            <label for="" class="form-label">Gender(M/F)</label>
                            <select name="share[` + (btn_click - 1) + `][0][pgender]" id="share[0][0][pgender]">
                                 <option selected value="" >Please select</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                            <select name="share[` + (btn_click - 1) + `][0][premtf]" id="share[0][0][premtf]">
                                 <option selected value="" >Please select</option>
                                 <option value="everyweek">Every Week</option>
                                 <option value="everymonth">Every Month</option>
                            </select>
                        </div>

                        <div class="formAreahalf ">
                            <label for="pexdate" class="form-label">Passport Expiry Date (DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[0][0][pexdate]" name="share[` + (
                        btn_click - 1) + `][0][pexdate]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="share[0][0][pnumber]" name="share[` + (
                        btn_click - 1) + `][0][pnumber]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">E mail</label>
                            <input type="text" class="form-control" id="share[0][0][pemail]" name="share[` + (
                        btn_click - 1) + `][0][pemail]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" id="share[0][0][pcountry]" name="share[` + (
                        btn_click - 1) + `][0][pcountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Residential Address(acc. to add proof)</label>
                            <input type="text" class="form-control" id="share[0][0][paddress]" name="share[` + (
                        btn_click - 1) + `][0][paddress]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="share[0][0][pphoneno]" name="share[` + (
                        btn_click - 1) + `][0][pphoneno]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" id="share[0][0][ptinnumber]" name="share[` + (
                        btn_click - 1) + `][0][ptinnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Country</label>
                            <input type="text" class="form-control" id="share[0][0][ptincountry]" name="share[` + (
                        btn_click - 1) + `][0][ptincountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="share[0][0][jtitle]" name="share[` + (
                        btn_click - 1) + `][0][jtitle]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Type of TIN</label>
                            <select name="share[` + (btn_click - 1) + `][0][ptypetin]" id="share[0][0][ptypetin]">others,please specify
                                 <option selected value="" >Please select</option>
                                 <option value="EAD">EAD</option>
                                 <!-- <option value="everymonth">Every Month</option> -->
                            </select>
                        </div>
                        <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Relationship with shareholder 1</label>
                                <select name="share[` + (btn_click - 1) + `][0][rl_with_sh]" id="share[0][0][rl_with_sh]" class="fo_shrholder_type">
                                    <option value="" selected >Please select shareholder type</option>
                                    <option value="self">self</option>
                                </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" id="share[0][0][msalary]" name="share[` + (
                        btn_click - 1) + `][0][msalary]">
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="share[0][0][premarks]" name="share[` + (btn_click - 1) + `][0][premarks]" rows="4" cols="50"></textarea>
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
                            name="add-shareholder">Add
                            shareholder</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next4company" class="btn saveBtn ` + btn_id + `" data-id="` +
                    btn_click + `">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="` +
                    btn_click + `">Back</button>
                </div></div>  `
                );
            });


            sh_no = 0;
            $('body').on('click', '.add_shareholder', function() {
                // alert('e');
                // sh_no = 0;
                var arr_id = $(this).parents('fieldset').find('#next4company').attr('data-id');
                // alert(arr_id);
                sh_no++;
                // $('#appended_shareholder_div').append($('#fo_shareholder').html());
                $(this).parents('fieldset').find('#appended_shareholder_div').append(
                    `<div id="fo_shareholder">

                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                        <span class="remove-input-fieldsh"><i class="fa fa-times" aria-hidden="true"></i></span> \

                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="Share_holder-w sub-heading">\
                                  <h4>Shareholder  #` + (sh_no + 1) + `</h4>\
                                </div>\
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne` + sh_no + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne` + sh_no + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">
                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[` + (arr_id - 1) + `][` + sh_no + `][equity_percentage]" id="equity_shareholder" class="form-control" value="">%
                            </div>
                            <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pname]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pname]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Full Name (chinese)</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pnamec]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pnamec]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Renewal Reminder</label>
                            <select name="share[` + (arr_id - 1) + `][` + sh_no + `][prenrem]" id="share[` + (arr_id -
                        1) + `][` + sh_no + `][prenrem]">
                                 <option selected value="" >Please select</option>
                                 <option value="30">30 days before expiry</option>
                                 <option value="60">60 days before expiry</option>
                                 <option value="90">90 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="pdob" class="form-label">DOB(DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pdob]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pdob]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Reminder Trigger Frequency</label>
                            <select name="share[` + (arr_id - 1) + `][` + sh_no + `][premtf]" id="share[` + (arr_id -
                        1) + `][` + sh_no + `][premtf]">
                                 <option selected value="" >Please select</option>
                                 <option value="everyweek">Every Week</option>
                                 <option value="everymonth">Every Month</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Gender(M/F)</label>
                            <select name="share[` + (arr_id - 1) + `][` + sh_no + `][pgender]" id="share[` + (arr_id -
                        1) + `][` + sh_no + `][pgender]">
                                 <option selected value="" >Please select</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pnumber]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="pexdate" class="form-label">Passport Expiry Date (DD/MM/YYYY) </label>
                            <input type="date" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pexdate]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pexdate]">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pcountry]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pcountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">E mail</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pemail]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pemail]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][pphoneno]" name="share[` + (arr_id - 1) + `][` + sh_no + `][pphoneno]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Residential Address(acc. to add proof)</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][paddress]" name="share[` + (arr_id - 1) + `][` + sh_no + `][paddress]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Country</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][ptincountry]" name="share[` + (arr_id - 1) + `][` + sh_no + `][ptincountry]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][ptinnumber]" name="share[` + (arr_id - 1) + `][` + sh_no + `][ptinnumber]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Type of TIN</label>
                            <select name="share[` + (arr_id - 1) + `][` + sh_no + `][ptypetin]" id="share[` + (arr_id -
                        1) + `][` + sh_no + `][ptypetin]">others,please specify
                                 <option selected value="" >Please select</option>
                                 <option value="EAD">EAD</option>
                                 <!-- <option value="everymonth">Every Month</option> -->
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][jtitle]" name="share[` + (arr_id - 1) + `][` + sh_no + `][jtitle]">
                        </div>
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" id="share[` + (arr_id - 1) + `][` + sh_no +
                    `][msalary]" name="share[` + (arr_id - 1) + `][` + sh_no + `][msalary]">
                        </div>
                        <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Relationship with shareholder 1</label>
                                <select name="share[` + (arr_id - 1) + `][` + sh_no + `][rl_with_sh]" id="share[` + (
                        arr_id - 1) + `][` + sh_no + `][rl_with_sh]" class="fo_shrholder_type">
                                    <option value="" selected >Please select shareholder type</option>
                                    <option value="self">self</option>
                                </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="" for="remarks">Remarks</label>
                            <textarea id="share[` + (arr_id - 1) + `][` + sh_no + `][premarks]" name="share[` + (
                        arr_id - 1) + `][` + sh_no + `][premarks]" rows="4" cols="50"></textarea>
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                );

            });

            $(document).on('click', '.remove-input-fieldsh', function() {
                // alert('ff');
                var id = $(this).attr('data-id');
                // alert(id);
                $(this).parents('#fo_shareholder').remove();
            });






            $(document).on('click', '.fo_form_sub', function() {
                // $(document).on('click', '.next4company', function() {
                //   alert('financial app');
                arr = $('input[id=fo_compnay]').map(function() {
                    return this.value;
                }).get();

                $('#FO_shareholder').hide();
                $('#FO_shareholder_extra').hide();

                //   alert(arr.length);
                if (arr.length >= 2) {
                    $('.FO_institution').css("display", "block");
                    $('.FO_institution').html(`<div class="full_div"><div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6>` + arr[0] + `</h6>
                            <span>DEF Investments Pte Ltd</span>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Financial Institution name 1</label>
                                <input type="text" name="fin[0][0][i_name]" id="fin[0][0][i_name]" class="form-control" value="">
                                </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Application Submission</label>
                                <select name="fin[0][0][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Opening Status</label>
                                <select name="fin[0][0][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Type</label>
                                <select name="fin[0][0][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="SGD">SGD</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Number</label>
                                <input type="text" name="fin[0][0][ac_number]" id="fin[0][0][ac_number]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Account Status</label>
                                <select name="fin[0][0][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label class="" for="remarks">Remarks</label>
                                <textarea id="fin[0][0][remarks]" name="fin[0][0][remarks]" rows="4" cols="50"></textarea>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_finaceins" class="btn saveBtn btn_design add_finaceins"
                            name="add-Financial">Add Financial Institution</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next5company" class="btn saveBtn next5company" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>
                </div>`);
                } else {
                    $('.FO_institution').css("display", "block");
                    $('.FO_institution').html(`<div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6>` + arr + `</h6>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                  {{--
                    <div id="fo_finance" class="sharehold">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="Share_holder-w sub-heading">

                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Financial Institution name</label>
                                <input type="text" name="fin[0][0][i_name]" id="fin[0][0][i_name]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Application Submission</label>
                                <select name="fin[0][0][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Opening Status</label>
                                <select name="fin[0][0][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Type</label>
                                <select name="fin[0][0][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="SGD">SGD</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Number</label>
                                <input type="text" name="fin[0][0][ac_number]" id="fin[0][0][ac_number]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Account Status</label>
                                <select name="fin[0][0][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label class="" for="remarks">Remarks</label>
                                <textarea id="fin[0][0][remarks]" name="fin[0][0][remarks]" rows="4" cols="50"></textarea>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
                        </div>
                    </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_finaceins" class="btn saveBtn btn_design add_finaceins"
                            name="add-shareholder">Add Financial Institution</button>
                    </div>
                </div>
                    --}}


                    <div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Financial Institution name</label>
                                <input type="text" name="fin[0][0][i_name]" id="fin[0][0][i_name]" class="form-control" value="">
                                </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Application Submission</label>
                                <select name="fin[0][0][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Opening Status</label>
                                <select name="fin[0][0][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Type</label>
                                <select name="fin[0][0][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="SGD">SGD</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Number</label>
                                <input type="text" name="fin[0][0][ac_number]" id="fin[0][0][ac_number]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Account Status</label>
                                <select name="fin[0][0][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label class="" for="remarks">Remarks</label>
                                <textarea id="fin[0][0][remarks]" name="fin[0][0][remarks]" rows="4" cols="50"></textarea>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_finaceins" class="btn saveBtn btn_design add_finaceins"
                            name="add-shareholder">Add Financial Institution</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next5company" class="btn saveBtn fo_form_sub2" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>`);

                }
            });




            var btn_click = "";
            $('body').on('click', '.next5company', function() {
                // alert('t');
                sh_no = 0;
                var share_hold = $('input[id=fo_pass_name]').map(function() {
                    return this.value;
                }).get();
                var isLastElement1 = arr.length - 1;
                btn_click = $(this).attr('data-id');
                // $.each(arr, function(key, value) {
                let btn_id = "";
                if (btn_click == isLastElement1) {
                    btn_id = "fo_form_sub2";
                } else {
                    btn_id = "next5company";
                }
                btn_click++;
                $(this).parents('fieldset').find('.full_div').hide();
                $('.FO_institution_extra').append(`
        <div class="full_div">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name ` + [btn_click] + `</h4>
                            <h6>` + arr[btn_click - 1] + `</h6>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item active"  id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Financial Institution name</label>
                                <input type="text" name="fin[` + (btn_click - 1) + `][0][i_name]" id="fin[0][0][i_name]" class="form-control" value="">
                                </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Application Submission</label>
                                <select name="fin[` + (btn_click - 1) + `][0][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Opening Status</label>
                                <select name="fin[0][0][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Type</label>
                                <select name="fin[` + (btn_click - 1) + `][0][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="SGD">SGD</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Number</label>
                                <input type="text" name="fin[` + (btn_click - 1) + `][0][ac_number]" id="fin[0][0][ac_number]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Account Status</label>
                                <select name="fin[` + (btn_click - 1) + `][0][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label class="" for="remarks">Remarks</label>
                                <textarea id="fin[0][0][remarks]" name="fin[` + (btn_click - 1) + `][0][remarks]" rows="4" cols="50"></textarea>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_finaceins" class="btn saveBtn btn_design add_finaceins"
                            name="add-shareholder">Add Financial institutions</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next5company" class="btn saveBtn ` + btn_id + `" data-id="` +
                    btn_click + `">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="` +
                    btn_click + `">Back</button>
                </div></div>`);
            });





            sh_no = 0;
            $('body').on('click', '.add_finaceins', function() {
                // alert('e');
                // sh_no = 0;
                var arr_id = $(this).parents('fieldset').find('#next5company').attr('data-id');
                // alert(arr_id);
                sh_no++;
                // $('#appended_shareholder_div').append($('#fo_shareholder').html());
                $(this).parents('fieldset').find('#appended_shareholder_div').append(
                    `<div id="fo_company">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
                        <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                        <span class="remove-input-fieldfin"><i class="fa fa-times" aria-hidden="true"></i></span> \

                            <div class="accordion-item accordian-items-comp" id="accordion-1">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Financial Institution name</label>
                                <input type="text" name="fin[` + (arr_id - 1) + `][` + sh_no + `][i_name]" id="fin[0][0][i_name]" class="form-control" value="">
                            </div>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne` + sh_no + `" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">

                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseOne` + sh_no + `" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body d-flex flex-wrap">

                                    <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Application Submission</label>
                                <select name="fin[` + (arr_id - 1) + `][` + sh_no + `][ba_app_sub]" id="fin[0][0][ba_app_sub]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Opening Status</label>
                                <select name="fin[` + (arr_id - 1) + `][` + sh_no + `][ac_open_sta]" id="fin[0][0][ac_open_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Type</label>
                                <select name="fin[` + (arr_id - 1) + `][` + sh_no + `][ac_type]" id="fin[0][0][ac_type]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="SGD">SGD</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Account Number</label>
                                <input type="text" name="fin[` + (arr_id - 1) + `][` + sh_no + `][ac_number]" id="fin[0][0][ac_number]" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Bank Account Status</label>
                                <select name="fin[` + (arr_id - 1) + `][` + sh_no + `][bank_ac_sta]" id="fin[0][0][bank_ac_sta]" class="fo_shrholder_type">
                                    <option value="" selected >Please select</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label class="" for="remarks">Remarks</label>
                                <textarea id="fin[0][0][remarks]" name="fin[` + (arr_id - 1) + `][` + sh_no + `][remarks]" rows="4" cols="50"></textarea>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                );

            });

            $(document).on('click', '.remove-input-fieldfin', function() {
                // alert('ff');
                var id = $(this).attr('data-id');
                // alert(id);
                $(this).parents('#fo_company').remove();
            });




            // Payment


            $('body').on('click', '.fo_form_sub2', function() {
                $('#FO_institution').hide();
                $('#FO_institution_extra').hide();

                // alert('payment')
                $('.FO_payment').css("display", "block");
                $('.FO_payment').html(`<div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Payment Details</h4>

                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_shareholder" class="sharehold">
                    <div class="company_design Revunue">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">
                            <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Revunue Item 1</label>
                            <select name="payment[0][revenue]" id="payment[0][revenue]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="payment[0][currency]" id="payment[0][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Frequency</label>
                            <select name="payment[0][payfre]" id="payment[0][payfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="payment[0][amount]" id="payment[0][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Payment Recievable Deadline</label>
                            <input type="date" class="form-control" id="payment[0][paredead]"
                                name="payment[0][paredead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Recievable Reminder Trigger</label>
                            <select name="payment[0][pareretri]" id="payment[0][pareretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Recievable Status</label>
                            <select name="payment[0][paresta]" id="payment[0][paresta]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Reminder Trigger Frequency</label>
                            <select name="payment[0][paretrfre]" id="payment[0][paretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="payment[0][subject]" name="payment[0][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
                        </div>
                    </div>
                    <div>
                    <div id="appended_shareholder_div">
                    </div>

                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_payment" class="btn saveBtn btn_design add_payment"
                            name="add_payment">Add Payment Recievable Item</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next5company" class="btn saveBtn fo_form_sub3" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>`);

            });



            sh_no = 0;
            $('body').on('click', '.add_payment', function() {
                // alert('e');
                // sh_no = 0;
                // var arr_id = $(this).parents('fieldset').find('#next5company').attr('data-id');
                // alert(arr_id);
                sh_no++;
                // $('#appended_shareholder_div').append($('#fo_shareholder').html());
                $(this).parents('fieldset').find('#appended_shareholder_div').append(
                    `<div id="fo_shareholder" class="sharehold">\
              <div class="company_design Revunue">
                <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">\
                              <div class="cross"><span class="remove-input-fieldpay" data-id=".parent_field` + sh_no + `">x</span></div>
                    <div class="Share_holder-w sub-heading">\
                    </div>\
                    <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Revunue Item 1</label>
                            <select name="payment[` + sh_no + `][revenue]" id="payment[` + sh_no + `][revenue]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="payment[` + sh_no + `][currency]" id="payment[` + sh_no + `][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Frequency</label>
                            <select name="payment[` + sh_no + `][payfre]" id="payment[` + sh_no + `][payfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="payment[` + sh_no +
                    `][amount]" id="payment[` + sh_no + `][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Payment Recievable Deadline</label>
                            <input type="date" class="form-control" id="payment[` + sh_no + `][paredead]"
                                name="payment[` + sh_no + `][paredead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Recievable Reminder Trigger</label>
                            <select name="payment[` + sh_no + `][pareretri]" id="payment[` + sh_no + `][pareretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Recievable Status</label>
                            <select name="payment[` + sh_no + `][paresta]" id="payment[` + sh_no + `][paresta]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Reminder Trigger Frequency</label>
                            <select name="payment[` + sh_no + `][paretrfre]" id="payment[` + sh_no + `][paretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="payment[` + sh_no + `][subject]" name="payment[` + sh_no + `][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                    <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                    </div>\
                    </div>
                </div></div>`
                );

            });

            $(document).on('click', '.remove-input-fieldpay', function() {
                // alert('ff');
                var id = $(this).attr('data-id');
                // alert(id);
                $(this).parents('#fo_shareholder').remove();
            });




            // Report


            $('body').on('click', '.fo_form_sub3', function() {
                $('#FO_payment').hide();
                $('#FO_institution_extra').hide();

                // alert('report');
                $('.FO_report').css("display", "block");
                $('.FO_report').html(`<div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Report Details</h4>
                            <h6>` + arr + `</h6>
                        </div>
                        <div class="number_main">
                            <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active" id="1">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">2</a>
                                <p> Shareholders </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">3</a>
                                <p> Fiancial Institutions </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">4</a>
                                <p> Payment Recievable Item </p>
                            </li>
                            <li class="list-group-item active" id="3">
                                <a href="#">5</a>
                                <p> Report Submission Item </p>
                            </li>
                            <li class="list-group-item" id="4">
                                <a href="#">6</a>
                                <p> Complete</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fo_shareholder" class="report_submission">
                      <div class="company_design reports">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">
                            <div class="Share_holder-w sub-heading">

                            </div>
                            <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Report Submission Item 1</label>
                            <select name="report[0][submission]" id="report[0][submission]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="report[0][currency]" id="report[0][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Frequency</label>
                            <select name="report[0][subfre]" id="report[0][subfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="report[0][amount]" id="report[0][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Submission Deadline</label>
                            <input type="date" class="form-control" id="report[0][subdead]"
                                name="report[0][subdead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Reminder Trigger</label>
                            <select name="report[0][subretri]" id="report[0][subretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Status</label>
                            <select name="report[0][substa]" id="report[0][substa]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Reminder Trigger Frequency</label>
                            <select name="report[0][subretrfre]" id="report[0][subretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="report[0][remarks]" name="report[0][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
                        </div>
                    </div>
                    </div>
                    <div id="appended_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                        <button type="button" id="add_report" class="btn saveBtn btn_design add_report"
                            name="add_">Add Report Submission Item</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next4" class="btn saveBtn next4" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>`);

            });


            sh_no = 0;
            $('body').on('click', '.add_report', function() {
                // alert('e');
                // sh_no = 0;
                // var arr_id = $(this).parents('fieldset').find('#next5company').attr('data-id');
                // alert(arr_id);
                sh_no++;
                // $('#appended_shareholder_div').append($('#fo_shareholder').html());
                $(this).parents('fieldset').find('#appended_shareholder_div').append(
                    `<div id="fo_shareholder" class="report_submission">\
            <div class="company_design reports ">
                <div class="w-100 d-flex justify-content-start flex-wrap form-fields append-div-css">\
                  <div class="cross"><span class="remove-input-fieldreport" data-id=".parent_field` + sh_no + `">x</span></div>
                    <div class="Share_holder-w sub-heading">\
                    </div>\
                    <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Report Submission Item 1</label>
                            <select name="report[` + sh_no + `][submission]" id="report[0][submission]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="report[` + sh_no + `][currency]" id="report[0][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Frequency</label>
                            <select name="report[` + sh_no + `][subfre]" id="report[0][subfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="report[` + sh_no + `][amount]" id="report[0][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Submission Deadline</label>
                            <input type="date" class="form-control" id="report[0][subdead]"
                                name="report[` + sh_no + `][subdead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Reminder Trigger</label>
                            <select name="report[` + sh_no + `][subretri]" id="report[0][subretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Status</label>
                            <select name="report[` + sh_no + `][substa]" id="report[0][substa]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Reminder Trigger Frequency</label>
                            <select name="report[` + sh_no + `][subretrfre]" id="report[0][subretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="report[0][remarks]" name="report[` + sh_no + `][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                    <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                    </div>\
                </div>
                </div></div>`
                );

            });


            $(document).on('click', '.remove-input-fieldreport', function() {
                // alert('ff');
                var id = $(this).attr('data-id');
                // alert(id);
                $(this).parents('#fo_shareholder').remove();
            });





            // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




            $('#next2').click(function() {
                // alert('t');
                $('#FO_personaldetails').hide();
                $('#main_class_payment').show();


                var i = 0;
                $("#dynamic-ar").click(function() {
                    //   alert('dd');
                    ++i;
                    var I = i + 1;

                    $("#append_div_form .card_potentials_fg").last().append(
                        `  <fieldset id="dynamicAddRemove" class="w-100 d-flex justify-content-start flex-wrap form-fields custom-form parent_field` +
                        i + `">
                              <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>

                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTwi` + i + `">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseTwi` + i +
                        `"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwi` +
                        i +
                        `">
                                                       <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>

                                                </h2>
                                                <div id="panelsStayOpen-collapseTwi` + i + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTwi` + i + `">
                                                    <div class="accordion-body d-flex flex-wrap">
                                                    <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Revunue Item ` + I + `</label>
                            <select name="payment[` + i + `][revenue]" id="payment[` + i + `][revenue]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>
                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="payment[` + i + `][currency]" id="payment[` + i + `][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Frequency</label>
                            <select name="payment[` + i + `][payfre]" id="payment[` + i + `][payfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="payment[` + i + `][amount]" id="payment[` +
                        i + `][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Payment Recievable Deadline</label>
                            <input type="date" class="form-control" id="payment[` + i + `][paredead]"
                                name="payment[` + i + `][paredead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Payment Recievable Reminder Trigger</label>
                            <select name="payment[` + i + `][pareretri]" id="payment[` + i + `][pareretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Recievable Status</label>
                            <select name="payment[` + i + `][paresta]" id="payment[` + i + `][paresta]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Payment Reminder Trigger Frequency</label>
                            <select name="payment[` + i + `][paretrfre]" id="payment[` + i + `][paretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="payment[` + i + `][subject]" name="payment[` + i + `][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                </div>
                </div>
                </div>



            </fieldset>

            `)

                    // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                });
                $(document).on('click', '.remove-input-field', function() {
                    // alert('ff');
                    var id = $(this).attr('data-id');
                    console.log(id);
                    $(this).parents(id).remove();
                });

            });





            $('#next3').click(function() {
                // alert('t');
                $('#FO_personaldetails').hide();
                $('#main_class_payment').hide();
                $('#main_class_report').show();


                var i = 0;
                $("#dynamic-ar2").click(function() {
                    //   alert('dd');
                    ++i;
                    var I = i + 1;

                    $("#append_div_form2 .card_potentials_fg2").last().append(
                        `  <fieldset id="dynamicAddRemove" class="w-100 d-flex justify-content-start flex-wrap form-fields custom-form parent_field` +
                        i + `">
                              <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>

                              <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTwi` + i + `">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseTwi` + i +
                        `"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwi` +
                        i +
                        `">
                                                       <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>

                                                </h2>
                                                <div id="panelsStayOpen-collapseTwi` + i + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTwi` + i + `">
                                                    <div class="accordion-body d-flex flex-wrap">
                                                    <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Report Submission Item ` + I + `</label>
                            <select name="report[` + i + `][submission]" id="report[0][submission]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Wealth Management-Comission">Wealth Management-Comission</option>
                                <option value="Wealth Management-AUM fee">Wealth Management-AUM fee</option>
                            </select>                        </div>

                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Currency</label>
                            <select name="report[` + i + `][currency]" id="report[` + i + `][currency]">
                                <option value="" selected >Please select
                                </option>
                                <option value="SGD">SGD</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Frequency</label>
                            <select name="report[` + i + `][subfre]" id="report[` + i + `][subfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="One Time">One Time</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Amount</label>
                            <input type="text" class="form-control" name="report[` + i + `][amount]" id="report[` + i + `][amount]">
                        </div>

                        <div class="formAreahalf ">
                            <label class="form-label" for="dcname">Submission Deadline</label>
                            <input type="date" class="form-control" id="report[` + i + `][subdead]"
                                name="report[` + i + `][subdead]">
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="buscurr">Submission Reminder Trigger</label>
                            <select name="report[` + i + `][subretri]" id="report[` + i + `][subretri]">
                                <option value="" selected >Please select
                                </option>
                                <option value="60">60 days before expiry</option>
                                <option value="30">30 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Status</label>
                            <select name="report[` + i + `][substa]" id="report[` + i + `][substa]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Recievable">Recievable</option>
                            </select>
                        </div>
                        <div class="formAreahalf ">
                            <label class="form-label" for="passcountry">Submission Reminder Trigger Frequency</label>
                            <select name="report[` + i + `][subretrfre]" id="report[` + i + `][subretrfre]">
                                <option value="" selected >Please select
                                </option>
                                <option value="Every Week">Every Week</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="report[` + i + `][remarks]" name="report[` + i + `][remarks]" rows="4" cols="50"> </textarea>
                        </div>
                </div>
                </div>
                </div>



            </fieldset>

            `)

                    // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                });
                $(document).on('click', '.remove-input-field', function() {
                    // alert('ff');
                    var id = $(this).attr('data-id');
                    console.log(id);
                    $(this).parents(id).remove();
                });

            });





            $(document).on('click', '.next4', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                $.ajax({
                    url: "{{ route('finance.save') }}",
                    method: 'POST',
                    data: $('#multistep_form').serialize(),
                    success: function(response) {
                        console.log(response);
                        const el = document.createElement('div')
                        el.innerHTML =
                            "You can view Application List <a href=''>here</a>"
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
                            $('#multistep_form')[0].reset();
                            window.location = "{{ route('finance.newapp') }}"
                        })
                    },
                    error: function(data) {
                        // alert('ajax error');
                        console.log(data);
                    }
                });


            });



        });


        $('body').on('click', '.previous', function() {
            $(this).parents('fieldset').hide();
            $(this).closest('fieldset').prev().show();
        })
    </script>
@endpush
