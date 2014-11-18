@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($protocol, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                {{ Form::input('hidden', 't06_user_id', Auth::user()->id) }}
                <div class="form-group col-md-6">            
                  {{ Form::label('t06_name', 'Nombre') }}
                  {{ Form::text('t06_name', null, array('required' => 'required', 
                      'placeholder' => 'Nombre', 'class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">            
                  {{ Form::label('t06_description', 'Descripción') }}
                  {{ Form::text('t06_description', null, array('required' => 'required', 
                      'placeholder' => 'Descripción', 'class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('t06_url_pdf', 'Archivo Pdf', array('style' => 'width:100%')) }}
                  <input id="t06_url_pdf" name="t06_url_pdf" type="file" class="file"></input>
                </div>
                <div class="form-group col-md-6">            
                  {{ Form::label('categories[]', 'Categorias') }}
                  {{ Form::select('categories[]', $categories, $protocol->categories()->lists('t09_id'), array('multiple' => 'multiple', 'required' => 'required', 
                    'class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">            
                  {{ Form::label('areas[]', 'Areas') }}
                  {{ Form::select('areas[]', $areas, $protocol->areas()->lists('t07_id'), array('multiple' => 'multiple', 'required' => 'required', 
                    'class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">            
                  {{ Form::label('roles[]', 'Perfiles') }}
                  {{ Form::select('roles[]', $roles, $protocol->roles()->lists('t03_id'), array('multiple' => 'multiple', 'required' => 'required', 
                    'class' => 'form-control')) }}
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
    $("#t06_url_pdf").fileinput({
      initialPreview: "<div class='file-preview-text' title='{{$protocol->t06_name}}'>" +
        "{{$protocol->t06_description}}" +
        "<span class='wrap-indicator' onclick='$(\"#show-detailed-text\").modal(\"show\")' title='{{$protocol->t06_name}}'>[…]</span>" +
        "</div>",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 10
    }); 
  </script>
@stop