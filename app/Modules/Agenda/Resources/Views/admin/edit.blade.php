@extends('layouts.admin.app')

@section('page-title', 'Agenda')

@section('content')
    @component('admin.components.section', [
        'header' => 'Editing agenda item',
        'back' => route('admin.agenda.index'),
    ])
        {!! Form::open(
            [
                'route' => ['admin.agenda.update', $agendaItem],
                'action' => 'POST',
                'method' => 'PATCH',
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
