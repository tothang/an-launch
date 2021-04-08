@foreach($values as $checkboxValue => $label)

    <div class="checkbox @if($inline) checkbox-inline @endif">
        <span class="button-checkbox">
            <button
                    type="button"
                    class="btn @if($value == $checkboxValue) active @endif"
                    data-color="default">
                <?php echo $label; ?>
            </button>
            <input
                    type="checkbox"
                    class="hidden"
                    name="{{ $name }}"
                    id="{{ $name }}"
                    value="{{ $checkboxValue}}"
                    @if($value == $checkboxValue) checked @endif>
            </span>

    </div>
@endforeach

@if($hasErrors)
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
@endif