<?php

include_once('../config.php');
global $CFG, $DB, $PAGE;

$context = context_system::instance();
$PAGE->set_context($context);

$blocks = optional_param_array('blocks', [], PARAM_RAW);
$pluginType = required_param('plugintype', PARAM_TEXT);


//Delete all previous settings
$DB->delete_records('tool_catadmin_defaultplugin', ['plugintype' => $pluginType]);

if (count($blocks) != 0) {
    $params = [
        'plugintype' => $pluginType,
    ];
    for ($i = 0; $i < count($blocks); $i++) {
        $params['pluginname'] = $blocks[$i];
        $DB->insert_record('tool_catadmin_defaultplugin', $params);
        unset($params['pluginname']);
    }

//Go through each category and add the disabled blocks
    $categories = $DB->get_records('course_categories', []);

    foreach ($categories as $c) {
        $params['categoryid'] = $c->id;
        for ($i = 0; $i < count($blocks); $i++) {
            $params['pluginname'] = $blocks[$i];
            //Don't add it if it already exists
            if (!$exists = $DB->get_record('tool_catadmin_categoryplugin', $params)) {
                $params['userid'] = $USER->id;
                $params['timecreated'] = time();
                $DB->insert_record('tool_catadmin_categoryplugin', $params);
            }
            unset($params['pluginname']);
        }
        unset($params['categoryid']);
    }
}

