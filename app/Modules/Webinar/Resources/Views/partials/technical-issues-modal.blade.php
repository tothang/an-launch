@push('modal-stack')
    <div class="modal fade" id="tech-issues" tabindex="-1" role="dialog" aria-labelledby="tech-issues">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        @if(\App\Config::getBoolFromCache('technical_issues_title'))
                            {{ \App\Config::getFromCache('technical_issues_title') }}
                        @else
                            {{ config('technical.issue.default_title') }}
                        @endif
                    </h4>
                </div>

                <div class="modal-body">
                    <p>
                        @if(\App\Config::getBoolFromCache('technical_issues_message'))
                            {{ \App\Config::getFromCache('technical_issues_message') }}
                        @else
                            {{config('technical.issue.default_message')}}
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ url('/') }}">Refresh page</a>
                </div>

            </div>
        </div>
    </div>
@endpush
