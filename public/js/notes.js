
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
                    $(thisForm).parents('.notes-common').find('.notes_show').first().before(
                    `<div class="notes_show">
                        <p class="desc_notes">`+response.notes_description+` </p>
                        <p class="created">`+response.created_date+`</p>
                        <p class="createdby"><b> `+response.created_by+`</b></p>
                    </div>`);
                    $('#text_notes').val("");
                    $('#pagin').html('');
                    notesPaginate();
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Notes can't be empty")
            }
        })
    }
});
$('body').on('click', '.note_remove', function (e) {
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/note-destroy",
            type: "POST",
            data: {id:id},
            success: function (response) {
                $('#note'+id).hide();
                swal({
                    title: `Note Removed`,
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
                    
                })
            }
        })
    


});
//Pagination
notesPaginate();
function notesPaginate(){
    pageSize = 4;
    incremSlide = 5;
    startPage = 0;
    numberPage = 0;
    var pageCount =  $(".notes_show").length / pageSize;
    var totalSlidepPage = Math.floor(pageCount / incremSlide);
    for(var i = 0 ; i<pageCount;i++){
        $("#pagin").append('<li class="paginate_button page-item notesBtn" data-id="'+(i+1)+'" id="paginBtn'+(i+1)+'">' + `<a href="javascript:void(0);" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link" style="user-select: text;">${1+i}</a>` + '</li> ');
        if(i>pageSize){
        $("#pagin .notesBtn").eq(i).hide();
        }
    }

    var prev = $('<li class="paginate_button page-item"/>').addClass("previous").html('<a href="javascript:void(0);" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link" style="user-select: text;"><i class="fa fa-angle-double-left" style="user-select: text;"></i></a>').click(function(){

        var id = $('.notesBtn.active').data('id');
        id = id - 1;
        togglePrevNextBtn(id);
        showPage(parseInt(id));

    });

    prev.hide();
    

    var next = $('<li class="paginate_button page-item"/>').addClass("next").html('<a href="javascript:void(0);" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link" style="user-select: text;"><i class="fa fa-angle-double-right" style="user-select: text;"></i></a>').click(function(){

        var id = $('.notesBtn.active').data('id');
        id = id + 1;
        
        togglePrevNextBtn(id);
        
        showPage(parseInt(id));
    });
    if(pageCount <= 1 ){
        next.hide();
        prev.hide();
    }
    togglePrevNextBtn = function(btnId) {
        // console.log(btnId +'-'+ i);
        $("#pagin .notesBtn").removeClass("active");
        $('#paginBtn'+btnId).addClass("active");
        if(btnId >= 1){
            if(btnId == 1){
                $("#pagin .previous").hide();
            }else{
                $("#pagin .previous").show();
            }
            
            if(btnId == i){
                $("#pagin .next").hide();
            }else{
                $("#pagin .next").show();
            }
        }
        else {
            $("#pagin .previous").hide();
            $("#pagin .next").hide();
        }
        
    }
    $("#pagin").prepend(prev).append(next);

    $("#pagin .notesBtn").first().addClass("active");


    showPage = function(page) {
        $(".notes_show").hide();
        $(".notes_show").each(function(n) {
            if (n >= pageSize * (page - 1) && n < pageSize * page)
                $(this).show();
        });  
        
    }
        
    showPage(1);
    $("#pagin .notesBtn").eq(0).addClass("active");

    $("#pagin .notesBtn").click(function() {
        var id = $(this).data('id');
        
        
        togglePrevNextBtn(id);
       
        showPage(parseInt($(this).text()));
    });
}

