<div class="form-group">
    <label for="{{ snake_case($name) }}">{{ __($name) }}</label>

    <textarea
        id="{{ snake_case($name) }}"
        type="{{ isset($type) ? $type : 'text' }}"
        class="form-control{{ $errors->has(snake_case($name)) ? ' is-invalid' : '' }}"
        name="{{ snake_case($name) }}"
        rows="{{ isset($rows) ? $rows : 5 }}"
        {{ isset($required) ? 'required' : '' }}
        autofocus>{{ isset($value) ? $value : old(snake_case($name)) }}</textarea>

    @if ($errors->has(snake_case($name)))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first(snake_case($name)) }}</strong>
        </span>
    @endif
</div>