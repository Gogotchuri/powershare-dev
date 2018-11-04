<form id="campaignCreateForm" method="post" action="{{$route}}" enctype="multipart/form-data">

    <div class="text-center">
        <img src="/img/logo-gradient.png" alt="" class="campaign-form-logo w-50 mb-5">
    </div>

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
        'label' => 'For whom is the campaign important',
        'attributes' => [
            'name' => 'Target audience',
            'required' => true,
        ]
    ])

    @include('components.form.textarea-extended', [
        'label' => 'Short description (max. 1000 characters)',
        'attributes' => [
            'name' => 'Details',
            'required' => true,
            'maxlength' => '1000'
        ],
    ])

    <button type="submit" class="btn btn-secondary">
        Continue
    </button>

    @yield('additional-controls')
</form>
