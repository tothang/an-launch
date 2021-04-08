@extends('layouts.admin.app')

@section('page-title', 'Breakout rooms')

@section('content')
    @component('admin.components.section', [
        'header' => 'Breakout list',
        'create' => route('admin.breakouts.create'),
    ])
        <table class="table data-table">
            <thead>
            <th>Title</th>
            <th>Link</th>
            <th>Description</th>
            <th width="120px">Actions</th>
            </thead>
            <tbody>
            @foreach($breakouts as $breakout)
                <tr>
                    <td>{{ $breakout->title }}</td>
                    <td>{{ $breakout->link }}</td>
                    <td>{{ $breakout->description }}</td>
                    <td>
                        <a href="{{ route('admin.breakouts.edit', $breakout) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.breakouts.destroy', $breakout) }}" class="d-inline" method="POST">
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
