<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password Mail</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your new password is: {{ $password }}</p>
    <p>Please use this password to log in and consider changing it for security reasons.</p>
</body>
</html>
