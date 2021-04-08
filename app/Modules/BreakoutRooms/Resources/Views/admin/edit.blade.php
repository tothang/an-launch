@extends('layouts.admin.app')

@section('page-title', 'Breakout rooms')

@section('content')
    @component('admin.components.section', [
        'header' => 'Edit breakout',
        'back' => route('admin.breakouts.index'),
    ])
        <form action="{{ route('admin.breakouts.update', $breakout) }}" method="POST">
            @csrf
            @method('PUT')
            @include('breakout-rooms::admin.partials.fields')
            <button type="submit" class="btn btn-success">
                Save
            </button>
        </form>
    @endcomponent
@endsection
