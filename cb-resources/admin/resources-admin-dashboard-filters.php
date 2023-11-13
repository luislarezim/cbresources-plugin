<?php
/**
 * WordPress custom admin filters for 'resources-docs' post type.
 */

/**
 * Modifies the main query to filter 'resources-docs' post type by taxonomy in the admin dashboard.
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 */
function tsm_filter_resources_docs($query) {
    global $typenow;

    if ($typenow == 'resources-docs' && is_admin() && $query->is_main_query()) {
        $taxonomy = 'resources';

        if (isset($_GET[$taxonomy])) {
            $selected_term = filter_input(INPUT_GET, $taxonomy, FILTER_SANITIZE_STRING);

            if (!empty($selected_term)) {
                $query->set('tax_query', [
                    [
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $selected_term,
                    ],
                ]);
            }
        }
    }
}
add_action('pre_get_posts', 'tsm_filter_resources_docs');

/**
 * Adds a dropdown to filter 'resources-docs' post type by taxonomy in the admin dashboard.
 */
function tsm_filter_post_type_by_taxonomy() {
    global $typenow;
    $post_type = 'resources-docs';
    $taxonomy  = 'resources';

    if ($typenow === $post_type) {
        $selected = filter_input(INPUT_GET, $taxonomy, FILTER_SANITIZE_STRING);
        $info_taxonomy = get_taxonomy($taxonomy);

        wp_dropdown_categories([
            'show_option_all' => sprintf(__('Show all %s', 'textdomain'), $info_taxonomy->label),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
            'value_field'     => 'slug',
        ]);
    }
}
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');

/**
 * Adds a dropdown to filter 'resources-docs' post type by a custom field 'industry' in the admin dashboard.
 */
function custom_post_type_filter_industry() {
    global $typenow;
    $post_type = 'resources-docs';
    $custom_field = 'industry';

    if ($typenow === $post_type) {
        $field = get_field_object($custom_field);
        $value = filter_input(INPUT_GET, $custom_field, FILTER_SANITIZE_STRING);

        echo '<select name="' . esc_attr($custom_field) . '">';
        echo '<option value="">' . sprintf(__('Show All %s', 'textdomain'), $field['label']) . '</option>';

        foreach ($field['choices'] as $choice_value => $choice_label) {
            $selected = selected($value, $choice_value, false);
            echo '<option value="' . esc_attr($choice_value) . '"' . $selected . '>' . esc_html($choice_label) . '</option>';
        }
        echo '</select>';
    }
}
add_action('restrict_manage_posts', 'custom_post_type_filter_industry');

/**
 * Modifies the main query to include posts that match the selected custom field value 'industry'.
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 */
function custom_post_type_filter_industry1($query) {
    global $pagenow;
    $post_type = 'resources-docs';
    $custom_field = 'industry';

    if (isset($_GET[$custom_field]) && $pagenow === 'edit.php' && $query->query_vars['post_type'] === $post_type) {
        $term = filter_input(INPUT_GET, $custom_field, FILTER_SANITIZE_STRING);

        if (!empty($term)) {
            $query->set('meta_query', [
                [
                    'key'     => $custom_field,
                    'value'   => $term,
                    'compare' => 'LIKE',
                ],
            ]);
        }
    }
}
add_action('pre_get_posts', 'custom_post_type_filter_industry1');

/**
 * Adds a dropdown to filter 'resources-docs' post type by a custom field 'role' in the admin dashboard.
 */
function custom_post_type_filter_role() {
	global $typenow;
	$post_type = 'resources-docs';
	$custom_field = 'role'; // Change to 'role'

	if ($typenow === $post_type) {
			$field = get_field_object($custom_field);
			$value = filter_input(INPUT_GET, $custom_field, FILTER_SANITIZE_STRING);

			echo '<select name="' . esc_attr($custom_field) . '">';
			echo '<option value="">' . sprintf(__('Show All %s', 'textdomain'), $field['label']) . '</option>';

			foreach ($field['choices'] as $choice_value => $choice_label) {
					$selected = selected($value, $choice_value, false);
					echo '<option value="' . esc_attr($choice_value) . '"' . $selected . '>' . esc_html($choice_label) . '</option>';
			}
			echo '</select>';
	}
}
add_action('restrict_manage_posts', 'custom_post_type_filter_role');

/**
* Modifies the main query to include posts that match the selected custom field value 'role'.
*
* @param WP_Query $query The WP_Query instance (passed by reference).
*/
function custom_post_type_filter_role1($query) {
	global $pagenow;
	$post_type = 'resources-docs';
	$custom_field = 'role'; // Change to 'role'

	if (isset($_GET[$custom_field]) && $pagenow === 'edit.php' && $query->query_vars['post_type'] === $post_type) {
			$term = filter_input(INPUT_GET, $custom_field, FILTER_SANITIZE_STRING);

			if (!empty($term)) {
					$query->set('meta_query', [
							[
									'key'     => $custom_field,
									'value'   => $term,
									'compare' => 'LIKE',
							],
					]);
			}
	}
}
add_action('pre_get_posts', 'custom_post_type_filter_role1');

// End of custom admin filters for 'resources-docs' post type.
