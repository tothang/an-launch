@foreach($streams->chunk(4) as $chunk)
    <div class="row my-3">
        @foreach($chunk as $stream)
            <div class="col-sm-3">
                <a href="{{ route($route, $stream) }}">
                    <div class="small-box small-box--selectable bg-{{ $stream->getStateColour() }}">
                        <div class="inner">
                            <h3>{{ $stream->getStateText() }}</h3>
                            <hr>
                            <h5 class="mb-0 text-center">{{ ucfirst($stream->name). ' broadcast' }}</h5>
                        </div>
                        <div class="icon icon--small icon--stream"><i class="fa fa-film"></i></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endforeach
