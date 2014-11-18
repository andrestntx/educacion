@extends('dashboard.pages.models.layout-form')
@section('content_form')
{{ Form::model($user, $form_data) }}     
    <div class="box-body">
      <div class="row">
        <div class="form-group col-md-6">            
          {{ Form::label('t02_url_photo', 'Foto de Perfil') }}
          <input id="t02_url_photo" name="t02_url_photo" type="file" class="file"></input>
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('username', 'Nombre de usuario') }}
          {{ Form::text('username', null, array('required' => 'required', 
                'placeholder' => 'Nombre de usuario', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('email', 'Correo electrónico') }}
          {{ Form::input('email', 'email', null, array('required' => 'required', 
                'placeholder' => 'Correo electrónico', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('password', 'Contraseña') }}
          {{ Form::input('password', 'password', null, array( 
                'placeholder' => 'Contraseña', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
          {{ Form::input('password', 'password_confirmation', null, array( 
                'placeholder' => 'Confirmar contraseña', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('t02_name', 'Nombre') }}
          {{ Form::text('t02_name', null, array( 
                'placeholder' => 'Nombre Completo', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('t02_tel', 'Teléfono') }}
          {{ Form::input('tel', 't02_tel', null, array( 
                'placeholder' => 'Teléfono', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('roles[]', 'Perfiles') }}
          {{ Form::select('roles[]', $roles, $user->roles()->lists('t03_id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required')) }}
        </div>
        <div class="form-group col-md-6">            
          {{ Form::label('areas[]', 'Areas') }}
          {{ Form::select('areas[]', $areas, $user->areas()->lists('t07_id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required')) }}
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
      initialPreview: "<img src='{{url($user->t02_url_photo_validated)}}' class='file-preview-image' alt='Foto de Perfil' title='Foto de Perfil'>",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 1, 
    }); 
  </script>
@stop