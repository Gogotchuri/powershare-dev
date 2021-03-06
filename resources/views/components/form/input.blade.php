<div class="form-group">
    <label for="{{ snake_case($name) }}">{{ __($name) }}</label>

    <input
        id="{{ snake_case($name) }}"
        type="{{ isset($type) ? $type : 'text' }}asdsa"
        class="form-control{{ $errors->has(snake_case($name)) ? ' is-invalid' : '' }}"
        name="{{ snake_case($name) . (isset($multiple) && $multiple ? '[]' : '') }}"
        @unless( isset($multiple) && $multiple)
        value="{{ isset($value) ? $value : old(snake_case($name)) }}"
        @endunless
        {{ isset($required) && $required ? 'required' : '' }}
        {{ isset($checked) && $checked ? 'checked' : '' }}
        {{ isset($multiple) && $multiple ? 'multiple' : '' }}

        @if(isset($placeholder))
        placeholder="{{$placeholder}}"
        @endif

        autofocus
    />

    @if ($errors->has(snake_case($name)))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first(snake_case($name)) }}</strong>
        </span>
    @endif
</div>
