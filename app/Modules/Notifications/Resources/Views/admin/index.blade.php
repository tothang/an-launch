@extends('layouts.admin.app')

@section('page-title', 'Notifications')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Notifications</h3>
            <div class="card-tools">
                <a href="{{ route('admin.notifications.create') }}" class="btn btn-success btn-sm">Create Notification</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table data-table">
                <thead>
                    <th width="10px">#</th>
                    <th>Segment</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Send At</th>
                    <th>Sent At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td>{{ $notification->id }}</td>
                        <td>{{ $notification->is_global ?: implode(', ', $notification->segments->pluck('name')->toArray()) }}</td>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->type }}</td>
{{--                        <td>{{ Str::limit($notification->body, 25) }}</td>--}}
                        <td>{{ $notification->send_at }}</td>
                        <td>{{ $notification->sent_at }}</td>
                        <td>
                            <a href="{{ route('admin.notifications.edit', $notification) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.notifications.destroy', $notification) }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete btn-danger" type="submit">Delete</button>
                            </form>

                            <a class="btn btn-dark" href="{{ route('admin.notifications.send', $notification->id) }}">
                                <i class="fa fa-paper-plane"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
