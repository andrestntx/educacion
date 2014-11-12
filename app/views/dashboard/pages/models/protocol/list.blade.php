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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-book"></i>
                    <h3 class="box-title">Mis {{$module->model->plural_name}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	@if(Route::has('dashboard.'.$module->route.'.create'))
            	    	<div class="form-group">
            	    		<a href="{{route('dashboard.'.$module->route.'.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Crear {{$module->model->singular_name}}</a>
            	    	</div>
                	@endif
                	@include('dashboard.includes.table-model')
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-file-text"></i>
                    <h3 class="box-title">Todos los {{$module->model->plural_name}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    @foreach($titles_table as $title)
                                        <th>{{$title}}</th>
                                    @endforeach()
                                    @if(isset($actions))
                                        <th>Acciones</th>
                                    @endif
                                </tr>
                                @foreach($models as $model)
                                    <tr>
                                        @foreach($model->getMainAttributes() as $attribute)
                                            <td>
                                                {{$attribute}}
                                            </td>
                                        @endforeach()  
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary">Acción</button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a class="text-light-blue" href="{{route('dashboard.'.$module->route.'.show', $model->id)}}"><i class="fa fa-eye"></i>Presentar examen</a></li>
                                                        <li><a class="text-light-blue" href="{{route('dashboard.'.$module->route.'.show', $model->id)}}"><i class="fa fa-eye"></i>Ver examenes</a></li>
                                                    </ul>
                                                </div>
                                            </td>  
                                    </tr>
                                @endforeach()
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="no-margin pull-right">
                                {{ $models->links() }}
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>
        </div>

    @stop