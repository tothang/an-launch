@extends('layouts.admin.app')

@section('page-title', 'Creating Poll/Quiz')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <a href="{{ route('admin.poll-and-quiz.index', $stream) }}" class="btn btn-default btn-sm">Back</a>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.poll-and-quiz.store', $stream) }}" method="POST">
                @csrf
                @include('polls-and-quizzes::admin.form')
            </form>

        </div>
    </div>
@endsection
