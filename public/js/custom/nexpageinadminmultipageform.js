$(document).ready(function () {
    function updateText(element, newText) {
        var customNextPage = $(element);
        // Update the text
        customNextPage.find('.page-link').text(newText);
    }

    // Update text on window resize
    $(window).resize(function () {
        var screen_width = $(window).width();
        //check if viewport width is less than 265 pixels.
        if (screen_width < 265){
            updateText('.custom-next-page-1', '1');
            updateText('.custom-next-page-2', '2');
            updateText('.custom-next-page-3', '3');
            updateText('.custom-next-page-4', '4');
        }
        else{
            updateText('.custom-next-page-1', 'First Step');
            updateText('.custom-next-page-2', 'Second Step');
            updateText('.custom-next-page-3', 'Third Step');
            updateText('.custom-next-page-4', 'Last Step');
        }
    });

    function update_text_at_page_load(element, newText) {
        var screen_width = $(window).width();
        //check if viewport width is less than 265 pixels.
        if (screen_width < 265){
            var customNextPage = $(element);
            // Update the text
            customNextPage.find('.page-link').text(newText);
        }
       
    }

    update_text_at_page_load('.custom-next-page-1', '1');
    update_text_at_page_load('.custom-next-page-2', '2');
    update_text_at_page_load('.custom-next-page-3', '3');
    update_text_at_page_load('.custom-next-page-4', '4');
});
