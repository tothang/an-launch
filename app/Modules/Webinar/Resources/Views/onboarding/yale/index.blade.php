@extends('layouts.app')
@section('body-class', 'onboarding')
@section('content')
  <div class="container yale">
    <div class="owl-carousel owl-theme owl__full-screen text-center">
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/yale/onboarding/welcome@2x.png') }}" alt="System-test">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.yale.welcome_title') }}</h1>
          {{ __('on-boarding.yale.welcome') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/yale/onboarding/browser.png') }}" alt="Browsers">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.yale.browsers_title') }}</h1>
          {{ __('on-boarding.yale.browsers') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/yale/onboarding/javascript.png') }}" alt="Javascript">
        </div>
        <div class="owl__text js-system-test-text">
          {{ __('on-boarding.yale.javascript') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/yale/onboarding/javascript.png') }}" alt="Javascript">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.yale.enable_js_title') }}</h1>
          {!! __('on-boarding.yale.enable_js') !!}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="owl__img">
          <img class="img-fluid" src="{{ asset('img/yale/onboarding/vpn.png') }}" alt="Vpn">
        </div>
        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.yale.enable_js_title') }}</h1>
          {{ __('on-boarding.yale.vpn') }}
        </div>
      </div>
      <div class="item-wrapper">
        <div class="video-bg">
          <iframe src='https://player.vimeo.com/video/1084537' frameborder='0' webkitAllowFullScreen mozallowfullscreen
            allowFullScreen></iframe>
        </div>

        <div class="owl__text js-system-test-text">
          <h1>{{ __('on-boarding.yale.video_title') }}</h1>
          {{ __('on-boarding.yale.video') }}
        </div>
      </div>
    </div>
    <div class="text-center">
      <p>
      <form action="javascript:void(0)">
        <button
          class="btn btn-next btn-primary owl__btn js-system-test-continue">{{ __('on-boarding.yale.next') }}</button>
      </form>

      <form action="{{ route('onboarding.update') }}" method="POST">
        @csrf
        <button class="btn btn-trigger-got-it btn-primary owl__btn">{{ __('on-boarding.yale.got_it') }}</button>
      </form>
      </p>
    </div>
  @endsection
