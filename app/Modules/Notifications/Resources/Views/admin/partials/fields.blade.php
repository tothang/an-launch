{!! Form::select(
    'is_global',
    [
        1 => 'Yes',
        0 => 'No'
    ],
    old('is_global', $notification->is_global ?? 0),
    [
        'label' => 'Global?',
    ]
) !!}

<div class="{{ 'form-group show-if-not-global ' . old('is_global', isset($notification) && $notification->isGlobal() ? 'hidden' : '')}}">
    <label for="segments">Segments</label>
    <select name="segments[]" class="form-control selectpicker" multiple>
        @foreach($segments as $key => $segment)
            <option value="{{ $key }}" {{ isset($notification) && in_array($segment, $notification->segments->pluck('name')->toArray()) ? 'selected=selected' : '' }}>{{ $segment }}</option>
        @endforeach
    </select>
</div>

{!! Form::select(
    'type',
    $types,
    old('type', $notification->type ?? ''),
    [
        'label' => 'Types',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'title',
    old('title', $notification->title ?? ''),
    [
        'label' => 'Title',
    ]
) !!}

{{--{!! Form::textarea(--}}
{{--    'body',--}}
{{--    old('body', $notification->body ?? ''),--}}
{{--    [--}}
{{--        'label' => 'Body',--}}
{{--    ]--}}
{{--) !!}--}}

{{--{!! Form::text(--}}
{{--    'link',--}}
{{--    old('link', $notification->link ?? ''),--}}
{{--    [--}}
{{--        'label' => 'Link',--}}
{{--        'groupClasses' => 'hide-if-type-change show-if-type-link'--}}
{{--    ]--}}
{{--) !!}--}}
{!! Form::text(
              'content_en',
              old('content_en', $notification->content_en ?? ''),
              [
                  'label' => 'Content - English',
              ]
            ) !!}

{!! Form::text(
    'content_de',
    old('content_de', $notification->content_de ?? ''),
    [
        'label' => 'Content - German',
    ]
) !!}

{!! Form::text(
    'content_fr',
    old('content_fr', $notification->content_fr ?? ''),
    [
        'label' => 'Content - French',
    ]
) !!}

{!! Form::text(
    'content_es',
    old('content_en', $notification->content_es ?? ''),
    [
        'label' => 'Content - Spanish',
    ]
) !!}

{!! Form::text(
    'content_it',
    old('content_it', $notification->content_it ?? ''),
    [
        'label' => 'Content - Italian',
    ]
) !!}

{!! Form::text(
    'content_pl',
    old('content_pl', $notification->content_pl ?? ''),
    [
        'label' => 'Content - Polish',
    ]
) !!}

{!! Form::text(
    'content_ru',
    old('content_ru', $notification->content_ru ?? ''),
    [
        'label' => 'Content - Russian',
    ]
) !!}

{!! Form::text(
    'content_cs',
    old('content_cs', $notification->content_cs ?? ''),
    [
        'label' => 'Content - Czech',
    ]
) !!}

{!! Form::text(
    'content_nl',
    old('content_nl', $notification->content_nl ?? ''),
    [
        'label' => 'Content - Dutch',
    ]
) !!}

{!! Form::dateTime(
    'send_at',
    old('send_at', isset($notification) ? $notification->send_at->toDateTimeLocalString() : ''),
    [
        'label' => 'Send at',
    ]
) !!}

@push('js')
    <script>
        function toggleNonGlobalFields(node) {
            $(node).find('option:selected').val() == 1
                ? $('.show-if-not-global').addClass('hidden')
                : $('.show-if-not-global').removeClass('hidden')
        }

        function toggleTypeSpecificFields(node) {
            $('.hide-if-type-change').addClass('hidden')
            $('.show-if-type-' + $(node).find('option:selected').val()).removeClass('hidden')
        }

        toggleNonGlobalFields(
            $('#is_global').change(function () {
                toggleNonGlobalFields(this)
            })
        )

        toggleTypeSpecificFields(
            $('#type').change(function () {
                toggleTypeSpecificFields(this)
            })
        )
    </script>
@endpush
