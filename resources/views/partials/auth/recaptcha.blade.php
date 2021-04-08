<div class="recaptcha-container recaptcha-container-{{ $align ?? '' }} mb-2">
    @if ($errors->has('g-recaptcha-response'))
        <span class="help-block mb-2">
           <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
        </span>
    @endif
    {!! NoCaptcha::display() !!}
</div>

@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush
