@extends('layouts.admin.app')

@section('page-title', 'Wordclouds')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Edit Wordcloud</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.wordclouds.update', $wordcloud) }}" method="POST">
                @csrf
                @method('PATCH')

                @include('wordclouds::admin.partials.form')
            </form>
        </div>
    </div>
@endsection
