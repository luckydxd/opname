<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/> -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('demo5/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('demo5/assets/css/elements/breadcrumb.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('demo5/assets/css/elements/miscellaneous.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('demo5/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('demo5/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- YAJRA STYLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        /*
             The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
         */
        .column-tanggal {
        width: 240px;
    }
        .navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }

        .layout-px-spacing {
            min-height: calc(100vh - 96px) !important;
        }
    </style>
</head>

<body class="sidebar-noneoverflow">
    <!--  BEGIN NAVBAR  -->
    @include('user.componen.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>
        <!-- START SIDEBAR -->
        @include('user.componen.sidebar')
        <!-- END SIDEBAR -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2024 <a target="_blank"
                            href="https://designreset.com">Devgenfour</a>, All rights reserved.</p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="{{ asset('demo5/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="{{ asset('demo5/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('demo5/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('demo5/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('demo5/assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src="{{ asset('demo5/assets/js/custom.js') }}"></script>
        
        <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('script')


</body>
</html>
