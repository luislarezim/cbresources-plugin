<?php

/*****RESOURCES type DASHBOARD FILTER *****/

// Add an action that will be called before the query is executed.
add_action('pre_get_posts', 'tsm_filter_resources_docs');

// This function modifies the query to filter posts of type 'resources-docs' by taxonomy.
function tsm_filter_resources_docs($query) {
    // Access the global $typenow variable to get the type of the current post.
    global $typenow;

    // Check if the post type is 'resources-docs', we're in the admin area and this is the main query.
    if ($typenow == 'resources-docs' && is_admin() && $query->is_main_query()) {
        $taxonomy = 'resources';

        // Check if the 'resources' parameter is present in the URL.
        if (isset($_GET[$taxonomy])) {
            $selected_term = sanitize_text_field($_GET[$taxonomy]);

            // Set the query to filter posts by the selected category.
            $query->set('tax_query', array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $selected_term,
                ),
            ));
        }
    }
}

// Add an action to restrict posts by taxonomy.
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');

// This function adds a dropdown to filter posts in the admin area by a taxonomy.
function tsm_filter_post_type_by_taxonomy() {
	// Access the global $typenow variable to get the type of the current post.
	global $typenow;

	// Define the post type and taxonomy we're interested in.
	$post_type = 'resources-docs';
	$taxonomy  = 'resources';

	// If the current post type is the one we're interested in...
	if ($typenow == $post_type) {
			// Get the taxonomy value selected in the filter, if any.
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';

			// Get information about the taxonomy.
			$info_taxonomy = get_taxonomy($taxonomy);

			// Display a dropdown of all terms of this taxonomy.
			wp_dropdown_categories(array(
					'show_option_all' => sprintf(__('Show all %s', 'textdomain'), $info_taxonomy->label),
					'taxonomy'        => $taxonomy,
					'name'            => $taxonomy,
					'orderby'         => 'name',
					'selected'        => $selected,
					'show_count'      => true,
					'hide_empty'      => true,
					'value_field'     => 'slug',
			));
	}
}

 /*****DASHBOARD industry FILTER *****/

// This function adds a dropdown filter in the admin area for a custom field of a specific post type.
function custom_post_type_filter_industry() {
	// Access the global $typenow variable to get the type of the current post.
	global $typenow;

	// Define the post type and custom field we're interested in.
	$post_type = 'resources-docs';
	$custom_field = 'industry'; // Change 'industry' to your custom field name

	// If the current post type is the one we're interested in...
	if ($typenow == $post_type) {
			// Get information about the custom field.
			$field = get_field_object($custom_field);

			// Get the custom field value selected in the filter, if any.
			$value = isset($_GET[$custom_field]) ? $_GET[$custom_field] : '';

			// Display a dropdown of all possible values of this custom field.
			echo '<select name="' . $custom_field . '">';
			echo '<option value="">' . __("Show All {$field['label']}") . '</option>';
			foreach ($field['choices'] as $choice_value => $choice_label) {
					$selected = ($value == $choice_value) ? ' selected="selected"' : '';
					echo '<option value="' . $choice_value . '"' . $selected . '>' . $choice_label . '</option>';
			}
			echo '</select>';
	}
}
add_action('restrict_manage_posts', 'custom_post_type_filter_industry');

// This function modifies the query to include posts that match the selected custom field value.
function custom_post_type_filter_industry1($query) {
	// Access the global $pagenow variable to get the current admin page.
	global $pagenow;

	// Define the post type and custom field we're interested in.
	$post_type = 'resources-docs'; // Replace 'resources-docs' with your Custom Post Type name
	$custom_field = 'industry'; // Change 'industry' to your custom field name

	// If a custom field value was selected, we're on the posts list page, and we're querying for the post type we're interested in...
	if (isset($_GET[$custom_field]) && $pagenow=='edit.php' && $query->query_vars['post_type']==$post_type) {
			$term = $_GET[$custom_field];
			if (!empty($term)) {
					// Create a meta query to filter posts by the selected custom field value.
					$meta_query = array(
							array(
									'key'     => $custom_field,
									'value'   => $term,
									'compare' => 'LIKE',
							),
					);
					// Apply the meta query to the main query.
					$query->set('meta_query', $meta_query);
			}
	}
}
add_action('pre_get_posts', 'custom_post_type_filter_industry1');


 /*****END DASHBOARD industry FILTER *****/


 /*****DASHBOARD areas of interes FILTER *****/

// This function adds a dropdown filter in the admin area for a custom field of a specific post type.
function custom_post_type_filter_area() {
	// Access the global $typenow variable to get the type of the current post.
	global $typenow;

	// Define the post type and custom field we're interested in.
	$post_type = 'resources-docs';
	$custom_field = 'role'; // Change 'role' to your custom field name

	// If the current post type is the one we're interested in...
	if ($typenow == $post_type) {
			// Get information about the custom field.
			$field = get_field_object($custom_field);

			// Get the custom field value selected in the filter, if any.
			$value = isset($_GET[$custom_field]) ? $_GET[$custom_field] : '';

			// Display a dropdown of all possible values of this custom field.
			echo '<select name="' . $custom_field . '">';
			echo '<option value="">' . __("Show All {$field['label']}") . '</option>';
			foreach ($field['choices'] as $choice_value => $choice_label) {
					$selected = ($value == $choice_value) ? ' selected="selected"' : '';
					echo '<option value="' . $choice_value . '"' . $selected . '>' . $choice_label . '</option>';
			}
			echo '</select>';
	}
}
add_action('restrict_manage_posts', 'custom_post_type_filter_area');

// This function modifies the query to include posts that match the selected custom field value.
function custom_post_type_filter_area1($query) {
	// Access the global $pagenow variable to get the current admin page.
	global $pagenow;

	// Define the post type and custom field we're interested in.
	$post_type = 'resources-docs'; // Replace 'resources-docs' with your Custom Post Type name
	$custom_field = 'role'; // Change 'role' to your custom field name

	// If a custom field value was selected, we're on the posts list page, and we're querying for the post type we're interested in...
	if (isset($_GET[$custom_field]) && $pagenow=='edit.php' && $query->query_vars['post_type']==$post_type) {
			$term = $_GET[$custom_field];
			if (!empty($term)) {
					// Create a meta query to filter posts by the selected custom field value.
					$meta_query = array(
							array(
									'key'     => $custom_field,
									'value'   => $term,
									'compare' => 'LIKE',
							),
					);
					// Apply the meta query to the main query.
					$query->set('meta_query', $meta_query);
			}
	}
}
add_action('pre_get_posts', 'custom_post_type_filter_area1');


 /*****END DASHBOARD areas of interes FILTER *****/

?>