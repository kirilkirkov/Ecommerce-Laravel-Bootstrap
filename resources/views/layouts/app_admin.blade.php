<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title>{{ config('app.name', 'Laravel') }}</title>  
        <!-- Bootstrap core CSS     -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="{{ asset('css/material-dashboard.css?v=1.2.0') }}" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="purple" data-image="{{ url('img/sidebar-1.jpg') }}">
                <!--
                More martial icons - https://material.io/icons/
                
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    
            Tip 2: you can also add an image using data-image tag
                -->
                <div class="logo">
                    <a href="{{ lang_url('/') }}" class="simple-text">
                        Creative Tim
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{ lang_url('/admin') }}">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/users') }}">
                                <i class="material-icons">person</i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/table') }}">
                                <i class="material-icons">content_paste</i>
                                <p>Table List</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/typo') }}">
                                <i class="material-icons">library_books</i>
                                <p>Typography</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">bubble_chart</i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">location_on</i>
                                <p>Maps</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/notify') }}">
                                <i class="material-icons text-gray">notifications</i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li class="active-pro">
                            <a href="https://github.com/kirilkirkov" target="_blank">
                                <i class="material-icons">code</i>
                                <p>Kiril Kirkov</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> 
            <div class="main-panel">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"> Material Dashboard </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">dashboard</i>
                                        <p class="hidden-lg hidden-md">Dashboard</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">notifications</i>
                                        <span class="notification">5</span>
                                        <p class="hidden-lg hidden-md">Notifications</p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Mike John responded to your email</a>
                                        </li>
                                        <li>
                                            <a href="#">You have 5 new tasks</a>
                                        </li>
                                        <li>
                                            <a href="#">You're now friend with Andrew</a>
                                        </li>
                                        <li>
                                            <a href="#">Another Notification</a>
                                        </li>
                                        <li>
                                            <a href="#">Another One</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">person</i>
                                        <p class="hidden-lg hidden-md">Profile</p>
                                    </a>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group  is-empty">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="material-input"></span>
                                </div>
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="content"> 
                    @yield('content') 
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </div>
                </footer>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
        <!--  Charts Plugin -->
        <script src="{{ asset('js/chartist.min.js') }}"></script>
        <!--  Dynamic Elements plugin -->
        <script src="{{ asset('js/arrive.min.js') }}"></script>
        <!--  PerfectScrollbar Library -->
        <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Material Dashboard javascript methods -->
        <script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script type="text/javascript">
                                $(document).ready(function () {
                                    demo.initDashboardPageCharts();

                                });
        </script>
    </body>
</html>