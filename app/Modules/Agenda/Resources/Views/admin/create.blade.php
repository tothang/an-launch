@extends('layouts.admin.app')

@section('page-title', 'Agenda')

@section('content')
    @component('admin.components.section', [
        'header' => 'Create agenda item',
        'back' => route('admin.agenda.index'),
    ])
        {!! Form::open(
            [
                'route' => 'admin.agenda.store',
                'action' => 'POST',
            ],
            [
                'theme' => 'admin',
            ]
        ) !!}

        @include('agenda::admin.partials.fields')

        {!! Form::submit(
          'submit',
          'Submit'
        ) !!}

        {!! Form::close() !!}
    @endcomponent
@endsection
