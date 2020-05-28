@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#jstree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
                , 'data': {!!load_dep($department->department_id,$department->id) !!}
            }
            , "checkbox": {
                "keep_selected_style": false
            }
            , "plugins": ["wholerow"]
        });

    });
    $('#jstree').on('changed.jstree', function(e, data) {
        var i, j, r = [];
        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $('.department_id').val(r.join(', '));
        //alert( $('.department_id').val());
    });

</script>
@endpush

<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('departments/'.$department->id),'method'=>'put','files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('dep_name_ar',trans('admin.dep_name_ar')) !!}
            {!! Form::text('dep_name_ar',$department->dep_name_ar,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('dep_name_en',trans('admin.dep_name_en')) !!}
            {!! Form::text('dep_name_en',$department->dep_name_en,['class'=>'form-control']) !!}
        </div>
        <div class="clearfix"></div>
        <div id="jstree"></div>
        <input type="hidden" name="department_id" class="department_id" value="{{$department->department_id }}">
        <div class="clearfix"></div>
        <div class="form-group">
            {!! Form::label('description',trans('admin.description')) !!}
            {!! Form::textarea('description',$department->description,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('keyword',trans('admin.keyword')) !!}
            {!! Form::textarea('keyword',$department->keyword,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('icon',trans('admin.icon')) !!}
            {!! Form::file('icon',['class'=>'form-control' ,'onchange'=>'readURL(this);' ,'data-view'=>'icon_view']) !!}
            @if(!empty($department->icon) && Storage::has($department->icon)) 
            <img src="{{Storage::url($department->icon)}}" id="icon_view" style="width:50px;height: 50px;" class="img-thumbnail" />
            @endif
        </div>
        {!! Form::submit(trans('admin.edit'),['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
