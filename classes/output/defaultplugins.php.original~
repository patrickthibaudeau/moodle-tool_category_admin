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
class defaultplugins implements \renderable, \templatable {

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
            'modules' => $this->getModules(),
            'themes' => $this->getThemes()
        ];
        return $data;
    }

    private function getModules() {
        global $USER, $DB;
        //Get system modules
        $modules = $DB->get_records('modules', ['visible' => true]);
        //Get modules
        $hiddenModules = $DB->get_records('tool_catadmin_defaultplugin', ['plugintype' => 'mod']);
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
        //Get themes
        $hiddenThemes = $DB->get_records('tool_catadmin_defaultplugin', ['plugintype' => 'theme']);
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
            $data[$i]['selected'] = $selected;
            $i++;
        }

        return $data;
    }

}
