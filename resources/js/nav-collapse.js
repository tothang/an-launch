function adjustCollapseView() {
    let desktopView = $(document).width();
    let toggle =  $(".navigation__toggle");
    let collapse =  $(".navigation__collapse");

    if (desktopView >= "992") {
        toggle.attr("data-toggle", "");
        toggle.addClass("collapsed");
        collapse.removeClass('show')
    } else {
        toggle.attr("data-toggle", "collapse");
    }
}

$(function () {
    adjustCollapseView();
    $(window).on("resize", function () {
        adjustCollapseView();
    });
});
