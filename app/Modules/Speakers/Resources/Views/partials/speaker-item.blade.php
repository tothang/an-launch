<div class="col-12">
    <a href="{{ route('speakers.show', $speaker) }}">
        <div class="card">
            <div class="row card-body xnowrap">
                <div class="col-sm-2 col-3">
                    <div class="menu-img">
                        <img src="/{{ $speaker->getImage() }}" class="img-fluid speakers-img rounded-circle" alt="Speaker">
                    </div>
                </div>
                <div class="col-sm-10 col-9 vcenter">
                    @if(isset($speaker->name) && $speaker->name != '')
                        <div class="menu-item-name">
                            {{ $speaker->name }}
                        </div>
                    @endif
                    @if(isset($speaker->job_title) && $speaker->job_title != '')
                        <div class="menu-item-description">
                            {{ $speaker->job_title }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>

