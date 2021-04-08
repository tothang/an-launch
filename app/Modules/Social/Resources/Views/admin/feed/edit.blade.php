@extends('layouts.admin.app')

@section('page-title', 'Feed')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">Update Post</h3>
            <div class="text-center">
                @if($post->image ?? false)
                    <img src="{{ asset($post->image) }}" alt="Post image" class="w-50 mt-4"><br />
                    <a href="{{ route('admin.social.feed.destroy-image', $post) }}" class="btn btn-danger mt-2">Delete</a>
                @endif
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.social.feed.index') }}" class="btn btn-danger btn-sm">Cancel</a>
            </div>
        </div>
        <div class="card-body">

            {!! Form::model(
                $post,
                [
                    'route' => ['admin.social.feed.update', $post->id],
                    'action' => 'POST',
                    'method' => 'PATCH',
                    'files' => true,
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
                'Save'
            ) !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
