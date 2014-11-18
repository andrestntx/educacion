@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($category, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-12">            
              {{ Form::label('t09_name', 'Nombre de la Categoría') }}
              {{ Form::text('t09_name', null, array('required' => 'required', 
                  'placeholder' => 'Nombre de la Categoría', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-12">            
              {{ Form::label('t09_description', 'Descripción de la Categoría') }}
              {{ Form::text('t09_description', null, array('required' => 'required', 
                  'placeholder' => 'Descripción de la Categoría', 'class' => 'form-control')) }}
          </div>
              {{ Form::input('hidden', 't09_company_id', Auth::user()->preferredCompany->id) }}
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  </form>
@stop
