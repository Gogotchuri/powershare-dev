@extends('layouts.app')

@section('content')
    <form method="post" action="">

        @csrf

        @include('components.form.textarea', [
            'name' => 'Details',
            'required' => true
        ])

        {{-- Featured image input here --}}

        @include('components.form.input', [
            'name' => 'Video'
        ])

        {{-- TODO: make this multi selection 1 to 20 --}}
        @include('components.form.select', [
            'name' => 'Image',
            'required' => true,
            'options' => $images,
            'title' => 'name',
        ])

        {{-- TODO: Add remaining fields --}}

    </form>
@endsection
