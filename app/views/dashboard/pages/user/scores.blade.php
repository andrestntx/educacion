@extends('dashboard.pages.layout')
@section('title_page') Institución {{Auth::user()->preferredCompany->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-9">
			<div class="block">
				<div class="block-title">
					<h2>Mis Notas</h2>
				</div>
				<div class="block-section">
					<div class="table-responsive">
			            <table id="datatable" class="table table-striped table-bordered table-vcenter">
			                <thead>
			                    <tr>
			                        <th title="Nombre del Protocolo">Nombre</th>
			                        <th title="Descripción del Protocolo">Descripción</th>
			                        <th class="text-center" title="Número de Intentos"># Intentos</th>
			                        <th title="Ultima actulaización del Protocolo">Último Intento</th>
			                        <th class="text-center" title="Mejor Calificación">Calificación</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($protocols as $protocol)
			                        <tr>
			                            <td><a href="{{route('estudiar', $protocol->id)}}" title="Ver Protocolo">{{$protocol->name}}</a></td>
			                            <td>{{ $protocol->description }}</td>
			                            <td class="text-center">{{ $protocol->exams()->count() }}</a></td>
			                            <td> @if($protocol->last_exam) {{ $protocol->last_exam }} @else Sin examenes @endif</td>
			                            <td class="text-center"> @if($protocol->best_exam) {{ $protocol->best_exam }} @else NA @endif</td>
			                        </tr>
			                    @endforeach
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="block">
				<div class="block-title">
					<h2>{{Auth::user()->preferredCompany->name}}</h2>
				</div>
				<div class="block-section">
					<img src="{{url(Auth::user()->preferredCompany->logo)}}" style="display:block; margin: 0 auto; max-width:300px; width:80%;">
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