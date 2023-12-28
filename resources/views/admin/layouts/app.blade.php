<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.includes.head')
</head>

<body>
    <!-- SideBar -->
    @include('admin.layouts.includes.sidebar')

    <!-- Main Content -->
    <div class="ams-dashboard ams-main-content">
        <!-- Topbar -->
        @include('admin.layouts.includes.topbar')

        <!-- Main Dashboard Content -->
        <div class="ams-main-content-wpr">

            @yield('content')

            @include('admin.layouts.includes.show-modal')
            @include('admin.layouts.includes.common-modal')
            <!-- Footer -->
            @include('admin.layouts.includes.footer')
            @if (Auth::check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    @method('POST')
                </form>
            @endif
        </div>
    </div>
    <!-- Start JS -->
    <audio id="myAudio">
        <source src="{{ asset('assets/sounds/sound-1.mp3') }}" type="audio/mpeg">
    </audio>

    @include('admin.layouts.includes.scripts')
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
    
    @if (session()->has('play_audio'))
        <script>
            document.getElementById("myAudio").play();
        </script>
    @endif
</body>

</html>
