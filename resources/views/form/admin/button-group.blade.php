
<div class="input-group">
    <div id="{{ $name }}-btns"
         class="btn-group radioBtn {{$button_class}}"
    >

        @foreach($values as $key => $option)

            <a class="btn {{($value == $key) ? 'btn-primary active' : 'btn-default not-active'}}"
               data-toggle="{{ $toggle }}"
               data-value="{{$key}}"
               data-title="{{$option}}">
                {!! $option !!}
            </a>
        @endforeach

    </div>
    <input type="hidden" name="{{ $name }}" id="{{ $toggle }}" value="{{ $value }}">
</div>
