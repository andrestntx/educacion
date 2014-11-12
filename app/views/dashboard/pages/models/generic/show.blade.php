@extends('dashboard/pages/layout')
    @section('title_page') {{$action_model}} @stop
    @section('h1_page') 
    	<a href="{{route('dashboard.'.$module->route.'.index')}}" title="Volver atrás" class="btn btn-info">
    		<i class="fa fa-arrow-left"></i> 
    	</a> 
    	{{$module->model->plural_name}}
    @stop
    @section('h2_page') 
    	{{$action_model}} 
    @stop
    @section('content_page')
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-eye"></i>
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
                @foreach($model->toArray() as $key => $value)
                    @if($model->getAttributeType($key) == 'string')
                        <div class="col-sm-6 col-lg-4">
                            <p><b style="font-size:16px;">{{$model->getAttributeName($key)}}:</b>  {{$value}}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="box-footer">
            <a href="{{route('dashboard.'.$module->route.'.edit', $model->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</a>
            @if(Route::has('dashboard.'.$module->route.'.destroy'))
                <div style="display:inline-block;">
                    {{ Form::open(array('route' => array('dashboard.'.$module->route.'.destroy', $model->id), 'method' => 'DELETE', 'role' => 'form')) }}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
                    {{ Form::close() }}
                </div>
            @endif
        </div>
    </div><!-- /.box -->
    	
    @stop