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

    if ($oldversion < 2019082601) {

        // Define table tool_catadmin_defaultplugin to be created.
        $table = new xmldb_table('tool_catadmin_defaultplugin');

        // Adding fields to table tool_catadmin_defaultplugin.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, '0');
        $table->add_field('categoryid', XMLDB_TYPE_INTEGER, '10', null, null, null, '0');
        $table->add_field('plugintype', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('pluginname', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '20', null, null, null, '0');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '20', null, null, null, '0');

        // Adding keys to table tool_catadmin_defaultplugin.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for tool_catadmin_defaultplugin.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Category_admin savepoint reached.
        upgrade_plugin_savepoint(true, 2019082601, 'tool', 'category_admin');
    }
    
    if ($oldversion < 2019082602) {

        // Define field categoryid to be dropped from tool_catadmin_defaultplugin.
        $table = new xmldb_table('tool_catadmin_defaultplugin');
        $field = new xmldb_field('categoryid');

        // Conditionally launch drop field categoryid.
        if ($dbman->field_exists($table, $field)) {
            $dbman->drop_field($table, $field);
        }

        // Category_admin savepoint reached.
        upgrade_plugin_savepoint(true, 2019082602, 'tool', 'category_admin');
    }

    return true;
}
