@foreach($values as $checkboxValue => $label)
    <div class="checkbox @if($inline) checkbox-inline @endif">
        <span class="radio-checkbox">

            <input
                type="radio"
                name="{{ $name }}"
                id="{{ $name }}{{ $checkboxValue }}"
                value="{{ $checkboxValue }}"
                @if($value !== null && $value == $checkboxValue)
                    checked
                @endif
            >

            <label for="{{ $name }}{{ $checkboxValue }}" style="padding-left: 5px; font-size: 18px;" >
                {{ $label }}
            </label>

        </span>
    </div>
@endforeach

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif
