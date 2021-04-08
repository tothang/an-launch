<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'apiToken' => auth()->check() ? auth()->user()->api_token : '',
        'userId' => auth()->check() ? auth()->id() : ''
    ]) !!};
</script>
