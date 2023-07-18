<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">

    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">



    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="{{ asset("admin/vendor/animsition/animsition.min.css") }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">

    <link href="{{ asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('category#list') }}">
                                <i class="fa-solid fa-rectangle-list"></i>Category List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products#list') }}">
                                <i class="fas fa-chart-bar text-danger"></i>Products List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin#orderList') }}">
                                <i class="fa fa-list" aria-hidden="true"></i>Order list

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin#userList') }}">
                                <i class="fa fa-users " aria-hidden="true"></i>Users list
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin#messageList') }}">
                                <i class="fa-solid fa-envelope-open-text me-3"></i>  Messages
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h4 class="form-header">
                                Admin Dashboard Pannel
                                {{-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> --}}
                            </h4>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'female')
                                                <div class="image">
                                                    <img src="{{ asset('image/female_default.png') }}" />
                                                </div>
                                                @else
                                                <div class="image">
                                                    <img src="{{ asset('image/defaultUser.png') }}" />
                                                </div>
                                                @endif
                                            @else
                                            <div class="image">
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                            </div>
                                            @endif

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->image == null)
                                                        @if (Auth::user()->gender == 'female')
                                                        <div class="image">
                                                            <img src="{{ asset('image/female_default.png') }}" />
                                                        </div>
                                                        @else
                                                        <div class="image">
                                                            <img src="{{ asset('image/defaultUser.png') }}" />
                                                        </div>
                                                        @endif
                                                    @else
                                                    <div class="image">
                                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#list') }}">
                                                        <i class="zmdi zmdi-account"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#details') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">

                                                    <a href="{{ route('admin#changePasswordPage') }}">
                                                        <button type="submit" class="text-white bg-dark col-12 text-center my-1">
                                                            <i class="fa-solid fa-key mx-2"></i>Change Password
                                                        </button>
                                                    </a>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-dark col-12 text-center my-1">
                                                        <i class="zmdi zmdi-power mx-2"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
                @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>
    {{-- jquery cdn js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
@yield('scriptSource')
</html>
<!-- end document-->
