@extends('layouts.admin.app')

@section('page-title', 'Delegates')

@section('content')
    @component('admin.components.section', [
        'header' => 'Create new Delegate',
        'back' => route('admin.' . strtolower($brand) . '.index')
    ])
        {!! Form::open(
             [
                 'url' => route('admin.'.strtolower($brand).'.store'),
                 'method' => 'POST',
             ],
             [
                 'theme' => 'admin',
             ]
        ) !!}

        @include('admin.users.partials.form')

        {!! Form::submit(
            'submit',
            'Submit'
        ) !!}

        {!! Form::close() !!}
    @endcomponent
@endsection
