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
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">
                    Main featured image
                </div>
                <div class="card-body">
                    @include('components.form.image-upload', [
                        'multiple' => false,
                        'config' => [
                            /*'url' => route('admin.campaigns.images.upload', ['id' => $campaign->id]),*/
                            'url' => $mainImageRoute,
                            'paramName' => 'featured_image',
                        ],
                        'data' => [
                            'campaignId' => $campaign->id,
                        ],
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    Additional featured images
                </div>
                <div class="card-body">
                    @include('components.form.image-upload', [
                        'multiple' => true,
                        'config' => [
                            /*'url' => route('admin.campaigns.images.upload', ['id' => $campaign->id]),*/
                            'url' => $imagesRoute,
                            'paramName' => 'featured_images[]',
                        ],
                        'data' => [
                            'campaignId' => $campaign->id,
                        ],
                    ])
                </div>
            </div>
        </div>
    </div>
    @include('components.form.input', [
        'name' => 'Video',
        'value' => $campaign->video_url,
    ])

    {{-- Place for fields that will be determined --}}

    @include('components.form.input', [
        'name' => 'Ethereum address',
        'value' => $campaign->ethereum_address,
    ])

    {{--Here we add input to our form indicating with wich status campaign should be saved, based on button clicked--}}
    @push('scripts-stack')

        <script>
            var campaignId = {!! $campaign->id !!};
            var uploadRoute = "{!! route('admin.campaigns.images.upload', ['id' => $campaign->id]) !!}";
        </script>
        <script>
            function onClick(statusName) {

                var form = $('#campaignEditForm');
                var input = $('<input />').attr('type', 'hidden')
                    .attr('name', "status")
                    .attr('value', statusName);

                form.append(input).submit();
            }
        </script>
    @endpush

    @yield('additional-controls')

</form>
