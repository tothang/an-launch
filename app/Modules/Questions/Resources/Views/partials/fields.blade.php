{!! Form::text(
    'from',
    $question->from ?? '',
    [
        'label' => 'Your name',
        'placeholder' => 'Enter your name',
        'required' => true,
    ]
) !!}

@if(module_enabled('speakers'))
    <label for="to">Who is your question for?</label>
    <select name="to" class="form-control selectpicker" required>
        @foreach($speakers as $speaker)
            <option value="{{ $speaker }}"
                {{ old('to', isset($question) ? $question->to : '') ? 'selected="selected"' : '' }}>
                {{ $speaker }}
            </option>
        @endforeach
    </select>
@else
    {!! Form::text(
        'to',
        old('to', isset($question) ? $question->to : ''),
        [
            'label' => 'Who\'s is your question for?',
            'required' => true,
        ]
    ) !!}
@endif

{!! Form::textarea(
    'question',
    old('question', isset($question) ? $question->question : ''),
    [
        'label' => 'Your question',
        'required' => true,
    ]
) !!}
