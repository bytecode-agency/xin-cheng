@extends('layouts.app')
@push('css')
@endpush

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add Sales Application</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('sales.create') }}">Sales</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
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
    <!-- Form card data -->
    <div class="dataAreaMain sales-module">

        <div class="card formContentData border-0 p-4 salescreate">
            <h3>Application Details</h3>
            <form action="javascript:void(0);" class="userForm d-flex justify-content-center flex-wrap  application_details"
                method="POST" id="multistep_form">
                @csrf
                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="uid" value="{{ Auth::user()->id }}">

                <fieldset id="account"
                    class=" w-100 d-flex justify-content-start flex-wrap form-fields fieldset1-account">

                    <div class="formAreahalf">
                        <label for="bustype" class="form-label">Business Type</label>
                        <select class="" name="business" id="business">
                            <option value="" selected disabled>Please select business type</option>
                            <option value="B2B">B2B</option>
                            <option value="B2C">B2C</option>
                        </select>
                    </div>

                    <div class="formAreahalf ">
                        <label for="clienttype" class="form-label">Client Type</label>
                        <select class="" name="client" id="client">
                        </select>
                    </div>
                    <div id="FO_First" class="form-sets" style="display:none;">
                        <!-- <fieldset id="FO_First" class=" w-100 d-flex justify-content-start flex-wrap form-fields"> -->
                        <div class="formAreahalf ">
                            <label for="" class="form-label">Client's Full Name</label>
                            <input type="text" class="form-control" id="cname" name="cname">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Country of Client</label>
                            <input type="text" class="form-control" id="ccountry" name="ccountry">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">City of Client</label>
                            <input type="text" class="form-control" id="ccity" name="ccity">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Phone no. of POC</label>
                            <input type="text" class="form-control" id="pocph" name="pocph">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Name of POC</label>
                            <input type="text" class="form-control poc_name" id="pocname" name="pocname">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label">Email of POC</label>
                            <input type="text" class="form-control" id="pocemail" name="pocemail">
                        </div>

                        <div class="formAreahalf ">
                            <label for="" class="form-label"> Wechat ID of POC</label>
                            <input type="text" class="form-control" id="pocwechat" name="pocwechat">
                        </div>

                        <div class="formAreahalf " id="signdiv">

                        </div>


                        <div class="formAreahalf " id="b2bsigndatediv">

                            {{-- <input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-"> --}}
                        </div>

                        <div class="formAreahalf " id="b2bexdatediv">

                            {{-- <input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-"> --}}
                        </div>

                        <div class="formAreahalf" id="renewlremdiv">






                        </div>

                        <div class="formAreahalf" id="renewlfrediv">

                        </div>
                    </div>
                    <div>

                </fieldset>

                <div class="main_class_fp type-of-potential-business" style="display:none;">

                    <div id="append_div_form"
                        class="w-100 justify-content-start flex-wrap form-fields div1-append_div type_business">
                        <div class="card_potentials_fg potential-business-holder">



                            <div class="accordion-item pt-0 mt-0 border_sales">
                                <div class="formAreahalf checkbox">

                                    <input type="checkbox" id="same_client_topb" class="same_client_topb"
                                        name="same_client_topb" value="">
                                    <label for="same_client_topb" class="form-label checkbox_label">Same Basic Information
                                        as Client?</label>


                                </div>
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <label for="clienttype" class="form-label main-head main-head-r">Type of Potential
                                    Business</label>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <fieldset id="dynamicAddRemove"
                                            class="w-100 d-flex justify-content-start flex-wrap form-fields custom-form pt-4">
                                            <div class="formAreahalf ">
                                                <label for="clienttype" class="form-label main-head-r">Type of Potential
                                                    Business</label>
                                                <select name="addpb[0][drp]" id="topb_class" class="select_class "
                                                    data-id="0">
                                                    <option value="" selected disabled>Please select type of
                                                        potential business
                                                    </option>
                                                    <option value="Wealth Management">Wealth Management</option>
                                                    <option value="Immigration Programme">Immigration Programme</option>
                                                    <option value="Family Office">Family Office</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Real Property">Real Property</option>
                                                    <option value="Pure Identity Management">Pure Identity Management
                                                    </option>
                                                    <option value="Account Services">Account Services</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Bank Account Opening">Bank Account Opening</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <!-- <input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter list" class="form-control" /> -->
                                                {{-- @error('addMoreInputFields.*.subject')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror --}}

                                            </div>

                                            <div class="formAreahalf others">

                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="dcname">Name of direct client</label>

                                                <input type="text" class="form-control dc_name" id="dc_name"
                                                    name="addpb[0][dcname]" value="">

                                            </div>
                                            <div class="formAreahalf ">
                                                <label class="form-label" for="passcountry">Passport Country</label>
                                                <input type="text" class="form-control passcountry"
                                                    name="addpb[0][passcountry]" id="passcountry">

                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="wechatidc">Wechat ID of client</label>

                                                <input type="text" class="form-control wechatidc"
                                                    name="addpb[0][wechatidc]" id="wechatidc">
                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="cmobileno">Mobile no. of client</label>
                                                <input type="text" class="form-control cmobileno"
                                                    name="addpb[0][cmobileno]" id="cmobileno">
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="cemail">Email address of client</label>
                                                <input type="email" class="form-control cemail" name="addpb[0][cemail]"
                                                    id="cemail">
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="busdes">Business Description</label>
                                                <input type="text" class="form-control" id="busdes"
                                                    name="addpb[0][busdes]">
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="buscurr">Currency of Potential Business
                                                </label>
                                                {{-- <input type="text" class="form-control" id="buscurr[0][subject]"
                                        name="addpb[0][buscurr]"> --}}
                                                <select name="addpb[0][buscurr]" id="addpb[0][buscurr]">
                                                    <option value="" selected disabled>Please select currency
                                                    </option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="USD">USD</option>



                                                </select>
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="busamt">Amount of Potential
                                                    Business</label>
                                                <div class="dollersec"><span class="doller">$</span><span
                                                        class="input"><input type="number" class="form-control"
                                                            id="busamt[0][subject]" name="addpb[0][busamt]"></span></div>
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <textarea id="remarks[0][subject]" name="addpb[0][remarks]" rows="4" cols="50"></textarea>
                                            </div>

                                        </fieldset>
                                    </div>
                                </div>
                            </div>








                        </div>
                        <div class="generated text-end me-0 w-100 "><button type="button" name="dynamic-ar"
                                id="dynamic-ar" class="dynamic-ar btn saveBtn add_potentia  ">Add Potential
                                Business</button></div>
                    </div>

                    <div id="business_generated_section">

                        <div class="card_potentials_fg mb-0 pb-0">

                            <div class="accordion-item border_sales">
                                <div class="formAreahalf checkbox">

                                    <input type="checkbox" id="same_client_tobg"
                                        class="same_client_tobg Potential_business" name="same_client_topb"
                                        value="">
                                    <label for="same_client_tobg" class="form-label checkbox_label">Same as Type of
                                        Potential Business?</label>


                                </div>
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    </button>
                                </h2>

                                <label for="clienttype" class="form-label main-he main-her">Type of Generated
                                    Business</label>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        <fieldset id="dynamicAddRemove2 "
                                            class=" w-100 d-flex justify-content-start flex-wrap form-fields custom-form">
                                            <!-- <div class="col-sm-10" id="dynamicAddRemove2"> -->
                                            <div class="formAreahalf ">
                                                <label for="clienttype" class="form-label main-her">Type of Generated
                                                    Business</label>

                                                <select name="addbg[0][g_drp]" id="addMoreInputFields2[0][select]"
                                                    class="select_class_g g_drp_class" data-id="0">
                                                    <option value="" selected disabled>Please select type of business
                                                        generated
                                                    </option>
                                                    <option value="Wealth Management">Wealth Management</option>
                                                    <option value="Immigration Programme">Immigration Programme</option>
                                                    <option value="Family Office">Family Office</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Real Property">Real Property</option>
                                                    <option value="Pure Identity Management">Pure Identity Management
                                                    </option>
                                                    <option value="Account Services">Account Services</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Bank Account Opening">Bank Account Opening</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                {{-- @error('addMoreInputFields.*.subject')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror --}}
                                            </div>
                                            <div class="formAreahalf others2">

                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="">Name of direct client</label>

                                                <input type="text" class="form-control gendcname"
                                                    name="addbg[0][g_dcname]">

                                            </div>
                                            <div class="formAreahalf ">
                                                <label class="form-label" for="passcountry">Passport Country</label>
                                                <input type="text" class="form-control genpasscountry"
                                                    name="addbg[0][g_passcountry]">

                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="wechatidc">Wechat ID of client</label>

                                                <input type="text" class="form-control genwechatidc"
                                                    name="addbg[0][g_wechatid]">
                                            </div>

                                            <div class="formAreahalf ">
                                                <label class="form-label" for="cmobileno">Mobile no. of client</label>
                                                <input type="text" class="form-control gencmobileno"
                                                    name="addbg[0][g_cmobno]">
                                            </div>


                                            <div class="formAreahalf">
                                                <label class="form-label" for="cemail">Email address of client</label>
                                                <input type="email" class="form-control gencemail"
                                                    name="addbg[0][g_cemail]">
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="busdes">Business Description</label>
                                                <input type="text" class="form-control genbusdes"
                                                    id="genbusdes[0][subject]" name="addbg[0][g_busdes]">
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="buscurr">Currency of Business
                                                    Generated</label>
                                                {{-- <input type="text" class="form-control" id="genbuscurr[0][subject]"
                                            name="addbg[0][g_buscurr]"> --}}
                                                <select name="addbg[0][g_buscurr]" id="addbg[0][g_buscurr]">
                                                    <option value="" selected disabled>Please select currency
                                                    </option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="USD">USD</option>



                                                </select>
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="busamt">Amount of Business
                                                    Generated</label>
                                                <div class="dollersec"><span class="doller">$</span><span
                                                        class="input"><input type="number" class="form-control"
                                                            id="genbusamt[0][subject]" name="addbg[0][g_busamt]"></span>
                                                </div>
                                            </div>

                                            <div class="formAreahalf">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <textarea id="addbg[0][genremarks]" name="addbg[0][g_remarks]" rows="4" cols="50"></textarea>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="text-end generated"><button type="button" name="add" id="dynamic-ar2"
                                class="btn saveBtn add_potentia mb-0">Add Business Generated</button></div>
                    </div>
                </div>


                {{-- {!! Form::close() !!} --}}
        </div>
        <div class="text-center custom_next_btn pt-4 " id="append_div_btn">
            <button type="submit" id="next1" class="btn saveBtn next-step" name="next-step">Next</button>
        </div>
        </form>
    </div>





    <!-- <button type="button" name="rem1" id="rem1" class="btn saveBtn">remove</button> -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {



            $('body').on('click', '.same_client_topb', function() {
                // alert();
                // var chk=$(".same_client_topb")[0].checked;
                var chk = $(this).prop("checked");
                // alert(chk);
                if (chk == true) {
                    // alert('y');
                    var poc_name = $('#pocname').val();
                    var client_cnt = $('#ccountry').val();
                    var poc_wechat_id = $('#pocwechat').val();
                    var poc_phno = $('#pocph').val();
                    var poc_email = $('#pocemail').val();
                    // console.log("poc_name", poc_name);
                    // alert(poc_name);
                    $(this).parents('.accordion-item').find(".dc_name").val(poc_name);
                    $(this).parents('.accordion-item').find(".passcountry").val(client_cnt);
                    $(this).parents('.accordion-item').find(".wechatidc").val(poc_wechat_id);
                    $(this).parents('.accordion-item').find(".cmobileno").val(poc_phno);
                    $(this).parents('.accordion-item').find(".cemail").val(poc_email);




                } else {
                    $(this).parents('.accordion-item').find(".dc_name").val("");
                    $(this).parents('.accordion-item').find(".passcountry").val("");
                    $(this).parents('.accordion-item').find(".wechatidc").val("");
                    $(this).parents('.accordion-item').find(".cmobileno").val("");
                    $(this).parents('.accordion-item').find(".cemail").val("");
                }

            })



            $('body').on('click', '.same_client_tobg', function() {
                // alert("hi");
                // var chk=$(".same_client_topb")[0].checked;
                var chk1 = $(this).prop("checked");



                if (chk1 == true) {
                    // alert('y');
                    var poc_name = $('#dc_name').val();
                    console.log(poc_name);

                    var topb = $('#topb_class').val();
                    // alert(topb);
                    var client_cnt = $('#passcountry').val();
                    var poc_wechat_id = $('#wechatidc').val();
                    var poc_phno = $('#cmobileno').val();
                    var poc_email = $('#cemail').val();
                    var bus_desc = $('#busdes').val();
                    var other = $('#drp_spc').val();

                    // alert(other);
                    $(this).parents('.accordion-item').find(".g_drp_class").val(topb);
                    $(this).parents('.accordion-item').find(".gendcname").val(poc_name);
                    $(this).parents('.accordion-item').find(".genpasscountry").val(client_cnt);
                    $(this).parents('.accordion-item').find(".genwechatidc").val(poc_wechat_id);
                    $(this).parents('.accordion-item').find(".gencmobileno").val(poc_phno);
                    $(this).parents('.accordion-item').find(".gencemail").val(poc_email);
                    $(this).parents('.accordion-item').find(".genbusdes").val(bus_desc);
                    $(this).parents('.accordion-item').find(".g_drp_class").change();
                    $(this).parents('.accordion-item').find(".drp_spc_g").val(other);
                    $('.select_class_g').parents('.accordion-body').find('.others2').show()

                    // if (topb == "Others") {
                    //        alert('gk');

                    //        $(this).parents('.accordion-item').find(".g_drp_class").val(topb).parents('#business_generated_section').find('.others').append(
                    //             '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc" name="topb_drp_spc[' +
                    //             tpb_id + ']">');

                    //         // var tpb_id = $(this).attr('data-id');
                    //         // $(this).parents('.accordion-body').find('.others').append(
                    //         //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc" name="topb_drp_spc[' +
                    //         //     tpb_id + ']">'
                    //         // );
                    //         // ++o;

                    //     } else {
                    //         $(this).parents('.accordion-body').find('.others').html('');
                    //     }




                } else {
                    $(this).parents('.accordion-item').find(".g_drp_class").val("");
                    $(this).parents('.accordion-item').find(".gendcname").val("");
                    $(this).parents('.accordion-item').find(".genpasscountry").val("");
                    $(this).parents('.accordion-item').find(".genwechatidc").val("");
                    $(this).parents('.accordion-item').find(".gencmobileno").val("");
                    $(this).parents('.accordion-item').find(".gencemail").val("");
                    $(this).parents('.accordion-item').find(".genbusdes").val("");
                    $(this).parents('.accordion-body').find('.others').html("other");
                    $(this).parents('.accordion-item').find(".drp_spc_g").val("");
                    $(this).parents('.accordion-item').find(".drp_spc_g").val("");
                    $('.select_class_g').parents('.accordion-body').find('.others2').hide()

                }

            })

            // $("#addpb").change(function() {
            //      alert('bchange');
            //       // var option = document.getElementById("addpb").options;
            //       // if (document.getElementById('addpb[0][drp]').value == "Others") {
            //       //     // alert('b2b');
            //       //     // $("#client").append('<option>Select</option>');
            //       //     $("#ps_pb").html(
            //       //         '<lable>Please Specify</lable><input type="text">'
            //       //     );


            //       // }
            //     });



            $("#client").change(function() {
                if (($("#business").val() == "B2B" || $("#business").val() == "B2C") && ($("#client")
                        .val() == "Corporate" || $("#client").val() == "Personal")) {
                    // $("#append_div_form").html($('#FO_First').html());
                    $('#FO_First').show();
                    $(".main_class_fp").show();
                    $("#previous").attr("style", "display:block");
                    var i = 0;
                    $("#dynamic-ar").click(function() {
                        //   alert('dd');
                        ++i;
                        var I = $(this).parents('#append_div_form').find('.accordion-body').length +
                            1;

                        $("#append_div_form .card_potentials_fg").last().append(
                            `  <fieldset id="dynamicAddRemove" class="w-100 d-flex justify-content-start flex-wrap form-fields custom-form parent_field` +
                            i + ` border_sales">


                              <div class="accordion-item border_sales">
                                <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>
                                <div class="formAreahalf checkbox">
                                    <input type="checkbox" id="same_client_topb` + i + `"  class="same_client_topb" name="same_client_topb"  value="">
                                    <label for="same_client_topb` + i + `" class="form-label checkbox_label">Same Basic Information as Client?</label>
                                </div>
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

                                                <label for="clienttype" class="form-label main-head main-head-r"> Type of Potential Business ` +
                            I + ` </label>
                                                <div id="panelsStayOpen-collapseTwi` + i + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTwi` + i + `">
                                                    <div class="accordion-body d-flex flex-wrap">
                      <div class="formAreahalf ">
                        <label for="clienttype" class="form-label main-head-r"> Type of Potential Business ` +
                            I + ` </label>
                      <select name="addpb[` + i + `][drp]" id="addpb[` + i + `][drp]" class="select_class" data-id="` +
                            i + `">
                        <option value="" selected disabled>Please select type of potential business</option>
                        <option value="Wealth Management">Wealth Management</option>
                        <option value="Immigration Programme">Immigration Programme</option>
                        <option value="Family Office">Family Office</option>
                        <option value="Passport">Passport</option>
                        <option value="Real Property">Real Property</option>
                        <option value="Pure Identity Management">Pure Identity Management</option>
                        <option value="Account Services">Account Services</option>
                        <option value="Education">Education</option>
                        <option value="Bank Account Opening">Bank Account Opening</option>
                        <option value="Others" >Others</option>
                      </select>

                        </div>
                        <div class="formAreahalf others">

                        </div>
                    <div class="formAreahalf ">
                      <label class="form-label" for="dcname">Name of direct client</label>

                      <input type="text" class="form-control dc_name" id="dcname" name="addpb[` + i + `][dcname]" value="">

                    </div>
                    <div class="formAreahalf ">
                      <label class="form-label" for="passcountry">Passport Country</label>
                      <input type="text" class="form-control passcountry" name="addpb[` + i + `][passcountry]" value="">

                    </div>

                    <div class="formAreahalf ">
                      <label class="form-label" for="wechatidc">Wechat ID of client</label>

                      <input type="text" class="form-control wechatidc" name="addpb[` + i + `][wechatidc]" value="">
                    </div>

                    <div class="formAreahalf ">
                      <label class="form-label" for="cmobileno">Mobile no. of client</label>
                      <input type="text" class="form-control cmobileno" name="addpb[` + i + `][cmobileno]" value="">
                    </div>

                    <div class="formAreahalf">
                      <label class="form-label" for="cemail">Email address of client</label>
                      <input type="email" class="form-control cemail" name="addpb[` + i + `][cemail]" value="">
                    </div>

                    <div class="formAreahalf">
                      <label class="form-label" for="busdes">Business Description</label>
                      <input type="text" class="form-control" id="busdes[` + i + `][subject]" name="addpb[` + i + `][busdes]">
                    </div>

                    <div class="formAreahalf">
                      <label class="form-label" for="buscurr">Currency of Potential Business</label>

                      <select name="addpb[` + i + `][buscurr]" id="addpb[` + i + `][buscurr]">
                                                          <option value="" selected disabled>Please select currency</option>
                                                          <option value="SGD">SGD</option>
                                                          <option value="USD">USD</option>


                                                      </select>
                    </div>

                    <div class="formAreahalf">
                      <label class="form-label" for="busamt">Amount of Potential Business</label>
                      <div class="dollersec"><span class="doller">$</span><span class="input"><input type="number" class="form-control" id="busamt[0][subject]"
                                                        name="addpb[` + i + `][busamt]"></span></div>
                    </div>

                    <div class="formAreahalf">
                      <label class="form-label" for="remarks">Remarks</label>

                      <textarea id="remarks[` + i + `][subject]" name="addpb[` + i + `][remarks]" rows="4" cols="50"></textarea>

                    </div>
                </div>
                </div>
                </div>



            </fieldset>

            `)

                        // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                    });

                    // var o=0;
                    $(document).on('change', '.select_class', function() {
                        // alert($(this).val());
                        // $(".others").html(
                        //         'ojojo<input type="text">'
                        //     );
                        // console.log($(this).val());

                        if ($(this).val() == "Others") {
                            // $(this).(".others").html(
                            //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                            // );
                            var tpb_id = $(this).attr('data-id');
                            console.log("tpb_id", tpb_id);
                            $(this).parents('.accordion-body').find('.others').append(
                                // '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc" name="topb_drp_spc[' +
                                // tpb_id + ']">'
                                '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds" id="drp_spc" name="topb_drp_spc[' +
                                tpb_id + ']">'
                            );
                            // ++o;

                        } else {
                            $(this).parents('.accordion-body').find('.others').html('');
                        }


                    });


                    $(document).on('click', '.remove-input-field', function() {
                        var id = $(this).attr('data-id');
                        var c = 1;
                        $(this).parents(id).remove();
                        $('.potential-business-holder .main-head').each(function(index) {
                            var cc = c;
                            if (c == 1) cc = '';

                            $(this).parents('.accordion-item').find('.main-head-r').html(
                                'Type of Potential Business ' + cc);
                            c++;
                        });

                    });




                    var g = 0;
                    $("#dynamic-ar2").click(function() {
                        //   alert('dd');
                        ++g;

                        //var G = g + 1;
                        var G = $(this).parents('#business_generated_section').find(
                            '.accordion-body').length + 1;

                        $("#business_generated_section .card_potentials_fg").last().append(
                            ` <fieldset id="dynamicAddRemove2" class=" w-100 d-flex justify-content-start flex-wrap form-fields custom-form parent_field2` +
                            g + ` border_sales">

                            <div class="accordion-item border_sales">
                                <div class="cross"> <span class="remove-input-field2" data-id=".parent_field2` + g + `">x</span></div>
                                <div class="formAreahalf checkbox">
<input type="checkbox" id="same_client_tobg` + g + `" class="same_client_tobg Potential_business"
    name="same_client_topb" value="">
<label for="same_client_tobg` + g + `" class="form-label checkbox_label">Same as Type of Potential Business?</label>
</div>
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTw` + g + `">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseTw` + g +
                            `"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTw` +
                            g +
                            `">
                                                       <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    </button>

                                                </h2>

                                                <label for="clienttype" class="form-label main-he main-her"> Type of Generated Business ` +
                            G + ` </label>
                                                <div id="panelsStayOpen-collapseTw` + g + `"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="panelsStayOpen-headingTw` + g + `">
                                                    <div class="accordion-body d-flex flex-wrap">
                            <div class="formAreahalf ">

                                <label for="clienttype" class="form-label main-her"> Type of Generated Business ` +
                            G + ` </label>
      <select name="addbg[` + g + `][g_drp]" id="addMoreInputFields2[0][select]" class="select_class_g g_drp_class" data-id="` +
                            g + `">
        <option value="" selected disabled>Please select type of generated business</option>
        <option value="Wealth Management">Wealth Management</option>
        <option value="Immigration Programme">Immigration Programme</option>
        <option value="Family Office">Family Office</option>
        <option value="Passport">Passport</option>
        <option value="Real Property">Real Property</option>
        <option value="Pure Identity Management">Pure Identity Management</option>
        <option value="Account Services">Account Services</option>
        <option value="Education">Education</option>
        <option value="Bank Account Opening">Bank Account Opening</option>
        <option value="Others">Others</option>
      </select>
      @error('addMoreInputFields.*.subject')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
    <div class="formAreahalf others2">

                              </div>

    <div class="formAreahalf ">
      <label class="form-label" for="">Name of direct client</label>

      <input type="text" class="form-control gendcname" name="addbg[` + g + `][g_dcname]">

    </div>
    <div class="formAreahalf ">
      <label class="form-label" for="passcountry">Passport Country</label>
      <input type="text" class="form-control genpasscountry" name="addbg[` + g + `][g_passcountry]">

    </div>

    <div class="formAreahalf ">
      <label class="form-label" for="wechatidc">Wechat ID of client</label>

      <input type="text" class="form-control genwechatidc" name="addbg[` + g + `][g_wechatid]">
    </div>

    <div class="formAreahalf ">
      <label class="form-label" for="cmobileno">Mobile no. of client</label>
      <input type="text" class="form-control gencmobileno" name="addbg[` + g + `][g_cmobno]">
    </div>


    <div class="formAreahalf">
      <label class="form-label" for="cemail">Email address of client</label>
      <input type="email" class="form-control gencemail" name="addbg[` + g + `][g_cemail]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="busdes">Business Description</label>
      <input type="text" class="form-control genbusdes" id="genbusdes[0][subject]" name="addbg[` + g + `][g_busdes]">
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="buscurr">Currency of Business Generated</label>

      <select name="addbg[` + g + `][g_buscurr]" id="addbg[` + g + `][g_buscurr]">
                                          <option value="" selected disabled>Please select currency</option>
                                          <option value="SGD">SGD</option>
                                          <option value="USD">USD</option>


                                      </select>
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="busamt">Amount of Business Generated</label>
      <div class="dollersec"><span class="doller">$</span><span class="input"><input type="number" class="form-control" id="genbusamt[0][subject]"
                                        name="addbg[` + g + `][g_busamt]"></span></div>
    </div>

    <div class="formAreahalf">
      <label class="form-label" for="remarks">Remarks</label>

      <textarea id="addbg[0][genremarks]" name="addbg[` + g + `][g_remarks]" rows="4" cols="50"></textarea>

    </div>


    <!-- <input type="submit" name="submit" class="submit btn saveBtn" id="next1" name="next1" value="Next" style='margin-left:30%' /> -->


<!-- </div> -->
<div id="addbg"></div></div></div></div>
</fieldset>

  `)

                        // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                    });

                    $(document).on('change', '.select_class_g', function() {

                        // $(".others").html(
                        //         'ojojo<input type="text">'
                        //     );
                        // console.log($(this).val());

                        if ($(this).val() == "Others") {


                            // $(this).(".others").html(
                            //     '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control" id="drp_spc" name="drp_spc">'
                            // );
                            var tgb_id = $(this).attr('data-id');
                            $(this).parents('.accordion-body').find('.others2').empty()
                            $(this).parents('.accordion-body').find('.others2').append(
                                '<label for="" class="form-label">Please Specify</label><input type="text" class="form-control sds drp_spc_g" id="drp_spc_g" name="togb_drp_spc[' +
                                tgb_id + ']">'

                            );

                            // ++o;

                        } else {
                            $(this).parents('.accordion-body').find('.others2').html('');
                        }


                    });

                    $(document).on('click', '.remove-input-field2', function() {
                        var id = $(this).attr('data-id');
                        $(this).parents(id).remove();
                        var c = 1;
                        $('#business_generated_section .main-he').each(function(index) {
                            var cc = c;
                            if (c == 1) cc = '';

                            $(this).parents('.accordion-item').find('.main-her').html(
                                'Type of Generated Business ' + cc);
                            c++;
                        });
                    });


                } else {
                    $('#FO_First').hide();
                    $(".main_class_fp").hide();
                    $("#previous").attr("style", "display:block");
                }
            });



            $("#business").change(function() {
                //  alert('bchange');
                var option = document.getElementById("client").options;
                if (document.getElementById('business').value == "B2B") {
                    // alert('b2b');
                    // $("#client").append('<option>Select</option>');
                    $("#client").html(
                        '<option value="" selected disabled>Please select client type</option><option value="Personal">Personal</option><option value="Corporate">Corporate</option>'
                    );
                    // alert('empty');
                    $("#signdiv").html(`<label for="clienttype" class="form-label">Sign of B2B Agreement?</label>
                                    <select class="" name="sign" id="sign">
                                        <option value="No">No</option>
                                         <option value="Yes">Yes</option>

                                    </select>`);
                    $("#b2bsigndatediv").html(
                        '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
                    );
                    $("#b2bexdatediv").html(
                        '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
                    );
                    $("#renewlremdiv").html(
                        '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><input type="" class="form-control" id="renewlrem" name="renewlrem" placeholder="-" disabled>'
                    );
                    $("#renewlfrediv").html(
                        '<label for="clienttype" class="form-label"> Agreement Renewal Frequency</label><input type="" class="form-control" id="renewlfre" name="renewlfre" placeholder="-" disabled>'
                    );
                    // alert(document.getElementById('sign').value);

                    $("#sign").change(function() {
                        if (document.getElementById('sign').value == "Yes") {
                            $("#b2bsigndatediv").html(
                                '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate" >'
                            );
                            $("#b2bexdatediv").html(
                                '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="date" class="form-control" id="b2bexdate" name="b2bexdate">'
                            );

                            $("#renewlremdiv").html(
                                '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><select name="renewlrem" id="renewlrem"><option value="" selected disabled>Please select</option><option value="90 days before expiry">90 days before expiry</option><option value="120 days before expiry">120 days before expiry</option><option value="180 days before expiry">180 days before expiry</option></select>'
                            );
                            $("#renewlfrediv").html(
                                ` <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span class="select"><select
                                        name="renewlfre" id="renewlfre">
                                        <option value="" selected disabled>Please select</option>
                                        <option value="Day">Day</option>
                                        <option value="3 Days">3 Days</option>
                                        <option value="Week">Week</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="4 Weeks">4 Weeks</option>



                                    </select>
                                </span>`
                            );

                        } else {
                            $("#b2bsigndatediv").html(
                                '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
                            );
                            $("#b2bexdatediv").html(
                                '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
                            );
                            $("#renewlremdiv").html(
                                '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><input type="" class="form-control" id="renewlrem" name="renewlrem" placeholder="-" disabled>'
                            );
                            $("#renewlfrediv").html(
                                '<label for="clienttype" class="form-label"> Agreement Renewal Frequency</label><input type="" class="form-control" id="renewlfre" name="renewlfre" placeholder="-" disabled>'
                            );

                        }
                    })
                    //     if (document.getElementById('sign').value == "Yes") {
                    //         alert('yes');
                    //     $("#b2bsigndatediv").html(
                    //         '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate" >'
                    //     );
                    //     $("#b2bexdatediv").html(
                    //         '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="date" class="form-control" id="b2bexdate" name="b2bexdate">'
                    //     );

                    //     $("#renewlremdiv").html(
                    //         '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><select name="renewlrem" id="renewlrem"><option value="" selected disabled>Please select</option><option value="90 days before expiry">90 days before expiry</option><option value="120 days before expiry">120 days before expiry</option><option value="180 days before expiry">180 days before expiry</option></select>'
                    //     );
                    //     $("#renewlfrediv").html(
                    //         ` <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                //             <div class="select_box"><span class="every">Every</span><span class="select"><select
                //                         name="renewlfre" id="renewlfre">
                //                         <option value="" selected disabled>Please select</option>
                //                         <option value="Day">Day</option>
                //                         <option value="3 Days">3 Days</option>
                //                         <option value="Week">Week</option>
                //                         <option value="2 Weeks">2 Weeks</option>



                //                     </select>
                //                 </span>`
                    //     );

                    // } else if (document.getElementById('sign').value == "No"){
                    //     alert('no');
                    //     $("#b2bsigndatediv").html(
                    //         '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
                    //     );
                    //     $("#b2bexdatediv").html(
                    //         '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
                    //     );
                    //     $("#renewlremdiv").html(
                    //         '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><input type="" class="form-control" id="renewlrem" name="renewlrem" placeholder="-" disabled>'
                    //     );
                    //     $("#renewlfrediv").html(
                    //         '<label for="clienttype" class="form-label"> Agreement Renewal Frequency</label><input type="" class="form-control" id="renewlfre" name="renewlfre" placeholder="-" disabled>'
                    //     );

                    // }

                    // else {

                    // }




                }
                if (document.getElementById('business').value == "B2C") {
                    // alert('b2b');
                    // $("#client").append('<option>Select</option>');
                    $("#client").html(
                        '<option value="" selected disabled>Please select client type</option><option value="Personal">Personal</option>'
                    );
                    // $("#sign").html('');
                    $("#b2bsigndatediv").html('');
                    $("#b2bexdatediv").html('');
                    $("#renewlremdiv").html('');

                    $("#renewlfrediv").html('');
                    $("#signdiv").html('');


                }
                // $("#client").val('')
                //                 if (($("#business").val() == "B2B" || $("#business").val() == "B2C") && ($("#client")
                //                         .val() == "Corporate" || $("#client").val() == "Personal")) {
                //                     // $("#append_div_form").html($('#FO_First').html());
                //                     $('#FO_First').show();
                //                     $(".main_class_fp").show();
                //                     $("#previous").attr("style", "display:block");


                //                     var i = 0;
                //                     $("#dynamic-ar").click(function() {
                //                         //   alert('dd');
                //                         ++i;
                //                         var I = i + 1;
                //                         $("#dynamicAddRemove").append(
                //                             `    <fieldset id="dynamicAddRemove" class="w-100 d-flex justify-content-start flex-wrap form-fields custom-form parent_field` +
                //                             i + `">
            //     <div class="cross"><span class="remove-input-field" data-id=".parent_field` + i + `">x</span></div>

            //     <div class="accordion-item">
            //                                                 <h2 class="accordion-header" id="panelsStayOpen-headingTwi` + i + `">
            //                                                     <button class="accordion-button" type="button"
            //                                                         data-bs-toggle="collapse"
            //                                                         data-bs-target="#panelsStayOpen-collapseTwi` + i +
                //                             `"
            //                                                         aria-expanded="true" aria-controls="panelsStayOpen-collapseTwi` +
                //                             i +
                //                             `">
            //                                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
            //                                                     </button>

            //                                                 </h2>
            //                                                 <label for="clienttype" class="form-label"> Type of Potential Business ` +
                //                             I + ` </label>
            //                                                 <div id="panelsStayOpen-collapseTwi` + i + `"
            //                                                     class="accordion-collapse collapse show"
            //                                                     aria-labelledby="panelsStayOpen-headingTwi` + i + `">
            //                                                     <div class="accordion-body d-flex flex-wrap">
            //       <div class="formAreahalf ">


            //       <select name="addpb[` + i + `][drp]" id="addpb[` + i + `][drp]">
            //         <option value="" selected disabled>Please select type of potential business</option>
            //         <option value="Wealth Management">Wealth Management</option>
            //         <option value="Immigration Programme">Immigration Programme</option>
            //         <option value="Family Office">Family Office</option>
            //         <option value="Passport">Passport</option>
            //         <option value="Real Property">Real Property</option>
            //         <option value="Pure Identity Management">Pure Identity Management</option>
            //         <option value="Account Services">Account Services</option>
            //         <option value="Education">Education</option>
            //         <option value="Bank Account Opening">Bank Account Opening</option>
            //         <option value="Others">Others</option>
            //       </select>

            //          </div>
            //          <div class="formAreahalf ">

            //                               </div>
            //     <div class="formAreahalf ">
            //       <label class="form-label" for="dcname">Name of direct client</label>

            //       <input type="text" class="form-control" id="dcname[` + i + `][subject]" name="addpb[` + i + `][dcname]">

            //     </div>
            //     <div class="formAreahalf ">
            //       <label class="form-label" for="passcountry">Passport Country</label>
            //       <input type="text" class="form-control" id="passcountry[` + i + `][subject]" name="addpb[` + i + `][passcountry]">

            //     </div>

            //     <div class="formAreahalf ">
            //       <label class="form-label" for="wechatidc">Wechat ID of client</label>

            //       <input type="text" class="form-control" id="wechatidc[` + i + `][subject]" name="addpb[` + i + `][wechatidc]">
            //     </div>

            //     <div class="formAreahalf ">
            //       <label class="form-label" for="cmobileno">Mobile no. of Client</label>
            //       <input type="text" class="form-control" id="cmobileno[` + i + `][subject]" name="addpb[` + i + `][cmobileno]">
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="cemail">Email address of client</label>
            //       <input type="email" class="form-control" id="cemail[` + i + `][subject]" name="addpb[` + i + `][cemail]">
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="busdes">Business Description</label>
            //       <input type="text" class="form-control" id="busdes[` + i + `][subject]" name="addpb[` + i + `][busdes]">
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="buscurr">Currency of Bussiness Generated</label>

            //       <select name="addpb[` + i + `][buscurr]" id="addpb[` + i + `][buscurr]">
            //                                           <option value="" selected disabled>Please select currency</option>
            //                                           <option value="SGD">SGD</option>
            //                                           <option value="USD">USD</option>


            //                                       </select>
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="busamt">Amount of bussiness generated</label>
            //       <div class="dollersec"><span class="doller">$</span><span class="input"><input type="text" class="form-control" id="busamt[0][subject]"
            //                                         name="addpb[` + i + `][busamt]"></span></div>
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="remarks">Remarks</label>

            //       <textarea id="remarks[` + i + `][subject]" name="addpb[` + i + `][remarks]" rows="4" cols="50">
            //                 </textarea>

            //     </div>

            //   </div>
            // </div>

            // </div>


            //   </fieldset>

            //   `)

                //                         // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                //                     });
                //                     $(document).on('click', '.remove-input-field', function() {
                //                         // alert('hij');
                //                         var id = $(this).attr('data-id');
                //                         console.log(id);
                //                         // alert(id);
                //                         $(this).parents(id).remove();
                //                     });
                //                     var g = 0;
                //                     $("#dynamic-ar2").click(function() {
                //                         //   alert('dd');
                //                         ++g;

                //                         var G = g + 1;
                //                         $("#dynamicAddRemove2").append(
                //                             ` <fieldset id="dynamicAddRemove2" class=" w-100 d-flex justify-content-start flex-wrap form-fields type-of-buss-gen custom-form cross-btn parent_field2` +
                //                             g + `">

            //                             <div class="cross"><span class="remove-input-field2" data-id=".parent_field2` + g + `">x</span></div>
            //                             <div class="accordion-item">
            //                                                 <h2 class="accordion-header" id="panelsStayOpen-headingTw` + g + `">
            //                                                     <button class="accordion-button" type="button"
            //                                                         data-bs-toggle="collapse"
            //                                                         data-bs-target="#panelsStayOpen-collapseTw` + g +
                //                             `"
            //                                                         aria-expanded="true" aria-controls="panelsStayOpen-collapseTw` +
                //                             g +
                //                             `">
            //                                                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
            //                                                     </button>

            //                                                 </h2>
            //                                                 <label for="clienttype" class="form-label"> Type of Generated  Business ` +
                //                             G + ` </label>
            //                                                 <div id="panelsStayOpen-collapseTw` + g + `"
            //                                                     class="accordion-collapse collapse show"
            //                                                     aria-labelledby="panelsStayOpen-headingTw` + g + `">
            //                                                     <div class="accordion-body d-flex flex-wrap">
            //     <div class="formAreahalf ">


            //       <select name="addbg[` + g + `][g_drp]" id="addMoreInputFields2[0][select]">
            //         <option value="" selected disabled>Please select type of generated business</option>
            //         <option value="Wealth Management">Wealth Management</option>
            //         <option value="Immigration Programme">Immigration Programme</option>
            //         <option value="Family Office">Family Office</option>
            //         <option value="Passport">Passport</option>
            //         <option value="Real Property">Real Property</option>
            //         <option value="Pure Identity Management">Pure Identity Management</option>
            //         <option value="Account Services">Account Services</option>
            //         <option value="Education">Education</option>
            //         <option value="Bank Account Opening">Bank Account Opening</option>
            //         <option value="Others">Others</option>
            //       </select>
            //       @error('addMoreInputFields.*.subject')
            //       <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            //       @enderror
            //     </div>
            //     <div class="formAreahalf ">

            //                               </div>
            //     <div class="formAreahalf ">
            //       <label class="form-label" for="">Name of direct client</label>

            //       <input type="text" class="form-control" id="gendcname[0][subject]" name="addbg[` + g + `][g_dcname]">

            //     </div>
            //     <div class="formAreahalf ">
            //       <label class="form-label" for="passcountry">Passport Country</label>
            //       <input type="text" class="form-control" id="genpasscountry[0][subject]" name="addbg[` + g + `][g_passcountry]">

            //     </div>

            //     <div class="formAreahalf ">
            //       <label class="form-label" for="wechatidc">Wechat ID of client</label>

            //       <input type="text" class="form-control" id="genwechatidc[0][subject]" name="addbg[` + g + `][g_wechatid]">
            //     </div>

            //     <div class="formAreahalf ">
            //       <label class="form-label" for="cmobileno">Mobile no. of client</label>
            //       <input type="text" class="form-control" id="gencmobileno[0][subject]" name="addbg[` + g + `][g_cmobno]">
            //     </div>


            //     <div class="formAreahalf">
            //       <label class="form-label" for="cemail">Email address of client</label>
            //       <input type="email" class="form-control" id="gencemail[0][subject]" name="addbg[` + g + `][g_cemail]">
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="busdes">Business Description</label>
            //       <input type="text" class="form-control" id="genbusdes[0][subject]" name="addbg[` + g + `][g_busdes]">
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="buscurr">Currency of Business Generated</label>
            //       <select name="addbg[` + g + `][g_buscurr]" id="addbg[` + g + `][g_buscurr]">
            //                                           <option value="" selected disabled>Please select currency</option>
            //                                           <option value="SGD">SGD</option>
            //                                           <option value="USD">USD</option>


            //                                       </select>

            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="busamt">Amount of business generated</label>
            //       <div class="dollersec"><span class="doller">$</span><span class="input"><input type="text" class="form-control" id="genbusamt[0][subject]"
            //                                         name="addbg[` + g + `][g_busamt]"></span></div>
            //     </div>

            //     <div class="formAreahalf">
            //       <label class="form-label" for="remarks">Remarks</label>

            //       <textarea id="addbg[0][genremarks]" name="addbg[` + g + `][g_remarks]" rows="4" cols="50">
            //                 </textarea>

            //     </div>


            //     <!-- <input type="submit" name="submit" class="submit btn saveBtn" id="next1" name="next1" value="Next" style='margin-left:30%' /> -->


            // <!-- </div> -->
            // <div id="addbg"></div>
            // </div></div></div>
            // </fieldset>

            //   `)

                //                         // <button type="button" class="btn btn-outline-danger remove-input-field" data-id=".parent_field`+i+`">Delete</button>
                //                     });
                //                     $(document).on('click', '.remove-input-field2', function() {
                //                         var id = $(this).attr('data-id');
                //                         console.log(id);
                //                         $(this).parents(id).remove();
                //                     });
                //                 } else {
                //                     $('#FO_First').hide();
                //                     $(".main_class_fp").hide();
                //                     // $("#append_div_form").html("");
                //                     $("#previous").attr("style", "display:block");
                //                 }
            });

            $("#sign").change(function() {
                alert(document.getElementById('sign').value);
                // alert('schange');
                // var option = document.getElementById("client").options;

                if (document.getElementById('sign').value == "Yes") {
                    $("#b2bsigndatediv").html(
                        '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="date" class="form-control" id="b2bsigndate" name="b2bsigndate" >'
                    );
                    $("#b2bexdatediv").html(
                        '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="date" class="form-control" id="b2bexdate" name="b2bexdate">'
                    );

                    $("#renewlremdiv").html(
                        '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><select name="renewlrem" id="renewlrem"><option value="" selected disabled>Please select</option><option value="90 days before expiry">90 days before expiry</option><option value="120 days before expiry">120 days before expiry</option><option value="180 days before expiry">180 days before expiry</option></select>'
                    );
                    $("#renewlfrediv").html(
                        ` <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                            <div class="select_box"><span class="every">Every</span><span class="select"><select
                                        name="renewlfre" id="renewlfre">
                                        <option value="" selected disabled>Please select</option>
                                        <option value="Day">Day</option>
                                        <option value="3 Days">3 Days</option>
                                        <option value="Week">Week</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="4 Weeks">4 Weeks</option>



                                    </select>
                                </span>`
                    );

                } else {
                    $("#b2bsigndatediv").html(
                        '   <label for="" class="form-label">B2B Agreement Sign Date</label><input type="" class="form-control" id="b2bsigndate" name="b2bsigndate" placeholder="-" disabled>'
                    );
                    $("#b2bexdatediv").html(
                        '<label for="" class="form-label">B2B Agreement Expiry Date</label><input type="" class="form-control" id="b2bexdate" name="b2bexdate" placeholder="-" disabled>'
                    );
                    $("#renewlremdiv").html(
                        '<label for="clienttype" class="form-label"> Agreement Renewal Reminder</label><input type="" class="form-control" id="renewlrem" name="renewlrem" placeholder="-" disabled>'
                    );
                    $("#renewlfrediv").html(
                        '<label for="clienttype" class="form-label"> Agreement Renewal Frequency</label><input type="" class="form-control" id="renewlfre" name="renewlfre" placeholder="-" disabled>'
                    );

                }
            });



            $("#multistep_form").validate({

                rules: {
                    business: {
                        required: true
                    },
                    client: {
                        required: true
                    },
                    // cname: {
                    //     required: true
                    // },

                    pocph: {
                        minlength: 6,
                        maxlength: 10,
                        digits: true
                    },

                    pocemail: {
                        email: true
                    },
                },
                messages: {
                    pocph: "Please enter valid phone number",

                }
            })
            // $('#next1').on('click', function() {

            //     $("#multistep_form").valid();

            // });

            $('body').on('click', '#next1', function() {
                // var client = $('.same_client_topb').prop("checked");
                // var business = $('.Potential_business').prop("checked");
                // var clientfieldLength = $('input[name^="addpb"]').val().length;
                // console.log("clientfieldLength", clientfieldLength);
                // var clientfield = $('select[name^="addpb"]');
                // var businessfield = $('select[name^="addbg"]');
                // if (client == true) {
                // clientfield.each(function() {
                //     $(this).rules("add", {
                //         required: true,
                //     });
                // });
                //  } else {
                // clientfield.each(function() {
                //     $(this).rules("add", {
                //         required: false,
                //     });
                // });
                // }
                // if (business == true) {
                // businessfield.each(function() {
                //     $(this).rules("add", {
                //         required: true,
                //     });
                // });
                // } else {
                //     businessfield.each(function() {
                //         $(this).rules("add", {
                //             required: false,
                //         });
                //     });
                // }
                const valid = $("#multistep_form").valid();
                if (valid == true) {
                    console.log("validddd")
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('sales.save') }}",
                        type: "POST",
                        data: $('#multistep_form').serialize(),
                        success: function(response) {
                            console.log(response.input.view_id);
                            const el = document.createElement('div')
                            el.innerHTML =

                                `<p class='view-application'>You can view Application <a href='/salesshow/` +
                                response.input.view_id + `'>here</a>`
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
                                window.location.reload()

                            })
                        }
                    });
                }
            })


        });
    </script>
@endpush
