@extends ('layout')

@section ('title') @yield('title_dashboard', '.: Educación Continudada | Dashboard :.') @stop

@section ('header')
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="{{url('dashboard')}}" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            @yield('title_system', 'Educación Continuada')
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        @include('dashboard/nav-bar')
    </header>
@stop

@section ('class_body') skin-blue @stop
@section ('warp')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        @include('dashboard/aside-left')

        <!-- Right side column. Contains the navbar and content of the page -->
        @include('dashboard/aside-right')
    </div><!-- ./wrapper -->
@stop

