@extends('dashboard/pages/layout')
    @section('title_page') {{$module->model->plural_name}} @stop
    @section('h1_page') 
        Protocolo: <a href="{{route('dashboard.protocols.show', $protocol->id)}}">{{$protocol->t06_name}}</a>
    @stop
    @section('h2_page') Lista de {{$module->model->plural_name}} @stop
    @section('content_page')
    	<div class="form-group">
    	   <a href="{{route('dashboard.'.$module->route.'.create', $protocol->id)}}" class="btn btn-primary">
            <i class="fa fa-upload"></i> Subir {{$module->model->singular_name}}</a>
        </div>
    	@include('dashboard.includes.table-model')
    @stop