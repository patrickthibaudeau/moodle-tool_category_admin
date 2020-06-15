<?php

include_once('../config.php');
global $CFG, $DB, $PAGE;

$context = context_system::instance();
$PAGE->set_context($context);

$categoryId = required_param('categoryid', PARAM_INT);
$themes = optional_param_array('themes', [], PARAM_RAW);
$pluginType = required_param('plugintype', PARAM_TEXT);
$recursive = optional_param('recursive', 0, PARAM_INT);

//Delete all previous settings
$DB->delete_records('tool_catadmin_categoryplugin', ['categoryid' => $categoryId, 'plugintype' => $pluginType]);

if (count($themes) != 0) {
    $params = [
        'categoryid' => $categoryId,
        'userid' => $USER->id,
        'plugintype' => $pluginType,
        'timecreated' => time()
    ];
    for ($i = 0; $i < count($themes); $i++) {
        $params['pluginname'] = $themes[$i];
        $DB->insert_record('tool_catadmin_categoryplugin', $params);
        unset($params['pluginname']);
    }
}

if ($recursive) {
    $children = \tool_category_admin\Base::getChildCategories($categoryId);
    for ($x = 0; $x < count($children); $x++) {
        $DB->delete_records('tool_catadmin_categoryplugin', ['categoryid' => $children[$x], 'plugintype' => $pluginType]);
        if (count($themes) != 0) {
            $params = [
                'categoryid' => $children[$x],
                'userid' => $USER->id,
                'plugintype' => $pluginType,
                'timecreated' => time()
            ];
            for ($y = 0; $y < count($themes); $y++) {
                $params['pluginname'] = $themes[$y];
                $DB->insert_record('tool_catadmin_categoryplugin', $params);
                unset($params['pluginname']);
            }
        }
    }
}