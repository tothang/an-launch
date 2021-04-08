<div class="form-group">
    <label for="question">Question</label>
    <input name="question" class="form-control" value="{{ old('title', isset($wordcloud->question) ? $wordcloud->question : null) }}" required>
</div>

<div class="form-group">
    <label for="character_limit">Character Limit <small class="text-muted">Max: 255</small></label>
    <input type="number" name="character_limit" max="255" min="5" class="form-control" value="{{ old('character_limit', isset($wordcloud->character_limit) ? $wordcloud->character_limit : 20) }}">
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="active">
            <input
                name="active"
                type="checkbox"
                value="1"
                @if (old('active', isset($wordcloud) ? $wordcloud->active : false))
                    checked
                @endif
            > Active
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
