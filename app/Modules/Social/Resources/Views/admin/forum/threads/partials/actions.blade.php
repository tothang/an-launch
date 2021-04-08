<a href="{{ route('admin.social.forum.thread.show', [$thread->topic, $thread->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
<form class="d-inline" action="{{ route('admin.social.forum.thread.destroy', [$thread->topic, $thread->id]) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
    </button>
</form>
