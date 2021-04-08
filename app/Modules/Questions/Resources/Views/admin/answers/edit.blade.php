@extends('layouts.admin.app')

@section('page-title', 'Editing Answer')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Update Answer</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.answers.index', $answer->stream) }}" class="btn btn-default btn-sm">
                    Back to Answer Management List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.answers.update', $answer) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                @include('questions::admin.answers.form')
            </form>
        </div>
    </div>
@endsection
