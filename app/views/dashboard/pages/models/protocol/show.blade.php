@extends('dashboard/pages/layout')
    @section('title_page') {{$action_model}} @stop
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
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-file-text"></i>
     			<h3 class="box-title">{{$action_model}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="font-size:16px;">
                <div class="row">
                    @foreach($model->toArray() as $key => $value)
                        @if($model->getAttributeType($key) == 'png' || $model->getAttributeType($key) == 'jpg')
                            <div class="col-sm-6 col-lg-4">
                                <p><b style="font-size:16px;">{{$model->getAttributeName($key)}}</b></p>
                                {{ HTML::image($value, $model->getAttributeName($key), array('class' => 'fileinput-new thumbnail', 'style' => 'max-width:200px; height:150px;')) }}
                            </div>
                        @endif
                    @endforeach
                    @foreach($model->attributesToArray() as $key => $value)
                        @if($model->getAttributeType($key) == 'string')
                            <div class="col-sm-6 col-lg-4">
                                <p><b style="font-size:16px;">{{$model->getAttributeName($key)}}:</b> {{$model->value($key)}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                @if(isset($route_edit))
                    <a href="{{$route_edit}}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</a>
                @else
                    <a href="{{route('dashboard.'.$module->route.'.edit', $model->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</a>
                @endif
                @if(isset($model_father_id))
                    <div style="display:inline-block;">
                        {{ Form::open(array('route' => array('dashboard.'.$module->route.'.destroy', $model_father_id, $model->id), 'method' => 'DELETE', 'role' => 'form')) }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
                        {{ Form::close() }}
                    </div>
                @elseif(Route::has('dashboard.'.$module->route.'.destroy'))
                    <div style="display:inline-block;">
                        {{ Form::open(array('route' => array('dashboard.'.$module->route.'.destroy', $model->id), 'method' => 'DELETE', 'role' => 'form')) }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div><!-- /.box -->
    </div>
    <div class="col-md-5">
        <div class="box box-warning">
            <div class="box-header">
                <i class="fa fa-paperclip"></i>
                <h3 class="box-title">Anexos del Protocolo</h3>
            </div><!-- /.box-header -->
            <div class="box-body"
                <a href="#" class="btn btn-primary"><i class="fa {{$module->model->icon}}"></i> Crear {{$module->model->singular_name}}</a>
                @include('dashboard.includes.table-model')
            </div>
        </div>
    </div>
    	
    @stop