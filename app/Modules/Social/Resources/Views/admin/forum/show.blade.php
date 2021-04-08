
@extends('layouts.admin.app')

@section('page-title', 'Forum Threads')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Viewing Forum Threads - {{ $topic->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.forum.index') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="10px">#</th>
                    <th>User</th>
                    <th>Thread</th>
                    <th>Likes</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($topic->threads as $thread)
                        <tr>
                            <td>{{ $thread->id }}</td>
                            <td>{{ $thread->user->name }}</td>
                            <td>{{ $thread->body }}</td>
                            <td>{{ $thread->likeCount() }}</td>
                            <td>{{ $thread->commentCount() }}</td>
                            <td>@include('social::admin.forum.threads.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
