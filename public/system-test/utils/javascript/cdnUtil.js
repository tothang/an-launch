var CdnUtil = new Object();

CdnUtil.getCdnUrl = function(cdnPrefix, sourceUrl) {
	if(!sourceUrl) return "";
	if(!cdnPrefix) return sourceUrl;
	if(sourceUrl.indexOf(window.location.hostname) == -1) {
		return sourceUrl;
	}

	return cdnPrefix + sourceUrl.replace(/https?:\/\/[a-z0-9]*.[a-z0-9]*.com/, "")
}
