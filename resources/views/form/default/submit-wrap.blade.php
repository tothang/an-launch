<div class="form-group">

    @if($horizontal)<div class="col-sm-{{$labelWidth}}">@endif

    @if($previousTab)
        <button
            class="btn btn-default submit-back back-btn pull-right previous-{{$previousTab}}"
            href="#{{$previousTab}}"
            data-toggle="tab">
            <i class="fa fa-arrow-circle-o-left"></i>
            &nbsp;Back
        </button>
    @endif
    @if($horizontal)</div><div class="col-sm-{{$inputWidth}}">@endif
        <input type="hidden" name="{{$name}}" value="Submit"/>
        <button type="submit" class="btn btn-default btn-lg">
            {{ $value }}
        </button>
    @if($horizontal)</div>@endif

</div>
