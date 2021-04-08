$(function () {
    var pageViewId = null;

    if (window.Laravel.apiToken !== '') {
        window.addEventListener("load", function () {
            $.ajax('/api/analytics/page-view', {
                method: 'POST',
                data: {
                    track_url: window.location.pathname,
                    time_spent: 0,
                    api_token: window.Laravel.apiToken,
                },
                success: function (response) {
                    pageViewId = response.pageView;
                }
            });
        });

        TimeMe.initialize({
            idleTimeoutInSeconds: 10,
        });

        TimeMe.startTimer();

        window.addEventListener("beforeunload", function () {
            $.ajax('/api/analytics/page-view/update', {
                method: 'POST',
                data: {
                    page_view: pageViewId,
                    time_spent: TimeMe.getTimeOnCurrentPageInSeconds(),
                    api_token: window.Laravel.apiToken,
                }
            });
        });
    }
});
