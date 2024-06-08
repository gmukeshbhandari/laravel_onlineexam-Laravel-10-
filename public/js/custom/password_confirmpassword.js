$(document).ready(function () {
$('#password, #confirmpassword').blur(function () {
        var password = $('#password').val();
        var confirmPassword = $('#confirmpassword').val();
        if (password.length < 8 || password.length > 72 || confirmPassword.length < 8 || confirmPassword.length > 72) {
          if(password.length < 8 || confirmPassword.length < 8){
            if(password.length < 8)
            {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password must be minimum 8 character.');
                $('#password').addClass('is-invalid');
                $('#nextbtnstep2').prop('disabled', true);
            }
            if(confirmPassword.length < 8)
            {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password must be minimum 8 character.');
                $('#confirmpassword').addClass('is-invalid');
                $('#nextbtnstep2').prop('disabled', true);
            } 
          }
          if(password.length > 72 ||  confirmPassword.length > 72){
            if(password.length > 72 )
            {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password cannot be more than 72 characters.');
                $('#password').addClass('is-invalid');
                $('#nextbtnstep2').prop('disabled', true);
            }
            if(confirmPassword.length > 72)
            {
                $('#password_error').addClass('text-danger');
                $('#password_error').text('Password cannot be more than 72 characters.');
                $('#confirmpassword').addClass('is-invalid');
                $('#nextbtnstep2').prop('disabled', true);
            } 
          }

          if((password.length < 8 && confirmPassword.length > 72) || (confirmPassword.length < 8 && password.length > 72)){
            $('#password_error').addClass('text-danger');
            $('#password_error').text('Password must be between 8 to 72 character.');
            $('#password').addClass('is-invalid');
            $('#confirmpassword').addClass('is-invalid');
            $('#nextbtnstep2').prop('disabled', true);
          }
        }
  
        if (password !== confirmPassword) {
          $('#password_error').addClass('text-danger');
          $('#password_error').text('Passwords do not match.');
          $('#password').addClass('is-invalid');
          $('#nextbtnstep2').prop('disabled', true);
        }
  
        if ((password === confirmPassword) && (password.length > 8) && (password.length < 72) && (confirmPassword.length > 8) && (confirmPassword.length < 72))
         {
          $('#password_error').removeClass('text-danger');
          $('#password_error').text('');
          $('#password').removeClass('is-invalid');
          $('#nextbtnstep2').prop('disabled', false);
         }
    });
  });



  