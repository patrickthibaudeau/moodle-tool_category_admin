define([], function () {
    window.requirejs.config({
        paths: {
            "select2": M.cfg.wwwroot + '/admin/tool/category_admin/js/select2-4.0.3/dist/js/select2.min',
        },
        shim: {
            'select2': {exports: 'select2'},
        }
    });
});

