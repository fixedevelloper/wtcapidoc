<!doctype html>
<html lang="en">

<head>
    <title>Klorofil | API Documentation</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <a href="index.html"><img src="assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
        </div>
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><a href="#" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 2</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages2" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 3</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages3" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages4" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 4</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages4" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages5" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 5</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages5" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages6" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 6</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages6" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages7" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 7</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages7" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages8" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 8</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages8" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages9" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 9</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages9" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages10" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 10</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages10" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages11" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 11</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages11" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages12" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 12</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages12" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#subPages13" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Token 13</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="subPages13" class="collapse ">
                            <ul class="nav">
                                <li><a href="#" class="">Check Token &nbsp; <span class="label label-success">GET</span></a></li>
                                <li><a href="#" class="">Generate Token &nbsp; <span class="label label-primary">POST</span></a></li>
                                <li><a href="#" class="">Refresh Token &nbsp; <span class="label label-warning">PUT</span></a></li>
                                <li><a href="#" class="">Delete Token &nbsp; <span class="label label-danger">DELETE</span></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <h3 class="page-title">Generate Token</h3>
                <h4 class="page-title">Lorem ipsum dolor sit amet, <code>consectetur</code> adipiscing elit. Quisque nec venenatis est. Aliquam scelerisque bibendum volutpat. Donec vehicula tincidunt arcu, nec pellentesque neque dignissim eu. Duis a pretium sapien. Suspendisse efficitur eu metus ultrices suscipit. Mauris eget nulla a urna fermentum vulputate. Fusce ac leo rhoncus, convallis sem vel, blandit velit. Vestibulum pharetra dapibus nisi fermentum pretium. </h4>
                <div class="row">
                    <div class="col-md-7">
                        <!-- TABLE HOVER -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Request</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Type</th>
                                        <th>Position</th>
                                        <th>#</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Authorization</td>
                                        <td><code>string</code></td>
                                        <td><code>Header</code></td>
                                        <td><code>Required</code></td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
                                    </tr>
                                    <tr>
                                        <td>username</td>
                                        <td><code>string</code></td>
                                        <td><code>Body</code></td>
                                        <td><code>Required</code></td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec venenatis est. Aliquam scelerisque bibendum volutpat. Donec vehicula tincidunt arcu, nec pellentesque neque dignissim eu. </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END TABLE HOVER -->
                    </div>
                    <div class="col-md-5">
                        <!-- TABLE HOVER -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Response</h3>
                            </div>
                            <div class="panel-body">
								<pre>{
    "status": true,
    "result_code": 200,
    "message": "Success!",
    "values": {
        "name": "Kiddy",
        "email": "kiddydhana@gmail.com",
        "token": "9WUzKE7kCI1vSuQAbrmOwc2m2dk1NbPR",
        "account_status": "1"
    }
}</pre>
                            </div>
                        </div>
                        <!-- END TABLE HOVER -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
        </div>
    </footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script>
    $(document).ready(function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
