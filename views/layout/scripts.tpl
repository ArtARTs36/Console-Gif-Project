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
</script>
