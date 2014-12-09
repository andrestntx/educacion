@extends('dashboard/pages/layout')
    @section('title_page') Protocolos Disponibles @stop
    @section('h1_page') 
        Protocolos Disponibles
    @stop
    @section('h2_page') 
        Mis Protocolos
    @stop
    @section('content_page')
    	<div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Protocolo</th>
                        <th>Descripción</th>
                        <th class="text-center">Mejor Resultado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    @foreach($protocols as $protocol)
                        <tr>
                            <td>{{$protocol->t06_name}}</td>
                            <td>{{$protocol->t06_description}}</td>
                            <td class="text-center">5</td>
                            <td class="text-center">
                                <a class="btn btn-social-icon btn-primary" title="Estudiar Protocolo" href="{{route('dashboard.study', $protocol->id)}}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-social-icon btn-warning" title="Mis Resultados" href="{{route('dashboard.exams', $protocol->id)}}"><i class="fa fa-bar-chart-o"></i></a>
                                <a class="btn btn-social-icon btn-success" title="Presentar examen" href="{{route('dashboard.exams.create', $protocol->id)}}"><i class="fa fa-pencil-square"></i></a>
                            </td>  
                        </tr>
                    @endforeach()
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="no-margin pull-right">
                    {{ $protocols->links() }}
                </div>
            </div>
        </div><!-- /.box -->
    @stop