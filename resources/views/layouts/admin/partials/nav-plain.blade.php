<header class="plain">
	@if(Auth::user()->host)
		<a href="{{ route('admin.webinar.host') }}" class="btn btn-black" {{ isActiveRoute('admin.webinar.host') }}><i class="fa fa-thumbs-up"></i> Host</a>
	@endif
	@if(Auth::user()->moderate)
		<a href="{{ route('admin.webinar.moderate') }}" class="btn btn-black" {{ isActiveRoute('admin.webinar.moderate') }}><i class="fa fa-edit"></i> Moderator</a>
	@endif
		<a href="{{ \Request::fullUrl() }}" class="btn btn-black"><i class="fa fa-refresh"></i> Refresh</a>
        Logged in users: {{ App\User::whereHas('loginLogs')->count() }}
</header>
