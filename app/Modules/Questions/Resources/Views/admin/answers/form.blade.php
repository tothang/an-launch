<div class="form-group">
    <label for="question">Question</label>
    <textarea required name="question" rows="10" class="form-control">{{ old('question', isset($answer->question) ? $answer->question : null) }}</textarea>
</div>

<div class="form-group">
    <label for="answer">Answer</label>
    <textarea required name="answer" rows="10" class="form-control">{{ old('answer', isset($answer->answer) ? $answer->answer : null) }}</textarea>
</div>

<div class="form-group">
    <label for="asked_by">Asked By <small>(optional)</small></label>
    <input type="text" class="form-control" name="asked_by" value="{{ old('asked_by', isset($answer->asked_by) ? $answer->asked_by : null) }}">
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="visible">
            <input
                name="visible"
                type="checkbox"
                value="1"
                @if (old('visible', isset($answer->visible)) ? $answer->visible : true)
                checked
                @endif
            > Visible
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
