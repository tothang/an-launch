@extends('layouts.app')

@section('body-class', 'register-page')

@section('title', 'Registration')

@section('content')
  {!! Form::open(
      [
          'route' => ['registration.update', $registration],
          'action' => 'POST',
      ]
  ) !!}

  @csrf

  @include('registration::partials.fields')

  <div class='register-description'>
    <label class="container">
      {!! __('register.description') !!}
      <input name='agree_and_register' type="checkbox" id="agree_and_register">

      <div class="privacy-policy">
        <a target="blank" href="https://www.hyster-yale.com/external-privacy-policy/">https://www.hyster-yale.com/external-privacy-policy/</a>
      </div>
      <span class="checkmark"></span>
    </label>

    @if($errors->has('agree_and_register'))
        <div class="error">{{ $errors->first('agree_and_register') }}</div>
    @endif
  </div>

  <div class='form-group {{isHyster() ? "" : 'text-center'}}' style="margin-bottom: 0">
      {!! Form::submit(
        'submit',
        isHyster() ? __('register.agree_and_register_full') : __('register.agree_and_register')
      ) !!}
  </div>

  {!! Form::close() !!}
@endsection
