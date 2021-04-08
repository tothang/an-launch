<div class="checkbox @if($inline) checkbox-inline @endif">
  @foreach($values as $checkboxValue => $label)
    <span class="button-checkbox">
            <button
              type="button"
              class="btn @if($value == $checkboxValue) active @endif"
              data-color="default">
                {{ $label }}
            </button>
            <input
              type="checkbox"
              class="hidden"
              name="{{ $name }}"
              id="{{ $name }}"
              value="{{ $checkboxValue}}"
              @if (is_array($value))
              @if(collect($value)->contains($checkboxValue)) checked @endif
              @else
              @if($value == $checkboxValue) checked @endif
              @endif
            >
            </span>
  @endforeach
</div>


