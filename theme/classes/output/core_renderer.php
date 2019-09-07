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

namespace theme_YOURTHEMENAME\output;

use moodle_url;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_boost
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_boost\output\core_renderer {

    public function get_blocked_themes() {
        global $COURSE, $DB;
        $blockedThemes = '';
        //We have to iterate through all categories because this could be a sub category
        $category = $DB->get_record('course_categories', ['id' => $COURSE->category]);
        if ($category) {
            //Convert path into array, remove empty values and reverse
            $categoryPath = array_reverse(array_filter(explode('/', $category->path)));
            //Find themes that must be removed.
            //First category to have plugins blocked overrides parent category
            foreach ($categoryPath as $key => $categoryId) {
                $params = [
                    'categoryid' => $categoryId,
                    'plugintype' => 'theme'
                ];

                if ($blockedThemes = $DB->get_records('tool_catadmin_categoryplugin', $params)) {
                    break;
                }
            }
            //Get blocked themes
            $themes = '';
            if ($blockedThemes) {
                foreach ($blockedThemes as $bt) {
                    $themes .= trim($bt->pluginname) . ',';
                }
            }


            return rtrim($themes, ',');
        }
    }

    public function get_blocked_formats() {
        global $COURSE, $DB;
        $blockedThemes = '';
        //We have to iterate through all categories because this could be a sub category
        $category = $DB->get_record('course_categories', ['id' => $COURSE->category]);
        if ($category) {
            //Convert path into array, remove empty values and reverse
            $categoryPath = array_reverse(array_filter(explode('/', $category->path)));
            //Find themes that must be removed.
            //First category to have plugins blocked overrides parent category
            foreach ($categoryPath as $key => $categoryId) {
                $params = [
                    'categoryid' => $categoryId,
                    'plugintype' => 'format'
                ];

                if ($blockedFormats = $DB->get_records('tool_catadmin_categoryplugin', $params)) {
                    break;
                }
            }
            //Get blocked themes
            $formats = '';
            if ($blockedFormats) {
                foreach ($blockedFormats as $bf) {
                    $formats .= trim(str_replace('format_', '', $bt->pluginname)) . ',';
                }
            }

            return rtrim($formats, ',');
        }
    }

    public function get_blocked_blocks() {
        global $COURSE, $DB;
        $blockedThemes = '';
        //We have to iterate through all categories because this could be a sub category
        $category = $DB->get_record('course_categories', ['id' => $COURSE->category]);
        if ($category) {
            //Convert path into array, remove empty values and reverse
            $categoryPath = array_reverse(array_filter(explode('/', $category->path)));
            //Find themes that must be removed.
            //First category to have plugins blocked overrides parent category
            foreach ($categoryPath as $key => $categoryId) {
                $params = [
                    'categoryid' => $categoryId,
                    'plugintype' => 'block'
                ];

                if ($blockedFormats = $DB->get_records('tool_catadmin_categoryplugin', $params)) {
                    break;
                }
            }
            //Get blocked themes
            $formats = '';
            if ($blockedFormats) {
                foreach ($blockedFormats as $bf) {
                    $formats .= trim(str_replace('block_', '', $bf->pluginname)) . ',';
                }
            }

            return rtrim($formats, ',');
        }
    }

}
