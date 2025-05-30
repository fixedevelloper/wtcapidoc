<div class="nk-header nk-header-fixed is-theme">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{route('secure.dashboard')}}" class="logo-link">
                    <img class="logo-light logo-img " src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo">
                    <img class="logo-dark logo-img " src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo-dark">

                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    <a class="nk-news-item" href="#">
                        <div class="nk-news-icon">
                            <em class="icon ni ni-card-view"></em>
                        </div>
                        <div class="nk-news-text">
                            <p>Mode {{session('mode')}}</p>
                        </div>
                    </a>

                </div>
            </div><!-- .nk-header-news -->
            <div class="nk-header-center">

                <div class="custom-control custom-control-lg custom-switch">
                    <input checked type="checkbox" class="custom-control-input" id="switch_secure">
                    <label class="custom-control-label text-white" for="customSwitch2">Switch to sandbox mode</label>
                </div>

            </div>
            <div class="nk-header-tools">

                <ul class="nk-quick-nav">
                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="quick-icon border border-light">
                                <img class="icon" src="{{asset('assets/img/uk.png')}}" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                            <ul class="language-list">
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="{{asset('assets/img/uk.png')}}" alt="" class="language-flag">
                                        <span class="language-name">English</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="{{asset('assets/img/french.png')}}" alt="" class="language-flag">
                                        <span class="language-name">Français</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">
                                        {{auth()->user()->name}}
                                    </div>
                                    <div class="user-name dropdown-indicator"> {{auth()->user()->email}}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{session('name')}}</span>
                                        <span class="sub-text">{{session('email')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('secure.profil')}}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                  <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('secure.logout')}}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->

                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
