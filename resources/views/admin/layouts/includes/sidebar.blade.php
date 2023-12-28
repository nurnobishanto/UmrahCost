<!-- SideBar -->
<div class="ams-sidebar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img id="navbar-logo-big" src="{{ asset(get_static_option('logo') ?? 'loginasset/img/logo.png') }}" alt="logo">
            <img id="navbar-logo-small" src="{{ asset(get_static_option('logo') ?? 'loginasset/img/logo.png') }}" alt="logo">
        </a>
    </div>
    {{-- <div class="sidebar-search">
        <input type="text" placeholder="Search">
        <i class="fas fa-search"></i>
    </div> --}}
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : null }}"><i class="fas fa-columns nav-icon"></i><span>Dashboard</span></a>
        </li>
        
        @if (check_permission('Client Source List') || check_permission('Client Feedback List') || check_permission('Query About List') || check_permission('Client Status List') || check_permission('Status List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/clientSource*') ? ' active' : (Request::is('admin/queryAbout*') ? ' active' : (Request::is('admin/clientStatus*') ? ' active' : (Request::is('admin/status*') ? ' active' : null))) }}">
                    <i class="fa fa-user nav-icon"></i><span>Client Setting</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    @if (check_permission('Client Source List'))
                        <li class="menu-name {{ request()->routeIs('admin.clientSource.index') ? ' active' : null }}">
                            <a href="{{ route('admin.clientSource.index') }}">Client Source List</a>
                        </li>
                    @endif
                    @if (check_permission('Client Feedback List'))
                        <li class="menu-name {{ request()->routeIs('admin.clientFeedback.index') ? ' active' : null }}">
                            <a href="{{ route('admin.clientFeedback.index') }}">Client Feedback List</a>
                        </li>
                    @endif
                    @if (check_permission('Query About List'))
                        <li class="menu-name {{ request()->routeIs('admin.queryAbout.index') ? ' active' : null }}">
                            <a href="{{ route('admin.queryAbout.index') }}">Query About List</a>
                        </li>
                    @endif
                    @if (check_permission('Client Status List'))
                        <li class="menu-name {{ request()->routeIs('admin.clientStatus.index') ? ' active' : null }}">
                            <a href="{{ route('admin.clientStatus.index') }}">Client Status List</a>
                        </li>
                    @endif
                    @if (check_permission('Status List'))
                        <li class="menu-name {{ request()->routeIs('admin.status.index') ? ' active' : null }}">
                            <a href="{{ route('admin.status.index') }}">Status List</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (check_permission('Currency List') || check_permission('Package List') || check_permission('Package Type List') || check_permission('Hotel List') || check_permission('Room Type List') || check_permission('Airline List') || check_permission('Location List') || check_permission('Transport List') || check_permission('Guide List') || check_permission('Sightseeing List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/package*') ? ' active' : (Request::is('admin/packageType*') ? ' active' : (Request::is('admin/location*') ? ' active' : (Request::is('admin/hotel*') ? ' active' : (Request::is('admin/roomType*') ? ' active' : (Request::is('admin/airline*') ? ' active' : (Request::is('admin/currency*') ? ' active' : (Request::is('admin/sightseeing*') ? ' active' : (Request::is('admin/transport*') ? ' active' : ((Request::is('admin/guide*') ? ' active' : null)))))))))) }}">
                    <i class="fa fa-box nav-icon"></i><span>Package Setting</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    @if (check_permission('Currency List'))
                        <li class="menu-name {{ request()->routeIs('admin.currency.index') ? ' active' : null }}">
                            <a href="{{ route('admin.currency.index') }}">Currency List</a>
                        </li>
                    @endif
                    @if (check_permission('Package List'))
                        <li class="menu-name {{ request()->routeIs('admin.package.index') ? ' active' : null }}">
                            <a href="{{ route('admin.package.index') }}">Package List</a>
                        </li>
                    @endif
                    @if (check_permission('Package Type List'))
                        <li class="menu-name {{ request()->routeIs('admin.packageType.index') ? ' active' : null }}">
                            <a href="{{ route('admin.packageType.index') }}">Package Type List</a>
                        </li>
                    @endif
                    @if (check_permission('Hotel List'))
                        <li class="menu-name {{ request()->routeIs('admin.hotel.index') ? ' active' : null }}">
                            <a href="{{ route('admin.hotel.index') }}">Hotel List</a>
                        </li>
                    @endif
                    @if (check_permission('Room Type List'))
                        <li class="menu-name {{ request()->routeIs('admin.roomType.index') ? ' active' : null }}">
                            <a href="{{ route('admin.roomType.index') }}">Room Type List</a>
                        </li> 
                    @endif
                    @if (check_permission('Airline List'))
                        <li class="menu-name {{ request()->routeIs('admin.airline.index') ? ' active' : null }}">
                            <a href="{{ route('admin.airline.index') }}">Airline List</a>
                        </li>
                    @endif
                    @if (check_permission('Location List'))
                        <li class="menu-name {{ request()->routeIs('admin.location.index') ? ' active' : null }}">
                            <a href="{{ route('admin.location.index') }}">Location List</a>
                        </li>
                    @endif
                    @if (check_permission('Transport List'))
                        <li class="menu-name {{ request()->routeIs('admin.transport.index') ? ' active' : null }}">
                            <a href="{{ route('admin.transport.index') }}">Transport List</a>
                        </li>
                    @endif
                    @if (check_permission('Guide List'))
                        <li class="menu-name {{ request()->routeIs('admin.guide.index') ? ' active' : null }}">
                            <a href="{{ route('admin.guide.index') }}">Guide List</a>
                        </li>
                    @endif
                    @if (check_permission('Sightseeing List'))
                        <li class="menu-name {{ request()->routeIs('admin.sightseeing.index') ? ' active' : null }}">
                            <a href="{{ route('admin.sightseeing.index') }}">Sightseeing List</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (check_permission('Client List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/client*') ? ' active' : null }}">
                    <i class="fa fa-user nav-icon"></i><span>Client List</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-name {{ request()->routeIs('admin.client.index') ? ' active' : null }}">
                        <a href="{{ route('admin.client.index') }}">All Client</a>
                    </li>
                    @foreach (client_statuses() as $clientStatus)
                        <li class="menu-name {{ request()->routeIs('admin.client.index') ? ' active' : null }}">
                            <a href="{{ route('admin.client.index').'?client_status_id='.$clientStatus->id }}">{{ $clientStatus->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
        @if (check_permission('Role List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/role*') ? ' active' : null }}">
                    <i class="fa fa-stamp nav-icon"></i><span>Role</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-name {{ request()->routeIs('admin.role.index') ? ' active' : null }}">
                        <a href="{{ route('admin.role.index') }}">Role List</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (check_permission('CRM List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/crm*') ? ' active' : null }}">
                    <i class="fa fa-handshake nav-icon"></i><span>CRM</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-name {{ request()->routeIs('admin.crm.index') ? ' active' : null }}">
                        <a href="{{ route('admin.crm.index') }}">CRM List</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (check_permission('Custom Package List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/customPackage*') ? ' active' : null }}">
                    <i class="fa fa-clipboard-list nav-icon"></i><span>Custom Package</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-name {{ request()->routeIs('admin.customPackage.index') ? ' active' : null }}">
                        <a href="{{ route('admin.customPackage.index') }}">Custom Package List</a>
                    </li>
                </ul>
            </li>
        @endif
        
        @if (check_permission('Service Voucher Setting List') || check_permission('Service Voucher Setting Create') || check_permission('Service Voucher List'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/serviceVoucher*') ? ' active' : null }}">
                    <i class="fa fa-clipboard-list nav-icon"></i><span>Service Voucher</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    @if (check_permission('Service Voucher Setting List'))
                        <li class="menu-name {{ request()->routeIs('admin.serviceVoucher.index') ? ' active' : null }}">
                            <a href="{{ route('admin.serviceVoucher.index') }}">Service Voucher List</a>
                        </li>
                    @endif
                    
                    @if (check_permission('Service Voucher Setting List') || check_permission('Service Voucher Setting Create'))
                        <li class="menu-name {{ request()->routeIs('admin.serviceVoucherSetting.index') ? ' active' : null }}">
                            <a href="{{ route('admin.serviceVoucherSetting.index') }}">Service Voucher Setting</a>
                        </li>                        
                    @endif
                </ul>
            </li>
        @endif
        @if (check_permission('Application Information Update'))
            <li class="has-menu">
                <a href="#" class="has-children {{ Request::is('admin/setting*') ? ' active' : null }}">
                    <i class="fas fa-cog nav-icon"></i>
                    <span>Setting</span><span class="nav-expand"><i class="fas fa-angle-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="menu-name {{ request()->routeIs('admin.setting.information') ? ' active' : null }}">
                        <a href="{{ route('admin.setting.information') }}">Information</a>
                    </li>               
                </ul>
            </li>
        @endif
    </ul>
</div>
