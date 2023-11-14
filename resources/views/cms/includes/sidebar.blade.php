<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon"><span class="logo-text">Company</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ Auth::user()->file != null ? asset('assets/images/user/'.Auth::user()->file) : asset('assets/cms/images/avatars/avatar.png') }}" width="40" height="40">
                <span class="activity-indicator"></span>
                <span class="user-info-text">{{ Auth::user()->name }}<br><span class="user-state-info">{{ Auth::user()->user_type }}</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
                <li class="{{ Route::is('cms.dashboard') ? 'active-page' : '' }}">
                    <a href="{{ route('cms.dashboard') }}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                </li>
            @endif
            <li class="{{ Route::is('message.*') ? 'active-page' : '' }}">
                <a href="{{ route('message.index') }}"><i class="material-icons-two-tone">inbox</i>messsage
                    {{-- <span class="badge rounded-pill badge-danger float-end">87</span> --}}
                </a>
            </li>
            <li class="{{ Route::is('tourPlanning.index') ? 'active-page' : '' }}">
                <a href="{{ route('tourPlanning.index') }}" class="active"><i class="material-icons-two-tone">airline_seat_recline_extra</i>Request Trip</a>
            </li>
            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Route::is('websiteManagement.*') ? 'active-page' : '' }}">
                    <a href=""><i class="material-icons-two-tone">chrome_reader_mode</i>Website Management<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a class="{{ Route::is('websiteManagement.banner.*') ? 'active' : '' }}" href="{{ route('websiteManagement.banner.index') }}">Banners</a>
                        </li>
                        <li>
                            <a class="{{ Route::is('websiteManagement.partner.*') ? 'active' : '' }}" href="{{ route('websiteManagement.partner.index') }}">Partners</a>
                        </li>
                        <li>
                            <a class="{{ Route::is('websiteManagement.testimony.*') ? 'active' : '' }}" href="{{ route('websiteManagement.testimony.index') }}">Testimonies</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="{{ Route::is('fileManager.file.*') ? 'active-page' : '' }}">
                <a href="{{ route('fileManager.file.index') }}" class="{{ Route::is('fileManager.file.*') ? 'active' : '' }}"><i class="material-icons-two-tone">cloud_queue</i>File Manager</a>
            </li>
            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Route::is('newsManagement.*') ? 'active-page' : '' }}">
                    <a href=""><i class="material-icons-two-tone">burst_mode</i>Article Management<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a class="{{ Route::is('newsManagement.news.*') ? 'active' : '' }}" href="{{ route('newsManagement.news.index') }}">Article</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="{{ Route::is('masterData.*') ? 'active-page' : '' }}">
                <a href=""><i class="material-icons-two-tone">book</i>Master Data<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        @if (Auth::user()->user_type == 'admin')
                            <a class="{{ Route::is('masterData.category.*') ? 'active' : '' }}" href="{{ route('masterData.category.index') }}">Categories</a>
                        @endif
                        {{-- <a class="{{ Route::is('masterData.sub-category.*') ? 'active' : '' }}" href="{{ route('masterData.sub-category.index') }}">Sub Categories</a> --}}
                        <a class="{{ Route::is('masterData.packages.*') ? 'active' : '' }}" href="{{ route('masterData.packages.index') }}">Tour Packages</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">account_balance_wallet</i>Transaction<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Transaction</a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Route::is('userManagement.*') || Route::is('dashboard.customer') || Route::is('dashboard.profile') ? 'active-page' : '' }}">
                    <a href=""><i class="material-icons-two-tone">supervisor_account</i>User Management<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        @if (Auth::user()->user_type == 'admin')
                        <li>
                            <a class="{{ Route::is('userManagement.*') ? 'active' : '' }}" href="{{ route('userManagement.index') }}">Admin</a>
                            <a class="{{ Route::is('dashboard.customer') || Route::is('dashboard.profile') ? 'active' : '' }}" href="{{ route('dashboard.customer') }}">Customer</a>
                        </li>
                        @else
                            <li><a class="{{ Route::is('dashboard.profile') ? 'active' : '' }}" href="{{ route('dashboard.profile', Auth::user()->id) }}">Edit Profile</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::user()->user_type == 'admin')
                <li class="{{ Route::is('companyManagement.*') ? 'active-page' : '' }}">
                    <a href=""><i class="material-icons-two-tone">settings_applications</i>Settings<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a class="{{ Route::is('companyManagement.*') ? 'active' : '' }}" href="{{ route('companyManagement.about-us.create') }}">About Us</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
