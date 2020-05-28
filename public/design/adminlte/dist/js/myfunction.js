
function check_all() {

    $('input[class="item_checkbox"]:checkbox').each(function () {
        if ($('input[class="check_all"]:checkbox:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }
    });
}


function delete_all() {
    $(document).on('click', '.del_all', function () {
        $('#form_data').submit();
    });
    $(document).on('click', '.delBtn', function () {
        var item_check = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;
        if (item_check > 0) {
            $('.empty_record').addClass('hidden');
            $('.not_empty_record').removeClass('hidden');
            $('.record_count').text(item_check);
        } else {
            $('.record_count').text('');
            $('.not_empty_record').addClass('hidden');
            $('.empty_record').removeClass('hidden');
        }
        $('#mutlipleDelete').modal('show');
    });
}


  
  