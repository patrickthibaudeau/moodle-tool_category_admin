<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tool_category_admin;

/**
 * Description of Managers
 *
 * @author patrick
 */
class Managers {
    /**
     *
     * @var \stdClass
     */
    private $managers;
    
    /**
     *
     * @var string 
     */
    private $table;
    
    /**
     * 
     * @global \moodle_database $DB
     */
    public function __construct() {
        global $DB;
        $this->table = 'tool_catadmin_managers';
        $this->managers = $DB->get_records($this->table);
    }
    
    function getManagers() {
        return $this->managers;
    }

}
