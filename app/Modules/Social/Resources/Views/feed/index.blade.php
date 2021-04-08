@extends(View::exists('experience::layouts.app') ? 'experience::layouts.app' : 'layouts.app')

@section('title', 'Social Feed')

@section('content')
    <div id="react-social-feed"></div>
@endsection
