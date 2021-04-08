@extends('layouts.admin.app')

@section('page-title', $stream->name . ' reports')

@section('content')
    <h4>Click a report to download it</h4>
    <a href="{{ route('admin.reports') }}" class="btn btn-danger mt-2">Back to general reports</a>
    <div class="row mt-4">
        @foreach($reports as $report)
            <div class="col-sm-3">
                <a href="{{ route('admin.reports.download', [$report, $stream]) }}">
                    <div class="small-box small-box--selectable bg-dark">
                        <div class="inner">
                            <h5>{{ display_classname($report) }}</h5>
                        </div>
                        <div class="icon icon--small icon--report"><i class="fa fa-file"></i></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
