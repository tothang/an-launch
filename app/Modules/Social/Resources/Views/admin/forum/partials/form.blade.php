{!! Form::text(
    'title',
    old('title', $topic->title ?? ''),
    [
        'label' => 'Topic Title',
        'placeholder' => 'Enter title',
        'required' => true,
    ]
) !!}

<div class="form-group">
    <label for="pinned">Pinned</label>
    <input type="checkbox" name="pinned" {{ isset($topic) && $topic->pinned ? 'checked' : '' }}>
</div>
