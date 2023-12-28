<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} -Customer Details</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Customer Details | {{ config('app.name') }}</title>
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .client-info {
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #333;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .edit-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .notes-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .notes-title {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .note {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .note-content {
            color: #333;
        }

        .status-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .status-title {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .status {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .status-label {
            font-weight: bold;
            color: #333;
        }

        .status-value {
            color: #555;
        }

        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Client Details</h1>
        <div class="client-info">
            <span class="label">Name:</span>
            <span class="value">{{ $client->name }}</span>
        </div>
        <div class="client-info">
            <span class="label">Email:</span>
            <span class="value">{{ $client->email }}</span>
        </div>
        <div class="client-info">
            <span class="label">Phone:</span>
            <span class="value">{{ $client->phone }}</span>
        </div>
        <div class="client-info">
            <span class="label">Source:</span>
            <span class="value">{{ $client->clientSource?->name }}</span>
        </div>
        <div class="client-info">
            <span class="label">CRM:</span>
            <span class="value">{{ $client?->crm?->name }}</span>
        </div>
        <div class="client-info">
            <span class="label">Status:</span>
            <span class="value">{{ $client?->clientStatus?->name }}</span>
        </div>
        <div class="client-info">
            <span class="label">Created:</span>
            <span class="value">{{ common_date_time_format($client?->created_at) }}</span>
        </div>
        <div class="client-info">
            <span class="label">Printed:</span>
            <span class="value">{{ common_date_time_format(Carbon\Carbon::now()) }}</span>
        </div>
        <div class="notes-container">
            <div class="notes-title">Topic:</div>
            <div class="note">
                <span class="note-content">{{ $client?->queryAbout?->name }}</span>
            </div>
        </div>
        <div class="notes-container">
            <div class="notes-title">Notes:</div>
            <div class="note">
                <span class="note-content">{{ $client?->notes }}</span>
            </div>
        </div>
        <div class="notes-container">
            <div class="notes-title">Query:</div>
            <div class="note">
                <span class="note-content">{{ $client?->query_details }}</span>
            </div>
        </div>
        <div class="button-container">
            <a href="javascript:window.print()" id="printPageButton" class="edit-button"><i class="fa fa-print"></i>
                Print</a>
        </div>
    </div>
</body>

</html>
