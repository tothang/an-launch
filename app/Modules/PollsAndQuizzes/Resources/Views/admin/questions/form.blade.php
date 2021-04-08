<div class="form-group">
    <label for="title">Title</label>
    <input required type="text" name="title" class="form-control" value="{{ old('title', isset($pollAndQuizQuestion->title) ? $pollAndQuizQuestion->title : null) }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
