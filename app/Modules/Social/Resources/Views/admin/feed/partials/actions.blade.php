<a href="{{ route('admin.social.feed.show', $post->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
<a href="{{ route('admin.social.feed.edit', $post->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

<form class="d-inline" action="{{ route('admin.social.feed.destroy', $post->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
    </button>
</form>
