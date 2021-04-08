<a href="{{ route('admin.'.strtolower($brand).'.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

<form class="d-inline" id={{"delete-form-{$user->id}"}} action="{{ route('admin.'.strtolower($brand).'.destroy', $user->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button
        type="submit"
        data-id="{{ $user->id }}"
        class="btn btn-danger btn-sm js-delete">
        <i class="fa fa-trash" data-id="{{ $user->id }}"></i>
    </button>
</form>

@if ($user->status === 'declined')
    <form class="d-inline" id={{"set-status-delegate-form-{$user->id}"}} action="{{ route('admin.users.set-status', ['id' => $user->id]) }}" method="POST">
        @csrf
        <button
            type="submit"
            data-id="{{ $user->id }}"
            class="btn btn-dark btn-sm js-set-status-delegate">
            <span data-id="{{ $user->id }}">Set status</span>
        </button>
    </form>
@endif
