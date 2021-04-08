@extends('layouts.teaser')

@section('page-content')
  <div class="welcome-message"></div>

  <div class="embed-container embed-responsive">
    @if ($video)
      {!! $video['vimeo_iframe'] !!}
    @endif
  </div>
@endsection
