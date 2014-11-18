@extends('dashboard/pages/layout')
    @section('title_page') {{$module->model->plural_name}} @stop
    @section('h1_page') 
        @if(isset($title_page)) 
            {{$title_page}} 
        @else
            {{$module->model->plural_name}} 
        @endif
    @stop
    @section('h2_page') 
        @if(isset($subtitle_page)) 
            {{$subtitle_page}} 
        @else
            Lista de {{$module->model->plural_name}}
        @endif
    @stop
    @section('content_page')
    	@if(Route::has('dashboard.'.$module->route.'.create'))
	    	<div class="form-group">
                @if(isset($route_create))
	    	        <a href="{{$route_create}}" class="btn btn-primary"><i class="fa {{$module->model->icon}}"></i> Crear {{$module->model->singular_name}}</a>
                @else
                    <a href="{{route('dashboard.'.$module->route.'.create')}}" class="btn btn-primary"><i class="fa {{$module->model->icon}}"></i> Crear {{$module->model->singular_name}}</a>
                @endif
            </div>
    	@endif
    	@include('dashboard.includes.table-model')
    @stop