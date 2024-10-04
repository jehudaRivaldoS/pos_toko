<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>TB Maju</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/css/style-conquer.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    @yield('css')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <h4 style="color:#ffffff"><strong>TB MAJU</strong></h4>
                <br>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <img src="assets/img/menu-toggler.png" alt="" />
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">

            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
                <ul class="page-sidebar-menu">
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler">
                        </div>
                        <div class="clearfix">
                        </div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li class="sidebar-search-wrapper">
                        <form class="search-form" role="form" action="index.html" method="get">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control" name="query" placeholder="Search...">
                            </div>
                        </form>
                    </li>
                    <li class="start active ">
                        <a href="/">
                            <i class="glyphicon glyphicon-home"></i>
                            <span class="title">Home</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start active">
                        <a href="javascript:;">
                            <i class="fa fa-cubes"></i>
                            <span class="title">Barang</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="/barang" class="nav-link">
                                    <i class="fa fa-bars"></i>
                                    <span class="title">Data Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/tambahbarang" class="nav-link">
                                    <i class="fa fa-plus"></i>
                                    <span class="title">Tambah Barang</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="start active ">
                        <a href="/customer">
                            <i class="fa fa-users"></i>
                            <span class="title">Data Customer</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start active">
                        <a href="javascript:;">
                            <i class="fa fa-archive"></i>
                            <span class="title">Transaksi</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="/transaksi">
                                    <i class="fa fa-book"></i>
                                    Transaksi Penjualan
                                </a>
                            </li>
                            <li>
                                <a href="/laporantransaksi">
                                    <i class="fa fa-clipboard"></i>
                                    Laporan Penjualan
                                </a>
                            </li>                            
                        </ul>
                    </li>
                    <li class="start active">
                        <a href="javascript:;">
                            <i class="fa fa-archive"></i>
                            <span class="title">Cat Tinting</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="/datatinting">
                                    <i class="fa fa-book"></i>
                                    Data Cat Tinting
                                </a>
                            </li>
                            <li>
                                <a href="/tambahtinting">
                                    <i class="fa fa-clipboard"></i>
                                    Tambah Cat Tinting
                                </a>
                            </li>
                            <li>
                                <a href="/transaksitinting">
                                    <i class="fa fa-sign-in"></i>
                                    Transaksi Cat Tinting
                                </a>
                            </li>
                            <li>
                                <a href="/laporantinting">
                                    <i class="fa fa-database"></i>
                                    Laporan Cat Tinting
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="start active ">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-logout"></i>
                            <span class="title">Log Out</span>
                            <span class="selected"></span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2024 &copy; Toko Maju Minggiran.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery.peity.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>
    <script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/scripts/app.js" type="text/javascript"></script>
    <script src="assets/scripts/index.js" type="text/javascript"></script>
    <script src="assets/scripts/tasks.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" crossorigin=" anonymous"></script>



    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    @yield('script')
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function () {
            App.init(); // initlayout and core plugins
            Index.init();
            Index.initJQVMAP(); // init index page's custom scripts
            Index.initCalendar(); // init index page's custom scripts
            Index.initCharts(); // init index page's custom scripts
            Index.initChat();
            Index.initMiniCharts();
            Index.initPeityElements();
            Index.initKnowElements();
            Index.initDashboardDaterange();
            Tasks.initDashboardWidget();
        });
    </script>
    <!-- END JAVASCRIPTS -->
    @yield('js')
</body>
<!-- END BODY -->

</html>