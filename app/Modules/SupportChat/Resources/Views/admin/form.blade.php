{!! Form::buttonGroup('is_active',
    old('is_active', $supportChat->is_active),
    [
        1 => 'Active',
        0 => 'Inactive',
    ],
    [
        'class' => 'form-control',
        'label' => 'Status',
    ]
) !!}

<div class="js-live-chat--options">
  {!! Form::select('type',
      $types,
      old('type', $supportChat->type),
      [
          'class' => 'form-control',
          'label' => 'Widget Type',
          'placeholder' => 'Please select...',
      ]
  ) !!}

  {!! Form::text('name',
      old('name', $supportChat->name),
      [
          'class' => 'form-control',
          'label' => 'Widget Name'
      ]
  ) !!}

  {!! Form::text('api_token',
      old('api_token', $supportChat->api_token),
      [
          'class' => 'form-control',
          'label' => 'API Token'
      ]
  ) !!}

  {!! Form::color('colour',
      old('colour', $supportChat->colour),
      [
          'class' => 'form-control',
          'label' => 'Colour'
      ]
  ) !!}

  {!! Form::color('background_colour',
      old('background_colour', $supportChat->background_colour),
      [
          'class' => 'form-control',
          'label' => 'Background Colour'
      ]
  ) !!}
</div>

{!! Form::submit(
    'submit',
    'Submit'
) !!}

@push('js')
  <script>
    showHideSupportChatOptions();

    $('#is_active-btns .btn').on('click', function () {
        showHideSupportChatOptions()
    })

    function showHideSupportChatOptions()
    {
        let supportChatOptions = $('.js-support-chat--options');

        if ($('#is_active').val() == 0) {
            supportChatOptions.hide();
        } else {
            supportChatOptions.show()
        }
    }
  </script>
@endpush
