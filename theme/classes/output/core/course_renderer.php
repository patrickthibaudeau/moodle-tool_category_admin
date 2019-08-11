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
 * Course renderer.
 *
 * @package    theme_YOURTHEMENAME
 * @copyright  2019 York University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_YOURTHEMENAME\output\core;

defined('MOODLE_INTERNAL') || die();

use moodle_url;
use html_writer;
use coursecat;
use coursecat_helper;
use stdClass;
use course_in_list;

/**
 * Renderers to align Glendon's course elements to what is expect
 *
 * @package    theme_YOURTHEMENAME
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {    

    /**
     * Return modchooser modal.
     * @return string
     */
    public function course_modchooser($modules, $course) {
        global $OUTPUT, $COURSE;
        if (!$this->page->requires->should_create_one_time_item_now('core_course_modchooser')) {
            return '';
        }
        $modchooser = new \theme_YOURTHEMENAME\output\modchooser($course, $modules);

        return $this->render($modchooser);
    }

}