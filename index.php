<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This page lets users to manage rules for a given course.
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/category_admin/lib.php');

$courseid = optional_param('courseid', 0, PARAM_INT);

// Use the user context here so that the header shows user information.
$PAGE->set_context(context_user::instance($USER->id));

// Set up the page.
$indexurl = new moodle_url('/admin/tool/category_admin/index.php', array('courseid' => $courseid));
$PAGE->set_url($indexurl);
$PAGE->set_pagelayout('report');
$PAGE->set_title(get_string('pluginname', 'tool_category_admin'));
$PAGE->set_heading(fullname($USER));
$settingsnode = $PAGE->settingsnav->find('category_admin', null);
if ($settingsnode) {
    $settingsnode->make_active();
}

echo $OUTPUT->header();




echo $OUTPUT->footer();
