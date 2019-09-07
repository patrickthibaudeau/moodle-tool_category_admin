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
                updateBlocks();
                updateFormat();

                $('#mods').select2();
                $('#themes').select2();
                $('#blocks').select2();
                $('#courseFormat').select2();
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

            function updateBlocks() {
                $("#toolCatAdminSaveBlocks").unbind();
                $("#toolCatAdminSaveBlocks").on("click", function (e) {
                    var formData = $('#toolCategoryAdminBlocks').serialize();
                    console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: mdlcfg.wwwroot +
                                "/admin/tool/category_admin/ajax/defaultblocks.php",
                        data: formData,
                        dataType: "html",
                        success: function (formHtml) {
                            notification.alert(
                                    M.util.get_string('blocks', 'tool_category_admin'),
                                    M.util.get_string('blocks_saved', 'tool_category_admin'),
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

            function updateFormat() {
                $("#toolCatAdminSaveCourseFormat").unbind();
                $("#toolCatAdminSaveCourseFormat").on("click", function (e) {
                    var formData = $('#toolCategoryAdminCourseFormat').serialize();
                    console.log(formData);
                    $.ajax({
                        method: "POST",
                        url: mdlcfg.wwwroot +
                                "/admin/tool/category_admin/ajax/defaultformat.php",
                        data: formData,
                        dataType: "html",
                        success: function (formHtml) {
                            notification.alert(
                                    M.util.get_string('course_format', 'tool_category_admin'),
                                    M.util.get_string('course_format_saved', 'tool_category_admin'),
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