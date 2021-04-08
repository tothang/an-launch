<div class="tab__container">
    <ul class="nav nav-tabs tab__list mb-0" role="tablist">
        @if(module_enabled('questions'))
            <li role="presentation" class="nav-item tab__item">
                <a href="#questions" class="tab__link nav-link active" role="tab" data-toggle="tab">
                  {{ __('broadcast.ask_a_question') }}
                </a>
            </li>
        @endif
        {{-- @if(module_enabled('polls-and-quizzes'))
            <li role="presentation" class="nav-item tab__item">
                <a href="#poll-quiz" class="tab__link nav-link" role="tab" data-toggle="tab">Quiz</a>
            </li>
        @endif
        @if(module_enabled('wordclouds'))
            <li role="presentation" class="nav-item tab__item">
                <a href="#wordclouds" class="tab__link nav-link" role="tab" data-toggle="tab">Wordclouds</a>
            </li>
        @endif
        @if(module_enabled('breakout-rooms'))
            <li role="presentation" class="nav-item tab__item">
                <a href="#breakout-rooms" class="tab__link nav-link" role="tab" data-toggle="tab">Breakouts</a>
            </li>
        @endif --}}
    </ul>

    <div class="tab-content p-3 bg-brand-one">
        @if(module_enabled('questions'))
            <div role="tabpanel" class="tab-pane active" id="questions">
                @include('questions::partials.interaction')
            </div>
        @endif

        @if(module_enabled('polls-and-quizzes'))
            <div role="tabpanel" class="tab-pane" id="poll-quiz">
                @include('polls-and-quizzes::partials.interaction')
            </div>
        @endif
        @if(module_enabled('wordclouds'))
            <div role="tabpanel" class="tab-pane" id="wordclouds">
                @include('wordclouds::partials.interaction')
            </div>
        @endif
        @if(module_enabled('breakout-rooms'))
            <div role="tabpanel" class="tab-pane" id="breakout-rooms">
                @include('breakout-rooms::interaction')
            </div>
        @endif
    </div>
</div>
