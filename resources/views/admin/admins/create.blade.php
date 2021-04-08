@extends('layouts.admin.app')

@section('page-title', 'Admins')

@section('content')
    @component('admin.components.section', [
        'header' => 'Create admin',
        'back' => route('admin.admins.index')
    ])
        <div class="alert alert-warning" role="alert">
            Creating an admin will send an email inviting them to create their password and access the admin area.
        </div>

        {!! Form::open(
             [
                 'url' => route('admin.admins.store'),
                 'method' => 'POST',
             ],
             [
                 'theme' => 'admin',
             ]
        ) !!}

        @include('admin.admins.partials.form')

        {!! Form::submit(
            'submit',
            'Submit'
        ) !!}

        {!! Form::close() !!}
    @endcomponent
@endsection
