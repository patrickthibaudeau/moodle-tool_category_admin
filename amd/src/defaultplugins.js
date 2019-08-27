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
            function initManagePlugins() {
                updateModules();
                updateThemes();
                
                $('#mods').select2();
                $('#themes').select2();
            }

            function updateModules() {
                $("#toolCatAdminSaveModules").unbind();
                $("#toolCatAdminSaveModules").on("click", function (e) {
                    var formData = $('#toolCategoryAdminModules').serialize();
                    console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: mdlcfg.wwwroot +
                                "/admin/tool/category_admin/ajax/defaultmodules.php",
                        data: formData,
                        dataType: "html",
                        success: function (formHtml) {
                            notification.alert(
                                    M.util.get_string('modules', 'tool_category_admin'),
                                    M.util.get_string('modules_saved', 'tool_category_admin'),
                                    M.util.get_string('close', 'tool_category_admin')
                                    );
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                });
            }

            function updateThemes() {
                $("#toolCatAdminSaveThemes").unbind();
                $("#toolCatAdminSaveThemes").on("click", function (e) {
                    var formData = $('#toolCategoryAdminThemes').serialize();
                    console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: mdlcfg.wwwroot +
                                "/admin/tool/category_admin/ajax/defaultthemes.php",
                        data: formData,
                        dataType: "html",
                        success: function (formHtml) {
                            notification.alert(
                                    M.util.get_string('themes', 'tool_category_admin'),
                                    M.util.get_string('themes_saved', 'tool_category_admin'),
                                    M.util.get_string('close', 'tool_category_admin')
                                    );
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                });
            }

            return {
                init: function () {
                    initManagePlugins();
                }
            };
        });