@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Wordclouds')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Wordclouds</h3>
            <div class="card-tools">
                <a href="{{ route('admin.wordclouds.create', $stream) }}" class="btn btn-success btn-sm">Create Wordcloud</a>
                <a href="{{ route('admin.wordclouds.select-stream') }}" class="btn btn-dark btn-sm">Back to streams</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table data-table">
                <thead>
                    <th width="30px">#</th>
                    <th>Question</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody class="sortable" data-entityname="Wordcloud">
                    @foreach($wordclouds as $wordcloud)
                        <tr data-itemId="{{ $wordcloud->id }}">
                            <td>{{ $wordcloud->id }}</td>
                            <td>{{ $wordcloud->question }}</td>
                            <td>
                                @if($wordcloud->active)
                                    <span class="badge badge-pill badge-success">Active</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.wordclouds.screen.show', $wordcloud) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View Screen</a><br>
                                <a href="{{ route('admin.wordclouds.show', $wordcloud) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View</a><br>
                                <a href="{{ route('admin.wordclouds.edit', $wordcloud->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                @if($wordcloud->active)
                                    <form class="form-inline" action="{{ route('admin.wordclouds.activity.update', $wordcloud) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="active" value="0">
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-eye-slash"></i> Set Inactive</button>
                                    </form>
                                @else
                                    <form class="form-inline" action="{{ route('admin.wordclouds.activity.update', $wordcloud) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="active" value="1">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Set Active</button>
                                    </form>
                                @endif
                                @if($wordcloud->deleted_at)
                                    <form action="{{ route('admin.wordclouds.restore', $wordcloud->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-undo"></i> Restore</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.wordclouds.destroy', $wordcloud->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
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
