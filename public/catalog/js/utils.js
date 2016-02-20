/**
 * Created by sislex on 20.02.16.
 */

var Cookie = {
    set: function (key, value, expireTime) {
        var expires = new Date();
        if (!expireTime)
            expires.setTime(expires.getTime() + (30 * 1 * 24 * 60 * 60 * 1000));
        else
            expires.setTime(expires.getTime() + expireTime);
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    },

    get: function (key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    },

    del: function (key) {
        document.cookie = key + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
};