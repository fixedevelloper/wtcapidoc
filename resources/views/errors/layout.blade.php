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
    <title>@yield('title')|Error WTC</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('assets/secure/css/dashlite.min.css')}}?ver=3.2.3">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/secure/css/theme.css')}}?ver=3.2.3">

</head>

<body class="nk-body bg-white npc-general pg-error no-touch nk-nio-theme">
<div class="nk-app-root">
    <!-- wrap @s -->
    <div class="nk-wrap nk-wrap-nosidebar">


        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- wrap @e -->
</div>

<script src="{{asset('assets/secure/js/bundle.js')}}?ver=3.2.3"></script>
<script src="{{asset('assets/secure/js/scripts.js')}}?ver=3.2.3"></script>


@stack('js')
</body>

</html>
