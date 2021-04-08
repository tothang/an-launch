<div class="card card-{{ $type ?? 'primary' }} card-outline" style="overflow: auto">
    <div class="card-header with-border">
        <h3 class="card-title">{{ ucfirst(strtolower($header ?? $title ?? $name)) }}</h3>
        <div class="card-tools">
            @isset($create)
                <a href="{{ $create }}" class="btn btn-success btn-sm">Create</a>
            @endisset
            @isset($links)
                @foreach($links as $text => $link)
                    <a href="{{ $link }}" class="btn btn-primary btn-sm">{{ $text }}</a>
                @endforeach
            @endisset
            @isset($back)
                <a href="{{ $back }}" class="btn btn-danger btn-sm">Back</a>
            @endisset
        </div>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
