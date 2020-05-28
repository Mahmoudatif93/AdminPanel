@extends('admin.index')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        {!! Form::open(['route'=>['users.update',$user->id],'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::label('name',trans('admin.name')) !!}
            {!! Form::text('name',$user->name,['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email',trans('admin.email')) !!}
            {!! Form::email('email',$user->email,['class'=>'form-control' ,'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password',trans('admin.password')) !!}
            {!! Form::password('password',['class'=>'form-control' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation',trans('admin.password_confirmation')) !!}
            {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        </div>                          
        <div class="form-group">
            {!! Form::label('level',trans('admin.level')) !!}
            {!! Form::select('level',['user'=>trans('admin.user'),'company'=>trans('admin.company'),'vendor'=>trans('admin.vendor')],$user->level,['class'=>'form-control' ,'required']) !!}
        </div>  
        <div class="form-group">
            {!! Form::submit(trans('admin.save'),['class'=>'form-control btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


@endsection
