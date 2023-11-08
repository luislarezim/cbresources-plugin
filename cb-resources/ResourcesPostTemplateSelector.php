<?php


// This function selects a custom template for single posts of the 'resources-docs' custom post type.
function resources_post_type_template($single_template) {
	// Make the $post object available.
	global $post;

	// If the post is of the type 'resources-docs'...
	if ($post->post_type == 'resources-docs') {
		// ...and it's a single post...
		if (is_single()) {
			// ...if the post has a custom field 'resources_post_type_template' with a value of 'fullwidth'...
			if (get_post_meta($post->ID, 'resources_post_type_template', true) == 'fullwidth') {
				// ...use the 'fullwidth' template.
				$single_template = plugin_dir_url( __FILE__ ) . '/templates/single-resources-docs-full-width.php';
			} 
			// ...else if the post has a custom field 'resources_post_type_template' with a value of 'twocolumn'...
			elseif (get_post_meta($post->ID, 'resources_post_type_template', true) == 'twocolumn') {
				// ...use the 'twocolumn' template.
				$single_template = plugin_dir_url( __FILE__ ) . '/templates/single-resources-docs-two-columns.php';
			}
		}
	}

	// Return the path to the selected template.
	return $single_template;
}
// Add a filter to select a specific template for the 'resources' post type.
add_filter('template_include', 'resources_post_type_template', 99);


?>