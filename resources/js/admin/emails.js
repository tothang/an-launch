$(function () {
    $('#email-user-data-table').on('draw.dt', function () {
        let bulkSendBtn = $('.js-send-selected');
        let queueChunkBtn = $('.js-queue-chunk-button');
        let selected = [];

        // SELECTION
        function toggleSelected($id) {
            if (selected.includes($id)) {
                let index = selected.indexOf($id);
                if (index > -1) {
                    selected.splice(index, 1);
                }

                return;
            }

            return selected.push($id)
        }

        function showHideSubmit() {
            bulkSendBtn.addClass('hide');
            queueChunkBtn.removeClass('hide');
            bulkSendBtn.text('Send To Selected (' + selected.length + ')');

            if (selected.length > 0) {
                bulkSendBtn.removeClass('hide');
                // queueChunkBtn.addClass('hide');
            }
        }

        showHideSubmit();

        $('.js-add-to-selection').click((e) => {
            toggleSelected($(e.target).data('id'));
            showHideSubmit();
        })

        // CONFIRMATION
        $('.js-confirm-send').on('click', function (e) {
            e.preventDefault();

            let type = $(e.target).data('type')
            let textNode = $('.js-confirm-send-text')
            let valueNode = $('.js-selected-input')

            switch (type) {
                case 'send':
                    $(e.target).data('recently-emailed')
                        ? textNode.text($(e.target).data('name') + ' has been emailed recently, would you like to continue?')
                        : textNode.text('You are about to send ' + $(e.target).data('name') +' this email, would you like to continue?')
                    valueNode.val($(e.target).data('recipient'))
                    break;

                case 'chunk':
                    $(e.target).data('chunk') === 99999
                    ? textNode.text('You are about to send this email to every user that it hasn\'t been sent to yet, would you like to continue?')
                    : textNode.text('You are about to send ' + $(e.target).data('chunk') + ' emails, would you like to continue?')
                    valueNode.attr('name', 'chunk').val($(e.target).data('chunk'))

                    break;
                case 'selected':
                    textNode.text('You are about to send ' + selected.length + ' emails, would you like to continue?')
                    valueNode.val(selected)

                    break;
                case 'resend':
                    $(e.target).data('recently-emailed')
                        ? textNode.text($(e.target).data('name') + ' has been emailed recently, would you like to continue?')
                        : textNode.text('You are about to re-send ' + $(e.target).data('name') +' this email, would you like to continue?')
                    valueNode.val($(e.target).data('recipient'))

                    break;
            }

            $('.js-confirm-send-type').data('type', type)
            $('#js-confirm-send').modal('toggle')
        })
    })
})
