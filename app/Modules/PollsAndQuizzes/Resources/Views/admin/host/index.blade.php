@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Polls/Quizzes - Host Summary')

@section('content')
    @include('polls-and-quizzes::admin.partials.nav')
    @if($polls->count() > 0)
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Polls</h3>
            </div>
            <div class="card-body">
                @include('polls-and-quizzes::admin.host.partials.polls-table')
            </div>
        </div>
    @endif

    @if($quizzes->count() > 0)
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Quizzes</h3>
            </div>
            <div class="card-body">
                @include('polls-and-quizzes::admin.host.partials.quizzes-table')
            </div>
        </div>
    @endif

@endsection
