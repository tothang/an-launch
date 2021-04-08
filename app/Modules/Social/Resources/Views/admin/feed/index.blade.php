
@extends('layouts.admin.app')

@section('page-title', 'Feed')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Posts</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.feed.create') }}" class="btn btn-success btn-sm">Create Post</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="10px">#</th>
                    <th>Post</th>
                    <th>Pinned</th>
                    <th>Like count</th>
                    <th>Comment count</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->body }}</td>
                            <td>{{ $post->pinned }}</td>
                            <td>{{ $post->likeCount() }}</td>
                            <td>{{ $post->commentCount() }}</td>
                            <td>@include('social::admin.feed.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
