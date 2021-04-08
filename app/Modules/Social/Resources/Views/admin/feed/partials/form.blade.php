{!! Form::text(
    'body',
    old('body', $post->body ?? ''),
    [
        'label' => 'Post',
        'placeholder' => 'Enter post',
        'required' => true,
    ]
) !!}

<div class="form-group">
    <label for=image>Image</label><br>
    <input type="file" class="my-2" name="image"/>
</div>

<div class="form-group">
    <label for="pinned">Pinned</label>
    <input type="checkbox" name="pinned" {{ isset($post) && $post->pinned ? 'checked' : '' }}>
</div>
