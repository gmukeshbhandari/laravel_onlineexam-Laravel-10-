$(document).ready(function () {
    // Update text on window resize
    $(window).resize(function () {
        var screen_width = $(window).width();
        //check if viewport width is less than 350 pixels.
        if (screen_width < 350){
            $('.custom-change-password').addClass('table-responsive');
        }
        else{
            $('.custom-change-password').removeClass('table-responsive');
        }
    });
});
