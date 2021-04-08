@extends('layouts.app')

@section('content')

    @if($wordcloud === null)
        <div class="container max-width-app" >
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>Wordcloud</h1>
                    <p><strong>Word clouds will be available on the day of the event.</strong></p>
                    <a href="{{ route('index') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    @else
        <div class="container max-width-app" >
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>Pulse Check</h1>
                    <h2>{{ $wordcloud->description }}</h2>

                    @include('partials.notifications')

                    <form action="{{ route('wordclouds.entries.store', $wordcloud) }}" method="POST" id="wordcloud-form">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="word">Enter your word</label>
                            <input name="word" id="word" class="form-control" placeholder="Type Here..." maxLength="{{ $wordcloud->character_limit }}" required>
                        </div>

                        <small style="float: right;">Maximum <span class="jq-statement-character-limit" >{{ $wordcloud->character_limit }}</span> Characters</small>


                        <div class="clear"></div>

                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit" id="wordcloud-submit-button">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endif
@endsection
