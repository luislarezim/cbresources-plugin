<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Shortcode function to display resources with an AJAX filter
function cb_resources_shortcode() {
    ob_start(); // Begin output buffering.

    // Enqueue the jQuery script.
    /* wp_enqueue_script('jquery'); */

    // Enqueue the AJAX filtering script, making sure the correct path is used.
    wp_enqueue_script('ajax-filter', plugin_dir_url(dirname(__FILE__)) . 'assets/js/resources_archive_filter.js', array('jquery'), null, true);

    // Provide the AJAX filtering script with the URL it needs to make AJAX requests.
    wp_localize_script('ajax-filter', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    // Check if the template file exists and include it.
    $template_path = plugin_dir_path(__FILE__) . 'resources-filter-template.php';
    if (file_exists($template_path)) {
        include $template_path;
    } else {
        // Log an error and display an admin message if the file is not found.
        error_log('The template file ' . $template_path . ' does not exist.');
        if (current_user_can('administrator')) {
            echo "<div class='error'><p>Error: The template file for the 'cb_resources' shortcode is missing.</p></div>";
        }
    }

    // Return the buffered output.
    return ob_get_clean();
}

// Register the shortcode in WordPress.
add_shortcode('cb-resources', 'cb_resources_shortcode');

?>
