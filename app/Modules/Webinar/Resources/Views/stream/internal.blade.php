@extends('layouts.app')

@section('title', 'Broadcast')

@section('body-class', isset($stream->theme) && $stream->theme !== '' ? 'theme--' . $stream->theme : '')

@section('content')
  <div class="page__content container-fluid broadcast__container" id="content-wrap" style="margin-top: 50px;">
    <h1 class="now-live">
      {{ __('broadcast.now_live') }}

      <hr>
    </h1>

    <div class="embed-container">
      <div id="stream-player"></div>
    </div>

    @include('webinar::partials.interactions')
  </div>
@endsection

@push('js')
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        @if(\App\Config::getBoolFromCache('technical_issues'))
            $("#tech-issues").modal({backdrop: 'static', keyboard: false});
            $("#tech-issues").modal('show');
        @else
            $(function () {
                let streamLink = "{{ $embedCode }}"
                let streamId = "{{ $stream->id }}"
                let postUrl = "{{ route('api.webinar.events') }}"

                let player = new Vimeo.Player('stream-player', { url: streamLink });
                let playerState = 'OFF';

                function postWebinarEvent(event) {
                    axios.post(postUrl, {
                        event: event,
                        stream_id: streamId,
                    });
                }

                function postUsersViewTime() {
                    axios.post(postUrl, {
                        view_time: TimeMe.getTimeOnPageInSeconds('stream-view-time'),
                        stream_id: streamId,
                    });
                    TimeMe.resetRecordedPageTime('stream-view-time');
                }

                TimeMe.initialize({
                    currentPageName: 'broadcast',
                    idleTimeoutInSeconds: 99999
                });

                player.on('play', function () {
                    TimeMe.startTimer('stream-view-time');
                    if (playerState === 'OFF') {
                        postWebinarEvent('{{ \App\Modules\Webinar\Models\WebinarEvent::EVENT_STARTED_STREAM }}');
                    }
                    playerState = 'ON';
                });

                player.on('ended', function () {
                    playerState = 'OFF';
                    postWebinarEvent('{{ \App\Modules\Webinar\Models\WebinarEvent::EVENT_FINISHED_STREAM }}');
                    postUsersViewTime();
                });

                player.on('pause', function () {
                    playerState = 'PAUSED';
                    postUsersViewTime();
                });

                // Executes before window is closed (browser-dependant)
                window.onbeforeunload = function () {
                    if (playerState === 'ON') {
                        postUsersViewTime();
                    }
                };

                setInterval(function () {
                    if (typeof TimeMe.getTimeOnPageInSeconds('stream-view-time') !== 'undefined') {
                        postUsersViewTime();
                    }
                }, 20000)

                $('.nav-link:first').click();
            });
        @endif
    </script>
@endpush

@if(\App\Config::getBoolFromCache('technical_issues'))
    @include('webinar::partials.technical-issues-modal')
@endif
