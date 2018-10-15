<form id="campaignCreateForm" method="post" action="{{$route}}" enctype="multipart/form-data">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf

    @include('components.form.input', [
        'name' => 'Name',
        'required' => true,
    ])

    @include('components.form.input', [
        'name' => 'Target audience',
    ])

    @include('components.form.textarea', [
        'name' => 'Details',
        'required' => true,
    ])

    <button type="submit" class="btn btn-secondary">
        Continue
    </button>

    @yield('additional-controls')
</form>
