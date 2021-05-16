<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    $(function () {
        'use strict';

        let canvas_active = false;

        $('[data-toggle="offcanvas"]').on('click', function () {
            if (canvas_active === false) {
                $('.offcanvas-collapse').addClass('open');
                $('body').addClass('offcanvas-open');

                canvas_active = true;
            } else {
                $('.offcanvas-collapse').removeClass('open');
                $('body').removeClass('offcanvas-open');

                canvas_active = false;
            }
        })
    })

    function setCookie(name, value, options) {
        options = {
            path: '/',
            // при необходимости добавьте другие значения по умолчанию
            ...options
        };

        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function switchLanguage(lang)
    {
        setCookie('selected_language', lang, {secure: true, 'max-age': 3600});
        window.location.reload();
    }
</script>
