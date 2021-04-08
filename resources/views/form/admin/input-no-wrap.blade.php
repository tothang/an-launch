<label
        for="{{ $name }}"
        class="{{$horizontal ? 'col-sm-' . $labelWidth . ' control-label' : '' }}
        {{!$label ?' sr-only':''}}
        {{$required ? ' required' : ''}}"
>
    {{ $label }}
</label>

@include('form.admin.'.$type)


@if($helpBlock)
    <span id="helpBlock{{ $name }}" class="help-block">{{ $helpBlock }}</span>
@endif
