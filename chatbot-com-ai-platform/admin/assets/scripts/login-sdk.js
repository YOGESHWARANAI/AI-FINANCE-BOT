(function (scope, origin, clientId, utmSource) {
    var popup = null;
    var timeoutRef = null;
    var loginCallback = noop();

    function noop() {}
    function isFunc (variable) {
        return typeof variable === 'function'
    }
    function createPopup () {
        var width = 500;
        var height = 650;
        var y = window.top.outerHeight / 2 + window.top.screenY - ( height / 2);
        var x = window.top.outerWidth / 2 + window.top.screenX - ( width / 2);

        popup = window.open(
            origin + '/v2/authorize?client_id='+clientId+'&'+utmSource+'&response_type=token&redirect_uri=postmessage',
            'ChatBot',
            ['resizable=no', 'width='+width, 'height='+height, 'top='+y, 'left='+x].join(','));

        window.addEventListener('message', onMessage);
        recursivePopupCheck();
    }
    function destroyPopup () {
        if (popup && typeof isFunc(popup.close)) {
            popup.close();
        }

        popup = null;
        window.removeEventListener('message', onMessage);
        clearTimeout(timeoutRef);
    }
    function recursivePopupCheck () {
        if (!popup || popup.closed || !popup.window) {
            destroyPopup();
            return loginCallback();
        }

        timeoutRef = setTimeout(recursivePopupCheck, 100);
    }
    function onMessage (event) {
        if (
            event &&
            event.data &&
            event.data.access_token &&
            event.data.email
        ) {
            loginCallback(event.data);
            destroyPopup();
        }
    }
    function login (callback) {
        if (!isFunc(callback)) {
            return;
        }

        if (popup && typeof isFunc(popup.focus)) {
            return popup.focus();
        }

        loginCallback = callback;
        createPopup();
    }

    scope.login = login;
})(
    window.loginSDK = {},
    window.wpSdkConfig.origin,
    window.wpSdkConfig.clientId,
    window.wpSdkConfig.utmSource
);
