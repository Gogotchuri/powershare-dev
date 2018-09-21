@extends('layouts.app')

@section('content')

    <h2>Campaign</h2>

    <p>{{$campaign->details}}</p>

    <a class="btn btn-dark" href="{{route('admin.campaigns.edit', [$campaign->id])}}">Edit</a>
    <a class="btn btn-dark" href="{{route('admin.campaigns.create')}}">Create other one</a>

    {{--<form method="post" action="{{action('CampaignController@store')}}">

        @csrf

        @include('components.form.textarea', [
            'name' => 'Details',
            'required' => true
        ])

        @include('components.form.input', [
            'type' => 'image',
            'name' => 'Featured Image'
        ])

        @include('components.form.input', [
            'name' => 'Video'
        ])

        --}}{{-- TODO: make this multi selection 1 to 20 --}}{{--
        @include('components.form.select', [
            'name' => 'Image',
            //'required' => true,
            'options' => [],
            'title' => 'name',
        ])

        <button type="submit" class="btn btn-primary">
            Submit
        </button>--}}

        {{-- TODO: Add remaining fields --}}

    </form>
@endsection
