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

    @include('components.form.input-extended', [
        'label' => 'Campaign Name',
        'attributes' => [
            'placeholder' => 'Name',
            'name' => 'Name',
            'required' => true,
            'autofocus' => true
        ],
    ])

    @include('components.form.input-extended', [
        'attributes' => [
            'name' => 'Target audience',
            'placeholder' => 'For whom is the campaign important',
            'required' => true,
        ]
    ])

    @include('components.form.textarea-extended', [
        'label' => 'Short description',
        'attributes' => [
            'name' => 'Details',
            'required' => true,
        ],
    ])

    <button type="submit" class="btn btn-secondary">
        Continue
    </button>

    @yield('additional-controls')
</form>
