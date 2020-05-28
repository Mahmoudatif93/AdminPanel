@extends('admin.index')
@section('content')
@push('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>


@endpush



<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('colors'),'files'=>true]) !!}

        <a href="#" class="btn btn-primary save">{{ trans('admin.save') }} <i class="fa fa-floppy-o"></i></a>
        <a href="#" class="btn btn-success save_and_continue">{{ trans('admin.save_and_continue') }} <i class="fa fa-floppy-o"></i></a>
        <a href="#" class="btn btn-info copy_product">{{ trans('admin.copy_product') }} <i class="fa fa-copy"></i> </a>
        <a href="#" class="btn btn-danger delete">{{ trans('admin.delete') }} <i class="fa fa-trash"></i> </a>
        <hr />


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#product_info">@lang('admin.product_info') <i class="fa fa-info"></i></a></li>
            <li><a data-toggle="tab" href="#departments">@lang('admin.departments') <i class="fa fa-list"></i></a></li>
            <li><a data-toggle="tab" href="#product_setting">@lang('admin.product_setting') <i class="fa fa-cog"></i></a></li>
            <li><a data-toggle="tab" href="#product_media">@lang('admin.product_media') <i class="fa fa-photo"></i></a></li>
            <li><a data-toggle="tab" href="#product_size_weight">@lang('admin.product_size_weight') <i class="fa fa-won"></i></a></li>
            <li><a data-toggle="tab" href="#other_data">@lang('admin.other_data') <i class="fa fa-database"></i></a></li>
        </ul>

        <div class="tab-content">

            @include('admin.products.tabs.product_info')
            @include('admin.products.tabs.department')
            @include('admin.products.tabs.product_setting')
            @include('admin.products.tabs.product_media')
            @include('admin.products.tabs.product_size_weight')
            @include('admin.products.tabs.other_data')




        </div>

        



        <a href="#" class="btn btn-primary save">{{ trans('admin.save') }} <i class="fa fa-floppy-o"></i></a>
        <a href="#" class="btn btn-success save_and_continue">{{ trans('admin.save_and_continue') }} <i class="fa fa-floppy-o"></i></a>
        <a href="#" class="btn btn-info copy_product">{{ trans('admin.copy_product') }} <i class="fa fa-copy"></i> </a>
        <a href="#" class="btn btn-danger delete">{{ trans('admin.delete') }} <i class="fa fa-trash"></i> </a>

        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection
