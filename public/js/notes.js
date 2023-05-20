
// $("#notes").validate();
$('body').on('submit', '.note_send', function () {

    var form2 = $(this).serialize();
    console.log(form2);
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
                    location.reload();
                    $('#text_notes').val("");
                })
            }
        })
    }


});

