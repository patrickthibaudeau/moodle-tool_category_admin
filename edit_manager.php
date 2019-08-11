<?php

require_once('config.php');
include("edit_manager_form.php");

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
    $id = optional_param('id', 0, PARAM_INT);

    //Set principal parameters
    $context = CONTEXT_SYSTEM::instance();

    if (!has_capability('tool/category_admin:managecategories', $context)) {
        redirect($CFG->wwwroot);
    }

    if ($id) {
        $formdata = $DB->get_record('tool_catadmin_managers', array('id' => $id), '*', MUST_EXIST);
    } else {
        $formdata = new stdClass();
    }

    $mform = new edit_manager_form(null, array('formdata' => $formdata));

// If data submitted, then process and store.
    if ($mform->is_cancelled()) {
        redirect($CFG->wwwroot . '/admin/tool/category_admin/managers.php');
    } else if ($data = $mform->get_data()) {
        unset($data->username);
        $data->timemodifed = time();
        if ($data->id) {
            $DB->update_record('tool_catadmin_managers', $data);
        } else {
            $data->timecreated = time();
            $DB->insert_record('tool_catadmin_managers', $data);
        }
//        add user to role
        $role = $DB->get_record('role', ['shortname' => 'pluginmanager']);
        role_assign($role->id, $data->userid, $context->id);
        redirect($CFG->wwwroot . '/admin/tool/category_admin/managers.php');
    }

    $url = new moodle_url('/admin/tool/category_admin/edit_manager.php', array('id' => $id));

    echo \tool_category_admin\Base::page($url, get_string('pluginname', 'tool_category_admin'), get_string('manager', 'tool_category_admin'), $context);
    //--------------------------------------------------------------------------
    echo $OUTPUT->header();
    //**********************
    //*** DISPLAY HEADER ***

    $mform->display();
    //**********************
    //*** DISPLAY FOOTER ***
    //**********************
    echo $OUTPUT->footer();
}

display_page();
?>
