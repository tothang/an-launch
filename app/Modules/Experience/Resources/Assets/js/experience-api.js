$(function () {
    if (window.Laravel.apiToken !== '') {
        $('#apiDataButtonExample').on('click', function () {
            $.post("/api/experience/data",
                {
                    api_token: window.Laravel.apiToken,
                    type: $(this).data('type'),
                })
            .done(function (data) {
                console.log(data)
            });
        })

        $.post("/api/experience/views",
            {
                api_token: window.Laravel.apiToken,
                type: $('#apiViewExample').data('type'),
            })
        .done(function (data) {
            $('#apiViewExample').html(data)
        });
    }
})
