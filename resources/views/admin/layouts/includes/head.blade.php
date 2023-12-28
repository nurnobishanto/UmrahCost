<meta charset="UTF-8">
<!-- responsive tag -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@stack('title') | {{ config('app.name') }}</title>

<!-- Start CSS -->
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/fontawesome/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/mdi.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/style.css') }}"> <!-- Template Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/custom.css') }}"> <!-- Template Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('assets/backend/css/toaster.min.css') }}">

@stack('style')
<!-- End CSS -->

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
