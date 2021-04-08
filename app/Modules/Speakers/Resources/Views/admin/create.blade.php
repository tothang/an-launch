@extends('layouts.admin.app')

@section('page-title', 'Creating Speaker')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Speaker</h3>
            <div class="card-tools">
                <a href="{{ route('admin.speakers.index') }}" class="btn btn-default btn-sm">Back to Speaker Management List</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.speakers.store') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @include('speakers::admin.form')
            </form>

        </div>
    </div>
@endsection
