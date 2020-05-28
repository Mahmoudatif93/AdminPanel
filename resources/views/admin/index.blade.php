@include('admin.layouts.header')
@include('admin.layouts.navbar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('admin.adminpanel')
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.adminpanel')</a></li>
            <li class="active"> {{!empty($title)? $title : __('admin.dashboard')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('admin.layouts.message')
        @yield('content')
        @include('admin.layouts._session')

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->






@push('js')
<script>
    

</script>
@endpush
@include('admin.layouts.footer')
