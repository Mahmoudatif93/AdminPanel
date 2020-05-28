@extends('style.index')


@section('content')
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>{!!  setting()->message_maintenance  !!}</p>
                </div>
            </div>
            
        </div>
    </div>
</div> <!-- End promo area -->

 
@endsection