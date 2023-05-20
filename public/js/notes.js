
// $("#notes").validate();
$('body').on('submit', '.note_send', function (e) {
    e.preventDefault();
    var form2 = $(this).serialize();
    var thisForm = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(this).validate({
        rules: {
            notes: 'required',
        },
        messages: {
            notes: 'This is required',
        },
    });
    if ($(this).valid()) {

        $.ajax({
            url: "/notes",
            type: "POST",
            data: form2,
            success: function (response) {
                console.log(response);
                swal({
                    title: `Notes Created`,
                    // content: el,
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
                    // location.reload();
                    $(thisForm).parents('.notes-common').find('.notes_show').before(
                    `<div class="notes_show">
                        <p class="desc_notes">`+response.notes_description+` </p>
                        <p class="created">`+response.created_date+`</p>
                        <p class="createdby"><b> `+response.created_by+`</b></p>
                    </div>`);
                    $('#text_notes').val("");
                })
            }
        })
    }


});

