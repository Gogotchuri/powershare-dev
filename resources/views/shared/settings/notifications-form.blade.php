<form method="post" action="{{$update_route}}" class="col-sm-6">
    @csrf

    <div class="form-group mb-5">
        Receive notifications
        <label class="switch">
            <input @if(Auth::user()->settings->receive_notifications) checked @endif type="checkbox" value="Yes" name="receive_notifications" class="primary">
            <span class="slider round"></span>
        </label>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
