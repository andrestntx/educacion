@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($protocol->exists) Editar Protocolo: {{$protocol->name}} @else Nuevo Protocolo @endif
@stop
@section('title_form') Datos del Protocolo @stop
@section('form')
  {{ Form::model($protocol, $form_data) }}
    {{ Form::input('hidden', 'user_id', Auth::user()->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Protocolo <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Protocolo', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción del Protocolo </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Protocolo'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>   
    <div class="form-group">
      <label class="col-md-4 control-label" for="url_pdf">PDF del Protocolo </label>
      <div class="col-md-6">
          <div class="input-group">
              <input id="url_pdf" name="url_pdf" type="file" class="file"></input>
          </div>
      </div>
    </div>   
    <div class="form-group">
      <label class="col-md-4 control-label" for="categories[]">Categorias <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('categories[]', $categories, $protocol->categories()->lists('id'), 
                array('class' => 'form-control', 'placeholder' => 'Categorías del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-tags"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="areas[]">Áreas <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('areas[]', $areas, $protocol->areas()->lists('id'), 
                array('class' => 'form-control', 'placeholder' => 'Áreas del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-sort"></i></span>
          </div>
      </div>
    </div>    
    <div class="form-group">
      <label class="col-md-4 control-label" for="roles[]">Perfiles <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('roles[]', $roles, $protocol->roles()->lists('id'), 
                array('class' => 'form-control', 'placeholder' => 'Categorías del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-old_man"></i></span>
          </div>
      </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Protocolo</button>
        </div>
    </div>
  {{Form::close()}}
@stop

@section('js_aditional')
  {{ HTML::script('assets/js/plugins/forms/file-validator.js') }}
@stop