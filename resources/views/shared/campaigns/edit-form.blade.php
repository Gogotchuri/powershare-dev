<form method="post" action="{{$route}}" enctype="multipart/form-data">

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
        <img class="campaign-image" src="{{asset($campaign->featured_image->url)}}"/>
    </div>
    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Image',
    ])

    @include('components.form.input', [
        'name' => 'Video',
        'value' => $campaign->video_url,
    ])

    <span>Having ({{ $campaign->images === null ? 0 : count($campaign->images) }})</span>
    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Images',
        'multiple' => true
    ])

    {{-- Place for fields that will be determined --}}

    @include('components.form.input', [
        'name' => 'Ethereum address',
        'value' => $campaign->ethereum_address,
    ])

        <button type="submit" class="btn btn-primary">Submit</button>
    {{-- Admin may want to save--}}
    {{--<button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::DRAFT)}}')" type="button" class="btn btn-primary">
        Save as Draft
    </button>
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)}}')" type="button" class="btn btn-primary">
        Submit for review
    </button>--}}

    @yield('additional-controls')

</form>
