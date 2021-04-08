$(function () {
    $('#user-data-table').on('draw.dt', function () {
        // Temp passwords
        $('.js-temp-password').click((e) => {
            e.preventDefault();
            $('.js-temp-password-model-id').val($(e.target).data('id'));
            $('#js-temp-password-check').modal();
        })
        $('.js-confirm-temp-password').click(() => {
            $('#temp-password-form-' + $('.js-temp-password-model-id').val()).submit();
        })

        // Deleting a user
        $('.js-delete').click((e) => {
            e.preventDefault();
            $('.js-delete-id').val($(e.target).data('id'));
            $('#js-delete-check').modal();
        })

        $('.js-confirm-delete').click(() => {
            $('#delete-form-' + $('.js-delete-id').val()).submit();
        })

        // Set status for delegate
        $('.js-set-status-delegate').click((e) => {
            e.preventDefault();
            $('.js-set-status-delegate-model-id').val($(e.target).data('id'));
            $('#js-set-status-delegate-check').modal();
        });
        $('.js-confirm-set-status-delegate').click(() => {
            $('#set-status-delegate-form-' + $('.js-set-status-delegate-model-id').val()).submit();
        })
    })
})
