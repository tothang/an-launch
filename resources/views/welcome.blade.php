@extends('layouts.app')

@section('title', 'Event title to be added')

@section('content')
  <div class="bg">
    <div class="container event-container">
      <div class="row">
        <div class="{{isHyster() ? 'offset-md-2' : '' }} {{isHyster() ? 'col-md-10' : 'col-md-12' }} event-container-bg">
          @if (isHyster())
            <div class="diagonal-line">
            </div>
          @endif

          <h3 class="header">
            <span>
              {{ __('welcome.'.getBrand().'.event_title') }}
              <hr>
            </span>
          </h3>

          @if (isHyster())
            <div class="event-calendar">
              <strong class="event-date">{{ __('welcome.'.getBrand().'.event_date') }}</strong>
              <span class="event-time">{{ __('welcome.'.getBrand().'.event_time') }}<span>
            </div>

            <div class="description">
              {{ __('welcome.'.getBrand().'.event_description') }}
            </div>
          @else
            <div class="description" style="margin-bottom: 0">
              {{ __('welcome.'.getBrand().'.event_description') }}
            </div>

            <div class="event-calendar" style="margin-top: 0">
              <strong class="event-date">{{ __('welcome.'.getBrand().'.event_date') }}</strong>
              <span class="event-time">{{ __('welcome.'.getBrand().'.event_time') }}<span>
            </div>
          @endif

          <div class="btn-event-group">
            <a class="btn btn-primary btn-register" href="{{ route('registration.index') }}" tabindex="-1">
              {{ __('welcome.'.getBrand().'.register_now') }}
            </a>

            @if (!$user->isDeclined())
              <a class="link unable-attend" href="{{ route('registration.declineInvitation') }}">
                {{ __('welcome.'.getBrand().'.unable_to_attend') }}
              </a>
            @else
              <div style="margin-top: 20px;"></div>
            @endif

            <a class="btn btn-primary btn-register-mobile" href="{{ route('registration.index') }}" tabindex="-1">
              {{ __('welcome.'.getBrand().'.register_now') }}
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container event-section-container">
      <div class="row">
        <div class="col-md-4 col-xs-12" style="background-color: black">
          <div class="embed-container embed-responsive">
            @if ($video)
              {!! $video['vimeo_iframe'] !!}
            @endif
          </div>
        </div>

        <a href="{{ route('speakers.index') }}" class="col-md-4 col-xs-12">
          <img class="speaker-highlight"
            src="{{ isHyster() ? '/img/hyster/carousel/DR Murdoch.png' : '/img/yale/carousel/DR Murdoch.png' }}"
            height="220">

          <div class="highlight">
            <span>
              {{ __('welcome.'.getBrand().'.speaker_highlights') }}
            </span>
          </div>

          <div class="speaker-card">
            <div class="title">{{ $speaker['name'] }}</div>
            <div class="title-2">{!! $speaker['role'] !!}</div>
          </div>
        </a>

        <a href="{{ route('agenda.index') }}" class="col-md-4 col-xs-12">
          <img class="agenda-img"
            src="{{ isHyster() ? '/img/hyster/carousel/Agenda.png' : '/img/yale/carousel/Agenda.png' }}" height="220">
          <div class="highlight">
            <span>
              {{ __('welcome.'.getBrand().'.agenda') }}
            </span>
          </div>

          <div class="agenda-card">
            <div class="title">{{ __('welcome.'.getBrand().'.event_time') }}</div>
            <div class="title-2">{{ $agenda['title'] }}</div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="container about-event-container">
    <div class="row">
      <div class="col-md-6 col-xs-12 about-event-description">
        <div class="about-event-description-wrapper">
          <h4>{{ __('welcome.'.getBrand().'.about_the_event') }}</h4>
          <div class="content">
            {{ __('welcome.'.getBrand().'.event_content') }}
          </div>

          <a class="btn btn-primary btn-view-agenda" href="{{ route('agenda.index') }}">
            {{ __('welcome.'.getBrand().'.view_agenda') }}
          </a>
        </div>
      </div>
      <div class="col-md-6 col-xs-12 about-event-bg">
      </div>
    </div>
  </div>
@endsection

