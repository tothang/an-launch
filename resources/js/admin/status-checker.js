$(function () {
    $.ajax({
       url: '/admin/check-status',
       success: function (response) {
           var icon = 'down'
           var text = 'Oops!'

           var $statusIcon = $('.status-icon')

           if (response == '200') {
               icon = 'up'
               text = 'OK!'
           }

           if (response === '401' || response === '403') {
               icon = 'warning'
               text = 'Htpasswd Active!'
           }

           $statusIcon.removeClass('fa fa-spinner fa-pulse')
           $statusIcon.addClass('icon')
           $statusIcon.addClass(icon)
           $('.status-text').html(text)
       }
   })
});
