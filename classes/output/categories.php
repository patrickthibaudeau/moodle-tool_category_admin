<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tool_category_admin\output;

/**
 * 
 * @global \stdClass $USER
 * @param \renderer_base $output
 * @return array
 */
class categories implements \renderable, \templatable {

    private $userId;

    public function __construct($userId = 0) {
        global $CFG, $USER, $DB;

        $this->userId = $userId;
    }

    /**
     * 
     * @global \stdClass $USER
     * @global \moodle_database $DB
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output) {
        global $CFG, $USER, $DB, $COURSE;

        $data = [
            'wwwroot' => $CFG->wwwroot,
            'categories' => $this->getCategories()
        ];
        return $data;
    }

    private function getCategories() {
        global $USER, $DB;
        $categories = \core_course_category::make_categories_list();
        $params = [];
        $params['userid'] = $this->userId;
        $context = \context_system::instance();

        $data = [];
        $i = 0;
        if ((is_siteadmin($USER->id)) || has_capability('tool/category_admin:managecategories', $context)) {
            $managedCategories = $DB->get_records('course_categories', []);
            foreach ($managedCategories as $mc) {
                $category = $categories[$mc->id];
                $data[$i]['category'] = $category;
                $data[$i]['categoryid'] = $mc->id;
                $i++;
            }
        } else {
            $managedCategories = $DB->get_records('tool_catadmin_managers', $params);
            foreach ($managedCategories as $mc) {
                $category = $categories[$mc->categoryid];
                $data[$i]['category'] = $category;
                $data[$i]['categoryid'] = $mc->categoryid;
                $data[$i]['id'] = $mc->id;
                $i++;
            }
        }
        
        usort($data, function ($item1, $item2) {
            return $item1['category'] <=> $item2['category'];
        });
        return $data;
    }

}
