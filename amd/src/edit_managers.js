define(['jquery',
    'jqueryui',
    'core/notification',
    'core/config',
    'tool_category_admin/select2'],
        function ($,
                jqui,
                notification,
                mdlcfg,
                select2
                ) {
            "use strict";

            /**
             * This is the function that is loaded
             * when the page is viewed.
             * @returns {undefined}
             */
            function initEditManagers() {
                $('#id_categoryid').select2({
                    width: '50rem'
                });               
            }
            return {
                init: function () {
                    initEditManagers();
                }
            };
        });