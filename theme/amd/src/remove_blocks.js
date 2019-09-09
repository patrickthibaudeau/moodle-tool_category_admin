/* jshint ignore:start */
define(['jquery', 'core/log'], function ($, log) {

    "use strict"; // jshint ;

    log.debug('Remove blocks initialised');

    function init_blocks() {
        var blockedBlocks = $('#blocked_blocks').val();
        var blocks = blockedBlocks.split(',');
        var i;

        for (i = 0; i < blocks.length; i++) {
            console.log(blocks[i]);
            $('a[href*="&bui_addblock=' + blocks[i] + '"]').remove();
        }
    }

    return {
        init: function () {
            init_blocks();
        }
    };

});
/* jshint ignore:end */