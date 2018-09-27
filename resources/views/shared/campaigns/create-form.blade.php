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
        'value' => 'Featured images test' . \Carbon\Carbon::now(),
    ])

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true,
        'value' => 'Featured images test asdasdasdsadasdasdasdasdsadsad' . \Carbon\Carbon::now(),
    ])

    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Image',
    ])

    @include('components.form.input', [
        'name' => 'Video',
        'value' => 'https://www.youtube.com/watch?v=RSDqSjTO9fs' . \Carbon\Carbon::now(),
    ])

    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Images',
        'multiple' => true,
    ])

    {{-- Place for fields that will be determined --}}

    @include('components.form.input', [
        'name' => 'Ethereum address',
        'value' => '0x7614e80bE7E0C1e5aFce4E8e35627dEEc461d2bD',
    ])

    {{--Here we add input to our form indicating with wich status campaign should be saved, based on button clicked--}}
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

    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::DRAFT)}}')" type="button" class="btn btn-primary">
        Save as Draft
    </button>
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)}}')" type="button" class="btn btn-primary">
        Submit for review
    </button>
    @yield('additional-controls')
</form>
