const CookieService = {
    setCookie(name, value, days, path = '/', secure = true, sameSite = 'Lax') {
        if (this.getCookie(name) !== null) {
            console.log('Cookie with the name ' + name + ' already exists.');
            return;
        }

        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        const secureFlag = secure ? '; Secure' : '';
        const sameSiteFlag = '; SameSite=' + sameSite;
        document.cookie = name + '=' + encodeURIComponent(JSON.stringify(value)) + expires + '; path=' + path + secureFlag + sameSiteFlag;
    },
    getCookie(name) {
        const cookies = document.cookie.split(';');
        for (const cookie of cookies) {
            if (cookie.trim().indexOf(name + '=') === 0) {
                try {
                    return JSON.parse(decodeURIComponent(cookie.split('=')[1]));
                } catch (error) {
                    return null;
                }
            }
        }
        return null;
    }
};