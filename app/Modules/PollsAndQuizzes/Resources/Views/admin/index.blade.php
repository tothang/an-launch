@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Polls/Quizzes')

@section('content')
    @include('polls-and-quizzes::admin.partials.nav')
     <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Polls/Quiz List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.create', $stream) }}" class="btn btn-success btn-sm">Create Poll/Quiz</a>
            </div>
        </div>
        <div class="card-body">
            <nav class="nav nav-tabs nav-stacked">
                <a class="nav-link active" role="tab" data-toggle="tab" href="#polls">Polls</a>
                <a class="nav-link" role="tab" data-toggle="tab" href="#quizzes">Quizzes</a>
            </nav>
            <div class="tab-content">
                <div class="active tab-pane fade in show" id="polls">
                    @include('polls-and-quizzes::admin.partials.polls-table')
                </div>
                <div class="tab-pane fade" id="quizzes">
                    @include('polls-and-quizzes::admin.partials.quizzes-table')
                </div>
            </div>
        </div>
    </div>
@endsection
