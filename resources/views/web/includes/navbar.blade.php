<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="#"><img src="{{ App\Http\Controllers\controller::logoHeader() }}" alt="" width="80" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto border-bottom border-lg-bottom-0 fontSize-14 pt-2 pt-lg-0">
            <li class="nav-item"><a class="nav-link {{ Route::is('web.home') ? 'active' : '' }}" aria-current="page" href="{{ route('web.home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link {{ Route::is('web.destination') ? 'active' : '' }}" href="{{ route('web.destination') }}">Destination</a></li>
            <li class="nav-item"><a class="nav-link {{ Route::is('web.tripFinder') ? 'active' : '' }}" href="{{ route('web.tripFinder') }}">Trip Finder</a></li>
            <li class="nav-item"><a class="nav-link {{ Route::is('web.about') ? 'active' : '' }}" href="{{ route('web.about') }}">About</a></li>
        </ul>
        <form class="d-flex py-3 ms-auto py-lg-0">
            <button class="btn btn-sm fontSize-12 fw-normal order-1 order-lg-0" type="button"><iconify-icon icon="ep:phone"></iconify-icon> {{ App\Http\Controllers\Controller::formatPhone(App\Http\Controllers\Controller::aboutUs()->mobile_phone) }}</button>
            <button class="btn rounded-indecon {{ Route::is('web.tripFinder') ? 'bg-trip-finder text-trip-finder' : 'bg-yellow text-white' }} backdrop-blur order-0 fontSize-12 opacity-70 px-16-px {{ Route::is('web.tourPlanning') ? 'me-2' : '' }}" type="button">ENG</button>
            <a href="{{ route('web.tourPlanning') }}" class="btn rounded-indecon {{ Route::is('web.tripFinder') ? 'bg-trip-finder text-trip-finder' : 'bg-yellow text-white' }} mx-1 backdrop-blur fontSize-14 order-0 py-2 {{ Route::is('web.tourPlanning') ? 'd-none' : '' }}">Start Planning Here</a>
            <a href="{{ route('login') }}" class="btn rounded-indecon {{ Route::is('web.tripFinder') ? 'bg-trip-finder text-trip-finder' : 'bg-yellow text-white' }} backdrop-blur order-0 py-2 opacity-70 px-16-px">
                @if (Auth::check())
                    @if (Auth::user()->file != null)
                        <img src="{{ asset('assets/images/user/'.Auth::user()->file) }}" alt="" class="img-fluid" width="22.4744" height="22.4744">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                            <g clip-path="url(#clip0_456_6866)">
                                <path d="M11.6948 12.0624C12.806 12.0624 13.8923 11.7329 14.8163 11.1155C15.7403 10.4981 16.4604 9.6206 16.8857 8.59394C17.3109 7.56727 17.4222 6.43756 17.2054 5.34766C16.9886 4.25776 16.4535 3.25662 15.6677 2.47085C14.8819 1.68507 13.8808 1.14995 12.7909 0.933158C11.701 0.716363 10.5713 0.82763 9.54463 1.25289C8.51796 1.67815 7.64046 2.3983 7.02308 3.32227C6.4057 4.24624 6.07617 5.33254 6.07617 6.4438C6.07766 7.93348 6.67009 9.36173 7.72346 10.4151C8.77683 11.4685 10.2051 12.0609 11.6948 12.0624ZM11.6948 2.69806C12.4356 2.69806 13.1598 2.91775 13.7758 3.32933C14.3918 3.74092 14.8719 4.32592 15.1554 5.01037C15.4389 5.69481 15.5131 6.44795 15.3685 7.17455C15.224 7.90115 14.8673 8.56858 14.3434 9.09243C13.8196 9.61628 13.1521 9.97302 12.4255 10.1176C11.6989 10.2621 10.9458 10.1879 10.2613 9.9044C9.5769 9.62089 8.99189 9.14079 8.58031 8.52481C8.16872 7.90883 7.94904 7.18463 7.94904 6.4438C7.94904 5.45037 8.34368 4.49762 9.04614 3.79516C9.7486 3.0927 10.7013 2.69806 11.6948 2.69806V2.69806Z" fill="white"/>
                                <path d="M11.6947 13.9355C9.46029 13.938 7.31806 14.8268 5.73806 16.4068C4.15806 17.9868 3.26932 20.129 3.26685 22.3634C3.26685 22.6118 3.36551 22.85 3.54112 23.0256C3.71674 23.2012 3.95492 23.2999 4.20328 23.2999C4.45164 23.2999 4.68982 23.2012 4.86544 23.0256C5.04105 22.85 5.13971 22.6118 5.13971 22.3634C5.13971 20.6249 5.83033 18.9576 7.05964 17.7283C8.28894 16.499 9.95624 15.8084 11.6947 15.8084C13.4332 15.8084 15.1005 16.499 16.3298 17.7283C17.5592 18.9576 18.2498 20.6249 18.2498 22.3634C18.2498 22.6118 18.3484 22.85 18.524 23.0256C18.6997 23.2012 18.9378 23.2999 19.1862 23.2999C19.4346 23.2999 19.6727 23.2012 19.8484 23.0256C20.024 22.85 20.1226 22.6118 20.1226 22.3634C20.1202 20.129 19.2314 17.9868 17.6514 16.4068C16.0714 14.8268 13.9292 13.938 11.6947 13.9355V13.9355Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_456_6866">
                                <rect width="22.4744" height="22.4744" fill="white" transform="translate(0.45752 0.825195)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    @endif
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                        <g clip-path="url(#clip0_456_6866)">
                            <path d="M11.6948 12.0624C12.806 12.0624 13.8923 11.7329 14.8163 11.1155C15.7403 10.4981 16.4604 9.6206 16.8857 8.59394C17.3109 7.56727 17.4222 6.43756 17.2054 5.34766C16.9886 4.25776 16.4535 3.25662 15.6677 2.47085C14.8819 1.68507 13.8808 1.14995 12.7909 0.933158C11.701 0.716363 10.5713 0.82763 9.54463 1.25289C8.51796 1.67815 7.64046 2.3983 7.02308 3.32227C6.4057 4.24624 6.07617 5.33254 6.07617 6.4438C6.07766 7.93348 6.67009 9.36173 7.72346 10.4151C8.77683 11.4685 10.2051 12.0609 11.6948 12.0624ZM11.6948 2.69806C12.4356 2.69806 13.1598 2.91775 13.7758 3.32933C14.3918 3.74092 14.8719 4.32592 15.1554 5.01037C15.4389 5.69481 15.5131 6.44795 15.3685 7.17455C15.224 7.90115 14.8673 8.56858 14.3434 9.09243C13.8196 9.61628 13.1521 9.97302 12.4255 10.1176C11.6989 10.2621 10.9458 10.1879 10.2613 9.9044C9.5769 9.62089 8.99189 9.14079 8.58031 8.52481C8.16872 7.90883 7.94904 7.18463 7.94904 6.4438C7.94904 5.45037 8.34368 4.49762 9.04614 3.79516C9.7486 3.0927 10.7013 2.69806 11.6948 2.69806V2.69806Z" fill="white"/>
                            <path d="M11.6947 13.9355C9.46029 13.938 7.31806 14.8268 5.73806 16.4068C4.15806 17.9868 3.26932 20.129 3.26685 22.3634C3.26685 22.6118 3.36551 22.85 3.54112 23.0256C3.71674 23.2012 3.95492 23.2999 4.20328 23.2999C4.45164 23.2999 4.68982 23.2012 4.86544 23.0256C5.04105 22.85 5.13971 22.6118 5.13971 22.3634C5.13971 20.6249 5.83033 18.9576 7.05964 17.7283C8.28894 16.499 9.95624 15.8084 11.6947 15.8084C13.4332 15.8084 15.1005 16.499 16.3298 17.7283C17.5592 18.9576 18.2498 20.6249 18.2498 22.3634C18.2498 22.6118 18.3484 22.85 18.524 23.0256C18.6997 23.2012 18.9378 23.2999 19.1862 23.2999C19.4346 23.2999 19.6727 23.2012 19.8484 23.0256C20.024 22.85 20.1226 22.6118 20.1226 22.3634C20.1202 20.129 19.2314 17.9868 17.6514 16.4068C16.0714 14.8268 13.9292 13.938 11.6947 13.9355V13.9355Z" fill="white"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_456_6866">
                            <rect width="22.4744" height="22.4744" fill="white" transform="translate(0.45752 0.825195)"/>
                            </clipPath>
                        </defs>
                    </svg>
                @endif
            </a>
        </form>
        </div>
    </div>
</nav>
