@extends('layouts.admin.app')

@section('page-title', 'Editing Speaker')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Update Speaker</h3>
            <div class="card-tools">
                <a href="{{ route('admin.speakers.index') }}" class="btn btn-default btn-sm">Back to Speaker Management List</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.speakers.update', $speaker->id) }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                @include('speakers::admin.form')
            </form>

        </div>
    </div>
@endsection
