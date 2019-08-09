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
 * This page lists public api for tool_category_admin plugin.
 *
 * @package    tool_category_admin
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * This function extends the navigation with the tool items
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass        $course     The course to object for the tool
 * @param context         $context    The context of the course
 */
function tool_category_admin_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('tool/category_admin:managecategories', $context)) {
        $url = new moodle_url('/admin/tool/category_admin/managecategories.php', array('courseid' => $course->id));
        $settingsnode = navigation_node::create(get_string('manage_categories', 'tool_category_admin'), $url, navigation_node::TYPE_SETTING,
                null, null, new pix_icon('i/settings', ''));
        $reportnode = $navigation->get('courses');

        if (isset($settingsnode) && !empty($reportnode)) {
            $reportnode->add_node($settingsnode);
        }
    }
    
    if (has_capability('tool/category_admin:manageplugins', $context)) {
        $url = new moodle_url('/admin/tool/category_admin/manageplugins.php', array('courseid' => $course->id));
        $settingsnode = navigation_node::create(get_string('manage_plugins', 'tool_category_admin'), $url, navigation_node::TYPE_SETTING,
                null, null, new pix_icon('i/settings', ''));
        $reportnode = $navigation->get('courses');

        if (isset($settingsnode) && !empty($reportnode)) {
            $reportnode->add_node($settingsnode);
        }
    }
}
