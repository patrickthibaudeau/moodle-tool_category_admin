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
            'themes' => $this->getThemes(),
            'blocks' => $this->getBlocks(),
            'formats' => $this->getFormats()
        ];
        return $data;
    }

    private function getModules() {
        global $USER, $DB;
        //Get system modules
        $modules = $DB->get_records('modules', ['visible' => true], 'name');
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
            if (in_array($m->name, $hiddenModulesArray)) {
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
        
        usort($data, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });

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
            if (in_array($name, $hiddenThemesArray)) {
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
        
        usort($data, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });

        return $data;
    }

    private function getBlocks() {
        global $USER, $DB;
        //Get system modules
        $modules = $DB->get_records('block', ['visible' => true]);
        //Get modules
        $hiddenModules = $DB->get_records('tool_catadmin_categoryplugin', ['categoryid' => $this->categoryId, 'plugintype' => 'block']);
        $hiddenModulesArray = [];
        $x = 0;
        foreach ($hiddenModules as $hm) {
            $hiddenModulesArray[$x] = $hm->pluginname;
            $x++;
        }


        $data = [];
        $i = 0;
        foreach ($modules as $m) {
            if (in_array($m->name, $hiddenModulesArray)) {
                $selected = 'selected=""';
            } else {
                $selected = '';
            }
            $data[$i]['shortname'] = $m->name;
            $data[$i]['name'] = get_string('pluginname', 'block_' . $m->name);
            $data[$i]['selected'] = $selected;
            $data[$i]['categoryid'] = $this->categoryId;
            $data[$i]['id'] = $m->id;
            $i++;
        }
        
        usort($data, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });
        
        return $data;
    }

    private function getFormats() {
        global $USER, $DB;
        //Get system modules
        $sql = "SELECT DISTINCT (plugin) FROM {config_plugins} WHERE plugin LIKE 'format_%'";
        $formats = $DB->get_records_sql($sql);
        //Get formats
        $hiddenFormats = $DB->get_records('tool_catadmin_categoryplugin', ['categoryid' => $this->categoryId, 'plugintype' => 'format']);
        $hiddenFormatsArray = [];
        $x = 0;
        foreach ($hiddenFormats as $hf) {
            $hiddenFormatsArray[$x] = $hf->pluginname;
            $x++;
        }

        $data = [];
        $i = 0;
        foreach ($formats as $f) {

            if (in_array(trim($f->plugin), $hiddenFormatsArray)) {
                $selected = 'selected=""';
            } else {
                $selected = '';
            }

            $data[$i]['shortname'] = $f->plugin;
            $data[$i]['name'] = get_string('pluginname', $f->plugin);
            $data[$i]['categoryid'] = $this->categoryId;
            $data[$i]['selected'] = $selected;
            $i++;
        }

        usort($data, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });

        return $data;
    }

}
