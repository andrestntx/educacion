@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-check @stop
@section('title_page') Listas de Chequeo de la Institución @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('formularios.create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Nueva Lista de Chequeo</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Area">Nombre</th>
                        <th title="Descripción del Area">Descripción</th>
                        <th title="Ultima actulaización del Area">Actualización</th>
                        <th class="text-center" style="width:95px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td><strong>{{ $survey->name }}</strong></td>
                            <td>{{ $survey->description }}</td>
                            <td>{{ $survey->updated_at }}</td>
                            <td class="text-center">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{route('formularios.preguntas.index', $survey->id)}}" data-toggle="tooltip" title="Preguntas" class="btn btn-sm btn-effect-ripple btn-info">
                                        <i class="fa fa-question"></i>
                                    </a>
                                    <a href="{{route('formularios.edit', $survey->id)}}" data-toggle="tooltip" title="Editar Area" class="btn btn-sm btn-effect-ripple btn-warning">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-id="{{ $survey->id }}" id="btn-delete-{{$survey->id}}" onclick="deleteModel('btn-delete-{{$survey->id}}')"  data-toggle="tooltip" title="Borrar Area" class="btn btn-sm btn-effect-ripple btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @else
                                    <a href="{{route('formularios.registros.create', $survey->id)}}" data-toggle="tooltip" title="Nuevo Registro" class="btn btn-effect-ripple btn-info">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="{{route('formularios.registros.index', $survey->id)}}" data-toggle="tooltip" title="Ver Registros" class="btn btn-effect-ripple btn-warning">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
    {{Form::open(array('route' => array('formularios.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/areaTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop