(function()
{
    var deviceType = TDV.PlayerAPI.mobile ? 'mobile' : 'general';
    var devicesUrl = { "general": window.s3Asset("3dvista/script_general.js?v=1596622548812") };
    var url = deviceType in devicesUrl ? devicesUrl[deviceType] : devicesUrl['general'];
    if(typeof url == "object") {
        var orient = TDV.PlayerAPI.getOrientation();
        if(orient in url) {
            url = url[orient];
        }
    }
    var link = document.createElement('link');
    link.rel = 'preload';
    link.href = url;
    link.as = 'script';
    var el = document.getElementsByTagName('script')[0];
    el.parentNode.insertBefore(link, el);
})();
