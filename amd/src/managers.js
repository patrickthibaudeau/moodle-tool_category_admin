define(['jquery',
    'jqueryui',
    'core/notification',
    'core/config',
    'core/log', ],
        function ($,
                jqui,
                notification,
                mdlcfg,
                log
                ) {
            "use strict";

            /**
             * This is the function that is loaded
             * when the page is viewed.
             * @returns {undefined}
             */
            function initManagers() {
                deleteUser();
            }

            function deleteUser() {
                $(".btnDeleteUser").unbind();
                $(".btnDeleteUser").on("click", function (e) {
                    var id = $(this).data('id');
                    log.debug(id);


                    notification.confirm(M.util.get_string('delete', 'tool_category_admin'),
                            M.util.get_string('delete_manager', 'tool_category_admin'),
                            M.util.get_string('delete', 'tool_category_admin'),
                            M.util.get_string('cancel', 'tool_category_admin'), function () {
                        $.ajax({
                            method: "POST",
                            url: mdlcfg.wwwroot + 
                                    "/admin/tool/category_admin/ajax/managers.php",
                            data: '&id=' + id,
                            dataType: "html",
                            success: function (html) {
                                location.reload();
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                    });

//                    $.ajax({
//                        method: "POST",
//                        url: mdlcfg.wwwroot +
//                                "/admin/tool/category_admin/ajax/modules.php",
//                        data: formData,
//                        dataType: "html",
//                        success: function (formHtml) {
//                            notification.alert(
//                                    M.util.get_string('modules', 'tool_category_admin'),
//                                    M.util.get_string('modules_saved', 'tool_category_admin'),
//                                    M.util.get_string('close', 'tool_category_admin'),
//                                    );
//                        },
//                        error: function (err) {
//                            console.log(err);
//                        }
//                    });
                });
            }



            return {
                init: function () {
                    initManagers();
                }
            };
        });