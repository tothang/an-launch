<div class="form-group">
    <label for="value">Value</label>
    <input required type="text" name="value" class="form-control" value="{{ old('value', isset($pollAndQuizAnswer->value) ? $pollAndQuizAnswer->value : null) }}">
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="correct">
            <input
                name="correct"
                type="checkbox"
                value="1"
                @if (old('correct', isset($pollAndQuizAnswer->correct)) ? $pollAndQuizAnswer->correct : false)
                    checked
                @endif
            > Correct
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
