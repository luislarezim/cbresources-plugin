<?php
/**
 * Plugin Name: CB Resources
 * Description: Custom functionalities for resources docs.
 * Version: 1.0
 * Author: Cloudblue
 * Colaborator: Luis Lárez (luis.larez@ingrammicro.com)
 */

 error_reporting(E_ALL); ini_set('display_errors', 1);
 if ( !defined( 'ABSPATH' ) ) exit;


/* adds jQuery and an AJAX filter script to specific resources page */
function resources_archive_scripts() {
	$body_classes = get_body_class();
	if (in_array('post-type-archive-resources-docs', $body_classes)) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('ajax-filter', plugin_dir_url( __FILE__ ) . 'assets/js/resources_archive_filter.js', array('jquery'), null, true);
			wp_localize_script('ajax-filter', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	}
}
add_action('wp_enqueue_scripts', 'resources_archive_scripts');


// Enqueue the ResourceFilterDisplayAjax.php script for handling resource filtering and AJAX pagination.
include_once plugin_dir_path(__FILE__) . 'ResourceFilterDisplayAjax.php';

// Include the admin dashboard filters.
include_once plugin_dir_path(__FILE__) . 'resources-admin-dashboard-filters.php';

// Include the shortcode definitions.
include_once plugin_dir_path(__FILE__) . 'shortcode-resources.php';

// Enqueue the ResourcesPostTemplateSelector.php to handle custom template selection for single 'resources-docs' post type.

include_once plugin_dir_path(__FILE__) . 'ResourcesPostTemplateSelector.php';


?>