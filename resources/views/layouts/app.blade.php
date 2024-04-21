<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} @yield('title') </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ env('APP_URL') .'/'.'public/img/fav_icon.jpg'}}">

    <!-- Page-Level Styles -->
    @include('layouts.Headerlink')
    <!-- Extra Styles -->
    @yield('style')
    <script>
        var APP_URL = "{{ url('/') }}";
        var APP_URL1 = "<?php echo env('APP_URL'); ?>";
    </script>
</head>
<body>
    <div class="loader_div"  style="display: none;"><div class="loading" id="loader"><i class="fa fa-spinner fa-spin" style="font-size:70px;color:#213d58"></i></div>
    </div>
    <div class="new_loader" style="display: none;">
            <div class="loading" id="loader"><i class="fa fa-spinner fa-spin spin_style"></i></div>
    </div>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <!-- Left side column. contains the logo and sidebar -->
                @include('layouts.sidebar') 
            </div>
        </nav>
        
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fas fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        {{-- <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to {{ env('APP_NAME') }}.</span>
                        </li> --}}
                        <li>
                            {{-- <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a> --}}
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">   
                            </span> <span class="text-muted text-xs block">{{ Auth::user()->name }}<b class="caret"></b></span> </span> 
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li>
                                    <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out"></i> Log out </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <img alt="image" class="img-circle" src="{{ env('APP_URL').'/public/img/profile.png' }}" style="width: 50px;" />
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <!-- Top-content which display breadcrumb for each Page -->
                @yield('top-content')  
                {{-- <div class="col-lg-2">
                </div> --}}
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <!-- Original Page Content -->
                @yield('content')
            </div>
            <div class="footer" style="max-height: 100px;text-align: center">
                <div>
                    <strong>Copyright © {{ date('Y')}} <a href="#">{{ env('APP_NAME') }}</a>.</strong> All rights reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Page-Level Scripts -->
    @include('layouts.Footerlink')
    <!-- Extra Scripts for Individual Page-->
    @yield('scripts')
</body>
</html>
