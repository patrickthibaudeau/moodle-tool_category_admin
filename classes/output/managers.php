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
class managers implements \renderable, \templatable {

    public function __construct() {
        global $CFG, $USER, $DB;
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
            'managers' => $this->getManagers()
        ];
        return $data;
    }

    private function getManagers() {
        $categories = \core_course_category::make_categories_list();
        $MANAGERS = new \tool_category_admin\Managers();
        $managers = $MANAGERS->getManagers();
        $managerArray = [];
        $i = 0;
        foreach ($managers as $m) {
            $category = $categories[$m->categoryid];
            $user = \core_user::get_user($m->userid);
            $managerArray[$i]['category'] = $category;
            $managerArray[$i]['name'] = fullname($user);
            $managerArray[$i]['id'] = $m->id;
            $i++;
        }
        
        return $managerArray;
    }

}
