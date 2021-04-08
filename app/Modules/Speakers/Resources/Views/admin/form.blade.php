<div class="form-group">
    <label for="name">Name</label>
    <input required type="text" name="name" class="form-control" value="{{ old('name', isset($speaker->name) ? $speaker->name : null) }}">
</div>

<div class="form-group">
    <label for="name">Bio <small class="text-muted">Optional</small></label>
    <textarea name="bio" class="form-control" rows="10">{{ old('bio', isset($speaker->bio) ? $speaker->bio : '') }}</textarea>
</div>

<div class="form-group">
    <label for="job_title">Job Title <small class="text-muted">Optional</small></label>
    <input type="text" name="job_title" class="form-control" value="{{ old('job_title', isset($speaker->job_title) ? $speaker->job_title : null) }}">
</div>

<div class="form-group">
    <label for="job_description">Job Description <small class="text-muted">Optional</small></label>
    <textarea name="job_description" class="form-control" rows="10">{{ old('job_description', isset($speaker->job_description) ? $speaker->job_description : '') }}</textarea>
</div>

<div class="form-group">
    <label for="day">Day Active</label>
    <input required type="number" name="day" class="form-control" value="{{ old('day', isset($speaker) ? $speaker->day : 1) }}">
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="questionable">
            <input
                    name="questionable"
                    type="checkbox"
                    value="1"
                    @if (old('questionable', isset($speaker->questionable)) ? $speaker->questionable : true)
                    checked
                    @endif
            > Appears on Questions dropdown
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="agendable">
            <input
                    name="agendable"
                    type="checkbox"
                    value="1"
                    @if (old('agendable', isset($speaker->agendable)) ? $speaker->agendable : true)
                    checked
                    @endif
            > Appears on Agenda dropdown
        </label>
    </div>
</div>

<div class="form-group">
    <label for="image">Speaker Image</label><br>
    @if(isset($speaker))
        <img src="/{{ $speaker->getImage() }}" width="200" class="img-fluid img-thumbnail"><br>
    @endif
    <input type="file" name="image">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success pull-right">Submit</button>
</div>
