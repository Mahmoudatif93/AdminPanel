@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#jstree').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                }
                , 'data': {!!load_dep($product->department_id) !!}
            }
            , "checkbox": {
                "keep_selected_style": false
            }
            , "plugins": ["wholerow"]
        });

    });
    $('#jstree').on('changed.jstree', function(e, data) {
        var i, j, r = [];
        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        alert(r.join(', '));

        $('.department_id').val(r.join(', '));
    });

</script>
@endpush


<div id="departments" class="tab-pane fade">
    <h3>@lang('admin.departments')</h3>
    <div id="jstree"></div>
    <input type="hidden" name="department_id" class="department_id" value="{{ $product->department_id }}">
</div>
<hr>