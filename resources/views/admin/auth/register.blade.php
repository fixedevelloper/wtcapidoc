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
    <title>Register| WTC</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('assets/secure/css/dashlite.min.css')}}?ver=3.2.3">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/secure/css/theme.css')}}?ver=3.2.3">
    @notify_css
</head>
<body class="nk-body bg-white npc-general pg-auth dark-mode">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                                <div class="brand-logo pb-4 text-center">
                                    <a href="{{route('sandbox.login')}}" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg" src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg" src="{{asset('assets/img/Logo.png')}}" srcset="{{asset('assets/img/Logo.png')}} 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner card-inner-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Register</h4>
                                                <div class="nk-block-des">
                                                    <p>Create New WTC Account</p>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name</label>
                                                <div class="form-control-wrap">
                                                    <input name="name" type="text" class="form-control form-control-lg" id="name" placeholder="Enter your name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input name="email" type="text" class="form-control form-control-lg" id="email" placeholder="Enter your email address or username">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="email">Phone</label>
                                                    <div class="form-control-wrap">
                                                        <input name="phone" type="text" class="form-control form-control-lg" id="email" placeholder="Enter your phone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="password">Passcode</label>
                                                <div class="form-control-wrap">
                                                    <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    </a>
                                                    <input name="password" type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-control-xs custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox">
                                                    <label class="custom-control-label" for="checkbox">I agree to WTC <a href="#">Privacy Policy</a> &amp; <a href="#"> Terms.</a></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary btn-block">Register</button>
                                            </div>
                                        </form>
                                        <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{route('sandbox.login')}}"><strong>Sign in instead</strong></a>
                                        </div>
                                        <div class="text-center pt-4 pb-3">
                                            <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                        </div>
                                        <ul class="nav justify-center gx-8">
                                            <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Facebook</a></li>
                                            <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3" href="#">Google</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wrap @e -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wrap @e -->
    </div>

    <!-- main @e -->
<!-- JavaScript -->
<script src="{{asset('assets/secure/js/bundle.js')}}?ver=3.2.3"></script>
<script src="{{asset('assets/secure/js/scripts.js')}}?ver=3.2.3"></script>
@notify_js
@notify_render
</body>

</html>

