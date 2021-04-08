{!! Form::text(
    'ref',
    old('ref', $content->ref ?? ''),
    [
        'label' => 'Reference Code',
        'placeholder' => 'Enter reference code',
        'required' => true,
    ]
) !!}

{!! Form::select(
    'type',
    $types,
    old('surname', $content->type ?? ''),
    [
        'label' => 'Type',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'name',
    old('name', $content->name ?? ''),
    [
        'label' => 'Name',
        'placeholder' => 'Enter Name',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'body',
    old('body', $content->body ?? ''),
    [
        'label' => 'Body',
        'placeholder' => 'Enter body content',
        'required' => true,
    ]
) !!}
