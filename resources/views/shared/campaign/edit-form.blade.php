<form method="post" action="{{$route}}">

    {{method_field('PUT')}}

    @csrf

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true,
        'value' => $campaign->details,
    ])

    @include('components.form.input', [
        'type' => 'image',
        'name' => 'Featured Image'
    ])

    @include('components.form.input', [
        'name' => 'Video'
    ])

    {{-- TODO: make this multi selection 1 to 20 --}}
    @include('components.form.select', [
        'name' => 'Image',
        //'required' => true,
        'options' => [],
        'title' => 'name',
    ])

    <button type="submit" class="btn btn-primary">
        Submit
    </button>

    @yield('additional-controls')
    {{-- TODO: Add remaining fields --}}

</form>