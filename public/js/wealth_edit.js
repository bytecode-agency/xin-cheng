$(document).on('click', '.remove-input-field', function() {
  
    $(this).parents('.accordion-item').hide();
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
$('body').on('change', 'selectq', function () {
    if (this.value == 'Others') {
        $(this).parent().after(`<div class="formAreahalf basic_data please_specify">
                                                <label for="" class="form-label">Please Specify111</label>
                                                <input type="text" class="form-control"
                                                    name="share[please_specify]"
                                                    value="">
                                            </div>`);
    }
    else {
        $(this).parents().next('.please_specify').remove();
    }
});
function equity_percentage_checks() {

    var company = document.querySelectorAll('.accordion-item');
    var disable = 0;
    for (index = 0; index < company.length; index++) {
        var id = '';
        id = $(company[index]).attr('id');
        var eqty_precentage = document.getElementById(id).querySelectorAll('#equity_shareholder')
        // console.log(eqty_precentage);
        let percentage = 0;
        for (per = 0; per < eqty_precentage.length; per++) {
            percentage += parseFloat($(eqty_precentage[per]).attr('value'));

        }
        // console.log(percentage);
        if (percentage < 100) {

            $(".edit__add_com").addClass("disable");
            $(".edit__add_com").attr('disabled', 'disabled');
            $("#" + id).find(".edit_add_shareholder").removeClass("disable");
            if (!$("#" + id).find(".edit_add_shareholder").hasClass("disable")) {
                disable = 1;
            }
        }
        else {
            // console.log('here');
            $("#" + id).find(".edit_add_shareholder").addClass("disable");
            $("#" + id).find(".edit_add_shareholder").attr("disabled", 'disabled');
        }

    }
    // console.log(dable);
    if (disable != 1) {
        $(".edit__add_com").removeClass('disable');
    }

}


$(document).ready(function () {
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',        
        onClose: function() {
            $(this).valid();
        }
    });

    $('.js-example-responsive').select2({
        minimumResultsForSearch: -1
    });  

    equity_percentage_checks();

    $("#text_notes").keyup(function() {
        $("#notes_cancel").show();
        });
    $("#notes_cancel").click(function() {           
        $("#text_notes").val('');
        $("#notes_cancel").hide();
    });

    $("body").on('keyup', '#equity_shareholder', function (evt) {

        $(this).attr('value', $(this).val());

        // console.log($(this).val());
        let edit_percentage = 0;
        var compId = $(this).parents('.accordion-item').attr('id');
        var cal_eqty_percentage = $(this).parents('#' + compId + ".accordion-item").find(".equity_shareholders");
        for (per = 0; per < cal_eqty_percentage.length; per++) {
            // console.log(cal_eqty_percentage[per].value);
            // console.log($(cal_eqty_percentage[per]).attr('value'));
            edit_percentage += parseFloat($(cal_eqty_percentage[per]).attr('value'));
        }
        console.log(edit_percentage);
        if (edit_percentage == 100) {
            console.log('here');
            $('.edit__add_com').removeClass("disable");
            $('.edit__add_com').prop("disabled", false);
        }
        else {
            console.log('there');
            $('.edit__add_com').addClass("disable");
            $('.edit__add_com').attr("disabled", "disabled");

        }
        if (edit_percentage >= 100) {
            // console.log('ghty');
            $('#' + compId).find("#edit_add_share").addClass("disable");
            $('#' + compId).find("#edit_add_share").attr('disabled', 'disabled');
            //    $(".saveBtn").addClass("disable");
        }
        else {
            $('#' + compId).find("#edit_add_share").removeClass("disable");
            $('#' + compId).find("#edit_add_share").prop("disabled", false);
        }

    });


    $('body').on('click', '.edit__add_com', function () {

        var key = $('.accordion-item').length;
        // key++;

        $(this).parents('.company_show').find('#accordion-' + (key - 1)).after(
            `<div id="accordion-` + key + `" class="accordion-item company_name" data-companyid=` + key + `>
            <div class="card">
                <div class="card-header" id="headingOne">
                <div class="cross"><span class="edit_cancel_company remove-campany">x</span></div> 
                    <div class="formAreahalf basic_data">
                        <label for="company_name" class="form-label">Company Name `+ (key + 1) + ` </label>
                        <input type="hidden" name="cmp[`+ key + `][id]" id="fo_company_id"
                        class="form-control">
                        <input type="text" name="cmp[`+ key + `][name]" id="fo_compnay"
                            class="form-control">
                        <button class="btn btn_set" data-toggle="collapse" data-target="#collapseOne`+ key + `"
                            aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
            </div>

                <div id="collapseOne`+ key + `" class="collapse show company_share" aria-labelledby="headingOne" data-parent="#accordion-` + key + `">
                    <div class="card-body d-flex flex-wrap">
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Address</label>
                        
                            <input type="text" name="cmp[`+ key + `][address]" id="fo_compnay_address"
                                class="form-control">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">UEN</label>
                            <input type="text" name="cmp[`+ key + `][uen]" id="fo_compnay_uen"
                                class="form-control">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Incorporation Date</label>
                            <input type="date" name="cmp[`+ key + `][incorporate_date]"
                                id="fo_compnay_incorporate_date" class="form-control">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Relationship with Company 1</label>
                            <select name="cmp[`+ key + `][relationship]"
                                id="fo_compnay_relationship" class="form-control">
                                <option value="" selected disabled>Choose Relationship with company 1</option>
                                <option value="Self">Self</option>
                                <option value="Subsidiary">Subsidiary</option>
                                </select>
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Email</label>
                            <input type="text" name="cmp[`+ key + `][company_email]" id="fo_compnay_company_email"
                                class="form-control">
                        </div>
                        <div class="formAreahalf basic_data">
                            <label for="" class="form-label">Company Password</label>
                            <input type="text" name="cmp[`+ key + `][company_pass]" id="fo_compnay_company_pass"
                                class="form-control">
                        </div>

                    </div>  
                    <div id="shareholder-accordion-0" class="sharehold_length">
                                <div class="card shareholder">
                                    <div class="card-header" id="headingOne_shareholder">
                                        <div class="formAreahalf basic_data">
                                            <label for="" class="form-label">Shareholder #1 </label>
                                            <button class="btn btn_set" data-toggle="collapse"
                                                data-target="#collapseOneS0"
                                                aria-expanded="true" aria-controls="collapseOneS">
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </button>
                                            <div class="shareholder_div_accrodion_show">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Equity Percentage</label>
                                                  
                                                        <div class="dollersec percentage_input"><span class="input"><input type="text"
                                                        name="share[`+ key + `][0][equity_percentage]" id="equity_shareholder"
                                                        class="equity_shareholders form-control" value=""></span><span class="pecentage_end">%</span></div>
                                             
                                                </div>
                                                <input type="hidden" name="share[`+ key + `][0][id]" id="fo_company_id"
                                                class="form-control">
                                                <div class="formAreahalf basic_data">
                                                    <label for="" class="form-label">Shareholder Type</label>
                                                        <select
                                                        name="share[`+ key + `][0][shareholder_type]"
                                                        id="fo_shrholder_type" class="edit_shrholder_type">
                                                        <option value="" selected disabled>Please select shareholder
                                                            type
                                                        </option>
                                                        <option value="Company">Company</option>
                                                        <option value="Personal">
                                                            Personal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseOneS0" class="collapse show"
                                        aria-labelledby="headingOne_shareholder" data-parent="#shareholder-accordion-0">
                                        <div class="card-body d-flex flex-wrap sharetype_data">
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                    <button class="btn saveBtn edit_add_shareholder" style="float:right" name="edit_add_shoulder"
                            id="edit_add_share" data-id=`+ key + `>Add
                        Shareholder</button>
            </div>           
        </div>`);
        $(this).attr('data-id', key);
    });
    $('body').on('click', '.edit_add_shareholder', function () {

        var key2 = $(this).parents('.company_share').find('.sharehold_length').length;
        console.log(key2);
        var key = $(this).parents('.accordion-item').attr('data-companyid');
        console.log(key);
        //  alert();
        $(this).parents('#collapseOne' + key).find('#shareholder-accordion-' + (key2 - 1)).after(
            `<div id="shareholder-accordion-` + (key2) + `" class="sharehold_length">
                <div class="card shareholder">
                    <div class="card-header" id="headingOne_shareholder">
                    <div class="cross"><span class="edit_cancel_share remove-campany-shareholder">x</span></div>     
                        <div class="formAreahalf basic_data">
                            <label for="shareholder_name" class="form-label">Shareholder
                                #`+ (key2 + 1) + ` </label>
                            <input type="hidden" name="share[`+ key + `][` + key2 + `][id]" id="share_id" class="form-control" >
                            <button class="btn btn_set" data-toggle="collapse"
                                data-target="#collapseOneS`+ key2 + `" aria-expanded="true"
                                aria-controls="collapseOneS">
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <div class="shareholder_div_accrodion_show">
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label">Equity Percentage</label>
                                    <div class="dollersec percentage_input"><span class="input"><input type="text" class="form-control equity_shareholders"
                                    name="share[`+ key + `][` + key2 + `][equity_percentage]" id="equity_shareholder"
                                    ></span><span class="pecentage_end">%</span></div>
                         
                                  
                                </div>
                                <div class="formAreahalf basic_data">
                                    <label for="" class="form-label">Shareholder Type</label>                                     
                                    <select class="form-control edit_shrholder_type" name="share[`+ key + `][` + key2 + `][shareholder_type]">
                                    <option value="" selected disabled>Please select shareholder type</option>
                                    <option value="Company">Company</option>
                                    <option value=Personal">Personal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOneS`+ key2 + `" class="collapse show"
                        aria-labelledby="headingOne" data-parent="#shareholder-accordion-`+ key2 + `">
                        <div class="card-body d-flex flex-wrap sharetype_data">
                           
                        </div>
                    </div>
                </div>
              </div>`);
    })

    $('body').on('change', '.edit_shrholder_type', function () {
        // console.log( $(this).parents()[8].id);
        var shr_arr_id = $(this).parents()[8].id.replace("accordion-", "");
        // console.log(shr_arr_id);
        var arr = $('input[id="fo_compnay"]').map(function () {
            return this.value;
        }).get();
        // console.log(arr);
        var share_key = $(this).parents('.company_share').find('.sharehold_length').length;
        if ($(this).val() == "Company") {
            var option_values= "";
            $.each(arr, function(key, value) { 
               
                if( ( (key + 1) <= shr_arr_id))
                {
                    var divHtml = '<option value="'+value+'">'+value+'</option>'; 
                    // console.log(shr_arr_id);   
                }           
                option_values += divHtml;
            });
            
            $(this).parents('.shareholder').find('.sharetype_data').html(`<div class="formAreahalf basic_data">
            <label for="" class="form-label">Company Name</label>
            <select class="form-control" name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][shareholder_company_name]">
            <option value="" selected disabled>Choose company</option>
            `+option_values+`
            </select>
        </div>`);
        }
        else {
            $(this).parents('.shareholder').find('.sharetype_data').html(`<div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full
                            Name(Eng)</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][pass_name_eng]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Full
                            Name(Chinese)</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][pass_name_chinese]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Renewal
                            Reminder</label>
                            
                        <select
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][passport_renew]"
                            id="fo_cpm2_pass_renew" class="form-control">
                            <option value="" selected disabled>Choose Passport Renewal
                                Reminder</option>
                            <option value="90 days before expiry"
                               >
                                90 days before expiry
                            </option>
                            <option value="120 days before expiry"
                                >
                                120 days before expiry
                            </option>
                            <option value="180 days before expiry"
                                >
                                180 days before expiry
                            </option>
                        </select>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">DOB</label>
                        <input type="date" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][dob]"
                            value="{{ $shareholder->dob }}">
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Reminder Trigger
                            Frequency</label>
                        <div class="select_box"><span class="every">Every</span><span
                                class="select"><select
                                    name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][passport_trg_fqy]"
                                    id="fo_cpm2_pass_frq" class="form-control">
                                    <option value="" selected="" disabled="">
                                        Please select</option>
                                    <option value="Day"
                                      >
                                        Day</option>
                                    <option value="3 Days"
                                      >
                                        3 Days</option>
                                    <option value="Week"
                                       >
                                        Week</option>
                                    <option value="2 Weeks"
                                       >
                                        2 Weeks</option>
                                </select></span>
                        </div>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Gender </label>
                        <select class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][gender]"
                           >
                           <option value="" selected disabled>Choose gender</option>
                           <option value="Male">M</option>
                           <option value="Female">F</option>
                           </select>
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Number</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][passport_no]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Expiry
                            Date(MM/DD/YYYY)</label>
                        <input type="date" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][passport_exp_date]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Passport Country</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][passport_country]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">E-mail</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][email]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][phone]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Residential
                            Address</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][residential_address]"
                           >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN
                            country</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][tin_country]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Current TIN
                            Number</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][tin_no]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Type of TIN</label>
                        <select
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][type_of_tin]"
                            id="fo_cpm2_tin_type" class="form-control">
                            <option value="" selected disabled>Choose Type of TIN
                            </option>
                            <option vlaue="WP"
                                >WP
                            </option>
                            <option vlaue="SP"
                               >SP
                            </option>
                            <option vlaue="EP"
                               >EP
                            </option>
                            <option vlaue="LTVP"
                               >
                                LTVP
                            </option>
                            <option vlaue="DP"
                               >DP
                            </option>
                            <option vlaue="NRIC"
                               >
                                NRIC
                            </option>
                            
                        </select>

                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Job Title</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][job_title]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Monthly Salary in the
                            company(SGD)</label>
                        <input type="text" class="form-control"
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][monthly_sal]"
                            >
                    </div>
                    <div class="formAreahalf basic_data">
                        <label for="" class="form-label">Relationship With
                            Shareholder</label>
                        <select
                            name="share[`+ shr_arr_id + `][` + (share_key - 1) + `][relation_with_shareholder]"
                            id="fo_cpm2_relation" class="form-control" data-id="` + shr_arr_id + `" data-key="` + (share_key - 1) + `">
                            <option value="" selected disabled>Choose Relationship with
                                shareholder</option>
                            <option value="Self"
                               >Self
                            </option>
                            <option value="Parents"
                                >
                                Parents</option>
                            <option value="Spouse"
                               >
                                Spouse</option>
                            <option value="Children"
                                >
                                Children</option>
                            <option value="Relatives"
                                >
                                Relatives</option>
                            <option value="Friend"
                               >
                                Friend</option>
                            <option value="Others"
                                >
                                Others</option>
                        </select>

                    </div>`);
        }

    })

    $('body').on('click', '.edit_save', function () {
        // alert();
        var formdata = $('#multistep_form_edit').serialize();
        var url = "{{ route('wealth.update') }}";
        console.log(formdata);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            route: url,
            data: formdata,
            success: function (response) {
                console.log(response);
                const el = document.createElement('div')
                el.innerHTML =
                    "You can view Application List <a class='view-application' href='/wealth-view'>here</a>"
                swal({
                    title: `Application Updated`,
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
                    window.location.href = '/wealth-view/' + response.success.id;
                })
            }
        });
    });

    $('body').on('submit', '.file_wealt_upload', function (e) {
        // alert();
        e.preventDefault();
        let formData2 = new FormData(this);
        console.log(formData2);
        // $(formData2).validate({ // initialize the plugin
        //     rules: {
        //         wealth_file: {
        //             required: true,

        //         },
        //     },
        //     messages: {
        //         wealth_file: {
        //             required: 'File is required',
        //         }
        //     }
        // });
        $('#file-input-error').text('');
       
        $.ajax({
            type: 'POST',
            url: "/wealth-uploadfile",
            data: formData2,           
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    swal({
                        title: `File Uploaded Successfully`,
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
                        location.reload();
                        $('#wealth_inputFile').val("");
                    })
                }
            },
            error: function (response) {
                $('#file-input-error').text(response.responseJSON.message);
            }
        });
    });

    $('body').on('click', '.wealth_file_del_confirm', function () {
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure you want to delete this file ?",
            text: "You will not be able to retrieve this file again.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = "/wealth-deletefile/" + id;
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {
                        id: id,
                    },
                    cache: false,
                    success: function (response) {
                        // alert(response);
                        swal(
                            "Success!",
                            "File deleted successfully",
                            "success",
                        );
                        setTimeout(function () {
                            window.location.reload();
                        })
                    },
                    failure: function (response) {
                        swal(
                            "Internal Error",
                            "Oops, your file was not deleted.", // had a missing comma
                            "error"
                        )
                    }
                });
            }
        })

    });

    // $('body').on('click','.edit_cancel_company', function(){
    //    console.log('fgjgj');
    // })
    var f_btn_key = "";
    $('body').on('click','.edit_add_finance',function(){      
    
        // f_btn_key = $(this).parents('.wealth_finance_data').find('.wealth_finance_check').last().attr('id').replace("financial_accordion_","");
        f_btn_key = $('.wealth_finance_check').length;
        // alert(f_btn_key);
        // f_btn_key++;       
        
        $("#wealth_finance_data").append(`<div id="financial_accordion_`+ (f_btn_key +1) +`" class="mas_related financial_`+(f_btn_key +1)+` wealth_finance_check">
        <div class="new_chnages_finance accordion-items">                                        
            <div class="mas_heading_accordian">
                <input type="hidden" name="financial[`+(f_btn_key +1)+`][wealth_finance_id]"
                value="">  
                <div class="formAreahalf basic_data">
                    <label for="stakeholder_type" class="form-label">Stakeholder
                        Type</label>
                    <select name="financial[`+(f_btn_key +1)+`][stakeholder_type]" id="stakeholder_type"
                        class="form-control">
                        <option value="" selected disabled>Choose stakeholder type
                        </option>
                        <option value="Fund CO.">
                            Fund CO.</option>
                        <option value="Management CO.">
                            Management CO.</option>
                        <option value="Shareholder">
                            Shareholder</option>
                        <option value="Pass holder">
                            Pass holder</option>
                    </select>
                </div>
                <div class="formAreahalf basic_data">
                    <label for="financial_institution_name" class="form-label">Financial
                        Institution Name `+(f_btn_key +1 )+`</label>
                    <input type="text" name="financial[`+(f_btn_key +1)+`][financial_institution_name]"
                        id="financial_institution_name"
                        value=""
                        class="form-control">
                </div>
                <button class="btn btn_set edit_new_btn_set" data-toggle="collapse"
                    data-target="#financial_collapse`+(f_btn_key +1) +`" aria-expanded="true"
                    aria-controls="collapseOne">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </button>               
                <div class="cross financial_wealth"><span class="edit_cancel_share remove-financal">x</span></div>
            </div>
            <div id="financial_collapse`+(f_btn_key +1) +`" class="collapse" aria-labelledby="headingOne"
                 data-parent="#financial_accordion_`+ (f_btn_key +1) +`">
                <div class="tab_custom_settings new_test_finance tab_body">
                        <div class="tab-inner-text d-flex flex-wrap">
                            <div class="formAreahalf basic_data">
                                <label for="poc_name" class="form-label">POC Name</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][poc_name]" id="poc_name"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="poc_contact_no" class="form-label">POC Contact
                                    Number</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][poc_contact_no]" id="poc_contact_no"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="poc_email" class="form-label">POC Email</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][poc_email]" id="poc_email"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="application_submission" class="form-label">Application
                                    Submission</label>
                                <select name="financial[`+(f_btn_key +1)+`][application_submission]" id="application_submission"
                                    class="js-example-responsive form-control">
                                    <option value="" selected disabled>Choose application
                                        submission
                                    </option>
                                    <option
                                        value="In progress">In progress</option>
                                    <option
                                        value="Done">Done</option>

                                </select>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select name="financial[`+(f_btn_key +1)+`][account_type]" id="account_type" class="form-control">
                                    <option value="" selected disabled>Choose account type
                                    </option>
                                    <option value="SGD">
                                        SGD</option>
                                    <option value="USD">
                                        USD</option>
                                    <option value="Multi-currency">
                                        Multi-currency</option>
                                    <option value="Others">
                                        Others</option>
                                </select>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="account_policy_no" class="form-label">Account/Policy
                                    Number</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][account_policy_no]" id="account_policy_no"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="account_opening_status" class="form-label">Account
                                    Opening
                                    Status</label>
                                <select name="financial[`+(f_btn_key +1)+`][account_opening_status]" id="account_opening_status"
                                    class="js-example-responsive form-control">
                                    <option value="" selected disabled>Choose account opening
                                        status
                                    </option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="current_account_status" class="form-label">Current
                                    Account
                                    Status</label>
                                <select name="financial[`+(f_btn_key +1)+`][current_account_status]" id="current_account_status"
                                    class="js-example-responsive form-control">
                                    <option value="" selected disabled>Choose account status
                                    </option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="money_deposit_status" class="form-label">Money Deposit
                                    Status</label>
                                <select name="financial[`+(f_btn_key +1)+`][money_deposit_status]" id="money_deposit_status"
                                    class="js-example-responsive form-control">
                                    <option value="" selected disabled>Choose money deposit
                                        status
                                    </option>
                                    <option value="In progress">In progress</option>
                                    <option value="Done">Done</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="intial_deposit_amount" class="form-label">Initial
                                    Deposit
                                    Amount</label>
                                <div class="dollersec"><span class="doller">$</span>
                                    <span class="input"> <input type="text"
                                            name="financial[`+(f_btn_key +1)+`][intial_deposit_amount]"
                                            value=""
                                            class="form-control"></span>
                                </div>
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="online_account_username" class="form-label">Online
                                    Account
                                    Username</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][online_account_username]"
                                    id="online_account_username"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="online_account_pass" class="form-label">Online Account
                                    Password</label>
                                <input type="text" name="financial[`+(f_btn_key +1)+`][online_account_pass]"
                                    id="online_account_pass"
                                    value=""
                                    class="form-control">
                            </div>
                            <div class="formAreahalf basic_data">
                                <label for="finacial_remarks" class="form-label">Remarks</label>
                                <textarea name="financial[`+(f_btn_key +1)+`][finacial_remarks]" id="finacial_remarks" rows="4" cols="50"
                                    value=""></textarea>
                            </div>
                        </div>
                    </div>                                                                                                                                                       
                </div>           
            </div>`); 
            // if ($('.js-example-responsive').data('select2')) {
            //     $('.js-example-responsive').select2('destroy');
            // }
           
            $('#financial_accordion_'+ (f_btn_key +1)+' .js-example-responsive').select2({
                minimumResultsForSearch: -1
            });

    })
    $('body').on('click','.remove-financal',function(){
            var finance_entry_id =  $(this).parents('.wealth_finance_check').find('#finance_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "delete",
                url: "/finance-destroy",
                data: {id: finance_entry_id },
                success: function (response) {
                 console.log(response);                
                }
            });

        $(this).parents('.wealth_finance_check').remove();
        var count_finance = 1;
        $('.wealth_finance_check').each(function (index) {
            console.log($(this).children().find('.formAreahalf label[for="financial_institution_name"]'));
            $(this).children().find('.formAreahalf label[for="financial_institution_name"]').html('Financial Institution Name ' + count_finance);
            count_finance++;
        });         
   
      
    });  
    
   
    $('body').on('click','.btn_add_redempt',function(){
       var red_id = $(this).parents('.redemption_add_table').find('.busines_tab_id').val();
       var red_date =  $(this).parents('.redemption_add_table').find('.red_date').val();
       var red_amount = $(this).parents('.redemption_add_table').find('.red_amount').val()
       console.log(red_date, red_amount,red_id);    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/business-data",
            data: {red_date: red_date,
            red_amount: red_amount,
            red_id :red_id},
            success: function (response) {
                console.log(response);
                if(response.success)
                {
                 var html = '<tr>';
                 var redemption_date = moment(response.success.red_date).format('DD/MM/YYYY');
                 html += '<td>'+redemption_date+'</td>';
                 html += '<td>'+response.success.red_amount+'</td>';
                 html += `<td><a href="javascript:void(0);" data-id="`+response.success.id+`" title="Delete" class="btn del_confirm_business"><i class="fa-solid fa-trash"></i></a></td></tr>`;
                 $('#red_table').prepend(html);
                 $('.red_date').val("");
                 $('.red_amount').val("");
                }
            }
        });
    })
    $('body').on('click','.del_confirm_business',function(){
        var business_id = $(this).attr('data-id');      
         //    console.log(business_id);    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "delete",
            url: "/business-destroy",
            data: {id: business_id},
            success: function (response) {
                console.log(response);               
            }
        });
        $(this).parents('tr').remove();
    })

    $('body').on('click','.remove-campany',function(){
        var id =  $(this).parents('.company_name').find('#fo_company_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "delete",
            url: "/company-destroy",
            data: {id: id },
            success: function (response) {
             console.log(response);                
            }
        });

        $(this).parents('.company_name').remove();
        var count = 1;
        $('.company_name').each(function (index) {
            console.log($(this).children().find('.formAreahalf label[for="company_name"]'));
            $(this).children().find('.formAreahalf label[for="company_name"]').html('Company Name ' + count);
            count++;
        });         

    
    });  
    
    $('body').on('click','.remove-campany-shareholder',function(){
        var finance_entry_id =  $(this).parents('.sharehold_length').find('#share_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "delete",
            url: "/company-shareholder-destroy",
            data: {id: finance_entry_id },
            success: function (response) {
             console.log(response);                
            }
        });
        
        $(this).parents('.sharehold_length').remove();
        var count = 1;
        $('.sharehold_length').each(function (index) {
            console.log(count);
            console.log($(this).children().find('.formAreahalf label[for="shareholder_name"]'));
            $(this).children().find('.formAreahalf label[for="shareholder_name"]').html('Shareholder #' + count);
            count++;
        });         

    
    });
});