@extends ('auth/layout')

@section('title_auth') Página no encontrada @stop


@section('adicional_auth')
<div class="margin text-center">
    <span>La página que está buscando, no se encuentra disponible. <a href="{{url('login')}}">Ir al Inicio de Sesión</a></span>
</div>
@stop