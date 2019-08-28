<?php

include_once('../config.php');
global $CFG, $DB, $PAGE;

$context = context_system::instance();
$PAGE->set_context($context);

$categoryId = required_param('categoryid', PARAM_INT);
$modules = optional_param_array('blocks', [], PARAM_RAW);
$pluginType = required_param('plugintype', PARAM_TEXT);


//Delete all previous settings
$DB->delete_records('tool_catadmin_categoryplugin', ['categoryid' => $categoryId, 'plugintype' => $pluginType]);

if (count($modules) != 0) {
    $params = [
        'categoryid' => $categoryId,
        'userid' => $USER->id,
        'plugintype' => $pluginType,
        'timecreated' => time()
    ];
    for ($i = 0; $i < count($modules); $i++) {
        $params['pluginname'] = $modules[$i];
        $DB->insert_record('tool_catadmin_categoryplugin', $params);
        unset($params['pluginname']);
    }
}

