<?php
// catalog_func.php

// Удаляем дублирующуюся функцию get_category_by_type, так как она теперь в functions.php
// function get_category_by_type($category_id, $type, $taxonomy = 'category') { ... }

function get_child_categories($parent_slug, $taxonomy = 'category') {
    $parent_category = get_term_by('slug', $parent_slug, $taxonomy);
    if (!$parent_category) return [];
    $child_categories = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'parent' => $parent_category->term_id
    ));
    $options = [];
    if (!is_wp_error($child_categories)) {
        foreach ($child_categories as $category)
            $options[$category->slug] = $category->name;
    }
    return $options;
}

function get_child_terms($parent_slug, $taxonomy = 'category') {
    $parent_term = get_term_by('slug', $parent_slug, $taxonomy);
    if (!$parent_term) return [];
    $child_terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
        'parent' => $parent_term->term_id
    ));
    $options = [];
    if (!is_wp_error($child_terms)) {
        foreach ($child_terms as $term)
            $options[$term->slug] = $term->name;
    }
    return $options;
}

function generate_select_options($options, $default_text) {
    ?>
    <option value=""><?php echo esc_html($default_text); ?></option>
    <?php foreach ($options as $value => $label): ?>
        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
    <?php endforeach ?>
    <?php
}

?>