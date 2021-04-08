@include('experience::modals.types.modal')
@include('experience::modals.types.modalSlider')
@include('experience::modals.types.welcomeModal')
@include('experience::modals.types.timeModal')

<script>
    const modal = document.getElementById('modal')
    const modalSlider = document.getElementById('sliderModal')
    const welcomeModal = document.getElementById('welcomeModal')
    const timeModal = document.getElementById('timeModal')

    const modalClose = document.getElementById('modalClose')
    const modalSliderClose = document.getElementById('sliderModalClose')
    const modalWelcomeClose = document.getElementById('welcomeModalClose')
    const modalTimeClose = document.getElementById('timeModalClose')

    // Show modals
    function clickInfo(info, isVideo) {
        //    $.post("/api/experience/views", {
        //       api_token: window.Laravel.apiToken,
        //       type: info
        //    })
        //    .done(function (data) {
        //        $('#modal').html(data)
        // //    })
        $('#vista-content-wrapper').empty()
        $('#vista-content-wrapper').append(info)
        modal.classList.remove('modal--hidden')
    }

    function clickInfoSlider() {
        modalSlider.classList.remove('modal--hidden')
    }

    function clickWelcomeModal() {
        welcomeModal.classList.remove('modal--hidden')
    }

    function clickTimeModal(breakout) {
        $('#timeModal').find('#timeModal-name').html(breakout.name);
        $('#timeModal').find('#timeModal-timestamp').html(breakout.time);
        timeModal.classList.remove('modal--hidden')
    }

    // Close modals
    modalSliderClose.addEventListener("click", function() {
        modalSlider.classList.add('modal--hidden')
    })

    modalWelcomeClose.addEventListener("click", function() {
        welcomeModal.classList.add('modal--hidden')
    })

    modalTimeClose.addEventListener("click", function() {
        timeModal.classList.add('modal--hidden')
    })

    // Pause video on modal close
    modalClose.addEventListener("click", function() {
        const video = document.getElementById("video")
        const iframe = document.getElementById('videoiframe');
        if (video) {
            video.pause()
        }
        if (iframe) {
            const iframeSrc = iframe.src;
            iframe.src = iframeSrc;
        }
        modal.classList.add('modal--hidden')
        player.resumeGlobalAudios()
    });
</script>
