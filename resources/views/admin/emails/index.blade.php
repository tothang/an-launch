@extends('layouts.admin.app')

@section('page-title', 'Emails')

@section('content')
    <h4>Select an email to send</h4>
    @foreach(array_chunk($emails, 4) as $chunk)
        <div class="row my-3">
            @foreach($chunk as $email)
                @if($email == 'save-the-date-yale')
                    @include('admin.emails.partials.email-item', [
                        'email' => $email,
                        'title' => 'Save the date Emails - Yale'
                    ])
                @elseif($email == 'save-the-date-hyster')
                    @include('admin.emails.partials.email-item', [
                        'email' => $email,
                        'title' => 'Save the date Emails - Hyster'
                    ])
                @elseif($email == 'invite-yale')
                    @include('admin.emails.partials.email-item', [
                        'email' => $email,
                        'title' => 'Invitation Emails - Yale'
                    ])
                @elseif($email == 'invite-hyster')
                    @include('admin.emails.partials.email-item', [
                        'email' => $email,
                        'title' => 'Invitation Emails - Hyster'
                    ])
                @elseif($email == 'reminder-yale')
                  @include('.admin.emails.partials.email-item', [
                      'email' => $email,
                      'title' => 'Reminder Emails - Yale'
                  ])
                @elseif($email == 'reminder-hyster')
                  @include('admin.emails.partials.email-item', [
                      'email' => $email,
                      'title' => 'Reminder Emails - Hyster'
                  ])
                @elseif($email == 'apology')
                    @include('admin.emails.partials.email-item', [
                        'email' => $email,
                        'title' => 'Apology Emails'
                    ])
                @else
                    @include('admin.emails.partials.email-item', [$email])
                @endif
            @endforeach
        </div>
    @endforeach

    @include('admin.emails.partials.queue-info')

    @component('admin.components.section', ['header' => 'Email log'])
        <table class="table" id="log-data-table">
            <thead>
            <th width="30px">#</th>
            <th>Type</th>
            <th>User</th>
            <th>Sent At</th>
            </thead>
            <tbody></tbody>
        </table>
    @endcomponent
@endsection

@push('js')
    <script>
        $(function () {
            $('#log-data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": @json(route('admin.emails.datatable')),
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'type', name: 'type'},
                    {data: 'user', name: 'user'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        } );
    </script>
@endpush
