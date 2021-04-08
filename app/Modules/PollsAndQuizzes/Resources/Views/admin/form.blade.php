<div class="form-group">
    <label for="type">Type</label>
    <select required name="type" class="form-control">
        <option selected disabled>Please select...</option>
        @foreach($types as $type)
            <option value="{{ $type }}" @if(isset($pollAndQuiz->type) && $pollAndQuiz->type === $type) selected="selected" @endif>{{ $type }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input required type="text" name="name" class="form-control" value="{{ old('name', isset($pollAndQuiz->name) ? $pollAndQuiz->name : null) }}">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea required name="description" rows="10" class="form-control">{{ old('description', isset($pollAndQuiz->description) ? $pollAndQuiz->description : null) }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
