@extends('shared.settings.form-layout')

@section('name')
    Notifications
@endsection

@section('form')
    <form method="post" action="{{$update_route}}">
        @csrf

        <div class="form-group">
            Receive notifications
            <label class="switch">
                <input @if(Auth::user()->settings->receive_notifications) checked @endif type="checkbox" value="Yes" name="receive_notifications" class="primary">
                <span class="slider round"></span>
            </label>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@overwrite
