@extends('dashboard.pages.layout')
@section('title_page') Institución {{Auth::user()->preferredCompany->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-12">
			<div class="block">
				<div class="block-title">
					<h2>Mis Notas</h2>
				</div>
				<div class="block-section">
					<div class="table-responsive">
			            <table id="datatable" class="table table-striped table-bordered table-vcenter">
			                <thead>
			                    <tr>
			                        <th title="Nombre del Protocolo">Protocolo Evaluado</th>
			                        <th title="Descripción del Protocolo">Descripción</th>
			                        <th class="text-center" title="Número de Intentos">Número de Intentos</th>
			                        <th class="text-center" title="Mejor Calificación">Mejor Calificación</th>
			                        <th title="Ultima actulaización del Protocolo">Último Intento</th>
			                        <th class="text-center" title="Última Calificación">Última Calificación</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($protocols as $protocol)
			                        <tr>
			                            <td><a href="{{route('estudiar', $protocol->id)}}" title="Ver Protocolo">{{$protocol->name}}</a></td>
			                            <td>{{ $protocol->description }}</td>
			                            <td class="text-center">{{ Auth::user()->numberExamsProtocol($protocol->id) }}</a></td>
			                            <td class="text-center">{{ Auth::user()->bestExamProtocol_score($protocol->id) }}</td>
			                            <td> {{ Auth::user()->lastExamProtocol_update($protocol->id) }} </td>
			                        	<td class="text-center"> {{ Auth::user()->lastExamProtocol_score($protocol->id) }}</td>
			                        </tr>
			                    @endforeach
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/scoreTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop