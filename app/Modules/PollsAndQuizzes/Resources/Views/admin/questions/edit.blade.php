@extends('layouts.admin.app')

@section('page-title', 'Editing Question')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Edit Question</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.questions.index', $pollAndQuiz) }}" class="btn btn-default btn-sm">Back to Questions List</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.poll-and-quiz.questions.update', [$pollAndQuiz, $pollAndQuizQuestion]) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                @include('polls-and-quizzes::admin.questions.form')
            </form>

        </div>
    </div>
@endsection
