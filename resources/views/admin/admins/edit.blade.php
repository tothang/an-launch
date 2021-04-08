@extends('layouts.admin.app')

@section('page-title', 'Admins')

@section('content')
    @component('admin.components.section', [
        'header' => "Editing admin - {$admin->name}",
        'back' => route('admin.admins.index'),
    ])
        {!! Form::model(
            $admin,
            [
                'route' => ['admin.admins.update', $admin->id],
                'action' => 'POST',
                'method' => 'PATCH',
            ],
            [
                'theme' => 'admin',
            ]
        ) !!}

        @include('admin.admins.partials.form')

        {!! Form::submit(
            'submit',
            'Save'
        ) !!}

        {!! Form::close() !!}
    @endcomponent
@endsection
