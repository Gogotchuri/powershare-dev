<form method="post" action="{{$update_route}}">

    <h3>Change password</h3>
    <hr/>
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
