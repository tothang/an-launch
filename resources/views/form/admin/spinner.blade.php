<div class="input-group num-input">
    <span class="input-group-btn">
        <button
                type="button"
                class="btn btn-default {{$name}}-decrease"
                data-value="decrease"
                data-target="#{{$name}}"
                data-toggle="spinner"
        >
            <span class="glyphicon glyphicon-minus"></span>
        </button>
     </span>

    <input
            type="text"
            data-ride="spinner"
            id="{{$name}}"
            name="{{$name}}"
            class="form-control input-number"
            value="{{$value}}"
            @if ($helpBlock)aria-describedby="helpBlock {{$name}}" @endif
            @if ($disabled) readonly @endif
            @if ($required)required @endif
    />
    <span class=" input-group-btn">
        <button
                type="button"
                class="btn btn-default {{$name}}-increase"
                data-value="increase"
                data-target="#{{$name}}"
                data-toggle="spinner"
        >
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </span>
</div>