@extends('layouts.auth')

@section('title', (request()->has('admin') ? 'Admin ' : '') . 'Reset password')

@section('page-content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open([
        'route' => 'password.request',
        'action' => 'POST',
        'autocomplete' => 'off',
        'class' => 'auth__form'
    ]) !!}

    <div class="welcome-message">
      {!! __('auth.to_reset_your_password') !!}
    </div>

    <input type="hidden" name="token" value="{{ $token ?? 0 }}">

    @if(request()->has('admin'))
        <input type="hidden" name="admin" value="1">
    @endisset

    {!! Form::email(
        'email',
        old('email'),
        [
            'required' => true,
            'placeholder' => __('auth.email'),
        ]
    ) !!}

    {!! Form::password(
        'password',
        [
            'required' => true,
            'placeholder' => __('auth.password'),
        ]
    ) !!}

    {!! Form::password(
        'password_confirmation',
        [
            'required' => true,
            'placeholder' => __('auth.retype_password'),
        ]
    ) !!}

    <a href="{{ route(isset($admin) ? 'admin.login' : 'login') }}" class="link">
      {{ __('auth.back') }}
    </a>

    {!! Form::submit(
        'submit',
        __('auth.reset_password'),
        [
            'inline' => true,
        ]
    ) !!}

    {!! Form::close() !!}
@endsection
