@extends('experience::layouts.experience')

@section('title', 'Experience')

@section('content')
    <div class="loading" id="preloadContainer">
        <div class="loading__content">
            <h2 class="loading__title">
                Loading virtual tour. Please wait...
            </h2>
            <p class="loading__copy">
                created with the 3DVista VT Pro
            </p>
        </div>
    </div>
    <div id="viewer" class="world__viewer"></div>
@endsection
