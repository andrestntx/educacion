@extends ('auth/layout')

@section('title_auth') Iniciar Sesión @stop

@section('form_auth')
    {{ Form::open(array('url' => 'api/auth/login', 'method' => 'post')) }}
        <div class="body bg-gray">
            <div class="form-group">
                {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Nombre de usuario')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña')) }}
            </div>          
            <div class="form-group">
                <input type="checkbox" name="remember_me"/> Recordarme
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block">Iniciar ahora</button>  
            
            <p><a href="#">Olvidé mi contraseña</a></p>
            @include('alerts')

            {{-- <a href="register.html" class="text-center">Register a new membership</a> --}}
        </div>
    </form>
@stop

@section('adicional_auth')
<div class="margin text-center">
    <span>Inicia sesión con las redes sociales</span>
    <br/>
    <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
    <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
    <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
</div>
@stop