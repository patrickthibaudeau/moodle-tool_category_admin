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
 * The main location configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    cos_approval
 * @copyright  2013 Oohoo IT Services Inc.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once("$CFG->dirroot/lib/formslib.php");

/**
 * Module instance settings form
 */
class edit_manager_form extends moodleform {

    function definition() {

        global $CFG, $USER, $DB;
        $formdata = $this->_customdata['formdata'];
        $mform = & $this->_form;

        $context = CONTEXT_SYSTEM::instance();

        $categories = core_course_category::make_categories_list();


//-------------------------------------------------------------------------------
// Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general'));
        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);
        $mform->addElement('select', 'categoryid', get_string('category', 'tool_category_admin'), $categories);
        $mform->setType('username', PARAM_INT);
//Instead of reinventing the wheel, use a user selector form existing plugin
        $options = [
            'ajax' => 'tool_dataprivacy/form-user-selector',
            'valuehtmlcallback' => function($value) {
                global $OUTPUT;

                $allusernames = get_all_user_name_fields(true);
                $fields = 'id, email, ' . $allusernames;
                $user = \core_user::get_user($value, $fields);
                $useroptiondata = [
                    'fullname' => fullname($user),
                    'email' => $user->email
                ];
                return $OUTPUT->render_from_template('tool_dataprivacy/form-user-selector-suggestion', $useroptiondata);
            }
        ];
        $mform->addElement('autocomplete', 'userid', get_string('requestfor', 'tool_dataprivacy'), [], $options);
        $mform->addRule('userid', null, 'required', null, 'client');


//-------------------------------------------------------------------------------
// add standard buttons, common to all modules
        $this->add_action_buttons();

// set the defaults
        $this->set_data($formdata);
    }

}
