@extends('layouts.admin.app')

@section('page-title', $stream->name . ' - Question Facilitation')

@section('content')
    @include('questions::admin.partials.nav')
    @include('questions::admin.partials.filter', ['route' => 'admin.questions.facilitation.index'])

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Unread Question List</h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Question</th>
                    <th>Likes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($unreadQuestions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->from }}</td>
                        <td>{{ $question->to }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->likes()->count() }}</td>
                        <td>
                            @if($question->read === false)
                                <form action="{{ route('admin.questions.facilitation.update', $question) }}"
                                      method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="read" value="1">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-check"></i>
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.questions.facilitation.update', $question) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="hidden" value="1">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-eye-slash"></i>
                                    Hide
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Read Question List</h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                <th width="30px">#</th>
                <th>From</th>
                <th>To</th>
                <th>Question</th>
                <th>Actions</th>
                </thead>
                <tbody>
                @foreach($readQuestions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->from }}</td>
                        <td>{{ $question->to }}</td>
                        <td>{{ $question->question }}</td>
                        <td>
                            <form action="{{ route('admin.questions.facilitation.update', $question) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="hidden" value="1">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-eye-slash"></i>
                                    Hide
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
