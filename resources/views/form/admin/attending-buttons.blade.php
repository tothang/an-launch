@php
    $attendingValues = [true => 'Yes', false => 'No', "" => 'Not yet specified']
@endphp

<div class="input-group">
    <label for="attending">Attending Status</label>
    <br>
    <div id="attending-btns" class="btn-group radioBtn">
        @foreach($attendingValues as $key => $option)
            <a class="btn
            @if($registration->attending === null && $key === "")
                btn-primary active
            @elseif($registration->attending && $key === 1)
                btn-primary active
            @elseif(($registration->attending === 0 || (!$registration->attending && $registration->attending !== null)) && $key === 0)
                btn-primary active
            @else
                btn-default not-active
            @endif
                "
               data-toggle="attending"
               data-value="{{$key}}"
               data-title="{{$option}}">
                {!! $option !!}
            </a>
        @endforeach
    </div>
    <input type="hidden" name="attending" id="attending" value="{{ $registration->attending }}">
</div>
