<?php


namespace tool_category_admin;

class Base {

    /**
     * Creates the Moodle page header
     * @global \stdClass $CFG
     * @global \moodle_database $DB
     * @global \moodle_page $PAGE
     * @global \stdClass $SITE
     * @param string $url Current page url
     * @param string $pagetitle  Page title
     * @param string $pageheading Page heading (Note hard coded to site fullname)
     * @param array $context The page context (SYSTEM, COURSE, MODULE etc)
     * @return HTML Contains page information and loads all Javascript and CSS
     */
    public static function page($url, $pagetitle, $pageheading, $context, $pagelayout = 'admin') {
        global $CFG, $PAGE, $SITE;
        
        $stringman = get_string_manager();
        $strings = $stringman->load_component_strings('tool_category_admin', current_language());

        $PAGE->set_url($url);
        $PAGE->set_title($pagetitle);
        $PAGE->set_heading($pageheading);
        $PAGE->set_pagelayout($pagelayout);
        $PAGE->set_context($context);
        $PAGE->requires->strings_for_js(array_keys($strings), 'tool_category_admin');
    }

    /**
     * Sets filemanager options
     * @global \stdClass $CFG
     * @param \stdClass $context
     * @param int $maxfiles
     * @return array
     */
    public static function getFileManagerOptions($context, $maxfiles = 1) {
        global $CFG;
        return array('subdirs' => 0, 'maxbytes' => $CFG->maxbytes, 'maxfiles' => $maxfiles);
    }

    
    public static function getEditorOptions($context) {
        global $CFG;
        return array('subdirs' => 1, 'maxbytes' => $CFG->maxbytes, 'maxfiles' => -1,
            'changeformat' => 1, 'context' => $context, 'noclean' => 1, 'trusttext' => 0);
    }

}
