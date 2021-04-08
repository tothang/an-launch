@extends('layouts.admin.app')

@section('page-title', 'Viewing Answers')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Answer List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.poll-and-quiz.questions.index', [$pollAndQuiz]) }}" class="btn btn-default btn-sm">Back</a>
                <a href="{{ route('admin.poll-and-quiz.questions.answers.create', [$pollAndQuiz, $pollAndQuizQuestion]) }}" class="btn btn-success btn-sm">Create Answer</a>
            </div>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <th width="40px">Reorder</th>
                    <th width="30px">#</th>
                    <th>Value</th>
                    <th>Correct</th>
                    <th>Actions</th>
                </thead>
                <tbody class="sortable" data-entityname="QuizAnswer">
                @foreach($answers as $answer)
                    <tr data-itemId="{{ $answer->id }}">
                        <td class="sortable-handle text-center"><span class="fa fa-sort"></span></td>
                        <td>{{ $answer->id }}</td>
                        <td>{{ $answer->value }}</td>
                        <td>{!! $answer->correct ? '<span class="badge badge-success">Correct</span>' : '' !!}</td>
                        <td>
                            <a href="{{ route('admin.poll-and-quiz.questions.answers.edit', [$pollAndQuiz, $pollAndQuizQuestion, $answer]) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>
                            <hr>
                            @if($answer->deleted_at)
                                <!-- DRTODO - Add in restore -->
                                {{--<form class="form-inline" action="{{ route('admin.poll-and-quiz.questions.answers.restore', [$pollAndQuiz, $pollAndQuizQuestion, $answer]) }}" method="POST">--}}
                                    {{--{!! csrf_field() !!}--}}
                                    {{--<input type="hidden" name="_method" value="PUT">--}}
                                    {{--<button type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-undo"></i> Restore</button>--}}
                                {{--</form>--}}
                            @else
                                <form class="form-inline" action="{{ route('admin.poll-and-quiz.questions.answers.destroy', [$pollAndQuiz, $pollAndQuizQuestion, $answer]) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
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
