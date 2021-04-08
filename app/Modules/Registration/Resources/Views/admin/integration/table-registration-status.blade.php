<div class="badge badge-pill badge-{{ $user->statusHtmlClass() }}">
    {{ $user->registrationStatus() }}
</div> |
<a
    href="{{ route('admin.registrations.edit', $user->id) }}"
    class="badge badge-pill badge-warning">Edit
</a>
