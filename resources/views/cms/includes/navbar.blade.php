<div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                    </li>
                    {{-- <li class="nav-item dropdown hidden-on-mobile">
                        <a class="nav-link dropdown-toggle" href="#" id="addDropdownLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">add</i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="addDropdownLink">
                            <li><a class="dropdown-item" href="#">New Workspace</a></li>
                            <li><a class="dropdown-item" href="#">New Board</a></li>
                            <li><a class="dropdown-item" href="#">Create Project</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown hidden-on-mobile">
                        <a class="nav-link dropdown-toggle" href="#" id="exploreDropdownLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons-outlined">explore</i>
                        </a>
                        <ul class="dropdown-menu dropdown-lg large-items-menu" aria-labelledby="exploreDropdownLink">
                            <li>
                                <h6 class="dropdown-header">Repositories</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <h5 class="dropdown-item-title">
                                        Neptune iOS
                                        <span class="badge badge-warning">1.0.2</span>
                                        <span class="hidden-helper-text">switch<i class="material-icons">keyboard_arrow_right</i></span>
                                    </h5>
                                    <span class="dropdown-item-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <h5 class="dropdown-item-title">
                                        Neptune Android
                                        <span class="badge badge-info">dev</span>
                                        <span class="hidden-helper-text">switch<i class="material-icons">keyboard_arrow_right</i></span>
                                    </h5>
                                    <span class="dropdown-item-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                </a>
                            </li>
                            <li class="dropdown-btn-item d-grid">
                                <button class="btn btn-primary">Create new repository</button>
                            </li>
                        </ul>
                    </li> --}}
                </ul>

            </div>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item hidden-on-mobile">
                        @php $quote = new \RandomQuotes\RandomQuotes(); @endphp
                        <a class="nav-link" href="#">{{ $quote->generate()['quoteText'] ?? '' }}</a>
                    </li>
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"><img src="{{ Auth::user()->file != null ? asset('assets/images/user/'.Auth::user()->file) : asset('assets/cms/images/avatars/avatar.png') }}" alt="" width="30" height="30"></a>
                        <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
                            <li><a class="dropdown-item" href="{{ route('dashboard.profile',Auth::user()->id) }}?type=edit"><i class="fa-regular fa-user"></i> Profile  </a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>