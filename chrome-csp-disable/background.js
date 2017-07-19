var isActive = true;
var xFrame = 'x-frame-options';
var filter = {
    urls: ["*://*/*"],
    types: ["main_frame", "sub_frame"]
};
var callback = function(details) {
    if (!isActive) {
        return;
    }

    for (var i = 0; i < details.responseHeaders.length; i++) {
        if ('content-security-policy' === details.responseHeaders[i].name.toLowerCase()) {
            details.responseHeaders[i].value = '';
            console.info("ignoring 'csp'");
        } 
        
        if (xFrame == details.responseHeaders[i].name.toLowerCase()) {
            details.responseHeaders[i].value = '';
            console.info("ignoring 'X-Frame'");
        }
    }

    return {
        responseHeaders: details.responseHeaders
    };
};


chrome.webRequest.onHeadersReceived.addListener(callback, filter, ["blocking", "responseHeaders"]);


chrome.browserAction.onClicked.addListener(function(tab) {
    var state = isActive ? 'off' : 'on';
    var details = {
        path: "images/icon38-" + state + ".png"
    };
    chrome.browserAction.setIcon(details);
    isActive = !isActive;
});
