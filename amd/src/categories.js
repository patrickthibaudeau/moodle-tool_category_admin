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
            function initCategories() {
                $('#tool-category-admin').select2({
                    width: '50rem'
                });

                $('#tool-category-admin-modify').on('click', function () {
                    let id = $('#tool-category-admin').val();
                    if (id == 0) {
                        let title = M.util.get_string('error', 'tool_category_admin');
                        let desc = M.util.get_string('must_select_category', 'tool_category_admin');
                        notification.alert(title, desc, 'OK');
                    } else {
                        window.location = mdlcfg.wwwroot + '/admin/tool/category_admin/manageplugins.php?categoryid=' + id;
                    }
                });
            }
            return {
                init: function () {
                    initCategories();
                }
            };
        });