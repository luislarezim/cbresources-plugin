<?php

// Add a filter to replace the default template with a custom one from the plugin when necessary.
add_filter('template_include', 'cb_resources_template');

// Define the function that will provide the custom template for 'resources-docs'.
function cb_resources_template($template) {
    // Retrieve the current post type being queried.
    $post_type = get_query_var('post_type');

    // Check if the current archive page is for the 'resources-docs' post type.
    if ('resources-docs' === $post_type && is_archive()) {
        // Construct the path to the custom template file within the plugin directory.
        $plugin_template = CB_RESOURCES_DIR . 'templates/archive-resources-docs.php';
        // Check if the custom template file exists.
        if (file_exists($plugin_template)) {
            // Return the path to the custom template file.
            return $plugin_template;
        }
    }

    // Return the default template if we are not on a 'resources-docs' archive page.
    return $template;
}

// Add filter to replace the single post template with a custom one from the plugin when necessary.
add_filter('single_template', 'cb_resources_single_template');

// Define the function that will provide the custom template for single 'resources-docs' posts.
function cb_resources_single_template($single_template) {
    global $post;

    // Check if the current post is of type 'resources-docs'.
    if ('resources-docs' === $post->post_type) {
        // Construct the path to the custom single post template file within the plugin directory.
        $plugin_single_template = CB_RESOURCES_DIR . 'templates/single-resources-docs.php';
        // Check if the custom single post template file exists.
        if (file_exists($plugin_single_template)) {
            // Return the path to the custom single post template file.
            return $plugin_single_template;
        }
    }

    // Return the default template if we are not viewing a single 'resources-docs' post.
    return $single_template;
}

?>