<input
        type="{{$inputType}}"
        class="form-control"
        placeholder="{{$placeholder}}"
        id="{{$name}}"
        name="{{$name}}"
        value="{{$value}}"
        @if(!is_null($maxLength)) maxlength="{{(int)$maxLength}}" @endif
        @if ($helpBlock) aria-describedby="helpBlock{{$name}}" @endif
        @if ($disabled) disabled @endif
        @if ($required) required @endif
        @if ($readonly) readonly @endif
/>

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif
