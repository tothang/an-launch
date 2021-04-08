@extends('layouts.app')
@section('body-class', 'onboarding')
@section('content')
  <div class="container {{ isHyster() ? 'hyster' : 'yale' }}">
    <div class="owl-carousel owl-theme owl__full-screen text-center">
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/hyster/onboarding/welcome.svg') }}" alt="System-test">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.hyster.welcome_title') }}</h1>
          {!! __('on-boarding.hyster.welcome') !!}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/hyster/onboarding/browser.png') }}" alt="Browsers">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.hyster.browsers_title') }}</h1>
          {{ __('on-boarding.hyster.browsers') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/hyster/onboarding/javascript.png') }}" alt="Javascript">
        </div>
        <div class="owl__text js-system-test-text">
          {{ __('on-boarding.hyster.javascript') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/hyster/onboarding/enablejs.png') }}" alt="Javascript">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.hyster.enable_js_title') }}</h1>
          {!! __('on-boarding.hyster.enable_js') !!}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid disable-mobile" src="{{ asset('img/hyster/onboarding/vpn.png') }}" alt="Vpn">
          <img class="img-fluid mobile" src="{{ asset('img/hyster/onboarding/vpn-mobile.png') }}" alt="Vpn">
        </div>
        <div class="owl__text js-system-test-text">
          {{ __('on-boarding.hyster.vpn') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="video-bg">
          <iframe src='https://player.vimeo.com/video/1084537' frameborder='0' webkitAllowFullScreen mozallowfullscreen
            allowFullScreen></iframe>
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.hyster.video_title') }}</h1>
          {{ __('on-boarding.hyster.video') }}
        </div>
      </div>
    </div>
    <div class="text-center">
      <p>
      <div class="btn-group-justified">
        <form action="javascript:void(0)">
          <button type="button"
            class="btn btn-next btn-primary owl__btn js-system-test-continue">{{ __('on-boarding.hyster.next') }}</button>
        </form>

        <form action="{{ route('onboarding.update') }}" method="POST">
          @csrf
          <button type="submit"
            class="btn btn-trigger-got-it btn-primary owl__btn">{{ __('on-boarding.hyster.got_it') }}
          </button>
        </form>

      </div>
      </p>
      <p class="mobile">
        <span>
          <a class="skip-link" href="{{ route('webinar') }}">{{ __('on-boarding.hyster.skip') }}</a>
        </span>
      </p>
    </div>
  @endsection
