<select
    class="form-control {{ $classes }} {{ $multiple ? 'select2' : null }}"
    name="{{ $name . ($multiple ? '[]' : null) }}"
    id="{{ $id ?? $name }}"
    @if($helpBlock)aria-describedby="helpBlock{{ $name }}" @endif
    @if($disabled) disabled @endif
    @if($required) required @endif
    @if($readonly) readonly @endif
    @if($multiple) multiple @endif
    @if($searchable) data-live-search="true" @endif
>
    @if($placeholder)
        <option selected disabled>{{ $placeholder }}</option>
    @endif

    @foreach ($values as $option_value => $option_title)
        <option
            value="{{$option_value}}"
            @if($multiple)
                @if($value !== null && collect($value)->contains($option_value))
                    selected="selected"
                @endif
            @endif
            @if ($option_value === $value)
                selected="selected"
            @endif
        >
            {{ ucfirst($option_title)}}
        </option>
    @endforeach
</select>

@if($disabled)
    <input type="hidden" name="{{ $name  }}" value="{{ $value  }}">
@endif

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif
