<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TokoKita - Admin</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="/style/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/style/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="/style/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="/style/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/style/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/style/plugins/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/style/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/style/plugins/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="/style/plugins/c3/c3.min.css">
    <link rel="stylesheet" href="/style/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/style/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/style/dist/css/theme.min.css">
    @yield('cssStyle')
    <script src="/style/src/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
</head>

<body>
    @include('sweetalert::alert')
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <style>
        .fixedButtonAdd {
            position: fixed;
            bottom: 10px;
            right: 50px;
        }

        .fixedButtonRefresh {
            position: fixed;
            bottom: 10px;
            right: 110px;
        }

        .footer-buttons .btn-icon {
            width: 50px;
            height: 50px;
            color: white;
            line-height: 2.5;
            font-size: 20px;
            border-radius: 100%;
        }
    </style>
    <div class="wrapper">
        <!-- NAVBAR -->
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        <div class="header-search">
                            <div class="input-group">
                                <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                            </div>
                        </div>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <!-- <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button> -->
                        <a class="text">{{ Auth::user()->name }}</a>
                        <div class="dropdown">
                            @if(Auth::user()->image != null)
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{asset('storage/'.Auth::user()->image)}}" alt=""></a>
                            @else
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="/style/img/user.jpg" alt=""></a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}"><i class="ik ik-user dropdown-icon"></i> Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <i class="ik ik-power dropdown-icon"></i> Logout
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- END NAVBAR -->

        <!-- SIDEBAR -->
        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="index.html">
                        <div class="logo-img">
                            <img src="/style/src/img/brand-white.svg" class="header-brand-img" alt="lavalite">
                        </div>
                        <span class="text">TokoKita</span>
                    </a>
                    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                            <div class="nav-lavel">General</div>
                            <div class="nav-item {{Route::is('home') ? 'active' : ''}}">
                                <a href="{{route('home')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>

                            <div class="nav-lavel">User</div>
                            @can('super-admin')
                            <div class="nav-item {{Route::is('user.index') ? 'active' : ''}}">
                                <a href="{{route('user.index')}}"><i class="ik ik-users"></i><span>Admin</span></a>
                            </div>
                            @endcan
                            
                            <div class="nav-item {{Route::is('user.customer') ? 'active' : ''}}">
                                <a href="{{route('user.customer')}}"><i class="ik ik-users"></i><span>Customer</span></a>
                            </div>
                            

                            <div class="nav-lavel">Product</div>
                            <div class="nav-item {{Route::is('category.index') ? 'active' : ''}}">
                                <a href="{{route('category.index')}}"><i class="ik ik-list"></i><span>Kategori</span></a>
                            </div>
                            <div class="nav-item {{Route::is('product.index') ? 'active' : ''}}">
                                <a href="{{route('product.index')}}"><i class="ik ik-box"></i><span>Data Barang</span></a>
                            </div>

                            <div class="nav-lavel">Transaksi</div>
                            <div class="nav-item {{Route::is('order.index') ? 'active' : ''}}">
                                <a href="{{route('order.index')}}"><i class="ik ik-shopping-cart"></i><span>Data Transaksi</span></a>
                            </div>

                        </nav>
                    </div>
                </div>
            </div>

            <!-- SECTION FOR CHILD VIEW-->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    @yield('iconHeader')
                                    <!-- <i class="ik ik-edit bg-blue"></i> -->
                                    <div class="d-inline">
                                        <h5>@yield('titleHeader')</h5>
                                        <span>@yield('subtitleHeader')</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="../index.html"><i class="ik ik-home"></i></a>
                                        </li>
                                        @yield('breadcrumb')
                                        <!-- <li class="breadcrumb-item"><a href="#">Forms</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Components</li> -->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
            <div class='footer-buttons'>
                @yield('fixedButton')
            </div>

            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2018 ThemeKit v2.0. All Rights Reserved.</span>
                    <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark" target="_blank">Lavalite</a></span>
                </div>
            </footer>

        </div>
    </div>




    <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="quick-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                                <div class="input-wrap">
                                    <input type="text" id="quick-search" class="form-control" placeholder="Search..." />
                                    <i class="ik ik-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container">
                        <div class="apps-wrap">
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="app-item dropdown">
                                <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-command"></i><span>Ui</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STYLE FOR JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="/style/src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/style/plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="/style/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/style/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="/style/plugins/screenfull/dist/screenfull.js"></script>
    <script src="/style/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/style/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/style/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/style/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/style/plugins/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/style/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/style/plugins/moment/moment.js"></script>
    <script src="/style/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/style/plugins/d3/dist/d3.min.js"></script>
    <script src="/style/plugins/c3/c3.min.js"></script>
    <script src="/style/js/tables.js"></script>
    <script src="/style/js/widgets.js"></script>
    <script src="/style/js/charts.js"></script>
    <script src="/style/dist/js/theme.min.js"></script>
    @yield('jsStyle')
    @yield('script')
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>