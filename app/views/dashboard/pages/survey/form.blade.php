@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') fa fa-check @stop
@section('title_page') @if($survey->exists) Editar Formulario: {{$survey->name}} @else Nuevo Formulario @endif @stop
@section('title_form') Datos del Formulario @stop
@section('form')
  {{ Form::model($survey, $form_data) }}
    {{ Form::input('hidden', 'created_by', $user->id) }}
    {{ Form::input('hidden', 'type_id', null) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre de la Lista de Chequeo', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción de la Lista de Chequeo'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Lista de Chequeo</button>
        </div>
    </div>
  {{Form::close()}}
@stop
