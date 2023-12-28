<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- responsive tag -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inject:css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/fontawesome/css/all.css') }}">
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/responsive.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('title') | {{ config('app.name') }}</title>

    @stack('style')

</head>

<body>

    <!-- Mian Content -->
    @yield('content')
    <!-- Js files -->
    <script src="{{ asset('assets/backend/js/modernizr-3.5.0.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>

    @stack('script')
    <script src="{{ asset('assets/backend/js/main.js') }}"></script>
    @if ($errors->any())
        <script type="text/javascript">
            $(document).ready(function() {
                var errors = '{{ json_encode($errors->all()) }}';
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += ('' + value + '\n');
                });

                swal(errorMessage, {
                    icon: "warning",
                });
            });
        </script>
    @endif
</body>

</html>
