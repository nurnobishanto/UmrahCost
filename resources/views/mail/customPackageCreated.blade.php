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
    <h3>Dear {{ $user->name }}</h3>
    <p>A custom package created for you. <a target="_blank" href="{{ $url }}">Click Here</a> to view invoice</p>
    
</body>

</html>
