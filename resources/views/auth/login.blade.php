@extends('layouts.auth')

@section('title', isHyster() ? __('auth.hyster.login') : __('auth.login'))

@section('page-content')

  @if (isHyster())
    <div class="line"></div>
  @endif

  {!! Form::open([
      'route' => 'login',
      'action' => 'POST',
      'autocomplete' => 'off',
      'class' => 'auth__form'
  ]) !!}

  @csrf

  <div class="welcome-message">
     {{ __('auth.welcome_please_log_in_below') }}
  </div>

  {!! Form::email(
      'email',
      old('email'),
      [
          'required' => true,
          'placeholder' => __('auth.email')
      ]
  ) !!}

  @include('auth.partials.token-expired')

  @if($requiresPassword)
    {!! Form::password(
        'password',
        [
            'required' => true,
            'placeholder' => __('auth.password')
        ]
    ) !!}
  @endif

  @includeWhen(config('envx.recaptcha'), 'partials.auth.recaptcha')

  <a class="link forgot-password-mobile" href="{{ route('password.request') }}">
    {{  isHyster() ? __('auth.hyster.forgotten_your_password') : __('auth.forgotten_your_password') }}
  </a>

  @if ( Config::get('app.locale') === 'de')
    <button name="submit" type="submit" class="btn btn-primary btn-login">
      {{  isHyster() ? __('auth.hyster.login_button') : __('auth.login_button') }}
    </button>
  @else
    <button name="submit" type="submit" class="btn btn-primary btn-login">
      {{  isHyster() ? __('auth.hyster.login') : __('auth.login') }}
    </button>
  @endif


  <a class="link forgot-password-desktop" href="{{ route('password.request') }}">
    {{  isHyster() ? __('auth.hyster.forgotten_your_password') : __('auth.forgotten_your_password') }}
  </a>

  {!! Form::close() !!}
@endsection
