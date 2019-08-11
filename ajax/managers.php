<?php
include_once('../config.php');
global $CFG, $DB, $PAGE;

$context = context_system::instance();
$PAGE->set_context($context);

$id = required_param('id', PARAM_INT);


//Delete all previous settings
$DB->delete_records('tool_catadmin_managers', ['id' => $id]);


