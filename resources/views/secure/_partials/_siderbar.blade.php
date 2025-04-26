<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{route('secure.dashboard')}}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo-dark">

            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{route('secure.dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Use-Case Preview</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('secure.senders')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                            <span class="nk-menu-text">Senders</span><span class="nk-menu-badge">HOT</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                  <li class="nk-menu-item">
                        <a href="{{route('secure.beneficiaries')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-group-fill"></em></span>
                            <span class="nk-menu-text">Beneficiaries</span><span class="nk-menu-badge">HOT</span>
                        </a>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Transactions</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('secure.make_bank')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                            <span class="nk-menu-text">Bank transfer</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('secure.make_mobil')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-mobile"></em></span>
                            <span class="nk-menu-text">Mobil transfer</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('secure.transferList')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-list-fill"></em></span>
                            <span class="nk-menu-text">List</span>
                        </a>
                    </li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Settings</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('secure.profil')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                            <span class="nk-menu-text">Account</span>
                        </a>
                    </li>
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
