@extends('layouts.reset-password')

@section('custom-class', isHyster() ? 'page-hyster-password-creation' : '')

@section('title')
  <h3 class="reset-password__header">{{ (request()->has('admin') ? 'Admin ' : '') . __('auth.reset_password') }}</h3>
@stop

@section('page-content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if(isHyster())
      <hr class="hyster-line" />
    @endif

    {!! Form::open([
        'route' => 'password.email',
        'action' => 'POST',
        'autocomplete' => 'off',
        'class' => 'auth__form'
    ]) !!}

    <div class="reset-password-message">
      {!! __('auth.to_reset_your_password') !!}
    </div>

    <div class="col-lg-10 pl-0 pr-0">
      @isset($admin)
          <input type="hidden" name="admin" value="1">
      @endisset

      <div class="form-inline" style="">
        <label for="email" class="sr-only required">
            <span class="required-asterix">*</span>
        </label>

        <input type="email" class="form-control reset-email-input" placeholder="{{ __('auth.email') }}" id="email" name="email" value="" required/>

        @if(!isHyster())
          <button name="submit" type="submit" class="btn btn-primary send-email-tablet">
            {{ __('auth.send_email') }}
          </button>
        @endif

      </div>

      <a href="{{ route(isset($admin) ? 'admin.login' : 'login') }}" class="link">
        {{ __('auth.back') }}
      </a>

      @if(isHyster())
        <button name="submit" type="submit" class="btn btn-primary send-email-tablet">
          {{ __('auth.send_email') }}
        </button>
      @endif

      <div class="yale-mobile-spacing"></div>

      <button name="submit" type="submit" class="btn btn-primary send-email-mobile">
        {{ __('auth.send_email') }}
      </button>
    </div>

    {!! Form::close() !!}
@endsection
