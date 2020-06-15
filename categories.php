<?php

require_once('config.php');

/**
 * Display the content of the page
 * @global stdobject $CFG
 * @global moodle_database $DB
 * @global core_renderer $OUTPUT
 * @global moodle_page $PAGE
 * @global stdobject $SESSION
 * @global stdobject $USER
 */
function display_page() {
    // CHECK And PREPARE DATA
    global $CFG, $OUTPUT, $SESSION, $PAGE, $DB, $USER;
    $COURSE;

    require_login(1, FALSE);

    //Set principal parameters
    $context = CONTEXT_SYSTEM::instance();

    if (!has_capability('tool/category_admin:manageplugins', $context)) {
        redirect($CFG->wwwroot);
    }

    $url = new moodle_url('/admin/tool/category_admin/managers.php', array());
    $PAGE->requires->css(new moodle_url('/admin/tool/category_admin/js/select2-4.0.3/dist/css/select2.min.css'));
    echo \tool_category_admin\Base::page($url, get_string('pluginname', 'tool_category_admin'), get_string('category_managers', 'tool_category_admin'), $context);

//--------------------------------------------------------------------------
    echo $OUTPUT->header();
    //**********************
    //*** DISPLAY HEADER ***
    $output = $PAGE->get_renderer('tool_category_admin');
    $categories = new \tool_category_admin\output\categories($USER->id);
    echo $output->render_categories($categories);

    //*** DISPLAY FOOTER ***
    //**********************
    echo $OUTPUT->footer();
}

display_page();
?>
