$('#user_form').on('submit', function (event) {
        event.preventDefault();
        // let first_name = $('#first_name').val();
        // let middle_name = $('#middle_name').val();
        // let last_name = $('#last_name').val();
        // let email = $('#email').val();
        // let username = $('#username').val();
        // let institute_username = $('#institute_username').val();
        // let gender = $('#gender').val();
        // let password = $('#password').val();
        // let confirmpassword = $('#confirmpassword').val();
        // let country = $('#country').val();
        // let province = $('#province').val();
        // let district = $('#district').val();
        // let village = $('#village').val();
        // let ward_no = $('#ward_no').val();
        // let street_address = $('#street_address').val();
        // let _token = $('input[name="_token"]').val();
        let formData = new FormData(this);

        $('#first_name').removeClass('is-invalid');
        $("#first_name_error").empty();
        $('#middle_name').removeClass('is-invalid');
        $("#middle_name_error").empty();
        $('#last_name').removeClass('is-invalid');
        $("#last_name_error").empty();
        $('#email').removeClass('is-invalid');
        $("#email_error").empty();
        $('#username').removeClass('is-invalid');
        $("#username_error").empty();
        $('#institute_username').removeClass('is-invalid');
        $("#institute_username_error").empty();
        $('#gender').removeClass('is-invalid');
        $("#gender_error").empty();
        $('#password').removeClass('is-invalid');
        $("#password_error").empty();
        $('#confirmpassword').removeClass('is-invalid');
        $("#confirm_password_error").empty();
        $('#country').removeClass('is-invalid');
        $("#country_error").empty();
        $('#province').removeClass('is-invalid');
        $("#province_error").empty();
        $('#district').removeClass('is-invalid');
        $("#district_error").empty();
        $('#village').removeClass('is-invalid');
        $("#village_error").empty();
        $('#ward_no').removeClass('is-invalid');
        $("#ward_error").empty();
        $('#street_address').removeClass('is-invalid');
        $("#street_address_error").empty();

        $.ajax({
                type: 'POST',
                url: user_registration_check,
                data: formData,
                // data: {_token:_token,first_name: first_name,middle_name:middle_name,last_name:last_name,email:email,username:username,institute_username:institute_username,gender:gender,password:password,confirmpassword:confirmpassword,country:country,province:province,district:district,village:village,ward_no:ward_no,street_address:street_address},
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false for file uploads
                dataType: 'json',
                success: function(result) {
                    if(result.message === 'success'){
                        window.location.href = user_home_page_route;
                    }
                },
                error: function(error) {
                    if (error.status === 422)
                    {
                        errors = error.responseJSON.errors;
                        // console.log(error);
                        // console.log('\n');
                        //console.log(errors);
                        if (errors.hasOwnProperty('first_name'))
                        {
                            $('#first_name').addClass('is-invalid');
                            $("#first_name_error").empty();
                            $.each(errors['first_name'], function(index, errorMessage) {
                            $("#first_name_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('middle_name'))
                        {
                            $('#middle_name').addClass('is-invalid');
                            $("#middle_name_error").empty();
                            $.each(errors['middle_name'], function(index, errorMessage) {
                            $("#middle_name_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('last_name'))
                        {
                            $('#last_name').addClass('is-invalid');
                            $("#last_name_error").empty();
                            $.each(errors['last_name'], function(index, errorMessage) {
                            $("#last_name_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('email'))
                        {
                            $('#email').addClass('is-invalid');
                            $("#email_error").empty();
                            $.each(errors['email'], function(index, errorMessage) {
                            $("#email_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('username'))
                        {
                            $('#username').addClass('is-invalid');
                            $("#username_error").empty();
                            $.each(errors['username'], function(index, errorMessage) {
                            $("#username_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('institute_username'))
                        {
                            $('#institute_username').addClass('is-invalid');
                            $("#institute_username_error").empty();
                            $.each(errors['institute_username'], function(index, errorMessage) {
                            $("#institute_username_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('gender'))
                        {
                            $('#gender').addClass('is-invalid');
                            $("#gender_error").empty();
                            $.each(errors['gender'], function(index, errorMessage) {
                            $("#gender_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('password'))
                        {
                            $('#password').addClass('is-invalid');
                            $("#password_error").empty();
                            $.each(errors['password'], function(index, errorMessage) {
                            $("#password_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('confirmpassword'))
                        {
                            $('#confirmpassword').addClass('is-invalid');
                            $("#confirm_password_error").empty();
                            $.each(errors['confirmpassword'], function(index, errorMessage) {
                            $("#confirm_password_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
   
                        if (errors.hasOwnProperty('country'))
                        {
                            $('#country').addClass('is-invalid');
                            $("#country_error").empty();
                            $.each(errors['country'], function(index, errorMessage) {
                            $("#country_error").append('<div>' + errorMessage + '</div>');
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
                            $('#ward_no').addClass('is-invalid');
                            $("#ward_error").empty();
                            $.each(errors['ward_no'], function(index, errorMessage) {
                            $("#ward_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('street_address'))
                        {
                            $('#street_address').addClass('is-invalid');
                            $("#street_address_error").empty();
                            $.each(errors['street_address'], function(index, errorMessage) {
                            $("#street_address_error").append('<div>' + errorMessage + '</div>');
                            });
                        }
                    } 
                }
        });
});