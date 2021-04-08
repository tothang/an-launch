
@extends('layouts.admin.app')

@section('page-title', 'Forum Thread Comments')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Viewing Thread - {{ $thread->body }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.forum.show', [$thread->topic]) }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="10px">#</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($thread->comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->body }}</td>
                            <td>@include('social::admin.partials.comment-actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
