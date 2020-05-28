@extends('admin.index')
@section('content')


@push('js')


<!-- Modal -->
<div id="delete_bootstrap_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
        </div>
        {!! Form::open(['url'=>'','method'=>'delete','id'=>'form_Delete_department']) !!}
        <div class="modal-body">
          <h4>
           {{ trans('admin.ask_delete_dep') }} (<span id="dep_name"></span>)
          </h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
          {!! Form::submit(trans('admin.yes'),['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
      </div>
  
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#jstree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
                , 'data': {!!load_dep() !!}
            }
            , "checkbox": {
                "keep_selected_style": false
            }
            , "plugins": ["wholerow"]
        });

    });

    ////
    $('#jstree').on('changed.jstree', function(e, data) {
        var i, j, r = [] ,n = [];
        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
            n.push(data.instance.get_node(data.selected[i]).text);
        }
        $('#form_Delete_department').attr('action','{{ aurl('departments') }}/'+r.join(', '));
        $('#dep_name').text(n.join(', '));
        if(r.join(', ') != '')
            {
                //alert(r.join(', '));
                $('.showbtn_control').removeClass('hidden');
                $('.edit_dep').attr('href','{{ aurl('departments') }}/'+r.join(', ')+'/edit');
            }else{
                $('.showbtn_control').addClass('hidden');
            }
    });

</script>
@endpush


<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <a href="" class="btn btn-info edit_dep showbtn_control hidden" ><i class="fa fa-edit"></i> {{ trans('admin.edit') }}</a>
        <a href="" class="btn btn-danger delete_dep showbtn_control hidden"  data-toggle="modal" data-target="#delete_bootstrap_modal" ><i class="fa fa-trash"></i> {{ trans('admin.delete') }}</a>
        
        <div id="jstree">
        </div>



    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->






@endsection
