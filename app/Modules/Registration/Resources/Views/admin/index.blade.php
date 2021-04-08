@extends('layouts.admin.app')

@section('page-title', 'Registrations')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">Registration List</h3>
    </div>
    <div class="card-body">
        <table class="table data-table">
            <thead>
                <th width="30px">#</th>
                <th>Email</th>
                <th>Attending</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td>{{ $registration->id }}</td>
                    <td>{{ $registration->user->email}}</td>
                    <td>{{ $registration->attending ? 'Yes' : 'No' }}</td>
                    <td>{{ $registration->status }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.registrations.edit', $registration->id) }}">
                            Edit
                        </a>
                        <a class="btn btn-default" href="{{ route('admin.registrations.show', $registration->id) }}">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
