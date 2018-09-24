<form method="post" action="{{$route}}" enctype="multipart/form-data">

    @csrf

    @include('components.form.input', [
        'name' => 'Name',
        'required' => true
    ])

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true
    ])

    @include('components.form.input', [
        'type' => 'file',
        'name' => 'Featured Image',
    ])

    @include('components.form.input', [
        'name' => 'Video'
    ])

    {{-- TODO: make this multi selection 1 to 20 --}}
    {{--@include('components.form.select', [
        'name' => 'Image',
        //'required' => true,
        'options' => [],
        'title' => 'name',
    ])--}}

    <button type="submit" class="btn btn-primary">
        Submit
    </button>

    {{-- TODO: Add remaining fields --}}

</form>
