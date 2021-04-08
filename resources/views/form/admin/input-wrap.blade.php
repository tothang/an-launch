<div class="form-group @if($hasErrors) has-error @elseif($hasSuccess) has-success @endif {{$groupClasses}}">

    <label
            for="{{ $name }}"
            class="{{$horizontal ? 'col-sm-' . $labelWidth . ' control-label' : '' }}
            {{!$label ?' sr-only':''}}
            {{$required ? ' required' : ''}}"
    >
        {{ $label }}
    </label>

    @if ($horizontal)
        <div class="{{ !$label ? 'col-sm-offset-' . $labelWidth . ' ': ''}} col-sm-{{$inputWidth}}">
            @endif

            @include('form.admin.'.$type)


            @if($helpBlock)
                <span id="helpBlock{{ $name }}" class="help-block">{{ $helpBlock }}</span>
            @endif

            @if ($horizontal)
        </div>
    @endif
</div>
