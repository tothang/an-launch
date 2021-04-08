@extends('layouts.admin.app')

@section('page-title', 'Forum')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Create Topic</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.forum.index') }}" class="btn btn-danger btn-sm">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(
                 [
                     'url' => route('admin.social.forum.store'),
                     'method' => 'POST',
                 ],
                 [
                     'theme' => 'admin',
                 ]
            ) !!}

            @csrf
            @include('social::admin.forum.partials.form')

            <hr>

            {!! Form::submit(
                'submit',
                'Submit'
            ) !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
