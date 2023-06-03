$(document).on('click', '.accordion-button', function(){
    $(this).parents('.accordion-item').toggleClass('closed');
})
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