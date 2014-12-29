@extends('dashboard.pages.layout')
@section('title_page')
  Lista de Chequeo: {{$survey->name}}, # {{$resolvedSurvey->id}} 
  <a href="{{route('formularios.registros.export', array($survey->id, $resolvedSurvey->id))}}" data-toggle="tooltip" title="Exportar a PDF" class="btn btn-sm btn-effect-ripple btn-success">
    <i class="fa fa-file-pdf-o"></i>
  </a>
@stop
@section('content_body_page')
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      @foreach($resolvedSurvey->answers as $answer)
        <div class="block">
          <div class="block-title" style="margin-bottom:5px;">
            <h2>{{$answer->question->text}}</h2>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <p style="font-size:16px; margin-bottom:5px;">{{$answer->text}}</p>
            </div>
          </div>
        </div>
      @endforeach()
    </div>
  </div>
@stop


