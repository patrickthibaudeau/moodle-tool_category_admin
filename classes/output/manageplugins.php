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
class manageplugins implements \renderable, \templatable {

    private $categoryId;

    public function __construct($categoryid) {
        global $CFG, $USER, $DB;

        $this->categoryId = $categoryid;
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
        $categories = \core_course_category::make_categories_list();
        $data = [
            'wwwroot' => $CFG->wwwroot,
            'categoryid' => $this->categoryId,
            'categoryname' => $categories[$this->categoryId],
            'modules' => $this->getModules(),
            'themes' => $this->getThemes()
        ];
        return $data;
    }

    private function getModules() {
        global $USER, $DB;
        //Get system modules
        $modules = $DB->get_records('modules', ['visible' => true]);
        //Get modules currently hidden in category
        $hiddenModules = $DB->get_records('tool_catadmin_categoryplugin', ['categoryid' => $this->categoryId, 'plugintype' => 'mod']);
        $hiddenModulesArray = [];
        $x = 0;
        foreach ($hiddenModules as $hm) {
            $hiddenModulesArray[$x] = $hm->pluginname;
            $x++;
        }
                

        $data = [];
        $i = 0;
        foreach ($modules as $m) {
            if (in_array($m->name,$hiddenModulesArray)) {
                $selected = 'selected=""';
            } else {
                $selected = '';
            }
            $data[$i]['shortname'] = $m->name;
            $data[$i]['name'] = get_string('pluginname', $m->name);
            $data[$i]['categoryid'] = $this->categoryId;
            $data[$i]['selected'] = $selected;
            $data[$i]['id'] = $m->id;
            $i++;
        }

        return $data;
    }
    
    private function getThemes() {
        global $USER, $DB;
        //Get system modules
        $sql = "SELECT DISTINCT(plugin) FROM {config_plugins} WHERE plugin LIKE '%theme%'";
        $themes = $DB->get_records_sql($sql);
        //Get modules currently hidden in category
        $hiddenThemes = $DB->get_records('tool_catadmin_categoryplugin', ['categoryid' => $this->categoryId, 'plugintype' => 'theme']);
        $hiddenThemesArray = [];
        $x = 0;
        foreach ($hiddenThemes as $ht) {
            $hiddenThemesArray[$x] = $ht->pluginname;
            $x++;
        }
                

        $data = [];
        $i = 0;
        foreach ($themes as $t) {
            $name = str_replace('theme_', '', $t->plugin);
            if (in_array($name,$hiddenThemesArray)) {
                $selected = 'selected=""';
            } else {
                $selected = '';
            }
            $data[$i]['shortname'] = $name;
            $data[$i]['name'] = get_string('pluginname', $t->plugin);
            $data[$i]['categoryid'] = $this->categoryId;
            $data[$i]['selected'] = $selected;
            $i++;
        }

        return $data;
    }

}
