@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Polls/Quizzes - Leaderboard')

@section('content')
    @include('polls-and-quizzes::admin.partials.nav')

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Leaderboard</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Score</strong></td>
                    </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->quizScore($stream)}} / {{ $quizQuestions }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
