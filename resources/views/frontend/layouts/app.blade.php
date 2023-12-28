<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.includes.head')
</head>

<body>
    <!-- Header -->
    @include('frontend.layouts.includes.header')

    @yield('content')
    @if (Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            @method('POST')
        </form>
    @endif

    <!-- Footer -->
    @include('frontend.layouts.includes.footer')
    <!-- Js files -->
    @include('frontend.layouts.includes.scripts')

    @if (session()->has('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                var errorMessage = '{{ Session::get('success') }}';
                swal(errorMessage, {
                    icon: "success",
                });
            });
        </script>
    @endif
    @if (session()->has('warning'))
        <script type="text/javascript">
            $(document).ready(function() {
                var errorMessage = '{{ Session::get('warning') }}';
                swal(errorMessage, {
                    icon: "warning",
                });
            });
        </script>
    @endif
</body>

</html>
