@extends('admin.main')

@section('header', 'Settings')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('admin.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.settings.password-form', [
        'update_route' => route('admin.settings.updatePassword')
    ])
    <br/><br/><br/>
    @include('shared.settings.notifications-form', [
        'update_route' => route('admin.settings.updateNotifications')
    ])
@endsection
