@if($center)
  <div class="text-center">
    @endif
    @unless(isset($inline))
      <div class="form-group">
        @endunless
        @if ($horizontal)
          <div class="col-sm-offset-{{ $labelWidth }} col-sm-{{ $inputWidth }}">
            @endif
            <button name="{{ $name }}" type="submit" class="btn btn-primary">
              {{ $value }}
            </button>
            @if ($horizontal)
          </div>
        @endif
        @unless(isset($inline))
      </div>
    @endunless
    @if($center)
  </div>
@endif
