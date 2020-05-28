<span class="label 
{{$level == 'user'?'label-primary':''}}
{{$level == 'vendor'?'label-success':''}}
{{$level == 'company'?'label-info':''}}
">

    {{ trans('admin.'.$level) }}
</span>



