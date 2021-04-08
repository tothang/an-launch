@extends('layouts.admin.app')

@section('page-title', 'Agenda')

@section('content')
    @component('admin.components.section', [
        'header' => 'Agenda items',
        'create' => route('admin.agenda.create'),
    ])
        <table class="table data-table">
            <thead>
            <th width="10px">#</th>
            <th>Date</th>
            <th>Time</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
            </thead>
            <tbody>
            @foreach($agendaItems as $agendaItem)
                <tr>
                    <td>{{ $agendaItem->id }}</td>
                    <td>{{ $agendaItem->date }}</td>
                    <td>{{ $agendaItem->time }}</td>
                    <td>{{ $agendaItem->title }}</td>
                    <td>{{ Str::limit($agendaItem->description, 25) }}</td>
                    <td>
                        <a href="{{ route('admin.agenda.edit', $agendaItem) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.agenda.destroy', $agendaItem) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection
