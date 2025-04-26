<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Rodrigue mbah">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('assets/img/icon.png')}}">
    <!-- Page Title  -->
    <title>@yield('title')|WTC</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('assets/secure/css/dashlite.min.css')}}?ver=3.2.3">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/secure/css/theme.css')}}?ver=3.2.3">
    @notify_css
</head>

<body class="nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
       @include('secure._partials._siderbar')
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
           @include('secure._partials._navbar')
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                           @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2025 Agensic.
                        </div>
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <li class="nav-item dropup">
                                    <a href="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link text-base" data-bs-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="language-list">
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">English</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="language-item">
                                                    <span class="language-name">Français</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>

<script src="{{asset('assets/secure/js/bundle.js')}}?ver=3.2.3"></script>
<script src="{{asset('assets/secure/js/scripts.js')}}?ver=3.2.3"></script>
<script>
    var configs={
        routes:{
            index: "{{\Illuminate\Support\Facades\URL::to('/')}}",
            get_ajax_beneficiaries: "{{\Illuminate\Support\Facades\URL::route('secure.get_ajax_beneficiaries')}}",
            get_ajax_cities: "{{\Illuminate\Support\Facades\URL::route('secure.get_ajax_cities')}}",
            get_ajax_operators: "{{\Illuminate\Support\Facades\URL::route('secure.get_ajax_operators')}}",
            get_ajax_rate: "{{\Illuminate\Support\Facades\URL::route('secure.get_ajax_rate')}}",
        }
    }
</script>
@notify_js
@notify_render
@stack('js')
</body>

</html>
