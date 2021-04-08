@extends('layouts.admin.app')

@section('page-title', 'Editing Poll/Quiz')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Update Poll/Quiz</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.index', $pollAndQuiz->stream) }}" class="btn btn-default btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.poll-and-quiz.update', $pollAndQuiz) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                @include('polls-and-quizzes::admin.form')
            </form>

        </div>
    </div>
@endsection
