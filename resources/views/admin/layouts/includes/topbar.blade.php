<!-- Topbar -->
<div class="ams-nav-wpr">
    <span class="nav-toggle">
        <i class="fas fa-bars"></i>
    </span>
    <nav class="main-nav">
        <ul>
            @if (check_permission('Client Create'))
                <li><a class="{{ request()->routeIs('admin.client.create') ? ' active' : null }}"
                href="{{ route('admin.client.create') }}">Add Client</a></li>
            @endif
            @if (check_permission('Client List'))
                <li><a class="{{ request()->routeIs('admin.client.index') ? ' active' : null }}"
                href="{{ route('admin.client.index') }}">Package Preparation</a></li>
            @endif
            @if (check_permission('Service Voucher Create'))
                <li><a class="{{ request()->routeIs('admin.serviceVoucher.create') ? ' active' : null }}"
                href="{{ route('admin.serviceVoucher.create') }}">Service Voucher Create</a></li>
            @endif
        </ul>
    </nav>
    <div class="nav-right">
        {{-- <div class="lang-dropdown">
            <button onclick="langSelect()" class="dropbtn">English <i class="fas fa-caret-down ms-2"></i></button>
            <div id="lang-dropdown" class="dropdown-content">
                <a href="#">French</a>
                <a href="#">Dutch</a>
            </div>
        </div> --}}
        {{-- <span class="nav-search">
            <i class="fas fa-search search-icon"></i>
            <div class="nav-search-input">
                <input type="text" placeholder="Search here">
                <span class="search-close"><i class="fas fa-times"></i></span>
            </div>
        </span>
        <div onclick="getNotifications()" class="nav-item" id="notification-count"
            data-content="02">
            <i class="far fa-bell"></i>
            <div class="ams-notification-widget dropdown-content" id="notify-dropdown">
                <div class="notify-title">
                    <h6>Notifications</h6>
                </div>
                <div class="notify-content" id="notify-content">

                </div>
                <div class="notify-footer">
                    <a href="#">See All..</a>
                </div>
            </div>
        </div> --}}
        <div class="ams-admin-wpr">
            <div onclick="profileSelect()" class="ams-admin">
                <div class="admin-image">
                    <img src="{{ asset('assets/backend/images/no_image.jpg') }}" alt="admin">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="admin-details">
                    <h6 class="mb-0">{{ auth()->user() ? auth()->user()->name : 'Guest User' }}</h6>
                    <p>{{ auth()->user() ? 'User' : 'Designation' }}</p>
                </div>
            </div>
            <div id="profile-dropdown" class="dropdown-content">
                <a href="{{ route('admin.profile.edit') }}"><i class="far fa-edit"></i> Edit Profile</a>
                {{-- <a href="#"><i class="far fa-bell"></i> Notification</a> --}}
                <a href="{{ route('admin.changePassword') }}"><i class="fas fa-exclamation-circle"></i> Change
                    Password</a>
                <a href="javascript:void(0)" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        <span class="nav-item menu-stack"><i class="fas fa-ellipsis-v"></i></span>
    </div>
</div>


<script>
    function getNotifications() {
        
    }
</script>
