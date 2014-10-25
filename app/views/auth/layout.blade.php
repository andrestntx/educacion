@extends ('layout')

@section ('title') .: Educación Continudada | Login :. @stop

@section ('class_body') bg-black @stop
@section ('warp')
    <div class="form-box" id="login-box">
        <div class="header">@yield('title_auth', 'Iniciar Sesión')</div>
        @yield('form_auth')
        @yield('adicional_auth')
    </div>
@stop

