@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($role, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-12">            
              {{ Form::label('t03_name', 'Nombre del Perfil') }}
              {{ Form::text('t03_name', null, array('required' => 'required', 
                  'placeholder' => 'Nombre del Perfil', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-12">            
              {{ Form::label('t03_description', 'Descripción del Perfil') }}
              {{ Form::text('t03_description', null, array('required' => 'required', 
                  'placeholder' => 'Descripción del Perfil', 'class' => 'form-control')) }}
          </div>
              {{ Form::input('hidden', 't03_company_id', Auth::user()->preferredCompany->id) }}
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  </form>
@stop
