@extends('layouts.admin.app')

@section('page-title', 'Editing Question')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Update Question</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.index', $question->stream) }}" class="btn btn-default btn-sm">
                    Back to Question Management List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.update', $question) }}" method="POST">
                @csrf
                @method('PATCH')
                @include('questions::partials.fields')
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
