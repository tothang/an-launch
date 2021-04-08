@extends('layouts.admin.app')

@section('page-title', 'Updating Answer')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Update Answer</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $pollAndQuizQuestion]) }}" class="btn btn-default btn-sm">Back to Answers List</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.poll-and-quiz.questions.answers.update', [$pollAndQuiz, $pollAndQuizQuestion, $pollAndQuizAnswer]) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                @include('polls-and-quizzes::admin.answers.form')
            </form>

        </div>
    </div>
@endsection
