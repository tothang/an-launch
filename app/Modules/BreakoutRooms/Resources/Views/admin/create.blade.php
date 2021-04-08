@extends('layouts.admin.app')

@section('page-title', 'Breakout rooms')

@section('content')
    @component('admin.components.section', [
        'header' => 'Create breakout',
        'back' => route('admin.breakouts.index'),
    ])
        <form action="{{ route('admin.breakouts.store') }}" method="POST">
            @csrf
            @include('breakout-rooms::admin.partials.fields')
            <button type="submit" class="btn btn-success">
                Submit
            </button>
        </form>
    @endcomponent
@endsection
