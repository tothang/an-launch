@if(session()->has('token-expired'))
    <span class="help-block help-block-token">
        <strong>{{ session()->pull('token-expired') }}</strong>
    </span>
@endif
