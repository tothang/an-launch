@extends('layouts.app')

@section('title', __('confirmation-language.title'))
@section('body-class', 'confirmation-language')
@section('content')
  <div class="{{ isHyster() ? 'confirmation-language-hyster' : 'confirmation-language-yale' }}">
    <div class="container">
      <div class="row">
        <form method="POST" action="{{ route('store-confirmation-language') }}">
          @csrf
          <div class="col-sm-10 col-lg-6 col-xs-12 center-block">
            <div class="content">
              <h1 class="title title-desktop">
                {{ ucfirst(strtolower(__('confirmation-language.title'))) }}
              </h1>
              <h1 class="title title-mobile">
                {{ __('confirmation-language.title') }}
              </h1>

              @if (isHyster())
                <div class="line"></div>
              @endif

              <p class="current-language">
                {{ __('confirmation-language.your_current_language') }}
              </p>
              <div class="form-group">
                <select required type="text" class="form-control" name="language">
                  @foreach ($language as $key => $item)
                    @if ($key == auth()->user()->language)
                      <option selected value="{{ $key }}">{{ $item }}</option>
                    @else
                      <option value="{{ $key }}">{{ $item }}</option>
                    @endif
                  @endforeach
                </select>
              </div>

              <button type="submit"
                class="disable-mobile custom-btn btn btn-primary">{{ ucfirst(strtolower(__('confirmation-language.confirm'))) }}</button>

            </div>
          </div>
          <div class="mobile gr-btn-mobile">
            <button type="submit" class="custom-btn btn btn-primary">
              {{ strtoupper(__('confirmation-language.confirm')) }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
  //$('select').selectpicker();
</script>

@endpush
