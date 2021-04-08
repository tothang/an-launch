<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('experience::layouts.partials.head')

<body class="page page--experience brand--{{ $brand }}">
@yield('content')

<script src="{{ asset('js/experience.js') }}"></script>

@include('experience::sidebar.main')
@include('experience::modals.main')
@include('experience::notifications.main')

<script>
    const body = document.body
    const view = document.getElementById('viewer')
    const player = TDV.Tour.Script

    // Enable custom UI in full screen mode
    document.addEventListener("fullscreenchange", function() {
        if (!view.contains( modal )) {
            view.appendChild(modal)
            view.appendChild(modalSlider)
            view.appendChild(button)
            view.appendChild(sidebar)
            view.appendChild(notification)
        } else {
            view.removeChild(modal)
            body.appendChild(modal)
            view.removeChild(modalSlider)
            body.appendChild(modalSlider)
            view.removeChild(button)
            body.appendChild(button)
            view.removeChild(sidebar)
            body.appendChild(sidebar)
            view.removeChild(notification)
            body.appendChild(notification)
        }
    })

    // Prevent user from accessing Broadcast rooms too early
    function eventTimeChecker(room) {
        let time = {!! $upcomingBreakouts !!}[room].time
        let currentTime = new Date().toTimeString().split(' ')[0]

        if ((hmsToSeconds(time) - hmsToSeconds(currentTime)) > 600 ) {
            clickTimeModal({!! $upcomingBreakouts !!}[room])
        } else {
            window.location.href = `http://virtual-products-base.test/experience#media-name=${room}`
        }
    }

    // Convert date to sec
    function hmsToSeconds(s) {
        let b = s.split(':');
        return b[0] * 3600 + b[1] * 60 + (+b[2] || 0);
    }

    // Open Broadcast link
    function openBroadcast(broadcast) {
        let broadcastLink = `https://${window.location.hostname}/broadcast/${broadcast}`
        window.open(broadcastLink, '_blank')
    }

    // Add the page name into the URL
    function clickLocation(location) {
        window.location.href = '#media-name=' + location;
    }

    window.onload = () => {
        setTimeout(() => {
            clickWelcomeModal()
        }, 100)
    }

</script>

@stack('js')

</body>
</html>
