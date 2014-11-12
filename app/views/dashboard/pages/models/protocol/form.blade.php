@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($protocol, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="col-md-7">
            <div class="box box-primary">
              <div class="box-body">
                <div class="row">
                  {{ Form::input('hidden', 't06_user_id', Auth::user()->id) }}
                  <div class="form-group col-md-12">            
                    {{ Form::label('t06_name', 'Nombre') }}
                    {{ Form::text('t06_name', null, array('required' => 'required', 
                        'placeholder' => 'Nombre', 'class' => 'form-control')) }}
                  </div>
                  <div class="form-group col-md-12">            
                    {{ Form::label('t06_description', 'Descripción') }}
                    {{ Form::text('t06_description', null, array('required' => 'required', 
                        'placeholder' => 'Descripción', 'class' => 'form-control')) }}
                  </div>
                  <div class="form-group col-md-12">
                    {{ Form::label('t06_url_pdf', 'Archivo Pdf', array('style' => 'width:100%')) }}
                    <input id="t06_url_pdf" name="t06_url_pdf" type="file" class="file"></input>
                  </div>
                  <div class="form-group col-md-12">            
                    {{ Form::label('t06_user_id', 'Autor') }}
                    {{ Form::select('t06_user_id', $users, null, array('required' => 'required', 
                      'class' => 'form-control')) }}
                  </div>
                  <div class="form-group col-md-12">            
                    {{ Form::label('categories[]', 'Categorias') }}
                    {{ Form::select('categories[]', array('' => 'Vacio'), null, array('multiple' => 'multiple', 'required' => 'required', 
                      'class' => 'form-control')) }}
                  </div>
                  <div class="form-group col-md-12">            
                    {{ Form::label('areas[]', 'Areas') }}
                    {{ Form::select('areas[]', array('' => 'Vacio'), null, array('multiple' => 'multiple', 'required' => 'required', 
                      'class' => 'form-control')) }}
                  </div>
                  <div class="form-group col-md-12">            
                    {{ Form::label('roles[]', 'Perfiles') }}
                    {{ Form::select('roles[]', array('' => 'Vacio'), null, array('multiple' => 'multiple', 'required' => 'required', 
                      'class' => 'form-control')) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="box box-primary">
              <div class="box-header">
                <i class="fa fa-cloud-upload"></i>
                <h5 class="box-title">Anexos</h5>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <input id="anexos" name="anexos[]" type="file" class="file" multiple></input>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  {{ Form::close() }}
@stop

@section('aditional-js')
  <script type="text/javascript">
    $("#anexos").fileinput({showCaption: true, showUpload: false, showPreview: true, maxFileCount: 10}); 
    $("#t06_url_pdf").fileinput({
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 10
    }); 
  </script>
@stop