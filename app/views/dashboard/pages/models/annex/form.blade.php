@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($annex, $form_data) }}     
      <div class="box-body">
        <div class="row">
          {{ Form::input('hidden', 't11_protocol_id', $protocol->t06_id) }}
          <div class="form-group col-md-6">            
            {{ Form::label('t11_name', 'Nombre') }}
            {{ Form::text('t11_name', null, array('required' => 'required', 
                'placeholder' => 'Nombre', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-6">            
            {{ Form::label('t11_description', 'Descripción') }}
            {{ Form::text('t11_description', null, array('required' => 'required', 
                'placeholder' => 'Descripción', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-6">
            {{ Form::label('t11_url', 'Archivo Pdf', array('style' => 'width:100%')) }}
            <input id="t11_url" name="t11_url" type="file" class="file"></input>
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
    $("#t11_url").fileinput({
      initialPreview: "<div class='file-preview-text' title='{{$annex->t11_name}}'>" +
        "{{$annex->t11_description}}" +
        "<span class='wrap-indicator' onclick='$(\"#show-detailed-text\").modal(\"show\")' title='{{$annex->t11_name}}'>[…]</span>" +
        "</div>",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 10
    }); 
  </script>
@stop