<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp</title>
</head>

<body>
    <h3>Dear {{ $user->name ?? 'User' }} .</h3>
    <p>Your Otp is {{ $otp ?? '' }} . Use it to reset a new password.</p>
</body>

</html>
