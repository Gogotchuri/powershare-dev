<form id="campaignEditForm" method="post" action="{{$route}}" enctype="multipart/form-data">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{method_field('PUT')}}

    @csrf

    <div class="row">
        <div class="col-sm-8">
            @include('components.form.input', [
                'name' => 'Name',
                'required' => true,
                'value' => $campaign->name,
            ])

            @include('components.form.textarea', [
                'name' => 'Details',
                'required' => true,
                'value' => $campaign->details,
            ])

            @include('components.form.input', [
               'name' => 'Video',
               'value' => $campaign->video_url,
            ])

            @include('components.form.input', [
                'name' => 'Ethereum address',
                'value' => $campaign->ethereum_address,
            ])
        </div>
        <div class="col-sm-4">
            <div class="card mb-3">
                <div class="card-header">
                    Main featured image
                </div>
                <div class="card-body">
                    <img id="featured-image" src="{{ optional($campaign->featured_image)->thumbnail_url }}" class="w-100 mb-3"
                        @if(!$campaign->featured_image_id) style="display: none;" @endif
                    />
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="featured-image" class="custom-file-input" id="image-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Here we add input to our form indicating with wich status campaign should be saved, based on button clicked--}}
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

    @yield('additional-controls')

</form>
