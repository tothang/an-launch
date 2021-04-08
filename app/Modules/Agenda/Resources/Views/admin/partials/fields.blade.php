{!! Form::dateTime(
    'datetime',
    old('datetime', isset($agendaItem) ? $agendaItem->datetime->toDateTimeLocalString() : ''),
    [
        'label' => 'When',
        'required' => true,
    ]
) !!}

{!! Form::text(
    'title',
    old('title', $agendaItem->title ?? ''),
    [
        'label' => 'Title',
        'required' => true,
    ]
) !!}

{!! Form::textarea(
    'description',
    old('description', $agendaItem->description ?? ''),
    [
        'label' => 'Description',
        'required' => true,
    ]
) !!}
