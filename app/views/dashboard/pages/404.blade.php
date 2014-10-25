@extends('dashboard/pages/layout')
    @section('title_page') Página no encontrada - 404 @stop
    @section('h1_page') Página no encontrada @stop
    @section('h2_page')  @stop
    @section('content_page')
    	<div class="error-page">
	        <h2 class="headline text-info"> 404</h2>
	        <div class="error-content">
	            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>
	            <p>
	                La página que está buscando, no se encuntra disponible.
	                Por ahora, puede <a href="{{url('dashboard')}}">volver al inicio</a> o buscar aquí
	            </p>
	            <form class='search-form'>
	                <div class='input-group'>
	                    <input type="text" name="search" class='form-control' placeholder="Buscar"/>
	                    <div class="input-group-btn">
	                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
	                    </div>
	                </div><!-- /.input-group -->
	            </form>
	        </div><!-- /.error-content -->
	    </div><!-- /.error-page -->
    @stop