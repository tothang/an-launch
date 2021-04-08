@extends('layouts.admin.app')

@section('page-title', 'Wordclouds')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h3 class="card-title">Create Wordcloud Entry</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.wordclouds.entries.store', $wordcloud) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="word">Word</label>
                    <input required type="text" name="word" class="form-control" maxlength="20">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
