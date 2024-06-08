$(document).ready(function () {
    $('#adminemailregister, #adminusernameregister').blur(function () {
        var email = $('#adminemailregister').val().trim();
        var user_name = $('#adminusernameregister').val().trim();
        var _token = $('input[name="_token"]').val();
        // Define the regular expression pattern for username containing a-z, A-z, dash (-), underscore (_), minimum 3 and maximum 30 character long
        var pattern = /^[a-zA-Z0-9-_]{3,30}$/;


        // Test the username against the pattern
        if (pattern.test(user_name)) {
            // Valid username
            alert('Username is valid!');
            // You can perform further actions here, like submitting the form
        } else {
            // Invalid username
            alert('Invalid username! Use only alphabets, numbers, dashes, and underscores.');
        }



        if (!isValidEmailFormat(email) && !pattern.test(user_name)) //if both username and email are empty
         {
             //email
             $('#admin_email_reg_error_check').removeClass('text-success');
             $('#admin_email_reg_error_check').addClass('text-danger');
             $('#admin_email_reg_error_check').text('Invalid Email');
              $('#adminemailregister').addClass('is-invalid');
              //username
              $('#admin_username_reg_check_error').removeClass('text-success');
              $('#admin_username_reg_check_error').addClass('text-danger');
              $('#admin_username_reg_check_error').text('Invalid Username. Username must be minimum 3 character and must contains alphabets, numbers, dash and underscore only.');
               $('#adminusernameregister').addClass('is-invalid');
              $('#nextbtnstep1').prop('disabled', true);
        }
        if (isValidEmailFormat(email) && !pattern.test(user_name))
        {
            $('#admin_username_reg_check_error').removeClass('text-success');
              $('#admin_username_reg_check_error').addClass('text-danger');
              $('#admin_username_reg_check_error').text('Invalid Username. Username must be minimum 3 character and must contains alphabets, numbers, dash and underscore only.');
               $('#adminusernameregister').addClass('is-invalid');
               validateEmail(email, _token, 'disable_next_button');
        }
        if (!isValidEmailFormat(email) && pattern.test(user_name))
        {
              //email
              $('#admin_email_reg_error_check').removeClass('text-success');
              $('#admin_email_reg_error_check').addClass('text-danger');
              $('#admin_email_reg_error_check').text('Invalid Email');
               $('#adminemailregister').addClass('is-invalid');
               validateUsername(user_name, _token, 'disable_next_button');
        }
        if (isValidEmailFormat(email) && pattern.test(user_name))
        { //if both username and email are non-empty
            validateEmail(email, _token,'no_disable_next_button');
            validateUsername(user_name, _token,'no_disable_next_button');
        } 
    });

    function isValidEmailFormat(email) {
        // Regular expression for a simple email format validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       // var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return emailRegex.test(email);
    }

    // function validateEmailAndUsername(email, user_name, _token) {
    //     validateEmail(email, _token);
    //     validateUsername(user_name, _token);
    // }

    function validateEmail(email, _token, disabled_next) {
        $.ajax({
            url: checkEmailRoute,
            method: "POST",
            data: { email: email, _token: _token },
            dataType: 'json',
            success: function (result) {
                handleValidationResult(result, '#admin_email_reg_error_check', '#adminemailregister','email', disabled_next);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function validateUsername(user_name, _token, disabled_next) {
        $.ajax({
            url: checkusernameRoute,
            method: "POST",
            data: { username: user_name, _token: _token },
            dataType: 'json',
            success: function (result) {
                handleValidationResult(result, '#admin_username_reg_check_error', '#adminusernameregister','username', disabled_next);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function handleValidationResult(result, errorElement, inputElement,usernameoremail,disabled_next) {
        var successClass = 'text-success';
        var dangerClass = 'text-danger';
        var invalidClass = 'is-invalid';

        if (result.email_exist_check === "Email Exist" || result.username_exist_check === "Username Exist") {
            $(errorElement).removeClass(successClass).addClass(dangerClass);
            $(errorElement).text('This ' + usernameoremail + ' is not available.');
            $(inputElement).addClass(invalidClass);
            $('#nextbtnstep1').prop('disabled', true);
        } else {
            $(errorElement).removeClass(dangerClass).addClass(successClass);
            var user_or_email =  usernameoremail.charAt(0).toUpperCase() + usernameoremail.slice(1); //Capitalized First letter
            $(errorElement).text(user_or_email + ' Available.');
            $(inputElement).removeClass(invalidClass);
            if (disabled_next === 'disable_next_button')
            {
                $('#nextbtnstep1').prop('disabled', true);
            }
            else
            {
                $('#nextbtnstep1').prop('disabled', false);
            }
            
        }
    }
});
