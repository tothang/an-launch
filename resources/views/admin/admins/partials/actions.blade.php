<a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

<form class="d-inline" id={{"delete-form-{$admin->id}"}} action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button
        type="submit"
        data-id="{{ $admin->id }}"
        class="btn btn-danger btn-sm js-delete">
        <i class="fa fa-trash" data-id="{{ $admin->id }}"></i>
    </button>
</form>

<form class="d-inline" id={{"temp-password-form-{$admin->id}"}} action="{{ route('admin.set-temp-password', [class_basename($admin), $admin->id]) }}" method="POST">
    @csrf
    <button
        type="submit"
        data-id="{{ $admin->id }}"
        class="btn btn-dark btn-sm js-temp-password">
        <i class="fa fa-key" data-id="{{ $admin->id }}"></i>
    </button>
</form>
