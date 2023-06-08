$(document).on('click', '.accordion-button', function(){
    $(this).parents('.accordion-item').toggleClass('closed');
})
function addCommas(str){
    return str.replace(/^0+/, '').replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).on('keyup','[type^=integer]',function(event){
    var nm = $(this).val();
    $(this).val(addCommas(nm));
    
  });

$('.commanDataTable').DataTable({

    oLanguage: {
        "sInfo": "Showing _START_ - _END_ of _TOTAL_", // text you want show for info section
        "sLengthMenu": "Show _MENU_ Entries",
        "oPaginate": {
            "sNext": "<i class='fa fa-angle-double-right'></i>",
            "sPrevious": "<i class='fa fa-angle-double-left'></i>"
        },
    },
    
    searching: false,
    paging: true
});
$('.user_action_log').DataTable({

    oLanguage: {
        "sInfo": "Showing _START_ - _END_ of _TOTAL_", // text you want show for info section
        "sLengthMenu": "Show _MENU_ Entries",
        "oPaginate": {
            "sNext": "<i class='fa fa-angle-double-right'></i>",
            "sPrevious": "<i class='fa fa-angle-double-left'></i>"
        },
    },
    
    searching: false,
    paging: true
});
$('.file_upload_table').DataTable({

    oLanguage: {
        "sInfo": "Showing _START_ - _END_ of _TOTAL_", // text you want show for info section
        "sLengthMenu": "Show _MENU_ Entries",
        "oPaginate": {
            "sNext": "<i class='fa fa-angle-double-right'></i>",
            "sPrevious": "<i class='fa fa-angle-double-left'></i>"
        },
    },
    
    searching: false,
    paging: true
});

$(document).on('change', '#source_of_client', function() {
    if ($(this).val() == "Others" || $(this).val() == "Online marketing") {
        $(this).parents().next('.please_specify').remove();
        $(this).parent().after(
            `<div class="formAreahalf basic_data please_specify">
                <label for="" class="form-label">Please Specify</label>
                <input type="text" class="form-control"
                    name="source_of_client_specify" value="">
            </div>`
        );

    } else {
        $(this).parents().next('.please_specify').remove();
    }

});