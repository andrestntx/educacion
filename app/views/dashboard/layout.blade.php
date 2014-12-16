@extends('layout')
	@section('title_page') Bienvenido al Dashboard @stop
	@section('meta')
		<meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
	@stop
	@section('css_files')
		{{-- Css Files --}}
		@include('dashboard.includes.css')
		@yield('css_aditional')
	@stop
	@section('content_body')
		{{-- Content Body --}}
		<div id="page-wrapper" class="page-loading">
			<div class="preloader">
                <div class="inner">
                    <!-- Animation spinner for all modern browsers -->
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                    <!-- Text for IE9 -->
                    <h3 class="text-primary visible-lt-ie10"><strong>Cargando..</strong></h3>
                </div>
            </div>
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                <!-- Alternative Sidebar -->
                @include('dashboard.includes.right_sidebar')
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                @include('dashboard.includes.sidebar')
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    @include('dashboard.includes.header')
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content" style="position:relative;">
                        @yield('content_page', 'Contenido del Dashboard')
                    </div>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
			
		</div>
	@stop
	@section('js_files')
		{{-- Js Files --}}
		@include('dashboard.includes.script')
		@yield('js_aditional')
	@stop