
@extends('layouts.admin.app')

@section('page-title', 'Forum')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Topics</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.forum.create') }}" class="btn btn-success btn-sm">Create Topic</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="10px">#</th>
                    <th>Title</th>
                    <th>Pinned</th>
                    <th>Like count</th>
                    <th>Thread count</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <td>{{ $topic->id }}</td>
                            <td>{{ $topic->title }}</td>
                            <td>{{ $topic->pinned }}</td>
                            <td>{{ $topic->likeCount() }}</td>
                            <td>{{ $topic->threads->count() }}</td>
                            <td>@include('social::admin.forum.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
