@extends('layouts.app')

@section('title', __("contact.$brand.title", [], $locale))
@section('body-class', 'contact-us')
@section('content')
  <div class="bg contact-us-bg">
    <div class="container event-container">
      <div class="row">
        <div class="col-md-8 col-xs-12 event-container-bg">
          @if(isHyster())
            <div class="diagonal-line"></div>
          @endif

          <h3 class="header">
            <span>
              {!! __("contact.$brand.title", [], $locale) !!}
            </span>

            @if(isHyster())
              <hr>
            @endif
          </h3>

          <div class="content">
            <p class="text-content">
              {!! __("contact.$brand.text_content", [], $locale) !!}
            </p>

            <p class="text-description">{!! __("contact.$brand.text_description", [], $locale) !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
