@extends('layouts.app')

@section('content')

    <form method="post" action="{{action('CampaignController@update', ['id' => $campaign->id])}}">

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


        @if($campaign->is_approved)
            <a class="btn btn-primary" href="{{action('CampaignController@unapprove', ['id' => $campaign->id])}}">
                Unapprove
            </a>
        @else
            <a class="btn btn-primary" href="{{action('CampaignController@approve', ['id' => $campaign->id])}}">
                Approve
            </a>
        @endif
        {{-- TODO: Add remaining fields --}}

    </form>
@endsection
