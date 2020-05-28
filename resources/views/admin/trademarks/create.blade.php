@extends('admin.index')
@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('trademarks'),'method'=>'post','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name_ar',trans('admin.name_ar')) !!}
            {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_en',trans('admin.name_en')) !!}
            {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('logo',trans('admin.trade_icon')) !!}
            {!! Form::file('logo',['class'=>'form-control','onchange'=>'readURL(this);' ,'data-view'=>'logo_view']) !!}
            <img src="" id="logo_view" style="width:50px;height: 50px;" class="img-thumbnail"  />
        </div>
        <div class="form-group">
            {!! Form::submit(trans('admin.add'),['class'=>'form-control btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


@endsection
