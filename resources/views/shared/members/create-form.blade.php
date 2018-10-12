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


        <div class="col-sm-4">
            <div class="card mb-3">
                <div class="card-header">
                    Main featured image
                </div>
                <div class="card-body">
                    <img id="featured-image" src="" class="w-100 mb-3" />
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="featured-image" class="custom-file-input" id="image-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <button type="submit" class="btn btn-secondary">
        Continue
    </button>

    @yield('additional-controls')
</form>

@push('scripts-stack')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#featured-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image-input").change(function() {
            $("#featured-image").show();
            readURL(this);
        });
    </script>
@endpush
