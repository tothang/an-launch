$('.radioBtn a').on('click', function () {
    var sel = $(this).data('value')
    var tog = $(this).data('toggle')
    $('#' + tog).prop('value', sel)

    $('a[data-toggle="' + tog + '"]').not('[data-value="' + sel + '"]')
    .removeClass('active')
    .removeClass('btn-primary')
    .addClass('not-active')
    .addClass('btn-default')
    $('a[data-toggle="' + tog + '"][data-value="' + sel + '"]')
    .removeClass('not-active')
    .removeClass('btn-default')
    .addClass('active')
    .addClass('btn-primary')
})

$('.button-checkbox').each(function () {
    // Settings
    var $widget = $(this)
    var $button = $widget.find('button')
    var $checkbox = $widget.find('input:checkbox')
    var color = $button.data('color')
    var settings = {
        on: {
            icon: 'glyphicon glyphicon-check'
        },
        off: {
            icon: 'glyphicon glyphicon-unchecked'
        }
    }

    // Event Handlers
    $button.on('click', function () {
        $checkbox.prop('checked', !$checkbox.is(':checked'))
        $checkbox.triggerHandler('change')
        updateDisplay()
    })
    $checkbox.on('change', function () {
        updateDisplay()
    })

    // Actions
    function updateDisplay () {
        var isChecked = $checkbox.is(':checked')

        // Set the button's state
        $button.data('state', (isChecked) ? 'on' : 'off')

        // Set the button's icon
        $button.find('.state-icon')
        .removeClass()
        .addClass('state-icon ' + settings[$button.data('state')].icon)

        // Update the button's color
        if (isChecked) {
            $button
            .removeClass('btn-default')
            .addClass('btn-' + color + ' active')
        } else {
            $button
            .removeClass('btn-' + color + ' active')
            .addClass('btn-default')
        }
    }

    // Initialization
    function init () {
        updateDisplay()

        // Inject the icon if applicable
        if ($button.find('.state-icon').length === 0) {
            $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ')
        }
    }

    init()
})


// TODO - do we need to keep this??
$('body').on('click', '.radio', function (evt) {
    evt.stopPropagation();
    // Ignore label clicks so the click event doesn't run twice.
    if ($(evt.target).is("label")) {
        return;
    }
    var $input = $(this).find('input[type="radio"]');
    var radioGroupName = $input.attr('name');
    $('[name="' + radioGroupName + '"]').closest('.radio').removeClass('selected');
    $(this).addClass('selected');
});
$('body').on('click', '.checkbox', function (evt) {
    evt.stopPropagation();
    // Ignore label clicks so the click event doesn't run twice.
    if( $(evt.target).is("label") ) {
        return;
    }
    var $checkbox = $(this);
    console.log($checkbox)
    if ($checkbox.hasClass('selected')) {
        $checkbox.removeClass('selected');
    } else {
        $checkbox.addClass('selected');
    }
});
