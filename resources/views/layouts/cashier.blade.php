<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('css/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/gijgo.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        h2 {

            position: relative;
            animation: mymove 15s infinite;
        }

        #h2 {
            animation-timing-function: linear;
        }

        @keyframes mymove {
            from {
                left: 0px;
            }
            to {
                left: 770px;
            }
        }
    </style>

    <!-- jQuery -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('/js/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{'/js/bootstrap.bundle.min.js'}}"></script>

    <script src="{{'/js/moment.min.js'}}"></script>
    <script src="{{asset('/js/daterangepicker.js')}}"></script>
    <script src="{{asset('/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script src="{{asset('/js/OverlayScrollbars.min.js')}}"></script>
    <script src="{{asset('/js/adminlte.js')}}"></script>

    <script src="{{asset('/js/demo.js')}}"></script>
    <script src="{{asset('/js/bootbox.min.js')}}"></script>
    <script src="{{asset('/js/bootbox.all.min.js')}}"></script>
    <script src="{{asset('/js/bootbox.locales.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert2@9.js')}}"></script>
    <script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('/js/gijgo.min.js')}}"></script>
    <script src="{{asset('/js/angular.min.js')}}"></script>
    <script src="{{asset('/js/jquery.tabletoCSV.js')}}"></script>
    <script src="{{asset('/js/date.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>

<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h2 class="navbar-brand" href="#" id="h2">Sri Lanka Light Infantry Regiment-SL Army</h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/cashier/index">Home<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> Reports </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/cashier/stock-report"> Stock Report </a></li>
                        <li><a class="dropdown-item" href="/cashier/invoice-list"> Invoice List </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="btn ml-2 btn-warning" href="{{ route('user.logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
</div>

</body>
</html>