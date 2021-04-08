@extends('layouts.admin.app')

@section('page-title', 'Creating Question for Quiz')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Question</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.questions.index', $pollAndQuiz) }}" class="btn btn-default btn-sm">Back to Questions List</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.poll-and-quiz.questions.store', $pollAndQuiz) }}" method="POST">
                {!! csrf_field() !!}
                @include('polls-and-quizzes::admin.questions.form')
            </form>

        </div>
    </div>
@endsection
