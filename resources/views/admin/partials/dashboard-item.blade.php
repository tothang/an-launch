<div class="col-sm-3">
    <div
        class="small-box bg-{{ $type ?? 'info' }} {{ isset($route) ? 'js-has-route' : '' }}"
        data-route="{{ isset($route) ? route($route) : '' }}"
    >
        <div class="inner">
            <h3>{{ $stat }}</h3>
            <h6>{{ $title }}</h6>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function () {
            $('.js-has-route').click(function () {
                window.location.href = $(this).data('route')
            });
        })
    </script>
@endpush
