<div class="box">
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                @foreach($titles_table as $title)
                    <th>{{$title}}</th>
                @endforeach()
                @if(isset($actions))
                    <th class="text-center">Acciones</th>
                @endif
            </tr>
            @foreach($models as $model)
                <tr>
                    @foreach($model->getMainAttributes() as $attribute)
                        <td>
                            {{$attribute}}
                        </td>
                    @endforeach()  
                    @if(isset($actions))
                        <td class="text-center">
                            @foreach($actions as $key => $action)
                                @if($action == 'show')
                                    <a class="btn btn-social-icon btn-primary" title="Ver" href="{{route('dashboard.'.$module->route.'.show', $model->id)}}"><i class="fa fa-eye"></i></a>
                                @elseif($action == 'edit')
                                    <a class="btn btn-social-icon btn-warning" title="Editar" href="{{route('dashboard.'.$module->route.'.edit', $model->id)}}"><i class="fa fa-edit"></i></a>
                                @elseif($action == 'destroy')
                                    <a href="#" class="btn btn-social-icon btn-danger" title="Borrar" data-id="{{ $model->id }}" id="btn-delete-{{$model->id}}" onclick="deleteModel('btn-delete-{{$model->id}}')"><i class="fa fa-trash-o"></i></a>
                                @elseif($key == 'show_models')
                                    <a class="btn btn-social-icon btn-primary" title="{{$action['name']}}" href="{{route('dashboard.'.$module->route.'.'.$action['models'].'.index', $model->id)}}"><i class="fa {{$action['icon']}}"></i></a> 
                                @endif
                            @endforeach
                        </td>  
                    @endif  
                </tr>
            @endforeach()
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="no-margin pull-right">
            {{ $models->links() }}
        </div>
    </div>
</div><!-- /.box -->
@if(Route::has('dashboard.'.$module->route.'.destroy'))
    {{Form::open(array('route' => array('dashboard.'.$module->route.'.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
    {{Form::close()}}
@endif
