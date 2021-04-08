@extends('layouts.app')

@section('title', 'Broadcast')

@section('body-class', isset($stream->theme) && $stream->theme !== '' ? 'theme--' . $stream->theme : '')

@section('content')
    <div class="text-center pt-4">
        <a href="{{ $stream->external_link }}" class="btn btn-primary">Go To - {{ $stream->name }}</a>
    </div>
@endsection
