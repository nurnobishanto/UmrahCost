<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A Custom package created for you</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h3 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>Your Credentials</h2>
    <p>Dear {{ $user->name }},</p>
    <p>Here are your login credentials:</p>
    <ul>
        <li><strong>URL:</strong> {{ $url }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Please keep your credentials confidential and do not share them with anyone. If you have any questions or need further assistance, feel free to contact our support team.</p>
    <p>Thank you for choosing our service!</p>
    <p>Sincerely,<br>
    Zamzam Travels</p>
</body>

</html>
