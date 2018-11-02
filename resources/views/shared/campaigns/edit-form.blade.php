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
        <div class="col-sm-12">
            @include('components.form.input-extended', [
                'label' => 'Campaign Name',
                'attributes' => [
                    'placeholder' => 'Name',
                    'name' => 'Name',
                    'required' => true,
                    'value' => $campaign->name,
                    'autofocus' => true
                ],
            ])

            @include('components.form.input-extended', [
                'label' => 'For whom is the campaign important',
                'attributes' => [
                    'name' => 'Target audience',
                    'value' => $campaign->target_audience,
                    'required' => true
                ]
            ])

            @include('components.form.select', [
                'name' => 'Category',
                'options' => $categories,
                'title' => 'name',
                'required' => true,
                'value' => $campaign->category_id,
            ])

            @include('components.form.input-extended', [
                'attributes' => [
                    'name' => 'Required funding',
                    'value' => $campaign->required_funding,
                    'type' => 'number',
                    'placeholder' => 'Required amount of funds (USD)',
                    'required' => true
                ]
            ])

            @include('components.form.textarea-extended', [
                'label' => 'Short description (max. 1000 characters)',
                'attributes' => [
                    'name' => 'Details',
                    'required' => true,
                    'value' => $campaign->details,
                    'maxlength' => '1000'
                ],
            ])

            <div class="row">
                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            Cover photo
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

            @include('components.form.input-extended', [
                'attributes' => [
                    'name' => 'Ethereum address',
                    'value' => $campaign->ethereum_address,
                    'placeholder' => 'ETH Wallet Address',
                ]
            ])

            @include('components.form.textarea-extended', [
                'label' => '(max. 3000 characters)',
                'attributes' => [
                    'placeholder' => 'Why is the campaign important',
                    'name' => 'Importance',
                    'required' => true,
                    'value' => $campaign->importance,
                    'maxlength' => '3000'
                ]
            ])

            <div class="card mb-3">
                <div class="card-header">
                    Image gallery
                </div>
                <div class="card-body">
                    @include('components.dropzone', [
                        'images' => $campaign->images,
                        'url' => route('images.campaigns', $campaign->id)
                    ])
                </div>
            </div>

            @include('components.form.input-extended', [
                'attributes' => [
                    'name' => 'Video',
                    'value' => $campaign->video_url,
                    'placeholder' => 'Paste Youtube video link here'
               ]
            ])

            <div class="card mb-3">
                <div class="card-header">
                    Team members
                    <div class="btn-group float-right">
                        <a href="{{route($membersRoutePrefix . 'create', ['campaignId' => $campaign->id])}}" class="btn btn-success">Add
                            new</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($campaign->members as $member)
                            <div class="col-sm-4">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{$member->name}}
                                    </div>
                                    <div class="card-body">
                                        <img id="featured-image" src="{{ $member->image_url }}" class="w-100 mb-3"
                                             @if(!$member->image_url) style="display: none;" @endif
                                        />
                                        <div class="btn-group">
                                            <a href="{{route($membersRoutePrefix . 'edit', ['id' => $member->id])}}"
                                               class="btn btn-primary">Edit</a>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" onclick="removeTeamMember('{{route($membersRoutePrefix . 'destroy', ['id' => $member->id])}}')" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

            function removeTeamMember(url) {
                $('<form method="post" action="'+ url +'"> @method("DELETE") @csrf <form>').appendTo('body').submit();
            }
        </script>
    @endpush

    @yield('additional-controls')

</form>
