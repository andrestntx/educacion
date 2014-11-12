{{ Form::model($model, $form_data) }}     
    <div class="box-body">
        <div class="form-group">            
            {{ Form::label('singular_name', 'Nombre Singular') }}
            {{ Form::text('singular_name', null, array('required' => 'required', 
                'placeholder' => 'Nombre Singular', 'class' => 'form-control')) }}
        </div>
        <div class="form-group">            
            {{ Form::label('plural_name', 'Nombre Plural') }}
            {{ Form::text('plural_name', null, array('required' => 'required', 
                'placeholder' => 'Nombre Plural', 'class' => 'form-control')) }}
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</form>