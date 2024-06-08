$(document).ready(function () {
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    
    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
   
    $(".toggle-link").click(function(){
        // Hide all divs
        $(".toggle-div").hide();
        
        // Show the corresponding div
        var targetDivId = $(this).data("target");
        $("#" + targetDivId).show();
    });

});












