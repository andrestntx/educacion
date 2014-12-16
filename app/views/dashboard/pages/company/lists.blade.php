@extends('dashboard.pages.layout')
@section('title_page')Instituciones registradas @stop
@section('breadcrumbs')
	
@stop
@section('content_body_page')
	<div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('instituciones.create')}}" class="btn btn-primary btn-lg"> <i class="fa fa-building"></i> Nueva Institución</a>
        </div>
    </div>
	<div class="row">
		@foreach($companies as $company)
		    <div class="col-lg-4">
		        <div class="widget">
		        	<div class="widget-content themed-background-social text-right clearfix">
		                <a href="{{route('instituciones.edit', $company->id)}}" class="pull-left">
		                    <img src="{{$company->logo}}" alt="{{$company->name}}" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
		                </a>
		                <h3 class="widget-heading text-light">{{$company->name}}</h3>
		            </div>
		            <div class="widget-content themed-background-muted text-center">
		                <div class="btn-group">
		                    <a href="{{Route('instituciones.edit', $company->id)}}" class="btn btn-effect-ripple btn-warning"><i class="fa fa-pencil"></i> Editar</a>
		                    <a href="{{Route('instituciones.usuarios.index', $company->id)}}" class="btn btn-effect-ripple btn-info"><i class="fa fa-users"></i> Admins.</a>
		                </div>
		            </div>
		            <div class="widget-content">
		                <div class="row text-center">
		                    <div class="col-xs-6">
		                        <h3 class="widget-heading"><small>USUARIOS</small><br><a href="javascript:void(0)" class="themed-color-flat">{{$company->users()->count()}}</a></h3>
		                    </div>
		                    <div class="col-xs-6">
		                        <h3 class="widget-heading"><small>PROTOCOLOS</small><br><a href="javascript:void(0)" class="themed-color-flat">{{$company->protocols()->count()}}</a></h3>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
	    @endforeach
    </div>
    {{$companies->links()}}
@stop