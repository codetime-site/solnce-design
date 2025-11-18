<?php
add_action('pre_get_posts', 'exclude_templates_category');
function exclude_templates_category($query)
{
    if (!is_admin() && $query->is_main_query()) {
        $templates_cat = get_term_by('slug', 'templates', 'category');
        if ($templates_cat) {
            $query->set('category__not_in', array($templates_cat->term_id));
        }
    }
}