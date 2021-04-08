@extends('layouts.admin.app')

@section('content')
    <section class="content">
        @foreach($dashboardItems->chunk(4) as $group)
            <div class="row mt-3">
                @foreach($group as $item)
                    @include('admin.partials.dashboard-item', $item)
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
