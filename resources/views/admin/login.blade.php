@extends('layouts.auth')

@section('title', 'Admin Login')

@section('page-content')
    {!! Form::open([
        'route' => 'admin.login',
        'action' => 'POST',
        'autocomplete' => 'off',
        'class' => 'auth__form'
    ]) !!}

    @csrf

    {!! Form::email(
        'email',
        old('email'),
        [
            'label' => 'Please enter your email:',
            'required' => true,
        ]
    ) !!}

    {!! Form::password(
        'password',
        [
            'label' => 'Please enter your password:',
            'required' => true,
        ]
    ) !!}

    @includeWhen(config('envx.recaptcha'), 'partials.auth.recaptcha', ['align' => 'left'])

    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('adfs.login') }}" class="btn btn-secondary ml-md-2">DRPG account</a><br>
    <a href="{{ route('password.request', ['admin' => true]) }}" class="btn btn-secondary mt-1 mt-md-3">Forgot your password?</a>

    {!! Form::close() !!}

@endsection
