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

    <div class="form-group">
        <label for="image">Featured image</label>
        <input type="file" class="form-control-file" name="image">
        @if ($errors->has('image'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
        @endif
    </div>

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
