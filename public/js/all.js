$(document).on('click', '.accordion-button', function(){
    $(this).parents('.accordion-item').toggleClass('closed');
})