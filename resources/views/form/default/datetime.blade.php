<div class="form-group">
    {{ Form::label($name, $label) }}

    <div class='input-group date datetimepicker_{{$name}}'>
        <input
                type='text'
                class="form-control"
                placeholder="{{$placeholder}}"
                value="{{$value}}"
                name="{{$name}}"
                @if (!is_null($maxLength)) maxlength="{{(int)$maxLength}}" @endif
                @if ($helpBlock) aria-describedby="helpBlock{{$name}}" @endif
                @if ($disabled) disabled @endif
        />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>

@push('js')
    <script>
      $(function () {
        $('.datetimepicker_{{$name}}').datetimepicker({
          format: 'YYYY-MM-DD @if ($time)HH:mm:ss @endif',
            @if ($defaultDate) defaultDate: "{{ $defaultDate }}", @endif
            @if ($minDate) minDate: '{{ $minDate }} 00:00', @endif
            @if ($maxDate) maxDate: '{{ $maxDate }} 00:00', @endif
            @if ($minDate) useCurrent: false, @endif
            sideBySide: true
        });

        $('.input-group-addon.{{ $name }}').on('click', function() {
          $('.datetimepicker-date.{{ $name }}').data("DateTimePicker").show();
        });
      });
    </script>
@endpush
