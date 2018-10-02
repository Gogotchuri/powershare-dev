
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
    $('.datatables').DataTable({
        stateSave: true,
    });
} );

$('#fileupload').fileupload({
    dataType: 'json',
    add: function (e, data) {
        $('#loading').text('Uploading...');
        data.submit();
    },
    done: function (e, data) {
        $.each(data.result.files, function (index, file) {
            $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
            if ($('#file_ids').val() != '') {
                $('#file_ids').val($('#file_ids').val() + ',');
            }
            $('#file_ids').val($('#file_ids').val() + file.fileID);
        });
        $('#loading').text('');
    }
});
