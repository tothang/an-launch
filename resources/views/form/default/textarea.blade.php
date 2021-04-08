<textarea
    class="form-control"
    placeholder="{{ $placeholder}}"
    id="{{$name}}"
    name="{{$name}}"
    @if(!is_null($maxLength)) maxlength="{{(int)$maxLength}}" @endif
    @if ($helpBlock) aria-describedby="helpBlock-{{$name}}" @endif
    @if(!is_null($rows)) rows="{{ $rows }}" @endif
    @if ($disabled) disabled @endif
    @if ($required) required @endif
        >{{$value}}</textarea>
@if($hasErrors)
    <span class=" glyphicon glyphicon-remove form-control-feedback"></span>
@elseif($hasSuccess)
    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
@endif

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif
