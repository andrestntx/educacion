@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') fa fa-user @stop
@section('title_page')
  @if($user->exists) 
    Editar {{Auth::user()->editTypeUser()}} : {{$user->name}}
  @else 
    Nuevo {{Auth::user()->editTypeUser()}}
  @endif 
@stop
@section('breadcrumbs') @stop
@section('title_form') Datos del {{Auth::user()->editTypeUser()}} @stop
@section('form')
  <!-- Validation Wizard Content -->
  {{Form::model($user, $form_data)}}
  <!-- First Step -->
      <!-- END Step Info -->
      <!-- Dropzone Block -->
      <div class="form-group">
          <label class="col-md-4 control-label" for="url_photo">Foto de Perfil <span class="text-danger">*</span></label>
          <div class="col-md-6">
              <div class="input-group">
                <input id="url_photo" name="url_photo" type="file" class="file"></input>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="username">Nombre de usuario <span class="text-danger">*</span></label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Nombre con el que iniciará sesión', 'required' => 'required'))}}
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="password">Contraseña </label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::input('password', 'password', null, array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
                  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="password_confirmation">Confirmar Contraseña </label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::input('password', 'password_confirmation', null, array('class' => 'form-control', 'placeholder' => 'Confirmar Contraseña'))}}
                  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="name">Nombres y Apellidos <span class="text-danger">*</span></label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombres y Apellidos', 'required' => 'required'))}}
                  <span class="input-group-addon"><i class="gi gi-user"></i></span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="email">Correo electrónico <span class="text-danger">*</span></label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::input('email', 'email', null, array('class' => 'form-control', 'placeholder' => 'Correo electrónico'))}}
                  <span class="input-group-addon"><i class="gi gi-imac"></i></span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-4 control-label" for="tel">Teléfono</label>
          <div class="col-md-6">
              <div class="input-group">
                  {{Form::text('tel', null, array('class' => 'form-control', 'placeholder' => 'Teléfono fijo o Celular'))}}
                  <span class="input-group-addon"><i class="gi gi-iphone"></i></span>
              </div>
          </div>
      </div>
      @if(Auth::user()->isAdmin())
        <div class="form-group">
            <label class="col-md-4 control-label" for="roles[]">Perfiles <span class="text-danger">*</label>
            <div class="col-md-6">
                <div class="input-group">
                    {{Form::select('roles[]', $roles, $user->roles()->lists('id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required'))}}
                    <span class="input-group-addon"><i class="gi gi-old_man"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="areas[]">Áreas <span class="text-danger">*</label>
            <div class="col-md-6">
                <div class="input-group">
                    {{Form::select('areas[]', $areas, $user->areas()->lists('id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required'))}}
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                </div>
            </div>
        </div>
      @endif
      
  <!-- END First Step -->

    <!-- Form Buttons -->
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar {{Auth::user()->editTypeUser()}}</button>
        </div>
    </div>
    <!-- END Form Buttons -->
  {{Form::close()}}
@stop

@section('js_aditional')
  <script type="text/javascript">
    $('.file').fileinput({
      initialPreview: "<img src='{{url($user->image)}}' class='file-preview-image' alt='Foto de Perfil' title='Foto de Perfil' >",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 1, 
    }); 
  </script>

  {{ HTML::script('assets/js/plugins/forms/file-validator.js') }}
@stop