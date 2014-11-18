@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($area, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-12">            
              {{ Form::label('t07_name', 'Nombre del Area') }}
              {{ Form::text('t07_name', null, array('required' => 'required', 
                  'placeholder' => 'Nombre del Area', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-12">            
              {{ Form::label('t07_description', 'Descripción del Area') }}
              {{ Form::text('t07_description', null, array('required' => 'required', 
                  'placeholder' => 'Descripción del Area', 'class' => 'form-control')) }}
          </div>
              {{ Form::input('hidden', 't07_company_id', Auth::user()->preferredCompany->id) }}
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  </form>
@stop
