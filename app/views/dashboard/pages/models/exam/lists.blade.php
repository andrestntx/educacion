@extends('dashboard/pages/layout')
    @section('title_page') Examenes Protocolo {{$protocol->t06_name}}@stop
    @section('h1_page') 
        Protocolo {{$protocol->t06_name}}
    @stop
    @section('h2_page') 
        Mis Examenes
    @stop
    @section('content_page')
    	<div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Fecha</th>
                        <th>Preguntas Correctas</th>
                        <th>Preguntas Incorrectas</th>
                        <th class="text-center">Calificación</th>
                    </tr>
                    <tr></tr>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="no-margin pull-right">
                    {{-- $protocols->links() --}}
                </div>
            </div>
        </div><!-- /.box -->
    @stop