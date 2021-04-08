@extends('layouts.admin.app')

@section('page-title', 'Viewing Responses')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Response List
                <a class="btn btn-default float-right" href="{{ route('admin.poll-and-quiz.questions.index', [$pollAndQuiz, $pollAndQuizQuestion]) }}">Back</a>
            </h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>User</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($responses as $response)
                    <tr>
                        <td>{{ $response->id }}</td>
                        <td>{{ $response->user->name }}</td>
                        <td>{{ $response->answer->value }}</td>
                        <td>
                            <form action="{{ route('admin.poll-and-quiz.questions.responses.destroy', [$pollAndQuiz, $pollAndQuizQuestion, $response]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-block">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
