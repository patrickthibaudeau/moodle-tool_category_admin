/* jshint ignore:start */
define(['jquery', 'core/log'], function ($, log) {

    "use strict"; // jshint ;

    log.debug('Blocked themes initialised');

    function init_theme() {
        var themeAccess = $('#theme_access').val();
        var blockedThemes = $('#blocked_themes').val();
        var themes = blockedThemes.split(',');
        var path = window.location.pathname;
        var t;
        var m;

        if ((path.includes('/course/edit.php'))) {
            for (t = 0; t < themes.length; t++) {
                console.log(themes[t]);
                $("#id_theme option[value='" + themes[t] + "']").remove();
            }
        }

    }

    return {
        init: function () {
            init_theme();
        }
    };

});
/* jshint ignore:end */