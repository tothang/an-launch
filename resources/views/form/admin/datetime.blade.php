<div class="form-group">
    {{ Form::label($name, $label) }}
    <div class="row">
        <div class="col-12">
            <input type="datetime-local"
                   class="{{ $classes }} form-control"
                   id="{{ $name }}"
                   name="{{ $name }}"
                   value="{{ $value }}"
                   min="{{ $minDate }}"
                   max="{{ $maxDate }}"
                   @if ($helpBlock) aria-describedby="helpBlock{{$name}}" @endif
                   @if ($disabled) disabled @endif
                   @if ($required) required @endif
            >
        </div>
    </div>

    @if($hasErrors)
        {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
    @endif
</div>
