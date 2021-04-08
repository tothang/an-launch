<div class="mb-2">
    <a href="{{ route('admin.questions.select-stream') }}" class="btn btn-dark">Back to streams</a>

    <a href="{{ route('admin.questions.index', $stream) }}"
       class="btn {{ Route::is('admin.questions.index') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Manage</a>

    <a href="{{ route('admin.questions.moderation.index', $stream) }}"
       class="btn {{ Route::is('admin.questions.moderation.index') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Moderate</a>

    <a href="{{ route('admin.questions.facilitation.index', $stream) }}"
       class="btn {{ Route::is('admin.questions.facilitation.index') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Facilitate</a>

    <a href="{{ route('admin.questions.answers.index', $stream) }}"
       class="btn {{ Route::is('admin.questions.answers.index') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Answers</a>
</div>
