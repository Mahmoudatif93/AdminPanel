@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
    $(document).ready(function() {

        @if($state->country_id > 0)

        $.ajax({
            url: '{{ aurl('states/create') }}'
            , type: 'get'
            , dataType: 'html'
            , data: {
                country_id: {{$state->country_id}}
                , select: {{$state->city_id}}
            }
            , success: function(data) {
                $('.city').html(data);
            }
        });
        @endif
        $(document).on('change', '.country_id', function() {
            //alert($('.country_id').val());
            //alert($('.country_id option:selected').val());

            var country = $('.country_id option:selected').val();
            if (country > 0) {
                //alert(country);
                $.ajax({
                    url:'{{ aurl('states/create') }}'
                    , type: 'get'
                    , dataType: 'html'
                    , data: {
                        country_id: country
                        , select: ''
                    }
                    , success: function(data) {
                        $('.city').html(data);
                    }
                });
            } else {
                $('.city').html('');
            }
        });
    });

</script>
@endpush
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url'=>aurl('states/'.$state->id),'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('state_name_ar',trans('admin.state_name_ar')) !!}
            {!! Form::text('state_name_ar',$state->state_name_ar,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('state_name_en',trans('admin.state_name_en')) !!}
            {!! Form::text('state_name_en',$state->state_name_en,['class'=>'form-control']) !!}
        </div>

        
        <div class="form-group">
            {!! Form::label('country_id',trans('admin.country_id')) !!}
            {{--'country_name_'.session('lang')--}}
            {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.lang(),'id'),$state->country_id,['class'=>'form-control country_id' , 'placeholder'=>__('admin.choselist')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city_id',trans('admin.city_id')) !!}
            <span class="city"></span>
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
