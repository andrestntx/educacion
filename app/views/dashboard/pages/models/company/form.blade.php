@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($company, $form_data) }}     
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-12">            
              {{ Form::label('t01_name', 'Nombre de la Institución') }}
              {{ Form::text('t01_name', null, array('required' => 'required', 
                  'placeholder' => 'Nombre de la Institución', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-5">
              {{ Form::label('t01_url_logo', 'Logo de la Institución', array('style'=> 'width:100%;')) }}
              <input id="t01_url_logo" name="t01_url_logo" type="file" class="file"></input>
          </div>
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  </form>
@stop

@section('aditional-js')
  <script type="text/javascript">
    $('.file').fileinput({
      initialPreview: "<img src='{{url($company->t01_url_logo)}}' class='file-preview-image' alt='Logo de la Institución' title='Logo de la Institución'>",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 1, 
    }); 
  </script>
@stop