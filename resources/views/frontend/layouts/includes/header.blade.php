<header class="trv-header">
    <div class="trv-toolbar">
        <div class="container">
            <div class="toolbar-wpr">
                <a href="{{ route('frontend.index') }}" class="logo"><img
                        src="{{ asset('assets/frontend/images/logo.png') }}" alt="ZamZam Travels"></a>
                <div>
                    <p>24 hours a day, 7 days a week</p>
                    <a href="mailto:info@umrahcost.com">info@umrahcost.com</a>
                </div>
                <div>
                    <p><a href="tel:01978015579">01978015579</a></p>
                    <p><a href="tel:01705401060">01705401060</a></p>
                </div>
                <a href="#" class="cosult-btn">Free Consultation</a>
            </div>
        </div>
    </div>
    <div class="header-wpr">
        <div class="container">
            <div class="header-container">
                <nav class="nav-menu">
                    <a href="#">About</a>
                    <a href="{{ route('frontend.customPackage.create') }}">Umrah Package</a>
                    <a href="#">Hajj Package</a>
                    <a href="{{ route('frontend.customPackage.create') }}">Umrah Package Calculator</a>
                    <a href="#">Blog</a>
                    <a href="#">Contact</a>

                    @auth
                        @if (auth()->user()->user_type == 'client')
                            <a href="{{ route('frontend.index') }}">Dashboard</a>
                        @else
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @endif
                    @endauth
                </nav>
                <button class="nav-btn d-lg-none"><i class="icofont-navigation-menu"></i></button>
                @auth
                    <a href="javascript:void(0)" class="sign-btn logout-btn">Logout</a>
                @else
                    <a  href="{{ route('web.login_view') }}" class="sign-btn">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</header>
