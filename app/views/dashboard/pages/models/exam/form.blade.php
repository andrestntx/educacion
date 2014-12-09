@extends('dashboard/pages/layout')

@section('title_page') Examen del Protocolo {{$protocol->t06_name}} @stop
@section('h1_page') 
    <i class="fa fa-pencil"></i> Presentando examen
@stop
@section('h2_page') 
    {{$protocol->t06_name}}
@stop
@section('content_page')
  {{ Form::model($exam, $form_data) }}     
      <div class="box-body">
        <div class="row">
          @foreach($protocol->randomQuestions() as $question)
          <div class="form-group col-md-12">     
            <div class="box box-success"> 
              <div class="box-header">
                <i class="fa fa-bullhorn"></i>
                <h3 class="box-title">{{$question->t14_text}}</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  @foreach($question->answers as $answer)
                    <div class="form-group col-md-6 col-ms-12"> 
                      <div class="checkbox">
                        <label style="font-size:16px;">
                            <input type="checkbox" name="answers[{{$question->t14_id}}][{{$answer->t15_id}}]" value="true" />
                            {{$answer->t15_text}}
                        </label>
                      </div>
                    </div>
                  @endforeach
                  </div>
              </div>      
            </div>
          </div>
          @endforeach
              
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Enviar Examen</button>
      </div>
  </form>
@stop
