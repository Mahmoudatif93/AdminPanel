@extends('admin.index')
@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('trademarks/'.$tradeMark->id),'method'=>'put','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name_ar',trans('admin.name_ar')) !!}
            {!! Form::text('name_ar',$tradeMark->name_ar,['class'=>'form-control']) !!}
         </div>
    
         <div class="form-group">
            {!! Form::label('name_en',trans('admin.name_en')) !!}
            {!! Form::text('name_en',$tradeMark->name_en,['class'=>'form-control']) !!}
         </div>
    
    
         <div class="form-group">
            {!! Form::label('logo',trans('admin.trade_icon')) !!}
            {!! Form::file('logo',[ 'class'=>'form-control','onchange'=>'readURL(this);' ,'data-view'=>'logo_view']) !!}
            @if(!empty($tradeMark->logo))
            <img src="{{Storage::url($tradeMark->logo)}}" id="logo_view" class="img-thumbnail" style="width:50px;height: 50px;"/>
            
            @endif
         </div>                       
        <div class="form-group">
            {!! Form::submit(trans('admin.edit'),['class'=>'form-control btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


@endsection
