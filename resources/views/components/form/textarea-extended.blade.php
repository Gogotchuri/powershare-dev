@php
    //Dest attributes
    $dest = [];
    $name = snake_case($attributes['name']);
    $value = array_get($attributes, 'value') ?? old($name);
    $dest['id'] = $name;
    $dest['class'] = '';

    //Merge arrays, override attributes with passed attributes.
    $dest = array_merge($dest, $attributes);

    //Additional processing to attributes
    $dest['class'] .= ' form-control' . ($errors->has($name) ? ' is-invalid' : '');
    //If multiple option provided, Append array braces to support php arrays
    $dest['name'] = $name . (array_get($attributes, 'multiple') ? '[]' : '');
    $dest['rows'] = array_get($attributes, 'rows') ?? 5;

    // Appearance stuff
    $label = (isset($label) ? $label : null) ?? $attributes['name'];
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ __($label) }}</label>

    <textarea
    @foreach($dest as $attrName => $attrValue)
        {{$attrName}}="{{$attrValue}}"
    @endforeach >{!! $value !!}</textarea>

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first(snake_case($name)) }}</strong>
        </span>
    @endif
</div>

