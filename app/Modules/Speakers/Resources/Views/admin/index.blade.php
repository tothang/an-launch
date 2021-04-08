@extends('layouts.admin.app')

@section('page-title', 'Speakers')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Speakers List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.speakers.create') }}" class="btn btn-success btn-sm">Create Speaker</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table data-table">
                <thead>
                    <th width="40px">Reorder</th>
                    <th width="30px">#</th>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody class="sortable" data-entityname="Speaker">
                @foreach($speakers as $speaker)
                    <tr data-itemId="{{ $speaker->id }}">
                        <td class="sortable-handle text-center"><span class="fa fa-sort"></span></td>
                        <td>{{ $speaker->id }}</td>
                        <td>{{ $speaker->name }}</td>
                        <td>{{ $speaker->bio }}</td>
                        <td>
                            @if($speaker->questionable)
                                <span class="badge badge-primary">Questionable</span>
                            @else
                                <span class="badge badge-danger">Not Questionable</span>
                            @endif

                            @if($speaker->agendable)
                                <br>
                                <span class="badge badge-primary">Agendable</span>
                            @else
                                <br>
                                <span class="badge badge-danger">Not Agendable</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.speakers.edit', $speaker->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                            @if($speaker->deleted_at)
                                <form action="{{ route('admin.speakers.restore', $speaker->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-undo"></i> Restore</button>
                                </form>
                            @else
                                <form action="{{ route('admin.speakers.destroy', $speaker->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
