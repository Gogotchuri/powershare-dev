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
                'label' => 'Name of Initiator',
                'attributes' => [
                    'name' => 'Initiator',
                    'value' => $campaign->initiator,
                    'required' => true
                ]
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
                            <img id="featured-image" src="{{ optional($campaign->featured_image)->thumbnail_url }}"
                                 class="w-100 mb-3"
                                 @if(!$campaign->featured_image_id) style="display: none;" @endif
                            />
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="featured-image" class="custom-file-input" id="image-input"
                                           aria-describedby="inputGroupFileAddon01">
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
                'label' => 'Why is this campaign important (max. 3000 characters)',
                'attributes' => [
                    'name' => 'Importance',
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
                'label' => 'Video',
                'attributes' => [
                    'name' => 'video_url',
                    'value' => $campaign->video_url,
                    'placeholder' => 'Paste Youtube video link here'
               ]
            ])

            <div class="card mb-3">
                <div class="card-header">
                    Team members
                </div>
                <div class="card-body">
                    <div id="memberContainer" class="row">
                        <div id="memberTempalte" class="col-sm-4 member-column">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Member Name
                                </div>
                                <div class="card-body">
                                    <img class="member-image img-thumbnail mb-3" src="#"
                                         class="w-100 mb-3"
                                    />
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger member-button-delete">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <dir class="col-md-4">
                            <div class="card mb-3" id="newMemberInputCard">
                                <div class="card-header">
                                    Add new member
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- Please not inputs inside this card also belong to campaignForm,
                                                so be careful to not override input names --}}
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    Image
                                                </div>
                                                <div class="card-body">
                                                    <img id="member-image-preview" src="" class="w-100 mb-3"/>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input autofocus type="file" class="custom-file-input"
                                                                   id="member-image-input"
                                                                   aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="member-name-input" class="form-control mb-3" type="text" placeholder="Name">
                                        </div>
                                    </div>
                                    {{--Loading css--}}
                                    <div id="newMemberLoading" class="loader mt-4"></div>
                                    <button id="addNewMemberButton" type="button" class="btn btn-primary w-100 member-button-store">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </dir>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Here we add input to our form indicating with wich status campaign should be saved, based on button clicked--}}
    @push('scripts-stack')
        <script>
            function readURL(input, target) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        target.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function () {
                readURL(this, $("#featured-image").show());
            });

            $("#member-image-input").on('change keyup', function () {
                readURL(this, $("#member-image-preview").show());
            });

            //FIXME: Find better way to pass these variables to js
            var memberUrls = <?php echo json_encode([
                'index' => route($membersRoutePrefix . 'index', ['id' => $campaign->id]),
                'delete' => route($membersRoutePrefix . 'destroy', ['id' => 'ID_PLACEHOLDER']),
                'store' => route($membersRoutePrefix . 'store', ['campaignId' => $campaign->id]),
            ]) ?>;
        </script>
    @endpush

    @yield('additional-controls')

</form>
