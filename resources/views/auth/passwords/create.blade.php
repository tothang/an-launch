@extends('layouts.auth')

@section('title', 'Create password')

@section('page-content')
    @include('auth.partials.requirements')

    {!! Form::open([
        'route' => 'create-password.store',
        'action' => 'POST',
        'autocomplete' => 'off',
    ]) !!}

    {!! Form::password(
        'password',
        [
            'label' => 'Please enter a password:',
            'required' => true,
        ]
    ) !!}

    {!! Form::password(
        'password_confirmation',
        [
            'label' => 'Please confirm your password:',
            'required' => true,
        ]
    ) !!}

    {!! Form::submit(
        'submit',
        'Set password',
        [
            'inline' => true,
            'center' => true,
        ]
    ) !!}

    {!! Form::close() !!}
@endsection
