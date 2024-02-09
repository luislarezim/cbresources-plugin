<?php
/**
 * Plugin Name: CB Resources
 * Description: Custom functionalities for resources docs.
 * Version: 1.0
 * Author: Cloudblue
 * Colaborator: Luis Lárez (luis.larez@ingrammicro.com)
 */

// Prevent direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

// Define the plugin directory path if not already defined.
if ( ! defined( 'CB_RESOURCES_DIR' ) ) {
  define( 'CB_RESOURCES_DIR', plugin_dir_path( __FILE__ ) );
}

// Array of files to include.
$include_files = [
  'admin/registerFiles/register-resources-cpt.php',
  'admin/registerFiles/register-resources-taxonomy.php',
  'admin/registerFiles/template-override.php',
  'admin/registerFiles/register_resources-filters-fields.php',
  'includes/ResourceFilterDisplayAjax.php',
  'admin/resources-admin-dashboard-filters.php',
  'includes/shortcode-resources.php',
];

// Loop through the array of files and include each one if it exists.
foreach ( $include_files as $file ) {
  $file_path = CB_RESOURCES_DIR . $file;
  if ( file_exists( $file_path ) ) {
      require_once $file_path;
  }
}

?>