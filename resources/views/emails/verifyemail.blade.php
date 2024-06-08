<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
<body>
<p> Hi, {{  $verifyemailinfo->name }}</p>
<p> Thank you for signing up in Online Examination System.
<br/>
Please use {{  $verifyemailinfo->token }} to verify your email {{  $verifyemailinfo->email }}. </p>
<br/>
</body>
</html>



