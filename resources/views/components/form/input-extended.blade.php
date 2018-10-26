{{-- Gives easier way to override attributes--}}
{{--TODO: Should replace old input.blade.php, not updating yet to make sure dependant code is safe--}}

@php
    //Dest attributes
    $dest = [];
    $name = snake_case($attributes['name']);
    $dest['id'] = $name;
    $dest['type'] = 'text';
    $dest['class'] = '';

    //Merge arrays, override attributes with passed attributes.
    $dest = array_merge($dest, $attributes);

    //Additional processing to attributes
    $dest['class'] .= ' form-control' . ($errors->has($name) ? ' is-invalid' : '');
    //If multiple option provided, Append array braces to support php arrays
    $dest['name'] = $name . (array_get($attributes, 'multiple') ? '[]' : '');
    $dest['value'] = array_get($attributes, 'value') ?? old($name);

    // Appearance stuff
    $label = (isset($label) ? $label : null) ?? $attributes['name'];

@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ __($label) }}</label>

    <input
    @foreach($dest as $attrName => $attrValue)
        {{$attrName}}="{{$attrValue}}"
    @endforeach
    />

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first(snake_case($name)) }}</strong>
        </span>
    @endif
</div>
