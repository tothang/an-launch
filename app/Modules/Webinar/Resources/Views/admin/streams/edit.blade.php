@extends('layouts.admin.app')

@section('page-title', $title)

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header with-border">
        <h3 class="card-title">{{($stream->name ?: '') . ' broadcast'}}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.streams.index') }}" class="btn btn-info btn-sm">Back</a>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open([
            'url' => route('admin.streams.update', $stream),
            'method' => 'PUT',
        ], [
            'theme' => 'admin'
        ]) !!}

        @csrf

      @include('webinar::admin.streams.partials.form')

      {!! Form::submit(
          'submit',
          'Save'
      ) !!}

      {!! Form::close() !!}
    </div>
</div>
@endsection
