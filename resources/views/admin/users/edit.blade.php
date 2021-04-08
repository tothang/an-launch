@extends('layouts.admin.app')

@section('page-title', 'Delegates')

@section('content')
    @component('admin.components.section', [
        'header' => "Editing delegate - {$user->name}",
        'back' => route('admin.'.strtolower($brand).'.index'),
    ])
        {!! Form::model(
            $user,
            [
                'route' => ['admin.'.strtolower($brand).'.update', $user->id],
                'action' => 'POST',
                'method' => 'PATCH',
            ],
            [
                'theme' => 'admin',
            ]
        ) !!}

        @include('admin.users.partials.form')

        {!! Form::submit(
            'submit',
            'Save'
        ) !!}

        {!! Form::close() !!}
    @endcomponent
@endsection
