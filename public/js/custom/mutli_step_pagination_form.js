$(document).ready(function () {
    const steps = document.querySelectorAll('.step');
    const paginationItems = document.querySelectorAll('.pagination li');
    let currentStep = 1;
    const progress = document.getElementById("progress-bar");

    //console.log(steps.length);
    function showStep(step) {
        steps.forEach((stepElement) => {
            stepElement.style.display = 'none';
        });

        paginationItems.forEach((item) => {
            item.classList.remove('active');
        });

        steps[step - 1].style.display = 'block';
        paginationItems[step - 1].classList.add('active');
    }

    // document.querySelectorAll('.next').forEach((nextButton) => {
    //     nextButton.addEventListener('click', function () {
    //         if (validateStep(currentStep)) {  
    //             if (currentStep < steps.length) {
    //                 currentStep++;
    //                 showStep(currentStep);
    //                 const percentage = ((currentStep - 1) / 3) * 100;
    //                 progress.style.width = `${percentage}%`; 
    //             }
    //         }
    //     });
    // });




document.querySelectorAll('.next').forEach((nextButton) => {
    nextButton.addEventListener('click', function () {

        if (currentStep === 1)
        {
            var email = $('#adminemailregister').val().trim();
            var user_name = $('#adminusernameregister').val().trim();
            var pattern = /^[a-zA-Z0-9-_]{3,30}$/;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            // var institute_name = $('#institutename').val().trim();
            // var regex_institute_name = /^[a-zA-Z\s]+$/;
            
            if (emailRegex.test(email) && pattern.test(user_name))
            {
                // Asynchronous validation only for this condition
                validateStepForStepOneAsync().then((isValid) => {
                    if (isValid) {
                        if (currentStep < steps.length) {
                            currentStep++;
                            showStep(currentStep);
                            const percentage = ((currentStep - 1) / 3) * 100;
                            progress.style.width = `${percentage}%`;
                        }
                    }
                }).catch((error) => {
                    console.error('Error during validation:', error);
                });
            }
            else
            {
                // Synchronous validation for other conditions of step 1
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length) {
                        currentStep++;
                        showStep(currentStep);
                        const percentage = ((currentStep - 1) / 3) * 100;
                        progress.style.width = `${percentage}%`;
                    }
                }
            }
        }
        else if (currentStep  === 3)
        {
            var country = $('#country').val();
            var province = $('#province').val();
            var district = $('#district').val();
            var village = $('#village').val();
            var ward_no = $('#wardno').val();
            var street_address = $('#streetaddress').val();
            var email = $('#adminemailregister').val();
            var ins_name = $('#institutename').val();
            var _token = $('input[name="_token"]').val();

            if(country && country === "Nepal" && province && district && village && ward_no && street_address !== '')
            {
                $('#country').removeClass('is-invalid');
                $("#country_error_error").empty();
                $('#province').removeClass('is-invalid');
                $("#province_error").empty();
                $('#district').removeClass('is-invalid');
                $("#district_error").empty();
                $('#village').removeClass('is-invalid');
                $("#village_error").empty();
                $('#wardno').removeClass('is-invalid');
                $("#ward_error").empty();
                $('#streetaddress').removeClass('is-invalid');
                $("#street_address_error").empty();

                $('#country_error').removeClass('text-danger');
                $('#country_error').text('');
                $('#country_error_error').removeClass('text-danger');
                $('#country_error_error').text('');
                $('#verificationmessage').text('Verification Code is sent to your email: ' + email);
                // Asynchronous validation only for this condition
                validateStepForStepThreeAsync().then((isValid) => {
                    if (isValid) {
                        $('#loading_icon').addClass('d-none');
                        if (currentStep < steps.length) {
                            currentStep++;
                            showStep(currentStep);
                            const percentage = ((currentStep - 1) / 3) * 100;
                            progress.style.width = `${percentage}%`;
                        }
                    }
                    else{
                        $('#loading_icon').addClass('d-none');
                    }
                }).catch((error) => {
                    $('#loading_icon').addClass('d-none');
                    // console.error('Error during validation:', error);
                    if (error.status === 422)
                    {
                        errors = error.responseJSON.errors;
                        // console.log(errors);
                        if (errors.hasOwnProperty('country'))
                        {
                            $('#country').addClass('is-invalid');
                            $("#country_error_error").empty();
                            $.each(errors['country'], function(index, errorMessage) {
                            $("#country_error_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                
                        if (errors.hasOwnProperty('province'))
                        {
                            $('#province').addClass('is-invalid');
                            $("#province_error").empty();
                            $.each(errors['province'], function(index, errorMessage) {
                            $("#province_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                
                        if (errors.hasOwnProperty('district'))
                        {
                            $('#district').addClass('is-invalid');
                            $("#district_error").empty();
                            $.each(errors['district'], function(index, errorMessage) {
                            $("#district_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                
                        if (errors.hasOwnProperty('village'))
                        {
                            $('#village').addClass('is-invalid');
                            $("#village_error").empty();
                            $.each(errors['village'], function(index, errorMessage) {
                            $("#village_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                
                        if (errors.hasOwnProperty('ward_no'))
                        {
                            $('#wardno').addClass('is-invalid');
                            $("#ward_error").empty();
                            $.each(errors['ward_no'], function(index, errorMessage) {
                            $("#ward_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                
                        if (errors.hasOwnProperty('street_address'))
                        {
                            $('#streetaddress').addClass('is-invalid');
                            $("#street_address_error").empty();
                            $.each(errors['street_address'], function(index, errorMessage) {
                            $("#street_address_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                        return false;
                    
                    }
                    else {
                        // For other types of errors, you may want to perform different error handling tasks
                        console.error('AJAX request failed with status:', error.status);
                        return false;
                    }
                });
            }
            else
            {
                // Synchronous validation for other conditions of step 3
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length) {
                        currentStep++;
                        showStep(currentStep);
                        const percentage = ((currentStep - 1) / 3) * 100;
                        progress.style.width = `${percentage}%`;
                    }
                }
            }
        }
        else {
            // For Steps 2,4 perform synchronous validation only
            if (validateStep(currentStep)) {
                if (currentStep < steps.length) {
                    currentStep++;
                    showStep(currentStep);
                    const percentage = ((currentStep - 1) / 3) * 100;
                    progress.style.width = `${percentage}%`;
                }
            }
        }
    });
});







    document.querySelectorAll('.prev').forEach((prevButton) => {
        prevButton.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                const percentage = ((currentStep - 1) / 3) * 100;
                progress.style.width = `${percentage}%`;
            }
        });
    });

    function validateStepForStepOneAsync()
    {
        var email = $('#adminemailregister').val().trim();
        var user_name = $('#adminusernameregister').val().trim();
        var institute_name = $('#institutename').val().trim();
        var _token = $('input[name="_token"]').val();

        return new Promise((resolve, reject) => {
            $.ajax({
                url: checkusernameandEmailRoute,
                method: "POST",
                data: { email:email, username: user_name,institute_name:institute_name, _token: _token },
                dataType: 'json',
                success: function (result)
                {
                    // console.log(result);
                    // console.log(result.exist_check);

                    if(result.ins_msg === "institute_name_required")
                    {
                        $('#institutename_error').addClass('text-danger');
                        $('#institutename_error').text('Institute Name is required.');
                        $('#institutename').addClass('is-invalid');
                    }

                    if(result.ins_msg === "name_greater_than_60_and_space_alphabets_only.")
                    {
                        $('#institutename_error').addClass('text-danger');
                        $('#institutename_error').text('Institute name must not be greater than 60 characters.Also, institute name should contain only alphabets and spaces.');
                        $('#institutename').addClass('is-invalid');
                    }

                    if(result.ins_msg === "Institute name must not be greater than 60 characters.")
                    {
                        $('#institutename_error').addClass('text-danger');
                        $('#institutename_error').text('Institute name must not be greater than 60 characters.');
                        $('#institutename').addClass('is-invalid');
                    }

                    if(result.ins_msg === "Institute name should contain only alphabets and spaces.")
                    {
                        $('#institutename_error').addClass('text-danger');
                        $('#institutename_error').text('Institute name should contain only alphabets and spaces.');
                        $('#institutename').addClass('is-invalid');
                    }

                    if(result.ins_msg === "institute_no_error")
                    {
                        $('#institutename_error').removeClass('text-danger');
                        $('#institutename_error').text('');
                        $('#institutename').removeClass('is-invalid');
                    }

                    switch (result.exist_check)
                    {
                        case 'BothExist':
                            $('#admin_email_reg_error_check').removeClass('text-success');
                            $('#admin_email_reg_error_check').addClass('text-danger');
                            $('#admin_email_reg_error_check').text('This email is not available.');
                            $('#adminemailregister').addClass('is-invalid');
    
                            $('#admin_username_reg_check_error').removeClass('text-success');
                            $('#admin_username_reg_check_error').addClass('text-danger');
                            $('#admin_username_reg_check_error').text('This username is not available.');
                            $('#adminusernameregister').addClass('is-invalid');
                            resolve(false);
                            break;

                        case 'EmailExist':
                            $('#admin_email_reg_error_check').removeClass('text-success');
                            $('#admin_email_reg_error_check').addClass('text-danger');
                            $('#admin_email_reg_error_check').text('This email is not available.');
                            $('#adminemailregister').addClass('is-invalid');
    
                            $('#admin_username_reg_check_error').removeClass('text-danger');
                            $('#admin_username_reg_check_error').addClass('text-success');
                            $('#admin_username_reg_check_error').text('Username Available');
                            $('#adminusernameregister').removeClass('is-invalid');
                            resolve(false);
                            break;
                        
                        case 'Usernameexist':
                            $('#admin_email_reg_error_check').removeClass('text-danger');
                            $('#admin_email_reg_error_check').addClass('text-success');
                            $('#admin_email_reg_error_check').text('Email Available');
                            $('#adminemailregister').removeClass('is-invalid');
    
                            $('#admin_username_reg_check_error').removeClass('text-success');
                            $('#admin_username_reg_check_error').addClass('text-danger');
                            $('#admin_username_reg_check_error').text('This username is not available.');
                            $('#adminusernameregister').addClass('is-invalid');
                            resolve(false);
                            break;
                            
                        case 'BothAvailable':
                            $('#admin_email_reg_error_check').removeClass('text-danger');
                            $('#admin_email_reg_error_check').addClass('text-success');
                            $('#admin_email_reg_error_check').text('Email Available');
                            $('#adminemailregister').removeClass('is-invalid');
        
                            $('#admin_username_reg_check_error').removeClass('text-danger');
                            $('#admin_username_reg_check_error').addClass('text-success');
                            $('#admin_username_reg_check_error').text('Username Available');
                            $('#adminusernameregister').removeClass('is-invalid');
                            if(result.ins_msg === "institute_no_error")
                            {
                                resolve(true);
                                break;
                            }
                            else
                            {
                                resolve(false);
                                break;
                            }
                            
                        default:
                            resolve(false);
                    }
                }, 
                error: function (error) {
                    reject(error); // Reject the promise in case of an error
                }
            });
        });
    }

    function validateStepForStepThreeAsync()
    {
         // Show loading icon before making the AJAX call
        $('#loading_icon').removeClass('d-none');

        var country = $('#country').val();
        var province = $('#province').val();
        var district = $('#district').val();
        var village = $('#village').val();
        var ward_no = $('#wardno').val();
        var street_address = $('#streetaddress').val();
        var email = $('#adminemailregister').val();
        var ins_name = $('#institutename').val();
        var _token = $('input[name="_token"]').val();

        return new Promise((resolve, reject) => {
                $.ajax({
                            url: send_verfication_code,
                            method: "POST",
                            data: { email: email,ins_name: ins_name,_token: _token,country:country,province:province,district:district,village:village,ward_no:ward_no,street_address:street_address  },
                            dataType: 'json',
                            success: function (result)
                            {
                                if (result.msg === "success")
                                {
                                    resolve(true);
                                }
                                else
                                {
                                    resolve(false);
                                }
                                    
                            },
                            error: function (error)
                            {
                                reject(error);
                            }
                    });
            });
    }

        
    function validateStep(currentStep){
        if (currentStep === 1)
        {
            var email = $('#adminemailregister').val().trim();
            var user_name = $('#adminusernameregister').val().trim();
            var _token = $('input[name="_token"]').val();
            var institute_name = $('#institutename').val().trim();
            var regex_institute_name = /^[a-zA-Z\s]+$/;
            var pattern = /^[a-zA-Z0-9-_]{3,30}$/;
        
            if (institute_name === '' || institute_name.length > 60 || !regex_institute_name.test(institute_name))
            {
                if (institute_name === '')
                {
                    $('#institutename_error').addClass('text-danger');
                    $('#institutename_error').text('Institute Name is required.');
                    $('#institutename').addClass('is-invalid');
                    // return false;
                }
                if (institute_name.length > 60)
                {
                    $('#institutename_error').addClass('text-danger');
                    $('#institutename_error').text('Institute name must not be greater than 60 characters.');
                    $('#institutename').addClass('is-invalid');
                    // return false;
                }
                if(!regex_institute_name.test(institute_name))
                {
                    $('#institutename_error').addClass('text-danger');
                    $('#institutename_error').text('Institute name should contain only alphabets and spaces.');
                    $('#institutename').addClass('is-invalid');
                }
            }


            if (institute_name !== '' && institute_name.length <= 60 && regex_institute_name.test(institute_name))
            {
                $('#institutename_error').removeClass('text-danger');
                $('#institutename_error').text('');
                $('#institutename').removeClass('is-invalid');
            }
        

        
            if (!isValidEmailFormat(email) && !pattern.test(user_name)) //if both username and email are empty/non valid
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
                return false;
            }
        
            if (isValidEmailFormat(email) && !pattern.test(user_name))
            {
                $('#admin_username_reg_check_error').removeClass('text-success');
                $('#admin_username_reg_check_error').addClass('text-danger');
                $('#admin_username_reg_check_error').text('Invalid Username. Username must be minimum 3 character and must contains alphabets, numbers, dash and underscore only.');
                $('#adminusernameregister').addClass('is-invalid');
                validateEmail(email, _token);
            }
        
            if (!isValidEmailFormat(email) && pattern.test(user_name))
            {
                //email
                $('#admin_email_reg_error_check').removeClass('text-success');
                $('#admin_email_reg_error_check').addClass('text-danger');
                $('#admin_email_reg_error_check').text('Invalid Email');
                $('#adminemailregister').addClass('is-invalid');
                validateUsername(user_name, _token,);
            }
        
            //if (isValidEmailFormat(email) && pattern.test(user_name))
            //{
            //     return new Promise((resolve, reject) => {
            //     $.ajax({
            //         url: checkusernameandEmailRoute,
            //         method: "POST",
            //         data: { email:email, username: user_name, _token: _token },
            //         dataType: 'json',
            //         success: function (result)
            //         {
            //             // console.log(result);
            //             // console.log(result.exist_check);

            //             switch (result.exist_check)
            //             {
            //                 case 'BothExist':
            //                     $('#admin_email_reg_error_check').removeClass('text-success');
            //                     $('#admin_email_reg_error_check').addClass('text-danger');
            //                     $('#admin_email_reg_error_check').text('This email is not available.');
            //                     $('#adminemailregister').addClass('is-invalid');
        
            //                     $('#admin_username_reg_check_error').removeClass('text-success');
            //                     $('#admin_username_reg_check_error').addClass('text-danger');
            //                     $('#admin_username_reg_check_error').text('This username is not available.');
            //                     $('#adminusernameregister').addClass('is-invalid');
            //                     resolve(false);
            //                     break;

            //                 case 'EmailExist':
            //                     $('#admin_email_reg_error_check').removeClass('text-success');
            //                     $('#admin_email_reg_error_check').addClass('text-danger');
            //                     $('#admin_email_reg_error_check').text('This email is not available.');
            //                     $('#adminemailregister').addClass('is-invalid');
        
            //                     $('#admin_username_reg_check_error').removeClass('text-danger');
            //                     $('#admin_username_reg_check_error').addClass('text-success');
            //                     $('#admin_username_reg_check_error').text('Username Available');
            //                     $('#adminusernameregister').removeClass('is-invalid');
            //                     resolve(false);
            //                     break;
                            
            //                 case 'Usernameexist':
            //                     $('#admin_email_reg_error_check').removeClass('text-danger');
            //                     $('#admin_email_reg_error_check').addClass('text-success');
            //                     $('#admin_email_reg_error_check').text('Email Available');
            //                     $('#adminemailregister').removeClass('is-invalid');
        
            //                     $('#admin_username_reg_check_error').removeClass('text-success');
            //                     $('#admin_username_reg_check_error').addClass('text-danger');
            //                     $('#admin_username_reg_check_error').text('This username is not available.');
            //                     $('#adminusernameregister').addClass('is-invalid');
            //                     resolve(false);
            //                     break;
                                
            //                 case 'BothAvailable':
            //                     $('#admin_email_reg_error_check').removeClass('text-danger');
            //                     $('#admin_email_reg_error_check').addClass('text-success');
            //                     $('#admin_email_reg_error_check').text('Email Available');
            //                     $('#adminemailregister').removeClass('is-invalid');
            
            //                     $('#admin_username_reg_check_error').removeClass('text-danger');
            //                     $('#admin_username_reg_check_error').addClass('text-success');
            //                     $('#admin_username_reg_check_error').text('Username Available');
            //                     $('#adminusernameregister').removeClass('is-invalid');
            //                     resolve(true);
            //                     break;
            //                 default:
            //                     resolve(false);
            //             }
            //         }, 
            //         error: function (error) {
            //             reject(error); // Reject the promise in case of an error
            //         }
            //     });
            // });
        

            //} 
            
        
            function isValidEmailFormat(email)
            {
                // Regular expression for a simple email format validation
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return emailRegex.test(email);
            }
        
            function validateEmail(email, _token)
            {
                $.ajax({
                    url: checkEmailRoute,
                    method: "POST",
                    data: { email: email, _token: _token },
                    dataType: 'json',
                    success: function (result)
                    {
                        handleValidationResult(result, '#admin_email_reg_error_check', '#adminemailregister','email');
                    },
                    error: function (error)
                    {
                        console.error('Error:', error);
                    }
                });
            }
        
            function validateUsername(user_name, _token)
            {
                $.ajax({
                    url: checkusernameRoute,
                    method: "POST",
                    data: { username: user_name, _token: _token },
                    dataType: 'json',
                    success: function (result)
                    {
                        handleValidationResult(result, '#admin_username_reg_check_error', '#adminusernameregister','username');
                    },
                        error: function (error)
                    {
                    console.error('Error:', error);
                }
                });
            }
        
            function handleValidationResult(result, errorElement, inputElement,usernameoremail)
            {
                var successClass = 'text-success';
                var dangerClass = 'text-danger';
                var invalidClass = 'is-invalid';
        
                if (result.email_exist_check === "Email Exist" || result.username_exist_check === "Username Exist")
                {
                    $(errorElement).removeClass(successClass).addClass(dangerClass);
                    $(errorElement).text('This ' + usernameoremail + ' is not available.');
                    $(inputElement).addClass(invalidClass);
                    return false;
                }
                else
                {
                    $(errorElement).removeClass(dangerClass).addClass(successClass);
                    var user_or_email =  usernameoremail.charAt(0).toUpperCase() + usernameoremail.slice(1); //Capitalized First letter
                    $(errorElement).text(user_or_email + ' Available.');
                    $(inputElement).removeClass(invalidClass);
                    return true;
                }
            }

        }

        if (currentStep === 2)
        {
            var password = $('#password').val();
            var confirmPassword = $('#confirmpassword').val();
              if(password.length < 8 && confirmPassword.length < 8)
              {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password must be minimum 8 character.');
                $('#password').addClass('is-invalid');
                $('#confirmpassword').addClass('is-invalid');
                return false;
              }

              if(password.length > 72 && confirmPassword.length > 72)
              {  
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password cannot be more than 72 characters.');
                $('#password').addClass('is-invalid');
                $('#confirmpassword').addClass('is-invalid');
                return false;
              }

              if((password.length < 8 && confirmPassword.length > 72) || (confirmPassword.length < 8 && password.length > 72))
              {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password must be between 8 to 72 character.');
                $('#password').addClass('is-invalid');
                $('#confirmpassword').addClass('is-invalid');
                return false;
              }
            
      
            if (password !== confirmPassword)
            {
              $('#password_error').addClass('text-danger');
              $('#password_error').text('Passwords do not match.');
              $('#password').addClass('is-invalid');
              $('#confirmpassword').addClass('is-invalid');
              return false;
            }
      
            if ((password === confirmPassword) && (password.length >= 8) && (password.length <= 72) && (confirmPassword.length >= 8) && (confirmPassword.length <= 72))
             {
              $('#password_error').removeClass('text-danger');
              $('#password_error').text('');
              $('#password').removeClass('is-invalid');
              $('#confirmpassword').removeClass('is-invalid');
              return true;
             }
        }
        if (currentStep === 3)
        {
            var country = $('#country').val();
            var province = $('#province').val();
            var district = $('#district').val();
            var village = $('#village').val();
            var ward_no = $('#wardno').val();
            var street_address = $('#streetaddress').val();
            var email = $('#adminemailregister').val();
            var ins_name = $('#institutename').val();
            var _token = $('input[name="_token"]').val();
           
            if(!country)
            {
                $('#country_error_error').addClass('text-danger');
                $('#country_error_error').text('Country must be selected.');
                return false; // Prevent form going to next pagination
            }

            if (country)
            {
                $('#country').removeClass('is-invalid');
                $("#country_error_error").empty();
                $('#province').removeClass('is-invalid');
                $("#province_error").empty();
                $('#district').removeClass('is-invalid');
                $("#district_error").empty();
                $('#village').removeClass('is-invalid');
                $("#village_error").empty();
                $('#wardno').removeClass('is-invalid');
                $("#ward_error").empty();
                $('#streetaddress').removeClass('is-invalid');
                $("#street_address_error").empty();

               if(country === 'Nepal' )
               {
                   if(!province || !district || !village || !ward_no || !street_address)
                   {
                    $('#country_error').addClass('text-danger');
                    $('#country_error').text('All fields are required if the country is Nepal.');
                    
                    
                    if (!province) {
                        $('#province').addClass('is-invalid');
                    }
                    else{
                        $('#province').removeClass('is-invalid');
                    }
                    
                    if (!district) {
                        $('#district').addClass('is-invalid');
                    }
                    else{
                        $('#district').removeClass('is-invalid');
                    }
                    
                    if (!village) {
                        $('#village').addClass('is-invalid');
                    }
                    else{
                        $('#village').removeClass('is-invalid');
                    }
                    
                    if (!ward_no) {
                        $('#wardno').addClass('is-invalid');
                    }
                    else{
                        $('#wardno').removeClass('is-invalid');
                    }

                    if (!street_address) {
                        $('#streetaddress').addClass('is-invalid');
                    }
                    else{
                        $('#streetaddress').removeClass('is-invalid');
                    }
                       return false;
                   }
                }

                if(country !== 'Nepal')
                {
                    $('#country_error').removeClass('text-danger');
                    $('#country_error').text('');
                    $('#country_error_error').removeClass('text-danger');
                    $('#country_error_error').text('');
                    $('#verificationmessage').text('Verification Code is sent to your email: ' + email);
                    $.ajax({
                        url: send_verfication_code,
                            method: "POST",
                            data: { email: email,ins_name: ins_name,_token: _token,country:country  },
                            dataType: 'json',
                             success: function (result) {
                          
                             
                            },
                            error: function (error) {
                                // Handle errors if the request fails
                                console.error('Error:', error);
                            }
                        });
                    return true;
                } 
            }

        }
    }

    $('#registration_form').on('submit', function (event) {
        event.preventDefault();
        //  $('#registration_form').submit(function (event) {
         var email = $('#adminemailregister').val();
          var _token = $('input[name="_token"]').val();
          var ver_code = $('#verification_code').val();
       
            if (ver_code === ''){
                $("#verification_error").addClass('text-danger');
                $("#verification_error").text('Enter Verifiction Code.');
               $('#verification_code').addClass('is-invalid');
              return false;
            }
                    $.ajax({
                    url: checkVerificationCode,
                        method: "POST",
                        data: { email: email, ver_code:ver_code, _token: _token  },
                        dataType: 'json',
                         success: function (result) {
                             if (result.msg === 'Done')
                            {
                                $('#registration_form').off('submit'); // Avoid infinite loop
                                $('#registration_form').submit();
                            }
                             if (result.msg === 'Code Expired')
                            {
                                $("#verification_error").addClass('text-danger');
                                $("#verification_error").text('Code Expired.');
                                $('#verification_code').addClass('is-invalid');
                        //console.log('noexist');
                              //event.preventDefault();
                            }
                            if (result.msg === 'Invalid Verification Code')
                            {
                                $("#verification_error").addClass('text-danger');
                                $("#verification_error").text('Invalid Verification Code.');
                                $('#verification_code').addClass('is-invalid');
                               
                            }
                            if (result.msg === 'Email Not Found')
                            {
                                $("#verification_error").addClass('text-danger');
                                $("#verification_error").text('Email Not Found.');
                                $('#verification_code').addClass('is-invalid');
                            }
                           
           
                        },
                        error: function (error) {
                            // Handle errors if the request fails
                            console.error('Error:', error);
                        }
                    });
                });
});




