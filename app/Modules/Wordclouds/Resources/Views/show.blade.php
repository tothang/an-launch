@extends('layouts.app')

@section('content')

    {!! Breadcrumbs::render('wordcloud', $wordcloud) !!}

    <div class="container band">
        <div class="row">
            <div class="col-xs-12">
                <h2>{{ $wordcloud->title }}</h2>
                <h3>{{ $wordcloud->description }}</h3>

                <form method="POST" action="{{ route('wordclouds.entries.store', $wordcloud) }}">
                    @csrf
                    <div class="form-group">
                        <input required type="text" maxlength="{{ $wordcloud->character_limit }}" class="form-control" name="word">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit Word</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
