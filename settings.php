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
 * Links and settings
 *
 * This file contains links and settings used by tool_monitor
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

$context = context_system::instance();
// Manage category administrators.
$temp = new admin_externalpage(
        'toolcategoryadmin',
        get_string('manage_category_managers', 'tool_category_admin'),
        new moodle_url('/admin/tool/category_admin/managers.php', array('courseid' => 0)),
        'tool/category_admin:managecategories'
);
$ADMIN->add('courses', $temp);

$temp = new admin_externalpage(
        'toolcategoryadmindefaultplugins',
        get_string('set_default_plugins', 'tool_category_admin'),
        new moodle_url('/admin/tool/category_admin/defaultplugins.php', array('courseid' => 0)),
        'tool/category_admin:managecategories'
);
$ADMIN->add('courses', $temp);

if (has_capability('tool/category_admin:manageplugins', $context)) {
    $temp = new admin_externalpage(
            'toolcategoryadminplugins',
            get_string('manage_plugins', 'tool_category_admin'),
            new moodle_url('/admin/tool/category_admin/categories.php', array('courseid' => 0)),
            'tool/category_admin:manageplugins'
    );
    $ADMIN->add('courses', $temp);
}
