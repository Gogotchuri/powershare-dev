<form method="post" action="{{$route}}" enctype="multipart/form-data">

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
        <img class="campaign-image" src="{{asset($campaign->featured_image->url)}}" />
    </div>
    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Image',
    ])

    @include('components.form.input', [
        'name' => 'Video'
    ])

    <span>Having ({{ $campaign->images === null ? 0 : count($campaign->images) }})</span>
    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Images',
        'multiple' => true
    ])

    {{-- TODO: make this multi selection 1 to 20 --}}
    {{--@include('components.form.select', [
        'name' => 'Image',s
        //'required' => true,
        'options' => [],
        'title' => 'name',
    ])--}}

    <button type="submit" class="btn btn-primary">
        Submit
    </button>

    @yield('additional-controls')
    {{-- TODO: Add remaining fields --}}

</form>
