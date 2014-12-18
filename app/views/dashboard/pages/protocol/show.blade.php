@extends('dashboard.pages.layout')
@section('title_page')Protocolo: {{$protocol->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-lg-9">
			<div class="block">
				<div class="block-title">
					<div class="block-options pull-right">
						@if(Auth::user()->isAdmin())
							<a href="{{route('protocolos.edit', $protocol->id)}}" class="btn btn-effect-ripple btn-warning" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
						@endif
						<div class="btn-group">
							<a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary dropdown-toggle enable-tooltip" data-toggle="dropdown" title="" style="overflow: hidden; position: relative;" data-original-title="Opciones"><i class="fa fa-chevron-down"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<a href="javascript:void(0)">
										<i class="gi gi-cloud-download pull-right"></i>
										Descargar
									</a>
								</li>
							</ul>
						</div>
					</div>
					<h2>{{$protocol->description}}</h2>
				</div>
				<div class="block-section">
					@if($protocol->isPdfCorrect())
						<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($protocol->pdf)}}&embedded=true" style="width:100%; height:550px;" frameborder="0"></iframe>
					@else
						<h4>El protocolo no se ha subido</h4>
					@endif
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="row">
				<div class="block">
					<div class="block-title">
						<div class="block-options pull-right">
							@if(Auth::user()->isAdmin())
								<a href="{{route('protocolos.anexos.create', $protocol->id)}}" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Nuevo Anexo"><i class="fa fa-plus"></i></a>
							@endif
						</div>
						<h2>{{$protocol->annex()->count()}} Anexos </h2>
					</div>
					<div class="block-section">
						@if(Auth::user()->isAdmin())
							<ul class="list-unstyled">
			                    @foreach($protocol->annex as $annex)
		                            <li title="{{$annex->description}}">
		                            	<div class="row">
		                            		
			                            	<div class="col-sm-8">
			                            		<h4><a href="{{url($annex->url)}}" target="_blank">{{$annex->name}}</a></h4>
			                            	</div>
			                            	<div class="col-sm-4">
					                            <a href="{{route('protocolos.anexos.edit', array($protocol->id, $annex->id))}}" data-toggle="tooltip" title="Editar Anexo" class="btn btn-sm btn-effect-ripple btn-warning">
					                                <i class="fa fa-pencil"></i>
					                            </a>
					                            {{Form::open(array('route' => array('protocolos.anexos.destroy', $protocol->id, $annex->id), 'method' => 'DELETE', 'style' => 'display:inline-block;'))}}
						                            <button type="submit" title="Borrar Anexo" class="btn btn-sm btn-effect-ripple btn-danger">
						                                <i class="fa fa-times"></i>
						                            </button>
					                            {{Form::close()}}
				                        	</div>
			                        	</div>
		                            </li>
			                    @endforeach
			                </ul>
	                    @else
                        	<ul class="fa-ul">
			                    @foreach($protocol->annex as $annex)
		                            <li title="{{$annex->description}}">
		                            	<i class="fa fa-file-text fa-li"></i>
			                           	<h4><a href="{{url($annex->url)}}" target="_blank">{{$annex->name}}</a></h4>			                            	
		                            </li>
			                    @endforeach
			                </ul>
                        @endif
					</div>
				</div>
			</div>
			@if(Auth::user()->isAdmin())
				<div class="row">
					<div class="block">
						<div class="block-title">
							<div class="block-options pull-right">
								{{Form::open(array('route' => array('protocolos.preguntas.create', $protocol->id), 'method' => 'GET', 'class' => 'form-inline'))}}
									{{Form::text('respuestas', null, array('class' => 'form-control', 'placeholder' => '# Respuestas', 'required' => 'required'))}}
									<button type="submit" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" style="overflow: hidden; position: relative;" data-original-title="Nueva Pregunta"><i class="fa fa-plus"></i></button>
								</form>
							</div>
							<h2>{{$protocol->questions()->count()}} Preguntas </h2>
						</div>
						<div class="block-section">
							<ul class="list-unstyled">
		                    @foreach($protocol->questions as $question)
	                            <li title="Pregunta">
	                            	<div class="row">
		                            	<div class="col-sm-8">
		                            		<h4>{{$question->text}}</h4>
		                            	</div>
		                            	<div class="col-sm-4">
				                            <a href="{{route('protocolos.preguntas.edit', array($protocol->id, $question->id))}}" data-toggle="tooltip" title="Editar Pregunta" class="btn btn-sm btn-effect-ripple btn-warning">
				                                <i class="fa fa-pencil"></i>
				                            </a>
				                            {{Form::open(array('route' => array('protocolos.preguntas.destroy', $protocol->id, $question->id), 'method' => 'DELETE', 'style' => 'display:inline-block;'))}}
				                            <button type="submit" title="Borrar Pregunta" class="btn btn-sm btn-effect-ripple btn-danger">
				                                <i class="fa fa-times"></i>
				                            </button>
				                            {{Form::close()}}
			                        	</div>
		                        	</div>
	                            </li>
		                    @endforeach
		                    </ul>
						</div>
					</div>
				</div>
			@else
				<div class="row">
					<a href="{{route('examenes.create', $protocol->id)}}" class="widget" title="Presentar Examen">
						<div class="widget-content widget-content-mini themed-background-muted text-center">
							<i class="fa fa-bar-chart-o"></i> Mejor Calificación
						</div>
						<div class="widget-content text-center">
							<div class="pie-chart easyPieChart" data-percent="{{Auth::user()->bestExamProtocol_score($protocol->id)}}" data-line-width="3" data-bar-color="#cccccc" data-track-color="#f9f9f9" style="width: 80px; height: 80px; line-height: 80px;">
								<span><strong>{{Auth::user()->bestExamProtocol_score($protocol->id)}}%</strong></span>
								<canvas width="80" height="80"></canvas>
							</div>
						</div>
						<div class="widget-content themed-background-muted">
							<div class="progress progress-striped progress-mini active remove-margin">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{Auth::user()->bestExamProtocol_score($protocol->id)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{Auth::user()->bestExamProtocol_score($protocol->id)}}%"></div>
							</div>
						</div>
					</a>
				</div>
			@endif
		</div>
	</div>
@stop