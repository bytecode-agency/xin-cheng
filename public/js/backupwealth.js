$(document).ready(function () {
    var form_count = 1,
        form_count_form, next_form, total_forms;

    total_forms = $("fieldset").length;
    var form = $("#multistep_form");
    var i = 0;
    var sh_no = 0;
    var nfo_sh_no = 0;

    function setProgressBar(curStep) {
        var data = $('#' + curStep).addClass("active");
    };

    $("#business_type").change(function () {

        if ($("#business_type").val() == "FO") {
            $("#append_div_form").html($('#FO_First').html());
            $("#nav_list").html($('#nav_list_add_fo').html());
            $("#previous1").attr("style", "display:block");
        } else {
            $("#append_div_form").html($('#NFO_First').html());
            $("#nav_list").html($('#nav_list_add_nfo').html());
            $("#previous1").attr("style", "display:block");
            $("#non_business_type").val('Non-FO');

            $("#nfo_client_type").change(function () {
                if ($('#nfo_client_type').val() == "Corporate") {
                    $('#nfo_client_types').val('Corporate');
                    $("#nav_list").html($('#nav_list_add_nfo_corporate').html());
                } else {
                    $('#nfo_client_types').val('Personal');
                }
            });
        }
    });

    $('.next1').click(function () {
        form.validate({
            rules: {
                business_type: {
                    required: true
                },
                client_type: {
                    required: true
                },
                type_of_fo: {
                    required: true
                },
                servicing_fee: {
                    required: true,
                    number: true
                },
                servicing_fee_currency: {
                    required: true
                },
                servicing_fee_status: {
                    required: true
                },
                annual_servicing_fee: {
                    required: true,
                    number: true
                },
                annual_fee_currency: {
                    required: true
                },
                annual_fee_status: {
                    required: true
                },
                nfo_client_type: {
                    required: true
                },
            },
        });
        if (form.valid() === true) {
            if ($("#business_type").val() == "Non-FO") {

                if ($('#nfo_client_type').val() == "Personal") {
                    let next = $('#NFO_personal').attr('id');
                    $('#start_field').hide();
                    $('#' + next).show();
                } else {
                    let next = $('#NFO_corporate').attr('id');
                    $('#start_field').hide();
                    $('#' + next).show();
                }
            } else {
                let next = $('#' + this.id).closest('fieldset').next('fieldset').attr('id');
                $('#start_field').hide();
                $('#' + next).show();
            }
        }
    });
    $('#previous1').click(function () {
        if ($("#business_type").val() == "FO") {
            $('#append_div_form').html("");
            $("#nav_list").html(
                '<li class="list-group-item active"><a href="#">1</a><p> Business Details </p></li>'
            );

            $('#business_type').val("");
            $('#business_type option[value="-1"]').prop("selected", true);
        } else {
            $('#append_div_form').html("");
            $("#nav_list").html(
                '<li class="list-group-item active"><a href="#">1</a><p> Business Details </p></li>'
            );
            $('#business_type').val("");
            $('#business_type option[value="-1"]').prop("selected", true);
        }
    });

    $('body').on('click', '.previous', function () {
        let current = $(this).closest("fieldset").attr('id');
        $('#' + current).hide();
        let previous = $(this).closest("fieldset").prev().attr('id');
        $('#' + previous).show();
    });

    $('#previous5').click(function () {
        $('#NFO_personal').hide();
        $('#start_field').show();
    });
    $('body').on('click', '.previous2_nfo', function () {
        $('#NFO_corporate').hide();
        $('#start_field').show();
    });
    $('.add_company').click(function () {
        i++;
        // $('#appended_company_div').append($('#fo_company').html());
        $('#appended_company_div').append(
            `<div id="fo_company" data-id=`+i+`><div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                <span class="cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="formAreahalf company-full_width_Cstm"> \
                    <label for="fo_compnay" class="form-label">Company Name ` + (i + 1) + `</label>\
                    <input type="text" name="cmp[` + i + `][fo_company]" id="fo_compnay" class="form-control" value="">\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_uen" class="form-label">UEN</label>\
                    <input type="text" class="form-control" name="cmp[` + i + `][fo_uen]" id="fo_uen">\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_company_add" class="form-label">Company Address</label>\
                    <input type="text" class="form-control" name="cmp[` + i + `][fo_company_add]" id="fo_company_add">\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>\
                    <input type="text" class="form-control" name="cmp[` + i + `][fo_incorporation_date]" id="fo_incorporation_date">\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_company_email" class="form-label">Company Email</label>\
                    <input type="text" class="form-control" name="cmp[` + i + `][fo_company_email]" id="fo_company_email">\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_company_pass" class="form-label">Company Password</label>\
                    <input type="text" class="form-control" name="cmp[` + i + `][fo_company_pass]" id="fo_company_pass">\
                </div>\
            </div></div>`
        )
    });

    $('body').on('click', '.add_shareholder', function () {
        var arr_id = $(this).parents('fieldset').find('#next3').attr('data-id');
        sh_no++;
        // $('#appended_shareholder_div').append($('#fo_shareholder').html());
        $(this).parents('fieldset').find('#appended_shareholder_div').append(
            `<div id="fo_shareholder" class="sharehold">\
                <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                    <span class="cancel_shareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
                    <div class="Share_holder-w sub-heading">\
                        <h4>Shareholder </h4>\
                    </div>\                           
                    <div class="formAreahalf">\
                        <label for="fo_equity" class="form-label">Equity Percentage</label>\
                        <input type="text" name="share[` + (arr_id - 1) + `][` + sh_no + `][fo_equity]" id="fo_equity" class="form-control" value="">\
                    </div> <div class="formAreahalf">\
                        <label for="fo_shrholder_type" class="form-label">Shareholder Type</label>\
                        <select name="share[` + (arr_id - 1) + `][` + sh_no + `][fo_shrholder_type]" id="fo_shrholder_type" class="fo_shrholder_type">\
                            <option value="" selected disabled>Please select shareholder type</option>\
                            <option value="Company">Company</option>\
                            <option value="Personal">Personal</option>\
                        </select>\
                    </div>\
                    <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                    </div>\
                </div></div>`
        );


    });
    var arr = "";
    $('body').on('click', '.next2', function () {

        arr = $('input[id=fo_compnay]').map(function () {
            return this.value;
        }).get();

        $('#FO_company').hide();

        if (arr.length >= 2) {
            $('.FO_shareholder').css("display", "block");
            $('.FO_shareholder').html(`<div class="full_div"><div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name 1</h4>
                            <h6>` + arr[0] + `</h6>
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
                                <li class="list-group-item active" id="3">
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
                    <div id="fo_shareholder" class="sharehold">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[0][0][fo_equity]" id="fo_equity" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Shareholder Type</label>
                                <select name="share[0][0][fo_shrholder_type]" id="fo_shrholder_type" class="fo_shrholder_type">
                                    <option value="" selected disabled>Please select shareholder type</option>
                                    <option value="Company">Company</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
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
                    <button type="button" id="next3" class="btn saveBtn next3" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>
                </div>`);
        } else {
            $('.FO_shareholder').css("display", "block");
            $('.FO_shareholder').html(`<div class="card formContentData border-0 p-4">
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
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Details </p>
                                </li>
                                <li class="list-group-item active" id="3">
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
                    <div id="fo_shareholder" class="sharehold">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder</h4>
                            </div>
                            <div class="formAreahalf"> 
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[0][0][fo_equity]" id="fo_equity" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Shareholder Type</label>
                                <select name="share[0][0][fo_shrholder_type]" id="fo_shrholder_type" class="fo_shrholder_type">
                                    <option value="" selected disabled>Please select shareholder type</option>
                                    <option value="Company">Company</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
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
                    <button type="button" id="next3" class="btn saveBtn fo_form_sub" data-id="1">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div>`);

        }
    });

    var btn_click = "";
    $('body').on('click', '.next3', function () {
        sh_no = 0;
        var share_hold = $('input[id=fo_pass_name]').map(function () {
            return this.value;
        }).get();
        var isLastElement1 = arr.length - 1;
        btn_click = $(this).attr('data-id');
        // $.each(arr, function(key, value) {               
        let btn_id = "";
        if (btn_click == isLastElement1) {
            btn_id = "fo_form_sub";
        } else {
            btn_id = "next3";
        }
        btn_click++;
        $(this).parents('fieldset').find('.full_div').hide();
        $('.FO_shareholder_extra').append(`
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
                                <li class="list-group-item active" id="2">
                                    <a href="#">2</a>
                                    <p> Company Details </p>
                                </li>
                                <li class="list-group-item active" id="3">
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
                    <div id="fo_shareholder" class="sharehold">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="share[` + (btn_click - 1) + `][0][fo_equity]" id="fo_equity" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Shareholder Type</label>
                                <select name="share[` + (btn_click - 1) + `][0][fo_shrholder_type]" id="fo_shrholder_type" class="fo_shrholder_type">
                                    <option value="" selected disabled>Please select shareholder type</option>
                                    <option value="Company">Company</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
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
                    <button type="button" id="next3" class="btn saveBtn ` + btn_id + `" data-id="` +
            btn_click + `">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previouss" data-id="` +
            btn_click + `">Back</button>
                </div></div>`);
    });

    $('body').on('click', '.previouss', function () {

        back_btn_click = "";
        var id = $(this).attr('data-id');

        if (id == 2) {
            back_btn_click = "previous";

        } else {
            back_btn_click = "previouss";
        }
        id--;
        $(this).parents('fieldset').find('.full_div').hide();
        $('.FO_shareholder_extra').html(`
        <div class="full_div">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name ` + id + `</h4>
                            <h6>` + arr[id - 1] + `</h6>
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
                                <li class="list-group-item active" id="3">
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
                    <div id="fo_shareholder" class="sharehold">
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Equity Percentage</label>
                                <input type="text" name="fo_equity" id="fo_equity" class="form-control" value="">
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity" class="form-label">Shareholder Type</label>
                                <select name="fo_shareholder_type" id="fo_shrholder_type" class="fo_shrholder_type">
                                    <option value="" selected disabled>Please select shareholder type</option>
                                    <option value="Company">Company</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                class="w-100 d-flex justify-content-start flex-wrap"></div>
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
                    <button type="button" id="next3" class="btn saveBtn next3">Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn ` + back_btn_click +
            `" data-id ="` + id + `" >Back</button>
                </div></div>`);


    });

    $('body').on('click', '.fo_form_sub', function () {
        var formdata = $('form').serialize();
        var url = "{{route('wealth-create')}}";
        console.log(formdata);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: '/add',
            data: formdata,
            success: function (response) {

                console.log(response);
                const el = document.createElement('div');

                el.innerHTML =
                    "You can view Application <a class='view-application' href='/wealth'>here</a>"
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
                    // $('#multistep_form')[0].reset();
                    window.location = "/wealth-add";
                })
            }
        });
    });

    $('body').on('change', '.fo_shrholder_type', function () {

        var shr_arr_id = $(this).parents('fieldset').find('#next3').attr('data-id');

        if ($(this).val() == "Company") {
            $(this).parents('#fo_shareholder').find(
                "#appended_user_shareholder_cmp2_selcection_div")
                .html(`<div id="FO_shrhold_c2_company" class="added_shareholder_cmp2 w-100 d-flex justify-content-start flex-wrap"">
                        <div class="formAreahalf">
                            <label for="fo_cpm2_cmpname" class="form-label">Company Name</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_cmpname]" id="fo_cpm2_cmpname" class="form-control">
                        </div>
                     </div>`);
        } else {
            // $(this).parents('#fo_shareholder').find(
            //     "#appended_user_shareholder_cmp2_selcection_div").html($(
            //         '#FO_shrhold_c2_personal')
            //     .html());
            $(this).parents('#fo_shareholder').find(
                "#appended_user_shareholder_cmp2_selcection_div")
                .html(`<div id="FO_shrhold_c2_personal" class="added_shareholder_cmp2 w-100 d-flex justify-content-start flex-wrap"">
                        <div class="formAreahalf">
                            <label for="fo_cpm2_passname" class="form-label">Passport Full Name(Eng)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_passname]" id="fo_cpm2_passname" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_ch" class="form-label">Passport Full Name(Chinese)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_ch]" id="fo_cpm2_pass_ch" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_gender" class="form-label">Gender</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_gender]" id="fo_cpm2_gender" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_dob" class="form-label">DOB(MM/DD/YYYY)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_dob]" id="fo_cpm2_dob" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_no" class="form-label">Passport Number</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_no]" id="fo_cpm2_pass_no" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_cnty" class="form-label">Passport Country</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_cnty]" id="fo_cpm2_pass_cnty" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_exp]" id="fo_cpm2_pass_exp" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_renew" class="form-label">Passport Renewal Reminder</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_renew]" id="fo_cpm2_pass_renew" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_pass_frq]" id="fo_cpm2_pass_frq" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_email" class="form-label">Email</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_email]" id="fo_cpm2_email" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_tin_ctry]" id="fo_cpm2_tin_ctry" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_res_add" class="form-label">Residential Add.(according to Add. proof)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_res_add]" id="fo_cpm2_res_add" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_type" class="form-label">Type of TIN</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_tin_type]" id="fo_cpm2_tin_type" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_num" class="form-label">Current TIN Number</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_tin_num]" id="fo_cpm2_tin_num" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_sal" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_sal]" id="fo_cpm2_sal" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_job_title" class="form-label">Job Title</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_job_title]" id="fo_cpm2_job_title" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_phone" class="form-label">Phone Number</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_phone]" id="fo_cpm2_phone" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_relation" class="form-label">Relationship with shareholder 1</label>
                            <input type="text" name="share[` + (shr_arr_id - 1) + `][` + sh_no + `][fo_cpm2_relation]" id="fo_cpm2_relation" class="form-control" value="">
                        </div>
                    </div>`);
        }
    });
    var n_i = 0;
    $('.add_corporate').click(function () {
        n_i++;
        // $('#appended_corporate_div').append($('#nfo_corporate').html());
        $('#appended_corporate_div').append(
            `<div id="nfo_corporate" class="corporate">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                <span class="cancel_nfocompany cancel_company "><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="formAreahalf company-full_width_Cstm">\
                    <label for="nfo_compnay" class="form-label">Company Name `+ (n_i + 1) + `</label>\
                    <input type="text" name="corporate[` + n_i + `][nfo_company]" id="nfo_compnay" class="form-control" value="">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_uen" class="form-label">UEN</label>\
                    <input type="text" class="form-control" name="corporate[` + n_i + `][nfo_uen]" id="nfo_uen">\
            </div>\
            <div class="formAreahalf">\
                <label for="nfo_company_add" class="form-label">Company Address</label>\
                <input type="text" class="form-control" name="corporate[` + n_i + `][nfo_company_add]" id="nfo_company_add">\
            </div>\
            <div class="formAreahalf">\
                <label for="nfo_incorporation_date" class="form-label">Incorporation Date</label>\
                                    <input type="text" class="form-control" name="corporate[` + n_i + `][nfo_incorporation_date]" nid="nfo_incorporation_date">\
            </div>\
            <div class="formAreahalf">\
                <label for="nfo_company_email" class="form-label">Company Email</label>\
                <input type="text" class="form-control" name="corporate[` + n_i + `][nfo_company_email]" id="nfo_company_email">\
            </div>\
            <div class="formAreahalf">\
                <label for="nfo_company_pass" class="form-label">Company Password</label>\
                <input type="text" class="form-control" name="corporate[` + n_i + `][nfo_company_pass]" id="nfo_company_pass">\
                </div>\
            </div></div>`
        );
    });
    $('body').on('click', '.next_nfo_2', function () {
        // if (form.valid() === true) {
        //     let next = $('#NFO_shareholder').attr('id');
        //     $('#' + next).show();
        //     $('#NFO_corporate').hide();
        // }
        nfo_arr = $('input[id=nfo_compnay]').map(function () {
            return this.value;
        }).get();

        $('#NFO_corporate').hide();
        if (nfo_arr.length >= 2) {
            $('.NFO_shareholder').css("display", "block");
            $('.NFO_shareholder').html(`<div class="nfo_full_div"><div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Name 1</h4>
                        <h6>` + nfo_arr[0] + `</h6>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">3</a>
                                <p> Shareholder</p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nfo_shareholder">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="Share_holder-w sub-heading">
                            <h4>Shareholder #1</h4>
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_equity" class="form-label">Equity Percentage</label>
                            <input type="text" name="shrd[0][0][nfo_equity]" id="nfo_equity" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_name]" id="nfo_pass_name">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_name_chinese]"
                                id="nfo_pass_name_chinese">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_reminder]"
                                id="nfo_pass_reminder">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_dob" class="form-label">DOB(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_dob]" id="nfo_dob">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_trg_frq]"
                                id="nfo_pass_trg_frq">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_gender]" id="nfo_gender">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_number" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_number]"
                                id="nfo_pass_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_exp]" id="nfo_pass_exp">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_country" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_country]"
                                id="nfo_pass_country">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_email]" id="nfo_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_phone_number]"
                                id="nfo_phone_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_residential_Add]"
                                id="nfo_residential_Add">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_ctry]" id="nfo_tin_ctry">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_number]"
                                id="nfo_tin_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_type]" id="nfo_tin_type">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_job_title]" id="nfo_job_title">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_mth_salary]"
                                id="nfo_mth_salary">
                        </div>

                    </div>
                </div>
                <div id="appended_nfo_shareholder_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                    <button type="button" id="add_nfo_shareholder"
                        class="btn saveBtn btn_design add_nfo_shareholder">Add
                        shareholder</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next_nfo_3" class="btn saveBtn next_nfo_3" data-id="1">Next</button>
                <button type="button" id="previous6" class="btn saveBtn cancelBtn previous3_nfo" data-id="1">Back</button>
            </div></div>`);
        } else {
            $('.NFO_shareholder').css("display", "block");
            $('.NFO_shareholder').html(`<div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Name 1</h4>
                        <h6>` + nfo_arr + `</h6>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">3</a>
                                <p> Shareholder</p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nfo_shareholder">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="Share_holder-w sub-heading">
                            <h4>Shareholder #1</h4>
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_equity" class="form-label">Equity Percentage</label>
                            <input type="text" name="shrd[0][0][nfo_equity]" id="nfo_equity" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_name]" id="nfo_pass_name">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_name_chinese]"
                                id="nfo_pass_name_chinese">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_reminder]"
                                id="nfo_pass_reminder">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_dob" class="form-label">DOB(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_dob]" id="nfo_dob">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_trg_frq]"
                                id="nfo_pass_trg_frq">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_gender]" id="nfo_gender">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_number" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_number]"
                                id="nfo_pass_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_exp]" id="nfo_pass_exp">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_country" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_pass_country]"
                                id="nfo_pass_country">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_email]" id="nfo_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_phone_number]"
                                id="nfo_phone_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_residential_Add]"
                                id="nfo_residential_Add">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_ctry]" id="nfo_tin_ctry">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_number]"
                                id="nfo_tin_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_tin_type]" id="nfo_tin_type">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_job_title]" id="nfo_job_title">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" name="shrd[0][0][nfo_mth_salary]"
                                id="nfo_mth_salary">
                        </div>

                    </div>
                </div>
                <div id="appended_nfo_shareholder_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                    <button type="button" id="add_nfo_shareholder"
                        class="btn saveBtn btn_design add_nfo_shareholder">Add
                        shareholder</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="nfo_next3" class="btn saveBtn fo_form_sub" data-id="1">Next</button>
                <button type="button" id="previous" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
            </div>`);
        }
    });
    var btn_click_nfo = 0;
    $('body').on('click', '.next_nfo_3', function () {
        nfo_sh_no = 0;
        var share_hold = $('input[id=nfo_equity]').map(function () {
            return this.value;
        }).get();
        var id_nfo = $(this).attr('data-id');
        var isLastElement2 = nfo_arr.length - 1;
        // $.each(arr, function(key, value) { 
        let btn_id_nfo = "";
        if (id_nfo == isLastElement2) {
            btn_id_nfo = "fo_form_sub";
        } else {
            btn_id_nfo = "next_nfo_3";
        }
        id_nfo++;

        $(this).parents('fieldset').find('.nfo_full_div').hide();
        $('.NFO_shareholder_extra').append(`
        <div class="nfo_full_div">
        <div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Name 1</h4>
                        <h6>` + nfo_arr[id_nfo - 1] + `</h6>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">3</a>
                                <p> Shareholder</p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nfo_shareholder">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="Share_holder-w sub-heading">
                            <h4>Shareholder #1</h4>
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_equity" class="form-label">Equity Percentage</label>
                            <input type="text" name="shrd[`+ (id_nfo - 1) + `][0][nfo_equity]" id="nfo_equity" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_name]" id="nfo_pass_name">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_name_chinese]"
                                id="nfo_pass_name_chinese">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_reminder]"
                                id="nfo_pass_reminder">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_dob" class="form-label">DOB(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_dob]" id="nfo_dob">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_trg_frq]"
                                id="nfo_pass_trg_frq">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_gender]" id="nfo_gender">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_number" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_number]"
                                id="nfo_pass_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_exp]" id="nfo_pass_exp">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_country" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_pass_country]"
                                id="nfo_pass_country">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_email]" id="nfo_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_phone_number]"
                                id="nfo_phone_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_residential_Add]"
                                id="nfo_residential_Add">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_tin_ctry]" id="nfo_tin_ctry">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_tin_number]"
                                id="nfo_tin_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_tin_type]" id="nfo_tin_type">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_job_title]" id="nfo_job_title">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" name="shrd[`+ (id_nfo - 1) + `][0][nfo_mth_salary]"
                                id="nfo_mth_salary">
                        </div>

                    </div>
                </div>
                <div id="appended_nfo_shareholder_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                    <button type="button" id="add_nfo_shareholder"
                        class="btn saveBtn btn_design add_nfo_shareholder">Add
                        shareholder</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next_nfo_3" class="btn saveBtn ` + btn_id_nfo + `" data-id="` +
            id_nfo + `">Next</button>
                <button type="button" id="previous6" class="btn saveBtn cancelBtn previous3_nfo" data-id=` +
            id_nfo + `>Back</button>
            </div></div>`);
    });

    $('body').on('click', '.previous3_nfo', function () {
        back_btn_click_nfo = "";
        var id_nfo_back = $(this).attr('data-id');
        console.log(id_nfo_back);
        if (id_nfo_back == 2) {
            back_btn_click_nfo = "previous";
        } else {
            back_btn_click_nfo = "previous3_nfo";
        }
        id_nfo_back--;
        $(this).find('fieldset').hide();
        $('.NFO_shareholder').html(`
        <div class="nfo_full_div">
        <div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Name 1</h4>
                        <h6>` + nfo_arr[id_nfo_back - 1] + `</h6>
                    </div>
                    <div class="number_main">
                        <ul class="list-group list-group-horizontal" id="nav_list">
                            <li class="list-group-item active">
                                <a href="#">1</a>
                                <p> Business Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">2</a>
                                <p> Company Details </p>
                            </li>
                            <li class="list-group-item active">
                                <a href="#">3</a>
                                <p> Shareholder</p>
                            </li>
                            <li class="list-group-item">
                                <a href="#">4</a>
                                <p> Complete</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="nfo_shareholder">
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
                        <div class="Share_holder-w sub-heading">
                            <h4>Shareholder #1</h4>
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_equity" class="form-label">Equity Percentage</label>
                            <input type="text" name="shrd[0][nfo_equity]" id="nfo_equity" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_name]" id="nfo_pass_name">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_name_chinese]"
                                id="nfo_pass_name_chinese">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_reminder]"
                                id="nfo_pass_reminder">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_dob" class="form-label">DOB(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_dob]" id="nfo_dob">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_trg_frq]"
                                id="nfo_pass_trg_frq">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_gender]" id="nfo_gender">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_number" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_number]"
                                id="nfo_pass_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_exp]" id="nfo_pass_exp">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_pass_country" class="form-label">Passport Country</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_pass_country]"
                                id="nfo_pass_country">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_email]" id="nfo_email">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_phone_number]"
                                id="nfo_phone_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_residential_Add]"
                                id="nfo_residential_Add">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_tin_ctry]" id="nfo_tin_ctry">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_tin_number]"
                                id="nfo_tin_number">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_tin_type]" id="nfo_tin_type">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_job_title]" id="nfo_job_title">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>
                            <input type="text" class="form-control" name="shrd[0][nfo_mth_salary]"
                                id="nfo_mth_salary">
                        </div>

                    </div>
                </div>
                <div id="appended_nfo_shareholder_div">
                </div>
                <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                    <button type="button" id="add_nfo_shareholder"
                        class="btn saveBtn btn_design add_nfo_shareholder">Add
                        shareholder</button>
                </div>
            </div>
            <div class="text-center pt-4 " id="append_div_btn">
                <button type="button" id="next3" class="btn saveBtn next3" data-id="` + id_nfo_back + `">Next</button>
                <button type="button" id="previous6" class="btn saveBtn cancelBtn ` + back_btn_click_nfo +
            `" data-id =` + id_nfo_back + `>Back</button>
            </div></div>`);


    });
    $('body').on('click', '.add_nfo_shareholder', function () {

        var nfo_arr_id = $(this).parents('fieldset').find('#next_nfo_3').attr('data-id');

        nfo_sh_no++;

        // $('#appended_nfo_shareholder_div').append($('#nfo_shareholder').html());
        $(this).parents('fieldset').find('#appended_nfo_shareholder_div').append(
            `<div id="nfo_shareholder">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">\
                <span class="cancel_nfoshareholder cancel_shareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="Share_holder-w sub-heading">
                    <h4>Shareholder #`+(nfo_sh_no +1)+`</h4>
                </div>
                <div class="formAreahalf">\
                    <label for="nfo_equity" class="form-label">Equity Percentage</label>\
                    <input type="text" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_equity]" id="nfo_equity" class="form-control" value="">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_name]" id="nfo_pass_name">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name(Chinese)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_name_chinese]" id="nfo_pass_name_chinese">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_reminder]" id="nfo_pass_reminder">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_dob" class="form-label">DOB(MM/DD/YYYY)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_dob]" id="nfo_dob">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_trg_frq]" id="nfo_pass_trg_frq">\
                    </div>\
                <div class="formAreahalf">\
                    <label for="nfo_gender" class="form-label">Gender</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_gender]" id="nfo_gender">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_number" class="form-label">Passport Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_number]" id="nfo_pass_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_exp" class="form-label">Passport Expiry Date(MM/DD/YYYY)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_exp]" id="nfo_pass_exp">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_country" class="form-label">Passport Country</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_pass_country]" id="nfo_pass_country">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_email" class="form-label">E-mail</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_email]" id="nfo_email">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_phone_number" class="form-label">Phone Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_phone_number]" id="nfo_phone_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_residential_Add" class="form-label">Residential Address</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_residential_Add]" id="nfo_residential_Add">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_tin_ctry]" id="nfo_tin_ctry">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_number" class="form-label">Current TIN Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_tin_number]" id="nfo_tin_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_type" class="form-label">Type of TIN</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_tin_type]" id="nfo_tin_type">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_job_title" class="form-label">Job Title</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_job_title]" id="nfo_job_title">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company(SGD)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id - 1) + `][` + nfo_sh_no + `][nfo_mth_salary]" id="nfo_mth_salary">\
                </div>\
                </div></div>`
        );
    });
    $('body').on('click', '.cancel_company', function () {
        $(this).parents('#fo_company').remove();
    });
    $('body').on('click', '.cancel_shareholder', function () {
        $(this).parents('#fo_shareholder').remove();
    });
    $('body').on('click', '.cancel_nfocompany', function () {
        $(this).parents('#nfo_corporate').remove();
    });
    $('body').on('click', '.cancel_nfoshareholder', function () {
        $(this).parents('#nfo_shareholder').remove();
    });

});