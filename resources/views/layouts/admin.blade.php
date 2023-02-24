<!DOCTYPE html>
<html>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{asset('img/AdminLTELogo21.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .9">
            <span class="brand-text font-weight-light">SLLIR-SMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Dashboard 
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/user/new-user" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New User</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-truck-moving"></i>
                            <p>
                                Suppliers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/supplier/new-supplier" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New Supplier</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/supplier/supplier-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Supplier List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/product/new-product" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/product/product-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Product List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Purchasing
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/purchase/new-purchase" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New Purchase</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/purchase/purchase-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Purchasing List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-arrow-circle-down"></i>
                            <p>
                                Good Receive Note
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/grn/new-grn" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New GRN</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/grn/grn-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>GRN List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-arrow-alt-circle-up"></i>
                            <p>
                                Return
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/return/new-return" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>Return</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/return/return-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Return List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/reports/reports" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Reports
                            </p>
                        </a>
                    </li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <li class="nav-item">
                        <a href="/Aboutus" target="_blank" class="nav-link"> 
                            <i class="fab fa-battle-net"></i>
                            <p>
                                About us & More details 
                            </p>
                            <i class="fab fa-battle-net"></i>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        @yield('content')

    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>


</body>
</html>
