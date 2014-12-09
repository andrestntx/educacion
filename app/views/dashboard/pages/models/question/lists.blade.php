@extends('dashboard/pages/layout')
    @section('title_page') {{$module->model->plural_name}} @stop
    @section('h1_page') 
        Protocolo: <a href="{{route('dashboard.protocols.show', $protocol->id)}}">{{$protocol->t06_name}}</a>
    @stop
    @section('h2_page') Lista de {{$module->model->plural_name}} @stop
    @section('content_page')
    	<div class="form-group">
            {{Form::open(array(
                'route' => array('dashboard.'.$module->route.'.create', $protocol->id), 
                'method' => 'GET', 
                'class' => 'form-inline'
            ))}}
            {{Form::input('number', 'answers', null, array('placeholder' => 'Número de Respuestas', 'class' => 'form-control', 'required' => 'required'))}}
    	    <button class="btn btn-primary">
                <i class="fa fa-outdent"></i> Nueva {{$module->model->singular_name}}
            </button>
            {{Form::close()}}
        </div>
    	@include('dashboard.includes.table-model')
    @stop