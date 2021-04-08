<div class="form-group @if($hasErrors) has-error @elseif($hasSuccess) has-success @endif {{$groupClasses}}">

    <label
            for="{{ $name }}"
            class="{{$horizontal ? 'col-sm-' . $labelWidth . ' control-label' : '' }}
            {{!$label ?' sr-only':''}}
            {{$required ? ' required' : ''}}"
    >
        {{ $label }} {!! $required ? '<span class="required-asterix" >*</span>' : '' !!}
    </label>

    @if ($horizontal)
        <div class="{{ !$label ? 'col-sm-offset-' . $labelWidth . ' ': ''}} col-sm-{{$inputWidth}}">
            @endif

            @include('form.default.'.$type)


            @if($helpBlock)
                <span id="helpBlock{{ $name }}" class="help-block">{{ $helpBlock }}</span>
            @endif

            @if ($horizontal)
        </div>
    @endif
</div>
