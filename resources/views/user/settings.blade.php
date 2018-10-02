@extends('user.main')

@section('header', 'Change Password')

@section('body')
    @include('shared.settings.password-form', [
        'update_route' => route('user.settings.updatePassword')
    ])
@endsection

@section('other')
    <div class="card">
        <div class="card-header">
            Notifications
        </div>

        <div class="card-body">
            @include('shared.settings.notifications-form', [
                'update_route' => route('user.settings.updateNotifications')
            ])
        </div>
    </div>
@endsection
