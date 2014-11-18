@extends('dashboard.pages.layout')
    @section('title_page') {{$module->model->plural_name}}: {{$action_model}} @stop
    @section('h1_page') 
        @if(isset($route_index))
            <a href="{{$route_index}}" title="Volver atrás" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> 
            </a> 
        @else
        	<a href="{{route('dashboard.'.$module->route.'.index')}}" title="Volver atrás" class="btn btn-info">
        		<i class="fa fa-arrow-left"></i> 
        	</a> 
        @endif
    	{{$module->model->plural_name}}
    @stop
    @section('h2_page') 
    	{{$action_model}} 
    @stop
    @section('content_page')
    <div class="box box-warning">
        <div class="box-header">
        	<i class="fa fa-edit"></i>
 			<h3 class="box-title">{{$action_model}}</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        @yield('content_form')
        @include('dashboard.includes.errors')

    </div><!-- /.box -->
    	
    @stop