@extends('layouts.app')

@section('title', 'Presenters')

@section('content')
    <div class="bg-presenter">
        <div class="container presenter-container">
            <div class="row">
                <div class="offset-lg-2 offset-md-1 col-lg-10 col-md-11 col-xs-12 presenter-container-bg">
                    @if (isHyster())
                        <div class="diagonal-line">
                        </div>
                    @endif

                    <h3 class="header">
                        <span>
                          {{ $presenter['title'] }}
                        </span>

                        @if (isHyster())
                            <hr class="red-line" />
                        @endif
                    </h3>

                    @if (isYale())
                        <div class="description">
                            {{ $presenter['description'] }}
                        </div>
                    @endif

                    <div class="presenter-calendar">
                        <strong class="presenter-date">{{ $presenter['date'] }}</strong>

                        @if(isHyster())
                            <img src="{{asset('img/hyster/mobile-diagonal-line.png')}}" />
                        @endif

                        <span class="presenter-time">{{ $presenter['time'] }}<span>
                    </div>

                    @if (isHyster())
                        <div class="description">
                            {{ $presenter['description'] }}
                        </div>
                        <div class="btn-presenter-group">

                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-xs-12"></div>
            </div>
        </div>

        <div class="container presenter-section-container">
            <div class="presenters-wrapper-desktop">
              <div class="row justify-content-lg-center">
                @foreach($firstThreePresenters as $item)
                  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="card-wrapper">
                      <div class="presenter-img-wrapper">
                        <img class="presenter-img" src="{{ asset($item['image']) }}" height="225">
                      </div>
                      <div class="presenter-card">
                        <div class="highlight">{{ __('presenter.presenter') }}</div>
                        <div class="title">{{ $item['name'] }}</div>
                        <div class="title-2">{!! $item['title'] !!}</div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>

              @foreach(array_chunk($lastPresenters, 4) as $key => $chunk)
                <div class="row">
                  @foreach($chunk as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="card-wrapper">
                        <div class="presenter-img-wrapper">
                          <img class="presenter-img" src="{{ asset($item['image']) }}" height="225">
                        </div>
                        <div class="presenter-card">
                          <div class="highlight">{{ __('presenter.presenter') }}</div>
                          <div class="title">{{ $item['name'] }}</div>
                          <div class="title-2">{!! $item['title'] !!}</div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>

            <div class="presenters-wrapper-tablet-and-mobile">
              @foreach(array_chunk($presenters, 4) as $chunk)
                <div class="row justify-content-center">
                  @foreach($chunk as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="card-wrapper">
                        <div class="presenter-img-wrapper">
                          <img class="presenter-img" src="{{ asset($item['image']) }}" height="225">
                        </div>
                        <div class="presenter-card">
                          <div class="highlight">{{ __('presenter.presenter') }}</div>
                          <div class="title">{{ $item['name'] }}</div>
                          <div class="title-2">{!! $item['title'] !!}</div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
