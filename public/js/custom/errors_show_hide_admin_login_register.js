$(document).ready(function(){
    $('#formTabs a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')

        // Hide all error messages
        $('.alert').hide();
    });

    $('#loginform').submit(function (e) {
       
        // Validate and submit the login form
        // Show/hide login error messages based on validation result
        $('#loginError').show(); // Show login error for demonstration purposes
    });

    $('#registration_form').submit(function (e) {
      
        // Validate and submit the register form
        // Show/hide register error messages based on validation result
        $('#registerError').show(); // Show register error for demonstration purposes
    });

});