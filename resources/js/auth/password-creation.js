$(document).ready(function () {
    setMarginTopBtnSubmit();

    $(window).resize(function () {
        setMarginTopBtnSubmit();
    });


    function setMarginTopBtnSubmit() {
        if ($('.page-hyster-password-creation').length == 0) {
            return;
        }

        $(".page-hyster-password-creation button[type=submit]").css('margin-top', '25px');
        if ($(window).width() > 567) {
            return;
        }

        setTimeout(function () {
            let height = Math.abs($('.page-hyster-password-creation .container').outerHeight() - $('.page-hyster-password-creation .row').outerHeight()) + 25 ;
            $(".page-hyster-password-creation button[type=submit]").css('margin-top', height + 'px');
        });
    }
})