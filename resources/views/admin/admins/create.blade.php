@extends('admin.index')
@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        {!! Form::open(['route'=>('admin.store'),'method'=>'post']) !!}
        <div class="form-group">
            {!! Form::label('name',trans('admin.name')) !!}
            {!! Form::text('name',old('name'),['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email',trans('admin.email')) !!}
            {!! Form::email('email',old('email'),['class'=>'form-control' ,'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password',trans('admin.password')) !!}
            {!! Form::password('password',['class'=>'form-control' ,'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation',trans('admin.password_confirmation')) !!}
            {!! Form::password('password_confirmation',['class'=>'form-control' ,'required']) !!}
        </div>                          

        <div class="form-group">
            {!! Form::submit(trans('admin.create_admin'),['class'=>'form-control btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


@endsection
