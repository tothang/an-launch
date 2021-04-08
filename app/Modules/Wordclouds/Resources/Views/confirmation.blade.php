@extends('layouts.app')

@section('content')
    <div class="container max-width-app" >
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2>Thank you for your {{ $wordcloud->title }} entry</h2>
                <p>All entries are moderated before appearing on screen.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="{{ route('wordclouds.index') }}" class="btn btn-primary ">Enter Another Word</a>

            </div>
            <div class="col-xs-12 text-center mt-20">
                <a href="{{ route('index') }}" class="btn btn-primary">Return to Home</a>
            </div>
        </div>
    </div>
@endsection
