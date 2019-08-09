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
 * Upgrade scirpt for tool_monitor.
 *
 * @package    tool_category_admin
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade the plugin.
 *
 * @param int $oldversion
 * @return bool always true
 */
function xmldb_tool_category_admin_upgrade($oldversion) {
    global $CFG, $DB;
    
    $dbman = $DB->get_manager();

    if ($oldversion < 2019080803) {

        // Define table tool_catadmin_administrators to be renamed to NEWNAMEGOESHERE.
        $table = new xmldb_table('tool_catadmin_administrators');

        // Launch rename table for tool_catadmin_administrators.
        $dbman->rename_table($table, 'tool_catadmin_managers');

        // Category_admin savepoint reached.
        upgrade_plugin_savepoint(true, 2019080803, 'tool', 'category_admin');
    }


    return true;
}
