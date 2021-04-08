<div id="notification-container" class="notification__container">
</div>

<script>
    const notificationContainer = document.getElementById('notification-container')

    notificationContainer.addEventListener("click", function(e) {
        let el = e.target
        if (el.className === "btn btn--primary notification__btn") {
            let notificationId = el.id
            let outerDiv = document.getElementById(`notification-${notificationId}`)
            outerDiv.remove()
        }
    })

    function openNotification(response) {
        if ($('#notification-'+response.notification.id).length) {
            return;
        }

        let notificationContent

        switch (response.notification.type) {
            case 'link':
                notificationContent = `<div class="notification__btn-wrap">
                    <a id="${response.notification.id}" href="{{ url('experience#media-name=${response.notification.link}') }}" class="btn btn--primary notification__btn">
                        Go to Zone
                    </a>
                </div>`;
                break;
            default:
                notificationContent = `<div class="notification__btn-wrap">
                    <button id="${response.notification.id}" class="btn btn--primary notification__btn">
                        Close
                    </button>
                </div>`;
        }

        let notification = `<div id="notification-${response.notification.id}" class="notification">
            <div class="notification__content">
                ${response.notification.title ? `<h3 class="notification__title">${response.notification.title}</h3>` : ''}
                ${response.notification.body ? `<p class="notification__text">${response.notification.body}</p>` : ''}
                ${notificationContent}
            </div>
        </div>`

        $('#notification-container').append(notification)
    }

    Echo.channel('notification')
        .listen('.SendNotification', (response) => {
            openNotification(response)
        })

    let segments = {!! $segments !!}
    segments.forEach(function (segment) {
        Echo.private(`notifications.${segment}`)
            .listen('.SendNotification', (response) => {
                openNotification(response)
            })
    })
</script>
