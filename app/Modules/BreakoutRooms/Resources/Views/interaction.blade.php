<div class="breakouts mx-2 question__response">
    @forelse($breakouts->chunk(3) as $group)
        <div class="row">
            @foreach($group as $breakout)
                <div class="col-sm-4 mt-4 text-center">
                    <a href="{{ $breakout->link }}" class="breakout py-3 px-1 bg-light d-block" target="_blank">{{ $breakout->title }}</a>
                </div>
            @endforeach
        </div>
    @empty
        <h3>No breakouts are available at the moment.</h3>
    @endforelse
</div>
