@extends('layouts.admin.app')

@section('page-title', 'Notifications')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Notification</h3>
            <div class="card-tools">
                <a href="{{ route('admin.notifications.index') }}" class="btn btn-danger btn-sm">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(
                [
                    'route' => 'admin.notifications.store',
                    'action' => 'POST',
                ],
                [
                    'theme' => 'admin',
                ]
            ) !!}

            @csrf
            @include('notifications::admin.partials.fields')

            {!! Form::submit(
              'submit',
              'Submit'
            ) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
