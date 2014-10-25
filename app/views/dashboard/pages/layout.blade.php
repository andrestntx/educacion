@extends('dashboard/layout')
    @section('title_dashboard') @yield('title_page', 'Página en Blanco') @stop
    @section('title_dashboard_page') @yield('h1_page', 'Página en Blanco') @stop
    @section('subtitle_dashboard') @yield('h2_page', 'Subtitulo de Página') @stop
    @section('page_dashboard') 
    	<div class="col-lg-12">
    		@yield('content_page', 'Aquí va el contenido de las paginas ')
    	</div>
    @stop