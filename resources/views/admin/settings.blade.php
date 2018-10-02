@extends('admin.main')

@section('header', 'Change Password')

@section('body')
    @include('shared.settings.password-form', [
        'update_route' => route('admin.settings.updatePassword')
    ])
@endsection

@section('other')
    <div class="card">
        <div class="card-header">
            Notifications
        </div>

        <div class="card-body">
            @include('shared.settings.notifications-form', [
                'update_route' => route('admin.settings.updateNotifications')
            ])
        </div>
    </div>
@endsection