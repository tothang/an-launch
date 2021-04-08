@extends('layouts.admin.app')

@section('page-title', 'Creating a Question')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Question</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.index', $stream) }}" class="btn btn-default btn-sm">
                    Back to Question Management List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.store', $stream) }}" method="POST">
                @csrf
                @include('questions::partials.fields')
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
