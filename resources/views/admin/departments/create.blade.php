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
                , 'data': {!!load_dep(old('department_id')) !!}
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
        alert(r.join(', '));

        $('.department_id').val(r.join(', '));
    });

</script>
@endpush

<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('departments'),'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('dep_name_ar',trans('admin.dep_name_ar')) !!}
            {!! Form::text('dep_name_ar',old('dep_name_ar'),['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('dep_name_en',trans('admin.dep_name_en')) !!}
            {!! Form::text('dep_name_en',old('dep_name_en'),['class'=>'form-control']) !!}
        </div>
        <div class="clearfix"></div>
        <div id="jstree"></div>
        <input type="hidden" name="department_id" class="department_id" value="{{ old('department_id') }}">
        <div class="clearfix"></div>
        <div class="form-group">
            {!! Form::label('description',trans('admin.description')) !!}
            {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('keyword',trans('admin.keyword')) !!}
            {!! Form::textarea('keyword',old('keyword'),['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('icon',trans('admin.icon')) !!}
            {!! Form::file('icon',['class'=>'form-control' ,'onchange'=>'readURL(this);' ,'data-view'=>'icon_view']) !!}
            <img src="" id="icon_view" style="width:50px;height: 50px;"/>
        </div>
        {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
