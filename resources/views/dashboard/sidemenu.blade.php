<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DRD - Petty Cash System - Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/logo.png') }}">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-reboot.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/PCS_UI.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/index.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body id="page-top" class="index">
    <div id="sticky-anchor"></div>

    <div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar" class="sticky-top text-uppercase">
            <div class="sidebar-header">
                <center><img src="{{ URL::asset('images/logo.png') }}" width="70%"></center>
                <hr class="M_sep">
                <p class="M_Txt_Article text-center white">DRD - PCS</p>
            </div>

            <ul class="list-unstyled components">
                @if (Auth::user()->type != 2)
                    <li class="{{ Request::is(['dashboard']) ? 'active' : null }}">
                        <a href="/dashboard" class="text-uppercase white"><i
                                class="material-icons optionIcon">analytics</i>Analytics</a>
                    </li>
                @endif

                @if (Auth::user()->type != 2 && Auth::user()->type != 1)
                    <li
                        class="{{ Request::is(['users']) || Request::is(['categories']) || Request::is(['budget']) ? 'active' : null }}">
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle white"><i class="material-icons optionIcon">library_add</i>Add</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li class="{{ Request::is(['users']) ? 'subactive' : null }}">
                                <a href="/users" class="text-uppercase">Users</a>
                            </li>
                            <li class="{{ Request::is(['categories']) ? 'subactive' : null }}">
                                <a href="/categories" class="text-uppercase">Categories</a>
                            </li>
                            <li class="{{ Request::is(['budget']) ? 'subactive' : null }}">
                                <a href="/budget" class="text-uppercase">Budget</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li
                    class="{{ Request::is(['apply']) || Request::is(['applications']) || Request::is(['application']) ? 'active' : null }}">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle white"><i
                            class="material-icons optionIcon">compare_arrows</i>Applications</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li class="{{ Request::is(['apply']) ? 'subactive' : null }}">
                            <a href="/apply" class="text-uppercase">Apply</a>
                        </li>
                        <li class="{{ Request::is(['applications']) ? 'subactive' : null }}">
                            <a href="/applications" class="text-uppercase">View
                                {{-- &nbsp;&nbsp;
                                <span class="badge badge-light">4</span> --}}
                            </a>
                        </li>
                    </ul>
                </li>

                <hr class="M_sep">

                <li class="{{ Request::is(['settings']) ? 'active' : null }}">
                    <a href="/settings" class="moreOption"><i class="material-icons optionIcon">settings</i>Settings</a>
                </li>
                <li>
                    <a href="/logout" class="moreOption"><i
                            class="material-icons optionIcon">power_settings_new</i>Logout</a>
                </li>
            </ul>

        </nav>

        <div class="container-fluid pad0" id="content">
            <nav class="navbar sticky-top navbar-expand-lg navbar-expand-md navbar-expand-sm M_TopNav">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <button class="btn btn-sm sidemenuBtn" id="sidebarCollapse" href="#">
                    <i class="material-icons sidemenuIcon">menu</i>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form class="form-inline M_Nav_Search">
                                <input class="form-control M_Txt_Normal" type="search"
                                    placeholder="Search your content" aria-label="Search">
                                <button class="btn mx-auto my-auto" type="submit"><i
                                        class="material-icons optionIcon">search</i></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <img src="{{ URL::asset('images/avatar.png') }}" width="32px" height="32px"
                                class="rounded-circle M_Nav_Profile">
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link M_Nav_options">{{ Auth::user()->names }}</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>



            @yield('content')


        </div>

    </div>

    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/wow.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>
