@extends('dashboard/pages/layout')

@section('title_page') Protocolo {{$protocol->t06_name}} @stop
@section('h1_page') 
    <i class="fa fa-eye"></i> Estudiando Protocolo
@stop
@section('h2_page') 
    {{$protocol->t06_name}}
@stop
@section('content_page')
	<div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-file-text"></i>
                <h3 class="box-title">Documento</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="font-size:16px;">
				<object width="100%" height="550" type="application/pdf" data="{{url($protocol->t06_url_pdf)}}" id="pdf_content">
					<p>El navegador no es compatilbe</p>
				</object>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    	<div class="row">
	    	<div class="box box-warning">
	            <div class="box-header">
	                <i class="fa fa-upload"></i>
	                <h3 class="box-title">Anexos</h3>
	            </div><!-- /.box-header -->
	            <div class="box-body" style="font-size:18px;">
	                @foreach($protocol->annex as $annex)
	                	<li style="list-style-type: none;"> 
	                		<a href="{{url($annex->t11_url)}}" title="{{$annex->t11_description}}" target="_blank">
	                			<i class="fa fa-check-square-o"></i>
	                			 {{$annex->t11_name}}
	                		</a> 
	                	</li>
	                @endforeach
	            </div>
	        </div>
        </div>
        <div class="row">
	        <!-- small box -->
	        <div class="small-box bg-aqua">
	            <div class="inner">
	                <h3>
	                    6
	                </h3>
	                <p style="font-size:20px;">
	                    Mejor Nota
	                </p>
	            </div>
	            <a href="{{route('dashboard.exams', $protocol->id)}}">
	                <div class="icon">
	                    <i class="ion ion-stats-bars"></i>
	                </div>
	            </a>
	            <a href="{{route('dashboard.exams.create', $protocol->id)}}" class="small-box-footer" style="font-size:16px;">
	                Presentar examen <i class="fa fa-arrow-circle-right"></i>
	            </a>
	        </div>  
        </div>
    </div>
@stop
