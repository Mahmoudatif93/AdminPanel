
<div id="product_info" class="tab-pane fade in active">
    <h3>@lang('admin.product_info')</h3>
    <div class="form-group">
        {!! Form::label('title_ar',trans('admin.title_ar')) !!}
        {!! Form::text('title_ar',$product->title_ar,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title_en',trans('admin.title_en')) !!}
        {!! Form::text('title_en',$product->title_en,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content_ar',trans('admin.content_ar')) !!}
        {!! Form::textarea('content_ar',$product->content_ar,['class'=>'form-control ckeditor']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content_en',trans('admin.content_en')) !!}
        {!! Form::textarea('content_en',$product->content_en,['class'=>'form-control ckeditor']) !!}
    </div>
    
</div>
