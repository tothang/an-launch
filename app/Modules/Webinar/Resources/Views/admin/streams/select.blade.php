
@extends('layouts.admin.app')

@section('page-title', $title)

@section('content')
  @component('admin.components.section', [
       'header' => 'Broadcast list',
       'create' => route('admin.streams.create'),
   ])

    <table class="table" id="broadcast-data-table">
      <thead>
      <tr>
        <th width="10px">#</th>
        <th style="min-width: 120px;">Name</th>
        <th>Embed Type</th>
        <th>Embed Code - English</th>
        <th>Embed Code - German</th>
        <th>Embed Code - French</th>
        <th>Embed Code - Spanish</th>
        <th>Embed Code - Italian</th>
        <th>Embed Code - Polish</th>
        <th>Embed Code - Russian</th>
        <th>Embed Code - Czech</th>
        <th>Embed Code - Dutch</th>
        <th>Is live</th>
        <th style="width: 120px">Actions</th>
      </tr>
      </thead>
      <tbody></tbody>
    </table>

  @endcomponent
@endsection

@push('js')
  <script>
    $(() => {
      $('#broadcast-data-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": @json(route('admin.broadcasts.datatable')),
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'embed_type', name: 'embed_type'},
          {data: 'embed_code_en', name: 'embed_code_en'},
          {data: 'embed_code_de', name: 'embed_code_de'},
          {data: 'embed_code_fr', name: 'embed_code_fr'},
          {data: 'embed_code_es', name: 'embed_code_es'},
          {data: 'embed_code_it', name: 'embed_code_it'},
          {data: 'embed_code_pl', name: 'embed_code_pl'},
          {data: 'embed_code_ru', name: 'embed_code_ru'},
          {data: 'embed_code_cs', name: 'embed_code_cs'},
          {data: 'embed_code_nl', name: 'embed_code_nl'},
          {data: 'is_live_status', name: 'is_live_status'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    } );
  </script>
@endpush
