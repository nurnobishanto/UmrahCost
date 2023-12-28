<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} -@stack('title')</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>@stack('title') | {{ config('app.name') }}</title>
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 2px solid #000;
        }

        .table td,
        .table th {
            padding: 8px 4px;
        }

        tfoot>tr>td {
            padding: 1px 0 !important;
        }

        .inv-heading{
            display: grid;
            grid-template-columns: 120px 1fr;
            align-items: center;
            grid-gap: 24px;
            padding-bottom: 16px  !important;
            margin-bottom: 16px !important;
            border-bottom: 2px solid #e5e5e5;
        }

        .inv-heading img{
            width: 120px;
            height: 120px;
        }

        .inv-heading .heading-text{
            border: 1px solid #000;
            padding: 16px;
            text-align: center;
        }

        .inv-heading .heading-text h5{
            font-size: 24px;
            font-weight: 700;
            color: #217a03;
        }

        .inv-heading .heading-text h6{
            font-size: 18px;
            font-weight: 700;
            margin: 4px 0 !important;
        }

        .inv-heading .heading-text h6:last-child{
            color: #db3449;
            margin: 0 !important;
        }

        .inv-sec > h6,
        .inv-summary > h6{
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 12px;
            text-decoration: underline;
        }

        .inv-sec .content p{
            display: grid;
            grid-template-columns: 180px 1fr;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .inv-summary .content p{
            font-size: 15px;
            font-weight: 500;
            display: grid;
            grid-template-columns: 180px 1fr 100px;
            margin-bottom: 4px;
        }

        .inv-summary .content p span:last-child{
            text-align: right;
        }

        .inv-summary .content p b{
            font-size: 20px;
        }

        .inv-notes b{
            margin-bottom: 16px;
        }

        .inv-notes .note{
            margin-bottom: 24px;
        }

        .inv-notes .note p{
            margin-bottom: 8px;
        }

        .inv-notes .note li{
            font-size: 15px;
            font-weight: 500;
            margin-left: 22px;
        }

        .inv-info p{
            font-size: 16px;
            font-weight: 700;
            margin-top: 8px;
        }

        .address-tbl{
            margin-top: 40px !important;
        }

        .address-tbl b{
            text-decoration: underline
        }

        .address-tbl td{
            padding-left: 8px;
        }

    </style>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i);

        .page,
        .page * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
            color: #232c3d;
        }

        .page {
            width: 21cm;
            max-width: 21cm;
            min-height: 29.7cm;
            margin: 90px auto 10px;
            padding: 40px;
            background-color: white;
            box-shadow: 0 0px 8px 0 rgb(0 0 0 / 6%), 0 1px 0px 0 rgb(0 0 0 / 2%);
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }

        @media print {
            @page {
                size: A4;
            }

            .page {
                width: 100%;
                max-width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .page,
            .page * {
                color: black;
            }
        }

        .page img {
            max-width: 100%;
        }

        .page .title {
            font-weight: bolder;
            letter-spacing: 0.1px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .page .subtitle {
            letter-spacing: 0.1px;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .page .property {
            font-size: 13px;
            color: black;
        }

        .page .property .key {
            font-weight: bold;
            margin-right: 2px;
            font-size: 13px;
            color: black;
        }

        .page .table-bordered thead th {
            font-size: 16px;
            vertical-align: middle !important;
        }

        .page .table-bordered td {
            font-size: 14px;
            font-weight: 600;
        }

        .page .summary-table {
            float: right;
        }

        .page .summary-table td,
        .page .summary-table th {
            border-top: none !important;
            border-bottom: none !important;
            font-size: 13px;
        }

        .page .summary-table td {
            padding: 5px 0
        }

        .page .payment-details {
            clear: both;
        }

        .page .table-bordered {
            border-left: none;
            border-right: none;
            border-top: 2px solid #000;
            border-bottom: none !important;
        }

        .page .border-transparent {
            border: 1px solid transparent;
        }

        .print-btn {
            position: fixed;
            bottom: 10px;
            right: 40%;
            z-index: 1000;
        }

        .page .table-bordered>tbody>tr>td {
            /* border: 1px solid #ebeff2; */
        }

        .invoice-name h3 {
            text-decoration: underline;
        }

        .summery-table p {
            font-size: 14px;
            font-weight: 600;
        }

        .single-box {
            background-color: #f5f5f5;
            border: 2px solid #d3d3d3;
            padding: 5px;
            margin-bottom: 16px;
        }

        .single-box h6 {
            font-weight: 600;
        }

        .hr-line {
            /* position: absolute;
            width: calc(100% - 80px);
            height: 2px;
            left: 40px;
            bottom: 0; */
            height: 2px;
            background-color: #000;
            margin-top: 50px
        }

        .voucher-code-table thead th {
            font-size: 14px !important;
            text-align: center;
        }

        .voucher-code-table tbody td {
            text-align: center;
        }

        .box-code-table .row>* {
            padding-right: 8px;
        }

        .page div[class^="col-"]{
            padding-right: 8px;
        }
    </style>

    <style type="text/css" media="print">
        body {
            font-weight: bold;
        }

        @page {
            /* size: auto; */
            /* auto is the initial value */
            /* margin: 0mm; */
            /* this affects the margin in the printer settings */
        }

        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body @if ($onload == true) onload="window.print();" @endif>
    <div class="print-btn d-print-none">
        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-print"></i> Print
        </a>

        @if(auth()->user() && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'crm'))
            <a href="{{ route('admin.customPackage.sendInvoiceToUser', encrypt($customPackage->id)) }}" class="btn btn-primary waves-effect waves-light">
                <i class="fas fa-share"></i> Send to User
            </a>
        @endif
    </div>


    <div style="margin-top: 50px;">
        @yield('print')
    </div>
</body>

</html>
