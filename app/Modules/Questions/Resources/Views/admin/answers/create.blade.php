@extends('layouts.admin.app')

@section('page-title', 'Creating an Answer')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Answer</h3>
            <div class="card-tools">
                <a href="{{ route('admin.questions.answers.index', $stream) }}" class="btn btn-default btn-sm">
                    Back to Answer List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.answers.store', $stream) }}" method="POST">
                {!! csrf_field() !!}
                @include('questions::admin.answers.form')
            </form>
        </div>
    </div>
@endsection
