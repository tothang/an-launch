@extends('layouts.admin.app')

@section('page-title', 'Viewing Questions for ' . $pollAndQuiz->name)

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Questions List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.index', $pollAndQuiz->stream) }}"
                   class="btn btn-default btn-sm">Back</a>
                <a href="{{ route('admin.poll-and-quiz.questions.create', $pollAndQuiz) }}"
                   class="btn btn-success btn-sm">Create Question</a>
                <a href="{{ route('admin.poll-and-quiz.scores.show', $pollAndQuiz) }}" class="btn btn-primary btn-sm">Show Scores</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>Title</th>
                    <th>Answers</th>
                    <th>Responses</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="sortable" data-entityname="QuizQuestion">
                @foreach($questions as $question)
                    <tr data-itemId="{{ $question->id }}">
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->answers->count() }}</td>
                        <td>{{ $question->responses->count() }}</td>
                        <td>{!! $question->active ? '<span class="badge badge-success">Active</span>'  : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                        <td>
                            @if($question->deleted_at === null)
                                <a target="_blank" href="{{ route('admin.poll-and-quiz.results', $question->id) }}"
                                   class="btn btn-primary btn-sm btn-block"><i class="fa fa-eye"></i> View Results</a>
                                <form class="form-inline"
                                      action="{{ route('admin.poll-and-quiz-question.active.update', [$pollAndQuiz, $question->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($question->active)
                                        <input type="hidden" name="active" value="0">
                                        <button type="submit" class="btn btn-warning btn-sm btn-block">
                                            <i class="fa fa-eye-slash"></i> Set Inactive
                                        </button>
                                    @else
                                        <input type="hidden" name="active" value="1">
                                        <button type="submit" class="btn btn-success btn-sm btn-block">
                                            <i class="fa fa-check"></i> Set Active
                                        </button>
                                    @endif
                                </form>

                                <hr>

                                <a href="{{ route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $question]) }}"
                                   class="btn btn-primary btn-sm btn-block">View Answers</a>
                                <a href="{{ route('admin.poll-and-quiz.questions.responses.index', [$pollAndQuiz, $question]) }}"
                                   class="btn btn-primary btn-sm btn-block">View Responses</a>
                                <a href="{{ route('admin.poll-and-quiz.questions.edit', [$pollAndQuiz, $question]) }}"
                                   class="btn btn-info btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                                <hr>
                                <form class="form-inline"
                                      action="{{ route('admin.poll-and-quiz.questions.destroy', [$pollAndQuiz, $question]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-block">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>

                            @else
                                <form class="form-inline"
                                      action="{{ route('admin.poll-and-quiz.questions.restore', [$pollAndQuiz, $question]) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-warning btn-sm btn-block">
                                        <i class="fa fa-undo"></i> Restore
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
