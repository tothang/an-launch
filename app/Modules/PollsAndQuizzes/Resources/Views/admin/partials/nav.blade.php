<div class="mb-2">
    <a href="{{ route('admin.poll-and-quiz.select-stream') }}" class="btn btn-dark">Back to streams</a>

    <a href="{{ route('admin.poll-and-quiz.index', $stream) }}"
       class="btn {{ Route::is('admin.poll-and-quiz.index') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Manage</a>

    <a href="{{ route('admin.poll-and-quiz.host', $stream) }}"
       class="btn {{ Route::is('admin.poll-and-quiz.host') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Host</a>

    <a href="{{ route('admin.poll-and-quiz.leaderboard', $stream) }}"
       class="btn {{ Route::is('admin.poll-and-quiz.leaderboard') ? 'btn-primary' : 'btn-outline-primary' }}"
    >Leaderboard</a>
</div>
