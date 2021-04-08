<form class="d-inline" action="{{ route('admin.social.comment.destroy', [$comment->id]) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
    </button>
</form>
