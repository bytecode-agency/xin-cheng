
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
pageSize = 4;
incremSlide = 5;
startPage = 0;
numberPage = 0;
var pageCount =  $(".notes_show").length / pageSize;
var totalSlidepPage = Math.floor(pageCount / incremSlide);
for(var i = 0 ; i<pageCount;i++){
    $("#pagin").append('<li class="btn btn-primary btn-round notesBtn">'+(i+1)+'</li> ');
    if(i>pageSize){
       $("#pagin .notesBtn").eq(i).hide();
    }
}

// var prev = $("<li/>").addClass("prev").html("Prev").click(function(){
//    startPage-=5;
//    incremSlide-=5;
//    numberPage--;
//    slide();
// });

// prev.hide();

// var next = $("<li/>").addClass("next").html("Next").click(function(){
// //    startPage+=5;
// //    incremSlide+=5;
// //    numberPage++;
// //    slide();
// });

// $("#pagin").prepend(prev).append(next);

$("#pagin .notesBtn").first().addClass("current");

// slide = function(sens){
// //    $("#pagin li").hide();
// //    for(t=startPage;t<incremSlide;t++){
// //      $("#pagin li").eq(t+1).show();
// //    }
// //    if(startPage == 0){
// //      next.show();
// //      prev.hide();
// //    }else if(numberPage == totalSlidepPage ){
// //      next.hide();
// //      prev.show();
// //    }else{
// //      next.show();
// //      prev.show();
// //    }
   
    
// }

showPage = function(page) {
	  $(".notes_show").hide();
	  $(".notes_show").each(function(n) {
	      if (n >= pageSize * (page - 1) && n < pageSize * page)
	          $(this).show();
	  });        
}
    
showPage(1);
$("#pagin .notesBtn").eq(0).addClass("current");

$("#pagin .notesBtn").click(function() {
	 $("#pagin .notesBtn").removeClass("current");
	 $(this).addClass("current");
	 showPage(parseInt($(this).text()));
});

