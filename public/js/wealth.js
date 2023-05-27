
$(document).ready(function () {
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        onClose: function() {
            $(this).valid();
        }
    });

    $(document).on('keypress','[type^=integer]',function(event){
        var key = window.event ? event.keyCode : event.which;
          if (event.keyCode === 8 || event.keyCode === 46) {
              return true;
          } else if ( key < 48 || key > 57 ) {
              return false;
          } else {
              return true;
          }
      });
    var form = $("#multistep_form");
    form[0].reset();

    // $('.business_type').val("");
    var form_count = 1,
        form_count_form, next_form, total_forms;
    total_forms = $("fieldset").length;

    var i = 0;
    var sh_no = 0;
    var nfo_sh_no=0;
    function setProgressBar(curStep) {
        var data = $('#' + curStep).addClass("active");
    };

    $("body").on('keyup', '.equity_shareholders', function (evt) {
        $(this).attr('value', $(this).val());
        // console.log('yes');
        // console.log($(this).val());
        let percentage = 0;
        var compId = $(this).parents('.full_div').attr('id');
        var cal_eqty_percentage = $(this).parents('#' + compId + ".full_div").find(".equity_shareholders");
        for (per = 0; per < cal_eqty_percentage.length; per++) {
            // console.log(cal_eqty_percentage[per].value);
            // console.log($(cal_eqty_percentage[per]).attr('value'));
            percentage += parseFloat($(cal_eqty_percentage[per]).attr('value'));
        }
        console.log(percentage , compId);
        if (percentage == 100) {
            // console.log('here');
            $(this).parents('#' + compId + ".full_div").find('#next3').removeClass("disable");
            $(this).parents('#' + compId + ".full_div").find('#next3').prop("disabled", false);
        }
        else {
            // console.log('there');
            $(this).parents('#' + compId + ".full_div").find('#next3').addClass("disable");
            $(this).parents('#' + compId + ".full_div").find('#next3').attr('disabled', 'disabled');

        }
        if (percentage >= 100) {
            // console.log('ghty');
            $('#' + compId).find("#add_shareholder").addClass("disable");
            $('#' + compId).find("#add_shareholder").attr('disabled', 'disabled');
            $('#' + compId).find("#add_nfo_shareholder").addClass("disable");
            $('#' + compId).find("#add_nfo_shareholder").attr('disabled', 'disabled');
            //    $(".saveBtn").addClass("disable");
        }
        else {
            $('#' + compId).find("#add_shareholder").removeClass("disable");
            $('#' + compId).find("#add_shareholder").prop("disabled", false);
            $('#' + compId).find("#add_nfo_shareholder").removeClass("disable");
            $('#' + compId).find("#add_nfo_shareholder").prop('disabled',false);
        }


    });

    $('body').on('change', ".business_type", function () {

        if ($(this).val() == "FO") {

            $(this).parents('fieldset').find("#append_div_form").html($('#FO_First').html());
            $("#nav_list").html($('#nav_list_add_fo').html());

            $('.js-example-responsive').select2({
                minimumResultsForSearch: -1
            });


        } else {
            $(this).parents('fieldset').find("#append_div_form").html($('#NFO_First').html());
            $("#nav_list").html($('#nav_list_add_nfo').html());
            if ($('.js-example-responsive').data('select2')) {
                $('.js-example-responsive').select2('destroy');
            }
            $("#non_business_type").val('Non-FO');
            $("#nfo_client_type").change(function () {
                if ($('#nfo_client_type').val() == "Corporate") {
                    $('#nfo_client_types').val('Corporate');
                    $("#nav_list").html($('#nav_list_add_nfo_corporate').html());
                } else {
                    $("#nav_list").html($('#nav_list_add_nfo').html());
                    $('#nfo_client_types').val('Personal');
                }
            });
        }
        $(".previous1").css("display", "block");
    });
    // $('body').on('change','.one_time_status', '.annual_status', function () {
    //     $(this).valid();
    // });
    // $('body').on('change', 'select', function () {
    //     if (this.value == 'Others') {
    //         $(this).parent().after(`<div class="formAreahalf basic_data please_specify">
    //             <label for="" class="form-label">Please Specify</label>
    //             <input type="text" class="form-control" name="tpe_plese_specify" value="">
    //         </div>`);
    //     }
    //     else {
    //         $(this).parents().next('.please_specify').remove();
    //     }
    // });

    $('body').on('click','.next1',function () {
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
                type_of_fo_specify: {
                    required: true,
                    // number: true
                },
                // servicing_fee_currency: {
                //     required: true
                // },
                // servicing_fee_status: {
                //     required: true
                // },
                // annual_servicing_fee: {
                //     required: true,
                //     number: true
                // },
                // annual_fee_currency: {
                //     required: true
                // },
                // annual_fee_status: {
                //     required: true
                // },
                nfo_client_type: {
                    required: true
                },
                // tpe_plese_specify: {
                //     required: true
                // },
            },
        });
        if (form.valid() === true) {

            if ($(".business_type").val() == "Non-FO") {

                if ($('#nfo_client_type').val() == "Personal") {
                    let next = $('#NFO_personal').attr('id');
                    $('#start_field').hide();
                    $('#' + next).show();
                } else {
                    let next = $('#NFO_corporate').attr('id');
                    $('#start_field').hide();
                    $('#' + next).show();
                }
            } else if ($(".business_type").val() == "FO") {
                let next = $('#' + this.id).closest('fieldset').next('fieldset').attr('id');
                $('#start_field').hide();
                $('#' + next).show();
            }
            else {
                // alert();
                // $(".business_type").rules("add", {required: true}),
                // validator = $(form).validate();
                // validator.resetForm();
                // form.removeData('validator');
                // form.validate();
                $('#again_error').text("This field is required.");
            }
        }
    });
    $('.previous1').click(function () {
        // if ($("#business_type").val() == "FO") {
        $('#append_div_form').html(`<div class="formAreahalf ">
                <label for="business_type" class="form-label">Business Type</label>
                <select id="business_type" name="business_type" class="business_type">
                    <option value="-1">Choose Business Type</option>
                    <option value="FO" selected="">FO</option>
                    <option value="Non-FO">Non-FO</option>
                </select>
                <span id="again_error" style="color : #ef0b0b;"></span>
            </div>`);
        $("#nav_list").html(
            '<li class="list-group-item active"><a href="#">1</a><p> Business Details </p></li>'
        );
        $('form').trigger("reset");

        $('#business_type option[value="-1"]').prop("selected", true);

        $(this).css("display", "none");
        if ($('.js-example-responsive').data('select2')) {
            $('.js-example-responsive').select2('destroy');
        }


        // } else {
        // $('#append_div_form').html("");
        //     $("#nav_list").html(
        //         '<li class="list-group-item active"><a href="#">1</a><p> Business Details </p></li>'
        //     );
        //     $('#business_type').val("");
        //     $('#business_type option[value="-1"]').prop("selected", true);
        // }
    });

    $('body').on('click', '.previous', function () {
        let current = $(this).closest("fieldset").attr('id');
        $('#' + current).hide();
        $(this).parents('fieldset').addClass("wealth_back_next_comp");
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

        var comp = $('.cmd_count').length;
        // console.log(comp);
        // $('#appended_company_div').append($('#fo_company').html());
        $('#appended_company_div').append(
            `<div id="fo_company" data-id=` + i + `><div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design cmd_count">
            <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
            <span class="cancel_company"><i class="fa fa-times" aria-hidden="true"></i></span> \

            <div class="accordion-item accordian-items-comp" id="accordion-`+ (comp + 1) + `">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                 <div class="formAreahalf company-full_width_Cstm"> \
                    <label for="fo_compnay_`+(comp + 1)+`" class="form-label">Company Name ` + (comp + 1) + `</label>\
                    <input type="text" name="cmp[` + (comp + 1) + `][name]" id="fo_compnay_`+(comp + 1)+`" class="form-control" value="">\
                </div>\
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne`+ (comp + 1) + `" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>

                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne`+ (comp + 1) + `" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body d-flex flex-wrap">
                    <div class="formAreahalf">\
                        <label for="fo_uen_`+(comp + 1)+`" class="form-label">UEN</label>\
                        <input type="text" class="form-control" name="cmp[` + (comp + 1) + `][uen]" id="fo_uen_`+ (comp + 1)+`">\
                    </div>\
                    <div class="formAreahalf">\
                        <label for="fo_company_add_`+ (comp + 1)+`" class="form-label">Company Address</label>\
                        <input type="text" class="form-control" name="cmp[` + (comp + 1) + `][address]" id="fo_company_add_`+ (comp + 1)+`">\
                    </div>\
                    <div class="formAreahalf">\
                        <label for="fo_incorporation_date_`+ (comp + 1)+`" class="form-label">Incorporation Date</label>\
                        <input type="text" class="form-control datepicker" name="cmp[` + (comp + 1) + `][incorporate_date]" id="fo_incorporation_date_`+ (comp + 1)+`" placeholder="dd/mm/yyyy">\
                    </div>\

                    <div class="formAreahalf">\
                    <label for="fo_relationship_`+ (comp + 1)+`" class="form-label">Relationship with Company 1</label>\
                        <select class="form-control" name="cmp[` + (comp + 1) + `][relationship]" id="fo_relationship_`+ (comp + 1)+`">
                        <option value ="" selected disabled>Choose Relationship with Company</option>
                        <option value="Self">Self</option>
                        <option value="Subsidiary">Subsidiary</option>
                        <option value="Parent company">Parent company</option>
                        <option value="Fund co.">Fund co.</option>
                        <option value="Management co.">Management co.</option>
                        </select>\
                    </div>\
                    <div class="formAreahalf">\
                        <label for="fo_company_email_`+ (comp + 1)+`" class="form-label">Company Email</label>\
                        <input type="email" class="form-control" name="cmp[` + (comp + 1) + `][company_email]" id="fo_company_email_`+ (comp + 1)+`">\
                    </div>\
                    <div class="formAreahalf">\
                        <label for="fo_company_pass_`+ (comp + 1)+`" class="form-label">Company Password</label>\
                        <input type="text" class="form-control" name="cmp[` + (comp + 1) + `][company_pass]" id="fo_company_pass_`+ (comp + 1)+`">\
                    </div>\
                </div>
            </div>
            </div>
            </div>
            </div></div>`
        )

        $( ".datepicker" ).datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });
        comp++;
    });
    $('body').on('click', '.add_first_comp_shareholder', function () {
        var sharehold_no = $(this).parents('.full_div').find('.sharehold_length').length;
        // alert(sharehold_no);
        $(this).parents('fieldset').find('#appended_shareholder_div').append(`<div id="fo_shareholder" class="sharehold">
        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design sharehold_length">
        <span class="cancel_shareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
            <div class="Share_holder-w sub-heading">
                <h4>Shareholder #`+ (sharehold_no + 1) + `</h4>
            </div>
            <div class="formAreahalf">
                <label for="fo_equity_`+ (sharehold_no + 1) + `" class="form-label">Equity Percentage</label>
                <div class="dollersec percentage_input"><span class="input"> <input type="text" name="share[1][`+ (sharehold_no + 1) + `][equity_percentage]" id="equity_shareholder_`+ (sharehold_no + 1) + `" class="form-control equity_shareholders" value=""></span><span class="pecentage_end">%</span></div>
            </div>

            <div class="formAreahalf">
                <label for="fo_cpm2_passname_`+ (sharehold_no + 1) + `" class="form-label">Passport Full Name (Eng)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][pass_name_eng]" id="fo_cpm2_passname_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_ch_`+ (sharehold_no + 1) + `" class="form-label">Passport Full Name (Chinese)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][pass_name_chinese]" id="fo_cpm2_pass_ch_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_gender_`+ (sharehold_no + 1) + `" class="form-label">Gender</label>
                <select name="share[1][`+ (sharehold_no + 1) + `][gender]" id="fo_cpm2_gender_`+ (sharehold_no + 1) + `" class="form-control">
                    <option value="" selected disabled>Choose gender</option>
                    <option value="Male">M</option>
                    <option value="Female">F</option>
                </select>
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_dob_`+ (sharehold_no + 1) + `" class="form-label">DOB (DD/MM/YYYY)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][dob]" id="fo_cpm2_dob_`+ (sharehold_no + 1) + `" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_no_`+ (sharehold_no + 1) + `" class="form-label">Passport Number</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][passport_no]" id="fo_cpm2_pass_no_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_cnty_`+ (sharehold_no + 1) + `" class="form-label">Passport Country</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][passport_country]" id="fo_cpm2_pass_cnty_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_exp_`+ (sharehold_no + 1) + `" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][passport_exp_date]" id="fo_cpm2_pass_exp_`+ (sharehold_no + 1) + `" class="form-control datepicker" placeholder="dd/mm/yyyy" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_renew_`+ (sharehold_no + 1) + `" class="form-label">Passport Renewal Reminder</label>
                <select name="share[1][`+ (sharehold_no + 1) + `][passport_renew]" id="fo_cpm2_pass_renew_`+ (sharehold_no + 1) + `" class="form-control">
                <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                <option value="90 days before expiry">90 days before expiry</option>
                <option value="120 days before expiry">120 days before expiry</option>
                <option value="180 days before expiry">180 days before expiry</option>
                </select>
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_pass_frq_`+ (sharehold_no + 1) + `" class="form-label">Passport Reminder Trigger Frequency</label>
                <div class="select_box"><span class="every">Every</span><span class="select"><select name="share[1][`+ (sharehold_no + 1) + `][passport_trg_fqy]" id="fo_cpm2_pass_frq_`+ (sharehold_no + 1) + `" class="form-control">
                <option value="" selected="" disabled="">Please select</option>
                <option value="Day">Day</option>
                <option value="3 Days">3 Days</option>
                <option value="Week">Week</option>
                <option value="2 Weeks">2 Weeks</option>
                <option value="4 Weeks">4 Weeks</option> </select></span></div>
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_email_`+ (sharehold_no + 1) + `" class="form-label">E-mail</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][email]" id="fo_cpm2_email_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_tin_ctry_`+ (sharehold_no + 1) + `" class="form-label">Current TIN country</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][tin_country]" id="fo_cpm2_tin_ctry_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_res_add_`+ (sharehold_no + 1) + `" class="form-label">Residential Add.(according to Add. proof)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][residential_address]" id="fo_cpm2_res_add_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_tin_type_`+ (sharehold_no + 1) + `" class="form-label">Type of TIN</label>
                <select name="share[1][`+ (sharehold_no + 1) + `][type_of_tin]" id="fo_cpm2_tin_type_`+ (sharehold_no + 1) + `" class="form-control">
                <option value="" selected disabled>Choose Type of TIN</option>
                <option vlaue="WP">WP</option>
                <option vlaue="SP">SP</option>
                <option vlaue="EP">EP</option>
                <option vlaue="LTVP">LTVP</option>
                <option vlaue="DP">DP</option>
                <option vlaue="NRIC">NRIC</option>
                </select>
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_tin_num_`+ (sharehold_no + 1) + `" class="form-label">Current TIN Number</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][tin_no]" id="fo_cpm2_tin_num_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_sal_`+ (sharehold_no + 1) + `" class="form-label">Monthly Salary(SGD)</label>
                <div class="dollersec"><span class="doller">$</span><input type="integer" name="share[1][`+ (sharehold_no + 1) + `][monthly_sal]" id="fo_cpm2_sal_`+ (sharehold_no + 1) + `" class="form-control" value="">
                </div>
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_job_title_`+ (sharehold_no + 1) + `" class="form-label">Job Title</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][job_title]" id="fo_cpm2_job_title_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_company_`+ (sharehold_no + 1) + `" class="form-label">Company</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][company]" id="fo_cpm2_company_`+ (sharehold_no + 1) + `" class="form-control" value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_month_wef_`+ (sharehold_no + 1) + `" class="form-label">Monthly Salary w.e.f. (DD/MM/YYYY)</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][monthly_salary_wef]" id="fo_cpm2_month_wef_`+ (sharehold_no + 1) + `" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_phone_`+ (sharehold_no + 1) + `" class="form-label">Phone Number</label>
                <input type="text" name="share[1][`+ (sharehold_no + 1) + `][phone]" id="fo_cpm2_phone_`+ (sharehold_no + 1) + `" class="form-control"
                    value="">
            </div>
            <div class="formAreahalf">
                <label for="fo_cpm2_relation_`+ (sharehold_no + 1) + `" class="form-label">Relationship with shareholder 1</label>
                <select name="share[1][`+ (sharehold_no + 1) + `][relation_with_shareholder]" id="fo_cpm2_relation_`+ (sharehold_no + 1) + `" class="form-control fo_cpm2_relation " data-id="`+sharehold_no+`" data-key="`+(sharehold_no + 1)+`" data-name="relation_with_shareholder_specify">
                <option value="" selected disabled>Choose Relationship with shareholder</option>
                <option value="Self">Self</option>
                <option value="Parents">Parents</option>
                <option value="Spouse">Spouse</option>
                <option value="Children">Children</option>
                <option value="Relatives">Relatives</option>
                <option value="Friend">Friend</option>
                <option value="Others">Others</option>
                </select>
            </div>
         <div id="appended_user_shareholder_cmp2_selcection_div"
                class="w-100 d-flex justify-content-start flex-wrap"></div>
        </div>
        </div>`);

        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });

    });

    var arr = "";
    var compElement = "";
    $('body').on('click', '.next2', function () {
        var comp_field = $('input[name^="cmp"]');
        var relationfield = $('select[name^="cmp"]');
        comp_field.each(function() {
            $(this).rules("add", {
                required: true,
                // messages: {
                //     required: "This field is required."
                // }
            });
        });
        relationfield.each(function() {
            $(this).rules("add", {
                required: true,
            });
        });

      arr = $('input[id^="fo_compnay"]').map(function () {
            return this.value;
        }).get();
        console.log(arr);
        if (form.valid() === true) {
            $('#FO_company').hide();

            if (arr.length >= 2) {
                $('.FO_shareholder').css("display", "block");
                if ($(this).closest('fieldset').next().hasClass("wealth_back_next_comp")) {
                    $(this).closest('fieldset').next().show();
                } else {
                    $('.FO_shareholder').html(`<div class="full_div sfd" id="comp_1"><div class="card formContentData border-0 p-4">
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
                            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design sharehold_length">
                                <div class="Share_holder-w sub-heading">
                                    <h4>Shareholder #1</h4>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_equity_1" class="form-label">Equity Percentage</label>
                                    <div class="dollersec percentage_input"><span class="input"> <input type="text" name="share[1][1][equity_percentage]" id="equity_shareholder_1" class="form-control equity_shareholders" value=""></span><span class="pecentage_end">%</span></div>
                                </div>

                                <div class="formAreahalf">
                                    <label for="fo_cpm2_passname_1" class="form-label">Passport Full Name (Eng)</label>
                                    <input type="text" name="share[1][1][pass_name_eng]" id="fo_cpm2_passname_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_ch_1" class="form-label">Passport Full Name (Chinese)</label>
                                    <input type="text" name="share[1][1][pass_name_chinese]" id="fo_cpm2_pass_ch_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_gender_1" class="form-label">Gender</label>
                                    <select name="share[1][1][gender]" id="fo_cpm2_gender_1" class="form-control">
                                        <option value="" selected disabled>Choose gender</option>
                                        <option value="Male">M</option>
                                        <option value="Female">F</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_dob_1" class="form-label">DOB (DD/MM/YYYY)</label>
                                    <input type="text" name="share[1][1][dob]" id="fo_cpm2_dob_1" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_no_1" class="form-label">Passport Number</label>
                                    <input type="text" name="share[1][1][passport_no]" id="fo_cpm2_pass_no_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_cnty_1" class="form-label">Passport Country</label>
                                    <input type="text" name="share[1][1][passport_country]" id="fo_cpm2_pass_cnty_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_exp_1" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                                    <input type="text" name="share[1][1][passport_exp_date]" id="fo_cpm2_pass_exp_1" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_renew_1" class="form-label">Passport Renewal Reminder</label>
                                    <select name="share[1][1][passport_renew]" id="fo_cpm2_pass_renew_1" class="form-control">
                                    <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                                    <option value="90 days before expiry">90 days before expiry</option>
                                    <option value="120 days before expiry">120 days before expiry</option>
                                    <option value="180 days before expiry">180 days before expiry</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_pass_frq_1" class="form-label">Passport Reminder Trigger Frequency</label>
                                    <div class="select_box"><span class="every">Every</span><span class="select"><select name="share[1][1][passport_trg_fqy]" id="fo_cpm2_pass_frq_1" class="form-control">
                                    <option value="" selected="" disabled="">Please select</option>
                                    <option value="Day">Day</option>
                                    <option value="3 Days">3 Days</option>
                                    <option value="Week">Week</option>
                                    <option value="2 Weeks">2 Weeks</option>
                                    <option value="4 Weeks">4 Weeks</option> </select></span></div>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_email_1" class="form-label">E-mail</label>
                                    <input type="text" name="share[1][1][email]" id="fo_cpm2_email_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_tin_ctry_1" class="form-label">Current TIN country</label>
                                    <input type="text" name="share[1][1][tin_country]" id="fo_cpm2_tin_ctry_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_res_add_1" class="form-label">Residential Add.(according to Add. proof)</label>
                                    <input type="text" name="share[1][1][residential_address]" id="fo_cpm2_res_add_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_tin_type_1" class="form-label">Type of TIN</label>
                                    <select name="share[1][1][type_of_tin]" id="fo_cpm2_tin_type_1" class="form-control">
                                    <option value="" selected disabled>Choose Type of TIN</option>
                                    <option vlaue="WP">WP</option>
                                    <option vlaue="SP">SP</option>
                                    <option vlaue="EP">EP</option>
                                    <option vlaue="LTVP">LTVP</option>
                                    <option vlaue="DP">DP</option>
                                    <option vlaue="NRIC">NRIC</option>
                                    </select>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_tin_num_1" class="form-label">Current TIN Number</label>
                                    <input type="text" name="share[1][1][tin_no]" id="fo_cpm2_tin_num_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_sal_1" class="form-label">Monthly Salary (SGD)</label>
                                    <div class="dollersec"><span class="doller">$</span><input type="integer" name="share[1][1][monthly_sal]" id="fo_cpm2_sal_1" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_job_title_1" class="form-label">Job Title</label>
                                    <input type="text" name="share[1][1][job_title]" id="fo_cpm2_job_title_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_company_1" class="form-label">Company</label>
                                    <input type="text" name="share[1][1][company]" id="fo_cpm2_company_1" class="form-control" value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_month_wef_1" class="form-label">Monthly Salary w.e.f. (DD/MM/YYYY)</label>
                                    <input type="text" name="share[1][1][monthly_salary_wef]" id="fo_cpm2_month_wef_1" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_phone_1" class="form-label">Phone Number</label>
                                    <input type="text" name="share[1][1][phone]" id="fo_cpm2_phone_1" class="form-control"
                                        value="">
                                </div>
                                <div class="formAreahalf">
                                    <label for="fo_cpm2_relation_1" class="form-label">Relationship with shareholder 1</label>
                                    <select name="share[1][1][relation_with_shareholder]" id="fo_cpm2_relation_1" class="form-control fo_cpm2_relation" data-id="1" data-key="1" data-name="relation_with_shareholder_specify">
                                    <option value="" selected disabled>Choose Relationship with shareholder</option>
                                    <option value="Self">Self</option>
                                    <option value="Parents">Parents</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Children">Children</option>
                                    <option value="Relatives">Relatives</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Others">Others</option>
                                    </select>
                                </div>
                            <div id="appended_user_shareholder_cmp2_selcection_div"
                                    class="w-100 d-flex justify-content-start flex-wrap"></div>
                            </div>
                        </div>
                        <div id="appended_shareholder_div">
                        </div>
                        <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
                            <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_first_comp_shareholder"
                                name="add-shareholder">Add
                                shareholder</button>
                        </div>
                    </div>
                    <div class="text-center pt-4 " id="append_div_btn">
                        <button type="button" id="next3" class="btn saveBtn next3" data-id="3" disabled="disabled" >Next</button>
                        <button type="button" id="previous3" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                    </div>
                    </div> `);
                }
            } else {   //not used code
                $('#FO_shareholder').show();
                $('#cmp_name').text(arr[0]);

            }

            $(".datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                onClose: function() {
                    $(this).valid();
                }
            });

        }

    });
    $(document).on('change', '.fo_cpm2_relation', function() {
        if ($(this).val() == "Others") {
            var tpb_id = $(this).attr('data-id');
            var tpb_key = $(this).attr('data-key');
            var tpb_name = $(this).attr('data-name');
            $(this).parent().after(
                `<div class="formAreahalf please_specify mb-40">
                                        <label for="" class="form-label">Please Specify</label>
                                        <input type="text" class="form-control"
                                            name="share[`+tpb_id+`][`+tpb_key+`][`+tpb_name+`]"
                                            value="">
                                    </div>`
            );
            // ++o;

        } else {
            $(this).parents().next('.please_specify').remove();
        }


    });
    $(document).on('change', '#type_of_fo', function() {
        if ($(this).val() == "Others") {
            // var tpb_id = $(this).attr('data-id');
            // var tpb_key = $(this).attr('data-key');
            $(this).parent().after(
                `<div class="formAreahalf please_specify mb-40">
                                        <label for="" class="form-label">Please Specify</label>
                                        <input type="text" class="form-control"
                                            name="type_of_fo_specify"
                                            value="">
                                    </div>`
            );
            // ++o;

        } else {
            $(this).parents().next('.please_specify').remove();
        }


    });
    $('body').on('click', '.add_shareholder', function () {
        var sharehold = $(this).parents('.full_div').find('.sharehold_length').length;  //not used
        // console.log(sharehold);
        // var arr_id = $(this).parents('.full_div').find('#next3').attr('data-id');
        var arr_id = $(this).parents('.full_div').attr('id').replace("comp_", "");
        // console.log(arr_id);
        sh_no = $(this).parents('fieldset').find('.sharehold_length').length;
        // $('#appended_shareholder_div').append($('#fo_shareholder').html());
        $(this).parents('fieldset').find('#appended_shareholder_div').append(
            `<div id ="fo_shareholder" class="sharehold">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design sharehold_length">\
                <span class="cancel_shareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="Share_holder-w sub-heading">\
                    <h4>Shareholder #`+ (sharehold + 1) + ` </h4>\
                </div>\
                <div class="formAreahalf">\
                    <label for="fo_equity_`+ (arr_id)+(sh_no + 1) + `" class="form-label">Equity Percentage</label>\
                    <div class="dollersec percentage_input"><span class="input"> <input type="text" name="share[` + (arr_id) + `][` + (sh_no + 1) + `][equity_percentage]" id="equity_shareholder_`+ (arr_id)+(sh_no + 1) + `" class="form-control equity_shareholders"></span><span class="pecentage_end">%</span></div>\
                </div> <div class="formAreahalf">\
                    <label for="fo_shrholder_type_`+ (arr_id)+(sh_no + 1) + `" class="form-label">Shareholder Type</label>\
                    <select name="share[` + (arr_id) + `][` + (sh_no + 1) + `][shareholder_type]" id="fo_shrholder_type_`+ (arr_id)+(sh_no + 1) + `" class="shrholder_type">\
                        <option value="" selected disabled>Please select shareholder type</option>\
                        <option value="Company">Company</option>\
                        <option value="Personal">Personal</option>\
                    </select>\
                </div>\
                <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
            </div>\
                </div ></div > `
        );



    });
    var btn_click = "";
    $('body').on('click', '.next3', function () {
        sh_no = 0;
        var share_hold = $('input[id=fo_pass_name]').map(function () {
            return this.value;
        }).get();
        var isLastElement1 = arr.length + 1;

        btn_click = $(this).attr('data-id');

        // $.each(arr, function(key, value) {
        let btn_id = "";
        if (btn_click == isLastElement1) {
            btn_id = "fo_form_sub";
        } else {
            btn_id = "next3";
        }
        btn_click++;
        $(this).parents('fieldset').hide();
        if ($(this).closest('fieldset').next().hasClass("wealth_back_next")) {
            $(this).closest('fieldset').next().css("display", "block");
        } else {
            $(this).parents('fieldset').after(`<fieldset id ="FO_shareholder_extra" class="w-100 justify-content-start flex-wrap form-fields wealth FO_shareholder_extra">
            <div class="full_div" id="comp_`+ (btn_click - 2) + `">
                <div class="card formContentData border-0 p-4">
                    <div class="Personal_Details company_space">
                        <div class="First-heading_">
                            <h4>Company Name ` + [btn_click - 2] + `</h4>
                            <h6>` + arr[btn_click - 3] + `</h6>
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
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design sharehold_length">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder #1</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="fo_equity_1" class="form-label">Equity Percentage</label>
                                <div class="dollersec percentage_input"><span class="input">
                                    <input type="text" name="share[` + (btn_click - 2) + `][1][equity_percentage]" id="equity_shareholder_1" class="form-control equity_shareholders" value=""></span>
                                    <span class="pecentage_end">%</span>
                                </div>

                            </div>
                            <div class="formAreahalf mb-40">
                                <label for="fo_shrholder_type_1" class="form-label">Shareholder Type</label>
                                <select name="share[` + (btn_click - 2) + `][1][shareholder_type]" id="fo_shrholder_type_1" class="shrholder_type">
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
                btn_click + `" disabled="disabled" >Next</button>
                    <button type="button" id="previous3" class="btn saveBtn cancelBtn previouss" data-id="` +
                btn_click + `">Back</button>
                </div></div></fieldset > `);
        }

    });

    $('body').on('click', '.previouss', function () {

        $(this).parents('fieldset').hide();
        $(this).parents('fieldset').addClass("wealth_back_next");
        $(this).closest("fieldset").prev().show();

        // $('#FO_shareholder').css("display","block");
        // back_btn_click = "";
        // var id = $(this).attr('data-id');

        // if (id == 2) {
        //     back_btn_click = "previous";

        // } else {
        //     back_btn_click = "previouss";
        // }
        // id--;
        // $(this).parents('fieldset').find('.full_div').hide();
        // $('.FO_shareholder_extra').html(`
        // <div class="full_div" id="comp_`+ arr.length + `">
        //         <div class="card formContentData border-0 p-4">
        //             <div class="Personal_Details company_space">
        //                 <div class="First-heading_">
        //                     <h4>Company Name ` + id + `</h4>
        //                     <h6>` + arr[id - 1] + `</h6>
        //                 </div>
        //                 <div class="number_main">
        //                     <ul class="list-group list-group-horizontal" id="nav_list">
        //                         <li class="list-group-item active" id="1">
        //                             <a href="#">1</a>
        //                             <p> Business Details </p>
        //                         </li>
        //                         <li class="list-group-item active" id="2">
        //                             <a href="#">2</a>
        //                             <p> Company Details </p>
        //                         </li>
        //                         <li class="list-group-item active" id="3">
        //                             <a href="#">3</a>
        //                             <p> Shareholder </p>
        //                         </li>
        //                         <li class="list-group-item" id="4">
        //                             <a href="#">4</a>
        //                             <p> Complete</p>
        //                         </li>
        //                     </ul>
        //                 </div>
        //             </div>
        //             <div id="fo_shareholder" class="sharehold">
        //                 <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
        //                     <div class="Share_holder-w sub-heading">
        //                         <h4>Shareholder</h4>
        //                     </div>
        //                     <div class="formAreahalf">
        //                         <label for="fo_equity" class="form-label">Equity Percentage</label>
        //                         <input type="text" name="fo_equity" id="fo_equity" class="form-control" value="">
        //                     </div>
        //                     <div class="formAreahalf">
        //                         <label for="fo_equity" class="form-label">Shareholder Type</label>
        //                         <select name="fo_shareholder_type" id="fo_shrholder_type" class="fo_shrholder_type">
        //                             <option value="" selected disabled>Please select shareholder type</option>
        //                             <option value="Company">Company</option>
        //                             <option value="Personal">Personal</option>
        //                         </select>
        //                     </div>
        //                     <div id="appended_user_shareholder_cmp2_selcection_div"
        //                         class="w-100 d-flex justify-content-start flex-wrap"></div>
        //                 </div>
        //             </div>
        //             <div id="appended_shareholder_div">
        //             </div>
        //             <div class="text-center pt-4 add_potentia add_potential" id="add_shareholder_btn_div">
        //                 <button type="button" id="add_shareholder" class="btn saveBtn btn_design add_shareholder"
        //                     name="add-shareholder">Add
        //                     shareholder</button>
        //             </div>
        //         </div>
        //         <div class="text-center pt-4 " id="append_div_btn">
        //             <button type="button" id="next3" class="btn saveBtn next3">Next</button>
        //             <button type="button" id="previous3" class="btn saveBtn cancelBtn ` + back_btn_click +
        //     `" data-id ="` + id + `" >Back</button>
        //         </div></div>`);


    });
    var nfo_dob = "";
    var nfo_pass_exp = "";
    $('body').on('click', '.fo_form_sub_confirm', function () {
        $(this).parents('fieldset').hide();
        $(this).closest('fieldset').next('fieldset').show();
        $('#nfo_pass_name_c').text($('#nfo_pass_name').val());
        $('#nfo_pass_name_chinese_c').text($('#nfo_pass_name_chinese').val());
        $('#nfo_gender_c').text($('#nfo_gender').val());
        if($("#nfo_dob").val() != "" ){
            // nfo_dob = moment($("#nfo_dob").val()).format('DD/MM/YYYY');
            $("#nfo_dob_c").text($("#nfo_dob").val());
        }
        else{
            $("#nfo_dob_c").text("");
        }
        $('#nfo_pass_number_c').text($('#nfo_pass_number').val());
        $('#nfo_pass_exp_c').text($("#nfo_pass_exp").val());
        $('#nfo_pass_reminder_c').text($('#nfo_pass_reminder').val());
        $('#nfo_pass_country_c').text($('#nfo_pass_country').val());
        $('#nfo_pass_trg_frq_c').text($('#nfo_pass_trg_frq').val());
        $('#nfo_tin_number_c').text($('#nfo_tin_number').val());
        $('#nfo_tin_no_before_app_c').text($('#nfo_tin_no_before_app').val());
        $('#nfo_tin_ctry_c').text($('#nfo_tin_ctry').val());
        $('#nfo_tin_type_c').text($('#nfo_tin_type').val());
        $('#nfo_email_c').text($('#nfo_email').val());
        $('#nfo_tin_country_before_app_c').text($('#nfo_tin_country_before_app').val());
        $('#nfo_residential_Add_c').text($('#nfo_residential_Add').val());
        $('#nfo_tin_type_before_app_c').text($('#nfo_tin_type_before_app').val());
        $('#nfo_employer_ind_c').text($('#nfo_employer_ind').val());
        $('#nfo_phone_number_c').text($('#nfo_phone_number').val());
        $('#nfo_current_job_title_c').text($('#nfo_current_job_title').val());
        $('#nfo_emp_name_c').text($('#nfo_emp_name').val());


    });
    $('body').on('click', '.nfo_personal_back', function () {
        $(this).parents('fieldset').hide();
        $(this).closest('fieldset').prev('fieldset').show();
    });

    $('body').on('click', '.fo_form_sub', function () {
        var formdata = $('form').serialize();
        var url = "{{route('wealth-create')}}";
        // console.log(formdata);
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
                console.log(response.success);
                const el = document.createElement('div');
                if (response.success.business_type == "Non-FO" && response.success.client_type == "Personal") {
                    el.innerHTML =
                        `<p>You can view Application <a class='view-application' href='/wealth-view/` + response.success.id + `'>here</a></p>
                    <div class='number_main swal_number'><ul class="list-group list-group-horizontal" id = "nav_list">
                    <li class="list-group-item active"> <a href="#">1</a><p> Business Details </p> </li>
                    <li class="list-group-item active"> <a href="#">2</a><p> Personal Details </p> </li>
                    <li class="list-group-item active"> <a href="#">3</a><p> Complete </p> </li></ul>
                    </div>`;
                }
                else {
                    el.innerHTML =
                        `<p>You can view Application <a class='view-application' href='/wealth-view/` + response.success.id + `'>here</a></p>
                            <div class="number_main swal_number">
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
                                    <li class="list-group-item active" id="4">
                                        <a href="#">4</a>
                                        <p> Complete</p>
                                    </li>
                                </ul>
                            </div>`;
                }
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

    $('body').on('change', '.shrholder_type', function () {

        var shr_arr_id = $(this).parents('.full_div').attr('id').replace("comp_", "");
        var option_values= "";
        $.each(arr, function(key, value) {

            if( ( (key+1) < shr_arr_id))
            {
             var divHtml = '<option value="'+value+'">'+value+'</option>';
            }
            option_values += divHtml;
       });

        if ($(this).val() == "Company") {
            $(this).parents('#fo_shareholder').find(
                "#appended_user_shareholder_cmp2_selcection_div")
                .html(`<div id="FO_shrhold_c2_company" class="added_shareholder_cmp2 w-100 d-flex justify-content-start flex-wrap"">
                        <div class="formAreahalf">
                            <label for="fo_cpm2_cmpname_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Company Name</label>
                            <select name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][shareholder_company_name]" id="fo_cpm2_cmpname_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control fo_share_comp_option">
                            <option value="" selected disabled>Choose company</option>
                           `+option_values+`
                            </select>
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
                            <label for="fo_cpm2_passname_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][pass_name_eng]" id="fo_cpm2_passname_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_ch_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Full Name (Chinese)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][pass_name_chinese]" id="fo_cpm2_pass_ch_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_gender_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Gender</label>
                            <select name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][gender]" id="fo_cpm2_gender_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control">
                                <option value="" selected disabled>Choose gender</option>
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_dob_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">DOB (DD/MM/YYYY)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][dob]" id="fo_cpm2_dob_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control datepicker" placeholder="dd/mm/yyyy" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_no_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Number</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][passport_no]" id="fo_cpm2_pass_no_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_cnty_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Country</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][passport_country]" id="fo_cpm2_pass_cnty_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_exp_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][passport_exp_date]" id="fo_cpm2_pass_exp_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control datepicker" placeholder="dd/mm/yyyy" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_renew_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Renewal Reminder</label>
                            <select name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][passport_renew]" id="fo_cpm2_pass_renew_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control">
                            <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_frq_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Passport Reminder Trigger Frequency</label>
                           <div class="select_box"><span class="every">Every</span><span class="select"><select name="share[` + (shr_arr_id) + `][` + (shr_arr_id)+(sh_no + 1) + `][passport_trg_fqy]" id="fo_cpm2_pass_frq_` + (sh_no + 1) + `" class="form-control">
                           <option value="" selected="" disabled="">Please select</option>
                           <option value="Day">Day</option>
                           <option value="3 Days">3 Days</option>
                           <option value="Week">Week</option>
                           <option value="2 Weeks">2 Weeks</option>
                           <option value="4 Weeks">4 Weeks</option> </select></span></div>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_email_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">E-mail</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][email]" id="fo_cpm2_email_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_ctry_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Current TIN country</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][tin_country]" id="fo_cpm2_tin_ctry_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_res_add_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Residential Add.(according to Add. proof)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][residential_address]" id="fo_cpm2_res_add_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_type_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Type of TIN</label>
                            <select name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][type_of_tin]" id="fo_cpm2_tin_type_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control">
                            <option value="" selected disabled>Choose Type of TIN</option>
                            <option vlaue="WP">WP</option>
                            <option vlaue="SP">SP</option>
                            <option vlaue="EP">EP</option>
                            <option vlaue="LTVP">LTVP</option>
                            <option vlaue="DP">DP</option>
                            <option vlaue="NRIC">NRIC</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_num_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Current TIN Number</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][tin_no]" id="fo_cpm2_tin_num_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_sal_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Monthly Salary (SGD)</label>
                            <div class="dollersec"><span class="doller">$</span><input type="integer" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][monthly_sal]" id="fo_cpm2_sal_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                            </div>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_job_title_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Job Title</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][job_title]" id="fo_cpm2_job_title_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_company_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Company</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][company]" id="fo_cpm2_company_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_month_wef_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Monthly Salary w.e.f. (DD/MM/YYYY)</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][monthly_salary_wef]" id="fo_cpm2_month_wef_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control datepicker" value="" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_phone_`+(shr_arr_id)+(sh_no + 1)+`" class="form-label">Phone Number</label>
                            <input type="text" name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][phone]" id="fo_cpm2_phone_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_relation_` + (shr_arr_id)+(sh_no + 1) + `" class="form-label">Relationship with shareholder 1</label>
                            <select name="share[` + (shr_arr_id) + `][` + (sh_no + 1) + `][relation_with_shareholder]" id="fo_cpm2_relation_` + (shr_arr_id)+(sh_no + 1) + `" class="form-control fo_cpm2_relation" data-id="`+shr_arr_id+`" data-key="`+(sh_no + 1)+`" data-name="relation_with_shareholder_specify">
                            <option value="" selected disabled>Choose Relationship with shareholder</option>
                            <option value="Self">Self</option>
                            <option value="Parents">Parents</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Children">Children</option>
                            <option value="Relatives">Relatives</option>
                            <option value="Friend">Friend</option>
                            <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>`);
        }
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });
    });
    var n_i = 0;
    $('.add_corporate').click(function () {

        var cmp_count = $('.nfo_cmp_length').length;

        // $('#appended_corporate_div').append($('#nfo_corporate').html());
        $('#appended_corporate_div').append(
            `<div id="nfo_corporate" class="corporate">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_cmp_length">\
                <div class="company_set_accrodian" id="accordionPanelsStayOpenExample">
                    <span class="cancel_nfocompany cancel_company "><i class="fa fa-times" aria-hidden="true"></i></span> \

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <div class="formAreahalf company-full_width_Cstm">\
                                <label for="nfo_compnay_` + (cmp_count + 1) + `" class="form-label">Company Name `+ (cmp_count + 1) + `</label>\
                                <input type="text" name="corporate[` + (cmp_count + 1) + `][nfo_company]" id="nfo_compnay_` + (cmp_count + 1) + `" class="form-control" value="">\
                            </div>\
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne`+ (cmp_count + 1) + `" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                        </h2>
                    <div id="panelsStayOpen-collapseOne`+ (cmp_count + 1) + `" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body d-flex flex-wrap">
                            <div class="formAreahalf">\
                                <label for="nfo_uen_` + (cmp_count + 1) + `" class="form-label">UEN</label>\
                                <input type="text" class="form-control" name="corporate[` + (cmp_count + 1) + `][nfo_uen]" id="nfo_uen_` + (cmp_count + 1) + `">\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="nfo_company_add_` + (cmp_count + 1) + `" class="form-label">Company Address</label>\
                            <input type="text" class="form-control" name="corporate[` + (cmp_count + 1) + `][nfo_company_add]" id="nfo_company_add_` + (cmp_count + 1) + `">\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="nfo_incorporation_date_` + (cmp_count + 1) + `" class="form-label">Incorporation Date</label>\
                            <input type="text" class="form-control datepicker" name="corporate[` + (cmp_count + 1) + `][nfo_incorporation_date]" id="nfo_incorporation_date_` + (cmp_count + 1) + `" placeholder="dd/mm/yy">\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="nfo_relationship_` + (cmp_count + 1) + `" class="form-label">Relationship with Company 1</label>\
                            <select class="form-control" name="corporate[` + (cmp_count + 1) + `][nfo_relationship]" id="nfo_relationship_` + (cmp_count + 1) + `">\
                            <option value="" selected disabled>Choose Relationship with Company 1</option>
                            <option value="Self">Self</option>
                            <option value="Subsidiary">Subsidiary</option>
                            <option value="Parent company">Parent company</option>
                            <option value="Fund co.">Fund co.</option>
                            <option value="Management co.">Management co.</option>
                            </select>\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="nfo_company_email_` + (cmp_count + 1) + `" class="form-label">Company Email</label>\
                            <input type="email" class="form-control" name="corporate[` + (cmp_count + 1) + `][nfo_company_email]" id="nfo_company_email_` + (cmp_count + 1) + `">\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="nfo_company_pass_` + (cmp_count + 1) + `" class="form-label">Company Password</label>\
                            <input type="text" class="form-control" name="corporate[` + (cmp_count + 1) + `][nfo_company_pass]" id="nfo_company_pass_` + (cmp_count + 1) + `">\
                        </div>\
                    </div>
            </div></div></div></div></div></div>`
        );
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });
        cmp_count++;
    });
    $('body').on('click', '.next_nfo_2', function () {

        // if (form.valid() === true) {
        //     let next = $('#NFO_shareholder').attr('id');
        //     $('#' + next).show();
        //     $('#NFO_corporate').hide();
        // }
        nfo_arr = $('input[id^=nfo_compnay]').map(function () {
            return this.value;
        }).get();
        // console.log(nfo_arr);
        var nfo_comp_field = $('input[name^="corporate"]');
        var nfo_relation_field = $('select[name^="corporate"]');
        nfo_comp_field.each(function() {
            $(this).rules("add", {
                required: true,
                // messages: {
                //     required: "This field is required."
                // }
            });
        });
        nfo_relation_field.each(function() {
            $(this).rules("add", {
                required: true,
            });
        });
        if (form.valid() === true) {
            $('#NFO_corporate').hide();
            if (nfo_arr.length >= 2) {
                if ($(this).closest('fieldset').next().hasClass("wealth_back_next_comp")) {
                    $(this).closest('fieldset').next().show();
                } else {
                $('.NFO_shareholder').css("display", "block");
                $('.NFO_shareholder').html(`<div class="full_div" id="nf_comp_1"><div class="card formContentData border-0 p-4">
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
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_shr_length">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder #1</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_equity" class="form-label">Equity Percentage</label>
                                <div class="dollersec percentage_input"><span class="input">
                                <input type="text" name="shrd[1][1][nfo_equity]" id="nfo_equity" class="form-control equity_shareholders" value=""></span>
                                <span class="pecentage_end">%</span>
                                </div>

                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_name_shd" class="form-label">Passport Full Name (Eng)</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_name]" id="nfo_pass_name">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_name_chinese]"
                                    id="nfo_pass_name_chinese">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                                <select class="form-control" name="shrd[1][1][nfo_pass_reminder]" id="nfo_pass_reminder">
                                    <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                                    <option value="90 days before expiry">90 days before expiry</option>
                                    <option value="120 days before expiry">120 days before expiry</option>
                                    <option value="180 days before expiry">180 days before expiry</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_dob_1" class="form-label">DOB (DD/MM/YYYY)</label>
                                <input type="text" class="form-control datepicker" name="shrd[1][1][nfo_dob]" id="nfo_dob_1" placeholder="dd/mm/yy">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                                <div class="select_box"><span class="every">Every</span>
                                <span class="select"><select name="shrd[1][1][nfo_pass_trg_frq]" id="nfo_pass_trg_frq" class="form-control">
                                <option value="" selected="" disabled="">Please select</option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option> </select></span>
                                </div>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_gender" class="form-label">Gender</label>
                                <select class="form-control" name="shrd[1][1][nfo_gender]" id="nfo_gender">
                                <option value="" selected disabled>Choose gender</option>
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_number" class="form-label">Passport Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_number]"
                                    id="nfo_pass_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_exp_1" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                                <input type="text" class="form-control datepicker" name="shrd[1][1][nfo_pass_exp]" id="nfo_pass_exp_1" placeholder="dd/mm/yy">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_country" class="form-label">Passport Country</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_country]"
                                    id="nfo_pass_country">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_email]" id="nfo_email">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_phone_number]"
                                    id="nfo_phone_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_residential_Add]"
                                    id="nfo_residential_Add">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_tin_ctry]" id="nfo_tin_ctry">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_tin_number]"
                                    id="nfo_tin_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                                <select class="form-control" name="shrd[1][1][nfo_tin_type]" id="nfo_tin_type">
                                    <option value="" selected disabled>Choose Type of TIN</option>
                                    <option vlaue="WP">WP</option>
                                    <option vlaue="SP">SP</option>
                                    <option vlaue="EP">EP</option>
                                    <option vlaue="LTVP">LTVP</option>
                                    <option vlaue="DP">DP</option>
                                    <option vlaue="NRIC">NRIC</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_job_title]" id="nfo_job_title">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company (SGD)</label>
                                <div class="dollersec"><span class="doller">$</span> <input type="integer" class="form-control" name="shrd[1][1][nfo_mth_salary]"
                                    id="nfo_mth_salary"></div>
                            </div>

                        </div>
                    </div>
                    <div id="appended_nfo_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                        <button type="button" id="add_nfo_shareholder"
                            class="btn saveBtn btn_design add_nfo_firstcmp_shareholder">Add
                            shareholder</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next3" class="btn saveBtn next_nfo_3" data-id="1" disabled="disabled">Next</button>
                    <button type="button" id="previous6" class="btn saveBtn cancelBtn previous3_nfo" data-id="1">Back</button>
                </div></div>`);
                }
            } else {
                if ($(this).closest('fieldset').next().hasClass("wealth_back_next_comp")) {
                    $(this).closest('fieldset').next().show();
                } else {
                $('.NFO_shareholder').css("display", "block");
                $('.NFO_shareholder').html(`<div class="full_div" id="nf_comp_1"><div class="card formContentData border-0 p-4">
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
                        <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_shr_length">
                            <div class="Share_holder-w sub-heading">
                                <h4>Shareholder #1</h4>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_equity" class="form-label">Equity Percentage</label>
                                    <div class="dollersec percentage_input"><span class="input">
                                    <input type="text" name="shrd[1][1][nfo_equity]" id="nfo_equity" class="form-control equity_shareholders" value=""></span>
                                    <span class="pecentage_end">%</span>
                                    </div>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_name_shd" class="form-label">Passport Full Name (Eng)</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_name]" id="nfo_pass_name">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_name_chinese]"
                                    id="nfo_pass_name_chinese">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
                                <select class="form-control" name="shrd[1][1][nfo_pass_reminder]"
                                    id="nfo_pass_reminder">
                                <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                                <option vlaue="90 days before expiry">90 days before expiry</option>
                                <option vlaue="120 days before expiry">120 days before expiry</option>
                                <option value="180 days before expiry">180 days before expiry</option>
                                    </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_dob_1" class="form-label">DOB (DD/MM/YYYY)</label>
                                <input type="text" class="form-control datepicker" name="shrd[1][1][nfo_dob]" id="nfo_dob_1" placeholder="dd/mm/yy">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                                <div class="select_box"><span class="every">Every</span>
                                <span class="select"><select name="shrd[1][1][nfo_pass_trg_frq]" id="nfo_pass_trg_frq" class="form-control">
                                <option value="" selected="" disabled="">Please select</option>
                                <option value="Day">Day</option>
                                <option value="3 Days">3 Days</option>
                                <option value="Week">Week</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option> </select></span>
                                </div>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_gender" class="form-label">Gender</label>
                                <select class="form-control" name="shrd[1][1][nfo_gender]" id="nfo_gender">
                                <option value="" selected disabled>Choose gender</option>
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_number" class="form-label">Passport Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_number]"
                                    id="nfo_pass_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_exp_1" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                                <input type="text" class="form-control datepicker" name="shrd[1][1][nfo_pass_exp]" id="nfo_pass_exp_1" placeholder="dd/mm/yy">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_pass_country" class="form-label">Passport Country</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_pass_country]"
                                    id="nfo_pass_country">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_email]" id="nfo_email">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_phone_number]"
                                    id="nfo_phone_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_residential_Add" class="form-label">Residential Address</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_residential_Add]"
                                    id="nfo_residential_Add">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_tin_ctry]" id="nfo_tin_ctry">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_tin_number]"
                                    id="nfo_tin_number">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_tin_type" class="form-label">Type of TIN</label>
                                <select class="form-control" name="shrd[1][1][nfo_tin_type]" id="nfo_tin_type">
                                <option value="" selected disabled>Choose Type of TIN</option>
                                <option vlaue="WP">WP</option>
                                <option vlaue="SP">SP</option>
                                <option vlaue="EP">EP</option>
                                <option vlaue="LTVP">LTVP</option>
                                <option vlaue="DP">DP</option>
                                <option vlaue="NRIC">NRIC</option>
                                </select>
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="shrd[1][1][nfo_job_title]" id="nfo_job_title">
                            </div>
                            <div class="formAreahalf">
                                <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company (SGD)</label>
                                <div class="dollersec"><span class="doller">$</span> <input type="integer" class="form-control" name="shrd[1][1][nfo_mth_salary]"
                                    id="nfo_mth_salary"></div>
                            </div>

                        </div>
                    </div>
                    <div id="appended_nfo_shareholder_div">
                    </div>
                    <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
                        <button type="button" id="add_nfo_shareholder"
                            class="btn saveBtn btn_design add_nfo_firstcmp_shareholder">Add
                            shareholder</button>
                    </div>
                </div>
                <div class="text-center pt-4 " id="append_div_btn">
                    <button type="button" id="next3" class="btn saveBtn fo_form_sub" data-id="1" disabled="disabled">Next</button>
                    <button type="button" id="previous" class="btn saveBtn cancelBtn previous" data-id="1">Back</button>
                </div></div>`);
                }
            }
            $(".datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                onClose: function() {
                    $(this).valid();
                }
            });
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

        $(this).parents('fieldset').hide();
        if ($(this).closest('fieldset').next().hasClass("wealth_back_next")) {
            $(this).closest('fieldset').next().css("display", "block");
        } else {
        $(this).parents('fieldset').after(`<fieldset id="NFO_shareholder_extra"
        class="w-100 justify-content-start flex-wrap form-fields wealth NFO_shareholder_extra">
        <div class="full_div" id="nf_comp_`+ id_nfo + `">
        <div class="card formContentData border-0 p-4">
                <div class="Personal_Details company_space">
                    <div class="First-heading_">
                        <h4> Company Name `+ id_nfo + ` </h4>
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
                <div id ="nfo_shareholder" class="sharehold">\
                    <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_shr_length">\

                        <div class="Share_holder-w sub-heading">\
                            <h4>Shareholder #1</h4>\
                        </div>\
                        <div class="formAreahalf">\
                            <label for="fo_equity" class="form-label">Equity Percentage</label>\
                            <div class="dollersec percentage_input"><span class="input"> <input type="text" name="shrd[` + (id_nfo) + `][1][nfo_equity]" id="equity_shareholder" class="form-control equity_shareholders"></span><span class="pecentage_end">%</span></div>\
                        </div>
                        <div class="formAreahalf">\
                            <label for="fo_shrholder_type" class="form-label">Shareholder Type</label>\
                            <select name="shrd[` + (id_nfo) + `][1][nfo_shareholder_type]" id="fo_shrholder_type" class="nfo_shrholder_type">\
                                <option value="" selected disabled>Please select shareholder type</option>\
                                <option value="Company">Company</option>\
                                <option value="Personal">Personal</option>\
                            </select>\
                        </div>\
                        <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
                    </div>\
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
                <button type="button" id="next3" class="btn saveBtn ` + btn_id_nfo + `" data-id="` +
            id_nfo + `" disabled="disabled">Next</button>
                <button type="button" id="previous6" class="btn saveBtn cancelBtn previous3_nfo" data-id=` +
            id_nfo + `>Back</button>
            </div></div></fieldset>`);
        }
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });

    });
    $('body').on('change','.nfo_shrholder_type',function(){
        var shr_arr_id = $(this).parents('.full_div').attr('id').replace("nf_comp_", "");
        var option_values= "";
       $.each(nfo_arr, function(key, value) {

        if( ( (key+1) < shr_arr_id))
        {
         var divHtml = '<option value="'+value+'">'+value+'</option>';
        }
        option_values += divHtml;
    });

        if ($(this).val() == "Company") {
            $(this).parents('#nfo_shareholder').find(
                "#appended_user_shareholder_cmp2_selcection_div")
                .html(`<div id="FO_shrhold_c2_company" class="added_shareholder_cmp2 w-100 d-flex justify-content-start flex-wrap"">
                        <div class="formAreahalf">
                            <label for="fo_cpm2_cmpname" class="form-label">Company Name</label>
                            <select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][shareholder_company_name]" id="fo_cpm2_cmpname" class="form-control fo_share_comp_option">
                            <option value="" selected disabled>Choose company</option>
                           `+option_values+`
                            </select>
                        </div>
                     </div>`);
        } else {

            $(this).parents('#nfo_shareholder').find(
                "#appended_user_shareholder_cmp2_selcection_div")
                .html(`<div id="FO_shrhold_c2_personal" class="added_shareholder_cmp2 w-100 d-flex justify-content-start flex-wrap"">
                        <div class="formAreahalf">
                            <label for="fo_cpm2_passname" class="form-label">Passport Full Name (Eng)</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_name]" id="fo_cpm2_passname" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_ch" class="form-label">Passport Full Name (Chinese)</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_name_chinese]" id="fo_cpm2_pass_ch" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_gender" class="form-label">Gender</label>
                            <select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_gender]" id="fo_cpm2_gender" class="form-control">
                                <option value="" selected disabled>Choose gender</option>
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_cpm2_dobq_`+(shr_arr_id) +(nfo_sh_no + 1) +`" class="form-label">DOB (DD/MM/YYYY)</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_dob]" id="nfo_cpm2_dobq_`+(shr_arr_id)+(nfo_sh_no + 1) +`" class="form-control datepicker" value="" placeholder="dd/mm/yy">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_no" class="form-label">Passport Number</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_number]" id="fo_cpm2_pass_no" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_cnty" class="form-label">Passport Country</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_country]" id="fo_cpm2_pass_cnty" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="nfo_cpm2_pass_expq_`+(shr_arr_id)+(nfo_sh_no + 1)+`" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_exp]" id="nfo_cpm2_pass_expq_`+(shr_arr_id)+(nfo_sh_no + 1)+`" class="form-control datepicker" value="" placeholder="dd/mm/yy">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_renew" class="form-label">Passport Renewal Reminder</label>
                            <select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_reminder]" id="fo_cpm2_pass_renew" class="form-control">
                            <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                            <option value="90 days before expiry">90 days before expiry</option>
                            <option value="120 days before expiry">120 days before expiry</option>
                            <option value="180 days before expiry">180 days before expiry</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_pass_frq" class="form-label">Passport Reminder Trigger Frequency</label>
                           <div class="select_box"><span class="every">Every</span><span class="select"><select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_pass_trg_frq]" id="fo_cpm2_pass_frq" class="form-control">
                           <option value="" selected="" disabled="">Please select</option>
                           <option value="Day">Day</option>
                           <option value="3 Days">3 Days</option>
                           <option value="Week">Week</option>
                           <option value="2 Weeks">2 Weeks</option>
                           <option value="4 Weeks">4 Weeks</option> </select></span></div>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_email" class="form-label">E-mail</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_email]" id="fo_cpm2_email" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_ctry" class="form-label">Current TIN country</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_tin_ctry]" id="fo_cpm2_tin_ctry" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_res_add" class="form-label">Residential Add.(according to Add. proof)</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_residential_Add]" id="fo_cpm2_res_add" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_type" class="form-label">Type of TIN</label>
                            <select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_tin_type]" id="fo_cpm2_tin_type" class="form-control">
                            <option value="" selected disabled>Choose Type of TIN</option>
                            <option vlaue="WP">WP</option>
                            <option vlaue="SP">SP</option>
                            <option vlaue="EP">EP</option>
                            <option vlaue="LTVP">LTVP</option>
                            <option vlaue="DP">DP</option>
                            <option vlaue="NRIC">NRIC</option>
                            </select>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_tin_num" class="form-label">Current TIN Number</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_tin_number]" id="fo_cpm2_tin_num" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_sal" class="form-label">Monthly Salary in the company (SGD)</label>
                            <div class="dollersec"><span class="doller">$</span><input type="integer" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_mth_salary]" id="fo_cpm2_sal" class="form-control" value="">
                            </div>
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_job_title" class="form-label">Job Title</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_job_title]" id="fo_cpm2_job_title" class="form-control" value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_phone" class="form-label">Phone Number</label>
                            <input type="text" name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_phone_number]" id="fo_cpm2_phone" class="form-control"
                                value="">
                        </div>
                        <div class="formAreahalf">
                            <label for="fo_cpm2_relation" class="form-label">Relationship with shareholder 1</label>
                            <select name="shrd[` + (shr_arr_id) + `][` + (nfo_sh_no + 1) + `][nfo_relation_with_shareholder]" id="fo_cpm2_relation" class="form-control fo_cpm2_relation" data-id="`+shr_arr_id+`" data-key="`+(nfo_sh_no + 1)+`" data-name="nfo_relation_with_shareholder_specify">
                            <option value="" selected disabled>Choose Relationship with shareholder</option>
                            <option value="Self">Self</option>
                            <option value="Parents">Parents</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Children">Children</option>
                            <option value="Relatives">Relatives</option>
                            <option value="Friend">Friend</option>
                            <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>`);
        }
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });
    })

    $('body').on('click', '.previous3_nfo', function () {
        $(this).parents('fieldset').hide();
        $(this).closest('fieldset').prev().show();
        // back_btn_click_nfo = "";
        // var id_nfo_back = $(this).attr('data-id');
        // console.log(id_nfo_back);
        // if (id_nfo_back == 2) {
        //     back_btn_click_nfo = "previous";
        // } else {
        //     back_btn_click_nfo = "previous3_nfo";
        // }
        // id_nfo_back--;
        // $(this).find('fieldset').hide();
        // $('.NFO_shareholder').html(`
        // <div class="nfo_full_div">
        // <div class="card formContentData border-0 p-4">
        //         <div class="Personal_Details company_space">
        //             <div class="First-heading_">
        //                 <h4> Company Name 1</h4>
        //                 <h6>` + nfo_arr[id_nfo_back - 1] + `</h6>
        //             </div>
        //             <div class="number_main">
        //                 <ul class="list-group list-group-horizontal" id="nav_list">
        //                     <li class="list-group-item active">
        //                         <a href="#">1</a>
        //                         <p> Business Details </p>
        //                     </li>
        //                     <li class="list-group-item active">
        //                         <a href="#">2</a>
        //                         <p> Company Details </p>
        //                     </li>
        //                     <li class="list-group-item active">
        //                         <a href="#">3</a>
        //                         <p> Shareholder</p>
        //                     </li>
        //                     <li class="list-group-item">
        //                         <a href="#">4</a>
        //                         <p> Complete</p>
        //                     </li>
        //                 </ul>
        //             </div>
        //         </div>
        //         <div id="nfo_shareholder">
        //             <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
        //                 <div class="Share_holder-w sub-heading">
        //                     <h4>Shareholder #1</h4>
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_equity" class="form-label">Equity Percentage</label>
        //                     <input type="text" name="shrd[1][nfo_equity]" id="nfo_equity" class="form-control"
        //                         value="">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_name_shd" class="form-label">Passport Full Name</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_pass_name]" id="nfo_pass_name">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_pass_name_chinese]"
        //                         id="nfo_pass_name_chinese">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>
        //                     <select class="form-control" name="shrd[1][nfo_pass_reminder]"
        //                         id="nfo_pass_reminder">
        //                         <option value="" selected disabled>Choose Passport Renewal Reminder</option>
        //                         <option value="90 days before expiry>90 days before expiry</option>
        //                         <option value="120 days before expiry>120 days before expiry</option>
        //                         <option value="180 days before expiry>180 days before expiry</option>
        //                         </select>
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_dob" class="form-label">DOB(DD/MM/YYYY)</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_dob]" id="nfo_dob">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>

        //                         <div class="select_box"><span class="every">Every</span>
        //                         <span class="select"><select name="shrd[1][nfo_pass_trg_frq]" id="nfo_pass_trg_frq" class="form-control">
        //                         <option value="" selected="" disabled="">Please select</option>
        //                         <option value="Day">Day</option>
        //                         <option value="3 Days">3 Days</option>
        //                         <option value="Week">Week</option>
        //                         <option value="2 Weeks">2 Weeks</option> </select></span>
        //                     </div>
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_gender" class="form-label">Gender</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_gender]" id="nfo_gender">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_number" class="form-label">Passport Number</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_pass_number]"
        //                         id="nfo_pass_number">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_exp" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_pass_exp]" id="nfo_pass_exp">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_pass_country" class="form-label">Passport Country</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_pass_country]"
        //                         id="nfo_pass_country">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_email" class="form-label">E-mail</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_email]" id="nfo_email">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_phone_number" class="form-label">Phone Number</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_phone_number]"
        //                         id="nfo_phone_number">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_residential_Add" class="form-label">Residential Address</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_residential_Add]"
        //                         id="nfo_residential_Add">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_tin_ctry]" id="nfo_tin_ctry">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_tin_number" class="form-label">Current TIN Number</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_tin_number]"
        //                         id="nfo_tin_number">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_tin_type" class="form-label">Type of TIN</label>
        //                     <select class="form-control" name="shrd[1][nfo_tin_type]" id="nfo_tin_type">
        //                     <option value="" selected disabled>Choose Type of TIN</option>
        //                     <option vlaue="WP">WP</option>
        //                     <option vlaue="SP">SP</option>
        //                     <option vlaue="EP">EP</option>
        //                     <option vlaue="LTVP">LTVP</option>
        //                     <option vlaue="DP">DP</option>
        //                     <option vlaue="NRIC">NRIC</option>
        //                     </select>
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_job_title" class="form-label">Job Title</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_job_title]" id="nfo_job_title">
        //                 </div>
        //                 <div class="formAreahalf">
        //                     <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company (SGD)</label>
        //                     <input type="text" class="form-control" name="shrd[1][nfo_mth_salary]"
        //                         id="nfo_mth_salary">
        //                 </div>

        //             </div>
        //         </div>
        //         <div id="appended_nfo_shareholder_div">
        //         </div>
        //         <div class="text-center pt-4 add_potentia add_potential" id="add_nfo_shareholder_btn_div">
        //             <button type="button" id="add_nfo_shareholder"
        //                 class="btn saveBtn btn_design add_nfo_shareholder">Add
        //                 shareholder</button>
        //         </div>
        //     </div>
        //     <div class="text-center pt-4 " id="append_div_btn">
        //         <button type="button" id="next3" class="btn saveBtn next3" data-id="` + id_nfo_back + `">Next</button>
        //         <button type="button" id="previous6" class="btn saveBtn cancelBtn ` + back_btn_click_nfo +
        //     `" data-id =` + id_nfo_back + `>Back</button>
        //     </div></div>`);


    });
    $('body').on('click','.add_nfo_shareholder',function(){
        var sharehold_nfo_no = $(this).parents('.full_div').find('.nfo_shr_length').length;

        var arr_id = $(this).parents('.full_div').attr('id').replace("nf_comp_", "");
        // console.log(arr_id);
        var nfo_sh_no = $(this).parents('fieldset').find('.nfo_shr_length').length;
        // $('#appended_shareholder_div').append($('#fo_shareholder').html());
        $(this).parents('fieldset').find('#appended_nfo_shareholder_div').append(
            `<div id ="nfo_shareholder">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_shr_length">\
                <span class="cancel_shareholder cancel_nfoshareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="Share_holder-w sub-heading">\
                    <h4>Shareholder #`+ (nfo_sh_no + 1) + ` </h4>\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_equity" class="form-label">Equity Percentage</label>\
                    <div class="dollersec percentage_input"><span class="input"> <input type="text" name="shrd[` + (arr_id) + `][` + (sharehold_nfo_no + 1) + `][nfo_equity]" id="equity_shareholder" class="form-control equity_shareholders"></span><span class="pecentage_end">%</span></div>\
                </div> <div class="formAreahalf">\
                    <label for="nfo_shrholder_type" class="form-label">Shareholder Type</label>\
                    <select name="shrd[` + (arr_id) + `][` + (sharehold_nfo_no + 1) + `][nfo_shareholder_type]" id="nfo_shrholder_type" class="nfo_shrholder_type">\
                        <option value="" selected disabled>Please select shareholder type</option>\
                        <option value="Company">Company</option>\
                        <option value="Personal">Personal</option>\
                    </select>\
                </div>\
                <div id="appended_user_shareholder_cmp2_selcection_div" class="w-100 d-flex justify-content-start flex-wrap"></div>\
            </div>\
                </div ></div> `
        );


    })
    $('body').on('click', '.add_nfo_firstcmp_shareholder', function () {
        var nfo_shr_length = $(this).parents('.full_div').find('.nfo_shr_length').length;
        // var nfo_arr_id = $(this).parents('fieldset').find('#next_nfo_3').attr('data-id');
        var nfo_arr_id = $(this).parents('.full_div').attr('id').replace("nf_comp_", "");


        // $('#appended_nfo_shareholder_div').append($('#nfo_shareholder').html());
        $(this).parents('fieldset').find('#appended_nfo_shareholder_div').append(
            `<div id="nfo_shareholder">\
            <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design nfo_shr_length">\
                <span class="cancel_nfoshareholder cancel_shareholder"><i class="fa fa-times" aria-hidden="true"></i></span> \
                <div class="Share_holder-w sub-heading">
                    <h4>Shareholder #`+ (nfo_shr_length + 1) + `</h4>
                </div>
                <div class="formAreahalf">\
                    <label for="nfo_equity" class="form-label">Equity Percentage</label>\
                    <div class="dollersec percentage_input"><span class="input">
                    <input type="text" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_equity]" id="nfo_equity" class="form-control equity_shareholders" value=""></span>
                    <span class="pecentage_end">%</span>
                    </div>
                    </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_name_shd" class="form-label">Passport Full Name (Eng)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1)+ `][nfo_pass_name]" id="nfo_pass_name">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_name_chinese" class="form-label">Passport Full Name (Chinese)</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_name_chinese]" id="nfo_pass_name_chinese">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_reminder" class="form-label">Passport Renewal Reminder </label>\
                    <select class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_reminder]" id="nfo_pass_reminder">\
                    <option value="" selected disabled>Choose Passport Renewal Reminder</option>
                    <option value="90 days before expiry">90 days before expiry</option>
                    <option value="120 days before expiry">120 days before expiry</option>
                    <option value="180 days before expiry">180 days before expiry</option>

                    </select>\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_dob_` + (nfo_arr_id)+(nfo_shr_length +1) + `" class="form-label">DOB (DD/MM/YYYY)</label>\
                    <input type="text" class="form-control datepicker" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_dob]" id="nfo_dob_` + (nfo_arr_id)+(nfo_shr_length +1) + `" placeholder="dd/mm/yy">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_trg_frq" class="form-label">Passport Reminder Trigger Frequency</label>\
                    <div class="select_box"><span class="every">Every</span>
                        <span class="select"><select name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_trg_frq]" id="nfo_pass_trg_frq" class="form-control">
                        <option value="" selected="" disabled="">Please select</option>
                        <option value="Day">Day</option>
                        <option value="3 Days">3 Days</option>
                        <option value="Week">Week</option>
                        <option value="2 Weeks">2 Weeks</option>
                        <option value="4 Weeks">4 Weeks</option></select></span>
                    </div>
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_gender" class="form-label">Gender</label>\
                    <select class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1)+ `][nfo_gender]" id="nfo_gender">
                     <option value="" selected disabled>Choose gender</option>
                    <option value="Male">M</option>
                    <option value="Female">F</option>\
                    </select>\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_number" class="form-label">Passport Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_number]" id="nfo_pass_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_exp__` + (nfo_arr_id)+(nfo_shr_length +1) + `" class="form-label">Passport Expiry Date (DD/MM/YYYY)</label>\
                    <input type="text" class="form-control datepicker" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_exp]" id="nfo_pass_exp__` + (nfo_arr_id)+(nfo_shr_length +1) + `" placeholder="dd/mm/yy">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_pass_country" class="form-label">Passport Country</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_pass_country]" id="nfo_pass_country">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_email" class="form-label">E-mail</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_email]" id="nfo_email">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_phone_number" class="form-label">Phone Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_phone_number]" id="nfo_phone_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_residential_Add" class="form-label">Residential Address</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_residential_Add]" id="nfo_residential_Add">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_ctry" class="form-label">Current TIN country</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_tin_ctry]" id="nfo_tin_ctry">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_number" class="form-label">Current TIN Number</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_tin_number]" id="nfo_tin_number">\
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_tin_type" class="form-label">Type of TIN</label>\
                    <select class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_tin_type]" id="nfo_tin_type">\
                    <option value="" selected disabled>Choose Type of TIN</option>
                    <option vlaue="WP">WP</option>
                            <option vlaue="SP">SP</option>
                            <option vlaue="EP">EP</option>
                            <option vlaue="LTVP">LTVP</option>
                            <option vlaue="DP">DP</option>
                            <option vlaue="NRIC">NRIC</option>
                    </select>
                </div>\
                <div class="formAreahalf">\
                    <label for="nfo_job_title" class="form-label">Job Title</label>\
                    <input type="text" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_job_title]" id="nfo_job_title">\
                </div>\
                    <div class="formAreahalf">\
                        <label for="nfo_mth_salary" class="form-label">Monthly Salary in the company (SGD)</label>\
                        <div class="dollersec"><span class="doller">$</span><input type="integer" class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_mth_salary]" id="nfo_mth_salary">\
                    </div>
                </div>\
                <div class="formAreahalf">\
                <label for="nfo_mth_salary" class="form-label">Relationship with shareholder 1</label>\
                <select class="form-control" name="shrd[` + (nfo_arr_id) + `][` + (nfo_shr_length +1) + `][nfo_relation]" id="nfo_relation">\
                <option value="" selected disabled>Choose Relationship with shareholder 1</option>
                <option value="Self">Self</option>
                <option value="Parents">Parents</option>
                <option value="Spouse">Spouse</option>
                <option value="Children">Children</option>
                <option value="Relatives">Relatives</option>
                <option value="Friend">Friend</option>
                <option value="Others">Others</option>
                </select>
            </div>\
                </div></div>`
        );
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy',
            onClose: function() {
                $(this).valid();
            }
        });
    });
    $('body').on('click', '.cancel_company', function () {
        $(this).parents('#fo_company').remove();

        var count = 1;
        $('.cmd_count').each(function (index) {
            $(this).children().find('.formAreahalf.company-full_width_Cstm .form-label').html('Company Name ' + count);
            count++;
        });
    });
    $('body').on('click', '.cancel_shareholder', function () {
        var shar_count = 1;
        var loop = $(this).parents('.full_div').attr('id');
        $(this).parents('#fo_shareholder').remove();
        $('#' + loop + " .sharehold_length").each(function (index) {
            $(this).children().find('h4').html('Shareholder #' + shar_count);
            shar_count++;
        });

    });
    $('body').on('click', '.cancel_nfocompany', function () {
        $(this).parents('#nfo_corporate').remove();
        var nf_count = 1;
        $('.nfo_cmp_length').each(function (index) {
            $(this).children().find('.formAreahalf.company-full_width_Cstm .form-label').html('Company Name ' + nf_count);
            nf_count++;
        });
    });
    $('body').on('click', '.cancel_nfoshareholder', function () {

        var nfo_shar_count = 1;
        var nf_loop = $(this).parents('.full_div').attr('id');
        // alert(nf_loop);
        $(this).parents('#nfo_shareholder').remove();
        $('#' + nf_loop + " .nfo_shr_length").each(function (index) {
            $(this).children().find('h4').html('Shareholder #' + nfo_shar_count);
            nfo_shar_count++;
        });
    });

});
