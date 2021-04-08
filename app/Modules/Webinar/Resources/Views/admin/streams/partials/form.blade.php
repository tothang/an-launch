{!! Form::text(
            'name',
            old('name', $stream->name ?? ''),
            [
                'label' => 'Name',
                'required' => true,
            ]
        ) !!}

{!! Form::buttonGroup(
    'is_live',
    old('is_live', $stream->is_live ?? 0),
    [
        0 => 'No',
        1 => 'Yes'
    ],
    [
        'label' => 'Is live?',
        'required' => true,
    ]
) !!}

{!! Form::select(
    'embed_type',
    ['Vimeo' => 'Vimeo'],
    old('type', $stream->embed_type ?? 'Vimeo'),
    [
        'label' => 'Embed type',
        'required' => true,
        'required' => true,
    ]
) !!}

{!! Form::text(
    'embed_code_en',
    old('embed_code_en', $stream->embed_code_en ?? ''),
    [
        'label' => 'Embed code - English',
    ]
) !!}

{!! Form::text(
    'embed_code_de',
    old('embed_code_de', $stream->embed_code_de ?? ''),
    [
        'label' => 'Embed code - German',
    ]
) !!}

{!! Form::text(
    'embed_code_fr',
    old('embed_code_fr', $stream->embed_code_fr ?? ''),
    [
        'label' => 'Embed code - French',
    ]
) !!}

{!! Form::text(
    'embed_code_es',
    old('embed_code_es', $stream->embed_code_es ?? ''),
    [
        'label' => 'Embed code - Spanish',
    ]
) !!}

{!! Form::text(
    'embed_code_it',
    old('embed_code_it', $stream->embed_code_it ?? ''),
    [
        'label' => 'Embed code - Italian',
    ]
) !!}

{!! Form::text(
    'embed_code_pl',
    old('embed_code_pl', $stream->embed_code_pl ?? ''),
    [
        'label' => 'Embed code - Polish',
    ]
) !!}

{!! Form::text(
    'embed_code_ru',
    old('embed_code_ru', $stream->embed_code_ru ?? ''),
    [
        'label' => 'Embed code - Russian',
    ]
) !!}

{!! Form::text(
    'embed_code_cs',
    old('embed_code_cs', $stream->embed_code_cs ?? ''),
    [
        'label' => 'Embed code - Czech',
    ]
) !!}

{!! Form::text(
    'embed_code_nl',
    old('embed_code_nl', $stream->embed_code_nl ?? ''),
    [
        'label' => 'Embed code - Dutch',
    ]
) !!}
