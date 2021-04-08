<div class="notification hidden">
  <div class="wrapper">
    <div class="main">
      <div class="icon">
        <img src="{{ isHyster() ? '/img/hyster/icons/ring.png' : '/img/yale/icons/ring.png' }}" width="30" alt="ring">
      </div>
      <div class="content">
        <div class="title">
          Session starting
        </div>
        <div class="description">
          The Auditorium broadcast is starting in 3 minutes
        </div>
      </div>
    </div>
    <div class="action">
      <span class="dismiss"><i class="fa fa-times" aria-hidden="true"></i> Dismiss</span>
      <span class="goto"><i class="fa fa-blind" aria-hidden="true"></i> Go to Auditorium</span>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('.dismiss').on('click', function() {
      $('.notification').addClass('hidden');
    })

    var lang = "{{ optional(auth()->user())->Locale ?? 'en' }}"

    window.Echo.private('notifications.all').listen('.SendNotification', function (e) {
      var noti = e.notification;
      var body = noti['content_' + lang]
      var title = noti['title']
      if (window.location.href.includes('broadcast') && body !== null){
        $('.title').html(title)
        $('.description').html(body)
        $('.notification').removeClass('hidden')
      }
    });

  </script>
@endpush
