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

    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Image',
    ])

    @include('components.form.input', [
        'name' => 'Video',
    ])

    {{--@include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Images',
        'multiple' => true,
    ])--}}

    <input type="file" id="fileupload" name="featured_images[]" data-url="/upload" multiple/>
    <div id="files_list"></div>
    <p id="loading"></p>
    <input type="hidden" name="file_ids" id="file_ids" value=""/>

    {{-- Place for fields that will be determined --}}

    @include('components.form.input', [
        'name' => 'Ethereum address',
    ])

    {{--Here we add input to our form indicating with wich status campaign should be saved, based on button clicked--}}
    @push('scripts-stack')
        <script>
            alert(window.a);

            function onClick(statusName) {

                var form = $('#campaignCreateForm');
                var input = $('<input />').attr('type', 'hidden')
                    .attr('name', "status")
                    .attr('value', statusName);

                form.append(input).submit();
            }
        </script>
    @endpush

    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::DRAFT)}}')" type="button"
            class="btn btn-primary">
        Save as Draft
    </button>
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)}}')" type="button"
            class="btn btn-primary">
        Submit for review
    </button>
    @yield('additional-controls')
</form>

@push('scripts-stack')

@endpush
