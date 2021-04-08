<button
    data-recently-emailed="{{ $user->recentlyEmailed() ? 'true' : 'false' }}"
    data-name="{{ $user->name }}"
    data-recipient="{{$user->id}}"
    @if($sent->contains($user))
        data-type="resend"
        class="btn btn-warning js-confirm-send"
    >
        Resend
    @else
        data-type="send"
        class="btn btn-success js-confirm-send"
    >
        Send
    @endif
</button>
