<?php

namespace tool_category_admin\output;
/**
 * Description of renderer
 *
 * @author patrick
 */
class renderer extends \plugin_renderer_base {
    
    public function render_managers(\templatable $managers) {
        $data = $managers->export_for_template($this);
        return $this->render_from_template('tool_category_admin/managers', $data);
    }
    
    public function render_categories(\templatable $categories) {
        $data = $categories->export_for_template($this);
        return $this->render_from_template('tool_category_admin/categories', $data);
    }
    
    public function render_manageplugins(\templatable $manageplugins) {
        $data = $manageplugins->export_for_template($this);
        return $this->render_from_template('tool_category_admin/manageplugins', $data);
    }
    
}

