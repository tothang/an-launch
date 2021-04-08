
@extends('layouts.admin.app')

@section('page-title', 'Feed')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Viewing Post - {{ $post->body }}</h3>
            <div class="text-center">
                @if($post->image ?? false)
                    <img src="{{ asset($post->image) }}" alt="Post image" class="w-50 mt-4">
                @endif
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.social.feed.index') }}" class="btn btn-danger btn-sm">Back</a>
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
                    @foreach($post->comments as $comment)
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
