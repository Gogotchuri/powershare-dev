<form id="campaignCreateForm" method="post" action="{{$route}}" enctype="multipart/form-data">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf

    @include('components.form.input', [
        'name' => 'Name',
        'required' => true,
    ])

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true,
    ])

    @push('scripts-stack')
        <script>
            function onClick(statusName) {

                var form = $('#campaignCreateForm');
                var input = $('<input />').attr('type', 'hidden')
                    .attr('name', "status")
                    .attr('value', statusName);

                form.append(input).submit();
            }
        </script>
    @endpush


    <button type="submit" class="btn btn-secondary">
        Continue
    </button>

    @yield('additional-controls')

    <script defer>

        // FIXME: Temporary added this timout just to wait for jQuery/$ do get defined, ti should not be needed
        setTimeout(function () {
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
        }, 0);

    </script>
    {{--@endpush--}}
</form>
