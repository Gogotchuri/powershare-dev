@extends('shared.settings.form-layout')

@section('name')
    Change password
@endsection

@section('form')
    <form method="post" action="{{$update_route}}">

        {{-- TODO: Can ve use this: https://www.chromium.org/developers/design-documents/form-styles-that-chromium-understands
            To make chrome password update propt show right user after form submit success
        --}}

        @csrf

        @include('components.form.input', [
            'name' => 'Current Password',
            'type' => 'password',
        ])

        <hr/>

        @include('components.form.input', [
            'name' => 'Password',
            'type' => 'password',
        ])

        @include('components.form.input', [
            'name' => 'Password Confirmation',
            'type' => 'password',
        ])
        <br/>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@overwrite
