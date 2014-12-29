@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page')Institución {{Auth::user()->preferredCompany->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-6 col-lg-3">
            <a href="{{route('usuarios.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="gi gi-group text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_users}}"></span></strong>
                    </h2>
                    <span class="text-muted">USUARIOS</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{route('usuarios.perfiles.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-success" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="gi gi-old_man text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_roles}}"></span></strong>
                    </h2>
                    <span class="text-muted">PERFILES</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{route('areas.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-danger" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="fa fa-sitemap text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_areas}}"></span></strong>
                    </h2>
                    <span class="text-muted">AREAS</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{route('protocolos.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-warning" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="fa fa-file-text text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_protocols}}"></span></strong>
                    </h2>
                    <span class="text-muted">PROTOCOLOS</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{route('protocolos.categorias.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-info" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="fa fa-folder-open text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_categories}}"></span></strong>
                    </h2>
                    <span class="text-muted">CATEGORIAS</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{route('formularios.index')}}" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-info" style="width:95px; height: 95px; line-height: 90px;">
                        <i class="fa fa-check text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h2">
                        <strong>+ <span data-toggle="counter" data-to="{{$number_checks}}"></span></strong>
                    </h2>
                    <span class="text-muted">FORMULARIOS</span>
                </div>
            </a>
        </div>
    </div>
@stop

@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
        <script src="assets/js/pages/readyDashboard.js"></script>
        <script>$(function(){ ReadyDashboard.init(); });</script>
@stop