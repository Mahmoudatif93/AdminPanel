<!-- Notyfication plugins -->
<script src="{{ url('/') }}/design/adminlte/plugins/jQuery/jquery-3.1.1.min.js"></script>

@if (session('success'))

<script>
    new Noty({

        theme: 'metroui'
        , type: 'success'
        , layout: 'topRight'
        , text: "{{ session('success') }}"
        , timeout: 2500
        , killer: true

    }).show();

</script>

@endif

<script>

    
    $('body').on('click', '.delete', function(e) {
        let that = $(this);
        e.preventDefault();
        let n = new Noty({
            theme: 'metroui'
            , text: "@lang('admin.confirm_delete')"
            , layout: 'topCenter'
            , type: "warning"
            , killer: true
            , buttons: [
                Noty.button("@lang('admin.yes') ", 'btn btn-success btn-space m-2', function() {
                    that.closest('form').submit();
                    n.close();
                })

                , Noty.button("@lang('admin.no') ", 'btn btn-danger btn-space m-2', function() {
                    n.close();
                })
            ]

            //End of button
        });
        n.show();
    }); //end of delete

    $('body').on('click', '.edit', function(e) {
        let that = $(this);
        e.preventDefault();
        let n = new Noty({
            theme: 'metroui'
            , text: "@lang('admin.confirm_edit')"
            , layout: 'topCenter'
            , type: "info"
            , killer: true
            , buttons: [
                Noty.button("@lang('admin.yes') ", 'btn btn-success btn-space m-2', function() {
                    window.open($(that).attr("href"));
                    n.close();
                })

                , Noty.button("@lang('admin.no') ", 'btn btn-danger btn-space m-2', function() {
                    n.close();
                })
            ]

            //End of button
        });
        n.show();
    }); //end of delete

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#'+$(input).attr("data-view")).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    CKEDITOR.config.language =  "{{ app()->getLocale() }}";

</script>
