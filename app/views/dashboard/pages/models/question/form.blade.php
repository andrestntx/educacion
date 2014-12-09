@extends('dashboard.pages.models.layout-form')
@section('content_form')
  {{ Form::model($question, $form_data) }}     
      <div class="box-body">
        <div class="row">
          {{ Form::input('hidden', 't14_protocol_id', $protocol->t06_id) }}
          <div class="form-group col-md-12">            
            {{ Form::label('t14_text', 'Pregunta') }}
            {{ Form::text('t14_text', null, array('required' => 'required', 
                'placeholder' => 'Pregunta', 'class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-12"> 
            <h4>Respuestas</h4>
          </div>
          @for($i=1; $i <= $number_answers; $i++ )
            <div class="form-group col-md-12">    
              <div class="col-md-8">      
                {{ Form::text('answers['.$i.'][t15_text]', null, array('required' => 'required', 
                  'placeholder' => 'Respuesta '.$i, 'class' => 'form-control')) }}
              </div>
              <div class="col-md-4">
                <div class="checkbox">
                  <label>
                      <input type="checkbox" name="answers[{{$i}}][t15_correct]" value="true"/>
                      Verdadera
                  </label>
                </div>
              </div>
            </div>
          @endfor
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
      </div>
  {{ Form::close() }}
@stop