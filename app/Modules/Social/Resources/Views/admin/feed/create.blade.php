@extends('layouts.admin.app')

@section('page-title', 'Feed')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Create Post</h3>
            <div class="card-tools">
                <a href="{{ route('admin.social.feed.index') }}" class="btn btn-danger btn-sm">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(
                 [
                     'url' => route('admin.social.feed.store'),
                     'method' => 'POST',
                     'files' => true
                 ],
                 [
                     'theme' => 'admin',
                 ]
            ) !!}

            @csrf
            @include('social::admin.feed.partials.form')

            <hr>

            {!! Form::submit(
                'submit',
                'Submit'
            ) !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
