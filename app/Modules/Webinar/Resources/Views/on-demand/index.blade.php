@extends('layouts.app')

@section('title', 'On-Demand')

@section('content')
    <div class="bg-brand-one text-center py-3">
        <h4 class="mt-0" style="color: #fff;">Please send any enquires or questions to: <a href="mailto:anythingspossible@drpgroup.com">anythingspossible@drpgroup.com</a></h4>
    </div>

    <div class="embed-container">
        <iframe src='https://player.vimeo.com/video/{{ $stream->recording_code }}' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen width="100%"></iframe>
    </div>

    @if($answers->isNotEmpty() || $bookmarks->isNotEmpty())
            <ul class="nav nav-tabs tab__list mt-3" role="tablist">
                @if(module_enabled('questions'))
                    @if($answers->isNotEmpty())
                        <li role="presentation" class="nav-item">
                            <a href="#questions" class="tab__item nav-link active" role="tab" data-toggle="tab">Questions</a>
                        </li>
                    @endif
                @endif
                @if($bookmarks->isNotEmpty())
                    <li role="presentation" class="nav-item">
                        <a href="#bookmarks" class="tab__item nav-link" role="tab" data-toggle="tab">Bookmarks</a>
                    </li>
                @endif
            </ul>

            <div class="tab-content border">
                <div role="tabpanel" class="tab-pane m-0 active" id="questions">
                    <div id="accordion" class="answers-accordion">
                        @foreach($answers as $answer)
                            <div class="card">
                                <div class="card-header" id="heading{{ $answer->id }}">
                                    <a class="text-left" style="padding: 10px 0; display: block;" data-toggle="collapse" data-target="#collapse{{ $answer->id }}" aria-expanded="true" aria-controls="collapse{{ $answer->id }}">
                                        <h5 class="mb-0">
                                            {{ $answer->question }}
                                        </h5>
                                    </a>
                                </div>

                                <div id="collapse{{ $answer->id }}" class="collapse" aria-labelledby="heading{{ $answer->id }}" data-parent="#accordion">
                                    <div class="card-body" style="background: #fff; color: #333;">
                                        {!! nl2br(e($answer->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane m-0" id="bookmarks">
                    <div class="card bg-dark flex-row p-2 py-3">
                        @foreach($bookmarks as $bookmark)
                            <button class="btn btn-primary w-25 py-3 d-inline-block mx-2" data-time="{{ $bookmark->time }}">{{ $bookmark->label }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
@endsection

@push('js')
    <script>
        $(function () {
            $('.nav-link:first').click()
        })
    </script>
@endpush
