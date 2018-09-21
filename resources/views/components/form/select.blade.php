<div class="form-group">
    <label for="{{ snake_case($name) }}">{{ __($name) }}</label>

    <select
        id="{{ snake_case($name) }}"
        class="form-control{{ $errors->has(snake_case($name)) ? ' is-invalid' : '' }}"
        name="{{ snake_case($name) }}"
        {{ isset($required) ? 'required' : '' }}
        autofocus>
        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ isset($value) && $value === $option->id ? 'selected' : '' }}>
                {{ $option->$title }}
            </option>
        @endforeach
    </select>

    @if ($errors->has(snake_case($name)))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first(snake_case($name)) }}</strong>
        </span>
    @endif
</div>