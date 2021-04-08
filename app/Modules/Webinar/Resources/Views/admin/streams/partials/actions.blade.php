<a href="/admin/stream/{{$stream->id}}/questions" class="btn btn-warning btn-sm"><i class="fa fa-comments"></i></a>
<a href="{{ route('admin.streams.edit', $stream->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

<form class="d-inline" id={{"delete-form-{$stream->id}"}} action="{{ route('admin.streams.destroy', $stream->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="stream_id" value="{{$stream->id}}">
    <button
        type="submit"
        onclick="return confirm('Are you sure?')"
        data-id="{{ $stream->id }}"
        class="btn btn-danger btn-sm js-delete">
        <i class="fa fa-trash" data-id="{{ $stream->id }}"></i>
    </button>
</form>
