<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Password Reset </title>
</head>
<body>
    <p> Dear {{  $resetpasswordinfo->name }},</p>
    <p> You recently requested a password reset for your email {{  $resetpasswordinfo->email }} of Online Examination System. To complete the process, click the link below. </p>
    <br/>
    <a href="{{ route('reset_password', ['token' => $resetpasswordinfo->token]) }}">Reset now</a>
    
</body>
</html>

