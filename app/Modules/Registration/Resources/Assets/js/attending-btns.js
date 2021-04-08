$(document).ready(function () {
    attendingButtons()

    // Events
    $('#attending-btns a').on('click', function () {
        attendingButtons()
    })
});

function attendingButtons () {
    var attendingValue = $('#attending').val()

    $('.show-if-attending').addClass('hide')
    $('.show-if-not-attending').removeClass('hide')

    if (attendingValue === '1') {
        $('.show-if-not-attending').addClass('hide')
        $('.show-if-attending').removeClass('hide')
    }
}
