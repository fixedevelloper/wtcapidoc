<div class="nk-header is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="{{route('admin.dashboard')}}" class="logo-link">
                    <img class="logo-light logo-img" src="{{asset('assets/img/Logo.png')}}" alt="logo">
                    <img class="logo-dark logo-img" src="{{asset('assets/img/Logo.png')}}" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu ms-auto" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="{{route('admin.dashboard')}}" class="logo-link">
                            <img class="logo-light logo-img" src="{{asset('assets/img/Logo.png')}}" alt="logo">
                            <img class="logo-dark logo-img" src="{{asset('assets/img/Logo.png')}}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item">
                        <a href="{{route('admin.dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-text">Dashboards</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Applications</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.customers')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-switch-fill"></em></span>
                                    <span class="nk-menu-text">Customers</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.senders')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                                    <span class="nk-menu-text">Senders</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.beneficiaries')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-group-fill"></em></span>
                                    <span class="nk-menu-text">Beneficiaries</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.gateways')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-grid-add-c"></em></span>
                                    <span class="nk-menu-text">Gateways</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Transactions</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.transactions')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-fill"></em></span>
                                    <span class="nk-menu-text">All</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{route('admin.transactions')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-round"></em></span>
                                    <span class="nk-menu-text">Pending</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{route('admin.transactions')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-check"></em></span>
                                    <span class="nk-menu-text">Complete</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.transaction_sandbox')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-thumb"></em></span>
                                    <span class="nk-menu-text">Sandbox</span></a>
                            </li>

                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Operations</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.deposits')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-fill"></em></span>
                                    <span class="nk-menu-text">Deposits</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{route('admin.withdraws')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-round"></em></span>
                                    <span class="nk-menu-text">Withdraws</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{route('admin.journals')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-list-check"></em></span>
                                    <span class="nk-menu-text">Journals</span></a>
                            </li>

                        </ul><!-- .nk-menu-sub -->
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Settings</span>
                        </a>
                        <ul class="nk-menu-sub">

                            <li class="nk-menu-item">
                                <a href="{{route('admin.countries')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                    <span class="nk-menu-text">Countries</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.cities')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>

                                    <span class="nk-menu-text">Cities</span></a>
                            </li>
                         {{--   <li class="nk-menu-item">
                                <a href="{{route('admin.rates')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-percent"></em></span>
                                    <span class="nk-menu-text">Rates</span></a>
                            </li>--}}
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
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
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>{{strtoupper(substr(auth()->user()->name,0,2))}}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{auth()->user()->name}}</span>
                                        <span class="sub-text">{{auth()->user()->email}}</span>
                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon me-n2" href="#"><em class="icon ni ni-setting"></em></a>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                    <li><a class="dark-mode-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
