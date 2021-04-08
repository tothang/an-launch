@extends('layouts.app')

@section('body-class', 'register-page')

@section('title', 'Declined Invitation')

@section('content')
  <form id="unableToAttendForm" method="POST" action="{{ route('registration.postDeclineInvitation') }}">
    @csrf

    <h3 class='cant-make-it' style="font-size: {{ $cantMakeFontsize }}px;">
      {{ __("register.decline_form.{$brand}.cant_make_it", [], $locale) }}
    </h3>

    @if (isHyster())
      <div class="line"></div>
    @endif

    <div class="decline-form-container">
      <h4>
        {{ __("register.decline_form.{$brand}.reason_for_decline", [], $locale) }}
      </h4>

      <div class="form-group">
        <textarea rows="10" class="form-control" required name="declined_reason" id="declinedReason"
          placeholder="{{ __("register.decline_form.{$brand}.cannot_attend_because", [], $locale) }}"></textarea>
      </div>

      <div class="form-group text-left">
        <button name="submit" type="submit" class="btn btn-primary decline-btn">
          {{ __("register.decline_form.{$brand}.submit", [], $locale) }}
        </button>
      </div>
    </div>

    <div class="decline-success-container">
      <div class="form-group text-left decline-success-message">
        {{ __("register.decline_form.{$brand}.decline_success_message", [], $locale) }}
      </div>

      <div class="form-group text-left">
        <a class="btn btn-primary btn-home" href="{{ route('welcome') }}">
          {{ __("register.decline_form.{$brand}.return_to_home_page", [], $locale) }}
        </a>
      </div>
    </div>
  </form>
@endsection

@push('js')
  <script>
    $('#unableToAttendForm').submit(function(e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "{{ route('registration.postDeclineInvitation') }}",
        data: $('#unableToAttendForm').serialize(),
        success: function(response) {
          if (response.success) {
            $('.decline-success-container').show();
            $('.decline-form-container').hide();
          }
        },
        error: function() {
          console.log('Error');
        }
      });

      return false;
    });

  </script>
@endpush
