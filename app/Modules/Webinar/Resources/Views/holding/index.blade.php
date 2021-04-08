@extends('layouts.app')

@section('body-class', 'holding-page')

@section('content')
  <div class="holding bg">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-5 col-md-5 col-sm-12">
          <div class="clock-content">
            <h1 class="m-0">{{ __('holding.calendar.comming_soon') }}</h1>

            <div class="clock">
              <div class="day">
                <span class="day-label">{{ __('holding.calendar.days') }}</span>
                <span class="day-count">14</span>
              </div>
              <div class="hour">
                <span class="hour-label">{{ __('holding.calendar.hours') }}</span>
                <span class="hour-count">21</span>
              </div>
              <div class="min">
                <span class="min-label">{{ __('holding.calendar.minutes') }}</span>
                <span class="min-count">34</span>
              </div>
              <div class="sec">
                <span class="sec-label">{{ __('holding.calendar.seconds') }}</span>
                <span class="sec-count">23</span>
              </div>
            </div>

            <div class="des">
              <p>{{ __('holding.calendar.description') }}</p>
            </div>

            <div class="custom-btn-group">
              <button name="submit" type="button" onclick="window.open('/holding/download-calendar')" class="btn btn-primary btn-add-to-calendar">
                {{ __('holding.calendar.add_to_calendar') }}
              </button>
            </div>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12">
          @if(isYale())
          <div class="image">
            <img src="{{ isHyster() ? '/img/hyster/holding-bitmap@2x.png' : '/img/yale/holding-bitmap@2x.png' }}"
              alt="holding">
          </div>
          @else
          <div class="embed-container embed-responsive">
            @if ($video)
              {!! $video['vimeo_iframe'] !!}
            @endif
          </div>
          @endif
        </div>
      </div>

      <div class="row mb-5">
        <div class="col p-0 px-md-3">

          <div class="d-md-none">
            @if(isYale())
            <div class="mobile-block">

              {{-- 2 --}}
              <div class="section">
                <div class="card mb-2">
                  <div class="card-body"
                       style="background-image: url('{{ isHyster() ? '/img/hyster/carousel/2.png' : '/img/yale/holding-bitmap@2x.png' }}'); height: 233px;">
                    <span class="card-label">AGENDA</span>
                    <span class="card-label-1">11:00AM</span>
                  </div>

                  <a href="{{ route('agenda.index') }}"><img class="play-btn" src="/img/hyster/mobile/play.png" width="50"
                                                             height="50" alt="play"></a>
                </div>

                <div class="view-link">
                  <a href="{{ route('agenda.index') }}">VIEW NOW</a>
                </div>
              </div>

              {{-- 1 --}}
              <div class="section">
                <div class="card mb-2">
                  <div class="card-body"
                    style="background-image: url('{{ isHyster() ? '/img/hyster/carousel/DR Murdoch.png' : '/img/yale/carousel/DR Murdoch.png' }}'); height: 233px;">
                    <span class="card-label">Stewart D. Murdoch </span>
                    <span class="card-label-1">Senior Vice President, <br>Managing Director – EMEA</span>
                  </div>

                  <a href="{{ route('speakers.index') }}"><img class="play-btn"
                      src="/img/hyster/mobile/play.png" width="50" height="50" alt="play"></a>
                </div>

                <div class="view-link">
                  <a href="{{ route('speakers.index') }}">VIEW NOW</a>
                </div>
              </div>

              {{-- 3 --}}
              <div class="section">
                <div class="card mb-2">
                  <div class="card-body p-0"
                    style="background-image: url('{{ isHyster() ? '/img/hyster/carousel/DR Murdoch.png' : '/img/yale/carousel/DR Murdoch.png' }}'); height: 233px;">
                    <div class="embed-container embed-responsive">
                      @if ($video)
                        {!! $video['vimeo_iframe'] !!}
                      @endif
                    </div>
                  </div>
                </div>

                <div class="view-link">
                  VIEW NOW
                </div>
              </div>
            </div>
            @else
              <div class="mobile-block">
                {{-- 1 --}}
                <div class="section">
                  <div class="card mb-2">
                    <div class="card-body"
                         style="background-image: url('/img/hyster/carousel/DR Murdoch.png'); height: 225px;">
                      <span class="card-label">{{ isYale() ? __('holding.yale.presenters') : __('holding.hyster.presenters') }}</span>
                      <span class="card-label-1"></span>
                      <span class="card-title">Senior Vice President, <br>Managing Director – EMEA</span>
                    </div>

                    <a href="{{ route('speakers.index') }}"></a>
                  </div>
                </div>

                {{-- 2 --}}
                <div class="section">
                  <div class="card mb-2">
                    <div class="card-body"
                         style="background-image: url('/img/hyster/holding/Hyster-Agenda@2x.png'); height: 225px;">
                      <span class="card-label width-100">{{ isYale() ? __('holding.yale.agenda') : __('holding.hyster.agenda') }}</span>
                      <span class="card-label-1">09:30hrs - 11:00hrs (BST)</span>
                    </div>

                    <a href="{{ route('agenda.index') }}"></a>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!--Carousel Wrapper-->
    <div class="carousel-wrapper ">
      <div class="container">
        <div class="{{ isYale() ? 'd-none d-md-block row' : 'row' }}">
          @include('webinar::holding.partials.carousel')
        </div>
      </div>
    </div>
    <!--/.Carousel Wrapper-->

  </div>

@endsection
@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous"></script>

  @if (isHyster())
    <script>
      var targetDate = moment('2021-04-14T13:00:00')

      function initialCountdown() {
        var now = moment();

        var secsCD = targetDate.diff(now, 's');

        var daysCD = Math.floor(secsCD / 60 / 60 / 24);
        secsCD = secsCD - daysCD * 24 * 60 * 60;

        var hoursCD = Math.floor(secsCD / 60 / 60);
        secsCD = secsCD - hoursCD * 60 * 60;

        var minsCD = Math.floor(secsCD / 60)
        secsCD = secsCD - minsCD * 60;

        daysCD = (daysCD + '').padStart(2, 0)
        hoursCD = (hoursCD + '').padStart(2, 0)
        minsCD = (minsCD + '').padStart(2, 0)
        secsCD = (secsCD + '').padStart(2, 0);

        $('.day-count').text(daysCD)
        $('.hour-count').text(hoursCD)
        $('.min-count').text(minsCD)
        $('.sec-count').text(secsCD)
      }

      initialCountdown();

      setInterval(() => {
        initialCountdown()
      }, 1000);

    </script>
    @elseif(isYale())
    <script>
      var targetDate = moment('2021-04-12T09:30:00')

      function initialCountdown() {
        var now = moment();

        var secsCD = targetDate.diff(now, 's');

        var daysCD = Math.floor(secsCD / 60 / 60 / 24);
        secsCD = secsCD - daysCD * 24 * 60 * 60;

        var hoursCD = Math.floor(secsCD / 60 / 60);
        secsCD = secsCD - hoursCD * 60 * 60;

        var minsCD = Math.floor(secsCD / 60)
        secsCD = secsCD - minsCD * 60;

        daysCD = (daysCD + '').padStart(2, 0)
        hoursCD = (hoursCD + '').padStart(2, 0)
        minsCD = (minsCD + '').padStart(2, 0)
        secsCD = (secsCD + '').padStart(2, 0);

        $('.day-count').text(daysCD)
        $('.hour-count').text(hoursCD)
        $('.min-count').text(minsCD)
        $('.sec-count').text(secsCD)
      }

      initialCountdown();

      setInterval(() => {
        initialCountdown()
      }, 1000);

    </script>
    @endif
@endpush
