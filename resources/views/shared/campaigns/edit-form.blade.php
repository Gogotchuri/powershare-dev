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

    <div>
        <img class="campaign-image" src="{{asset($campaign->featured_image_url)}}"/>
    </div>
        @include('components.form.image-upload', [
                'multiple' => false,
                'config' => [
                    /*'url' => route('admin.campaigns.images.upload', ['id' => $campaign->id]),*/
                    'url' => route('admin.campaigns.images.upload-main', ['id' => $campaign->id]),
                    'paramName' => 'featured_image',
                ],
                'data' => [
                    'campaignId' => $campaign->id,
                ],
            ])

    @include('components.form.input', [
        'name' => 'Video',
        'value' => $campaign->video_url,
    ])

        {{--<span>Having ({{ $campaign->images === null ? 0 : count($campaign->images) }})</span>
        @include('components.form.input', [
            'type' => 'file',
            'name' => 'Featured Images',
            'multiple' => true
        ])--}}
        <br/>
    <h5>Featured images</h5>
        @include('components.form.image-upload', [
            'multiple' => true,
            'config' => [
                /*'url' => route('admin.campaigns.images.upload', ['id' => $campaign->id]),*/
                'url' => route('admin.campaigns.images.upload', ['id' => $campaign->id]),
                'paramName' => 'featured_images[]',
            ],
            'data' => [
                'campaignId' => $campaign->id,
            ],
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
