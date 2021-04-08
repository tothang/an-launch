<select
    class="form-control {{$classes}}"
    name="{{$name}}"
    id="{{isset($id) ? $id : $name}}"
    @if($helpBlock)aria-describedby="helpBlock{{$name}}" @endif
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
            @if($value !== null && collect($value)->contains($option_value))
                selected="selected"
            @endif
        >
            {{$option_title}}
        </option>
    @endforeach
</select>

@if($disabled)
    <input type="hidden" name="{{ $name  }}" value="{{ $value  }}">
@endif

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif
