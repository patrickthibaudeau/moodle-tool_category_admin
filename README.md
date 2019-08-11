# Category Manager #

The category manager will allow you to add users who can manage category module plugins and themes. Category managers will be able to select Modules and themes to disable.

To make the category manager work, you must make modifications within your theme. 

## Theme modifications ##
You will find inside the category_admin folder a theme folder. The folder structure is similar to that of a theme to make it easier for you to understand where files are supposed to go within your theme. Follow these instructions to the letter to avoid errors.

You will also need to modify files within your theme.
## Modifying the Module Chooser ##
The module chooser is the modal that pops up when you click the add an activity or resource link within course sections. We need to override the mod_chooser in order for this to work.

> **!Important**: Before copying any file into your theme, make sure that file does not already exist in your theme. You DO NOT want to overwrite your existing files

**course\_renderer.php**
Check to see if you already have the course\_renderer.php file in your theme. It will be in the theme folder:

    classes/output/core/

if you already have the course\_renderer.php file, copy the following code into your file.

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



> Remember to replace YOURTHEMENAME by your actual theme name

If you don't have the file, create the folder classes/output/core, if it does not already exist and copy the course\_renderer.php to this new folder. As above, remember to replace YOURTHEMENAME by your theme name.

**Mod chooser files**
Copy the modchooser.php and modchooser\_item.php files into the classes\output folder. Open the two files and replace YOURTHEMENAME by your theme name. DO NOT MAKE ANY OTHER MODIFICATIONS

**core\_rendere.php**
Check to see if you have a core\_renderer.php file wihtin your theme. IT will be in the classes\output folder.

If you do, open the file and copy the following code.

        public function get_blocked_themes() {
        global $COURSE, $DB;

        //We have to iterate through all categories because this could be a sub category
        $category = $DB->get_record('course_categories', ['id' => $COURSE->category]);
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

If you do not have that file, copy it and remember to replace YOURTHEMENAME by your theme name.

**Templates**


Create the folder templates/core in your theme if it doesn't already exists.

Copy chooser.mustache into this new folder

Make no modifications to the file.

## Removing themes ##

In order to remove themes from the drop down list available in course settings, the following must be done.You only need to do this if you allow users to change the themes at course levels.

Make sure your theme has the amd folder with both the src and build folders within it. If it doesn't, create an amd folder in your theme.

Once you have those folders, copy the blocked\_themes.js and blocked\_themes.min.js into their appropriate folders.

**header.mustache**

You will need to modify the header.mustache file. Open the header.mustache found in this theme folder and copy the following code and paste it at the end of your header.mustache file.

    <input type="hidden" id="blocked_themes" value="{{{output.get_blocked_themes}}}">

{{#js}}
require(['theme_YOURTHEMENAME/blocked_themes'], function(mod) {
mod.init();
});
{{/js}}

## End ##
Update your theme version so that these changes can be loaded. open the version.php file and modify the $plugin->version value. 

Upgrade your Moodle installation. That should do it.