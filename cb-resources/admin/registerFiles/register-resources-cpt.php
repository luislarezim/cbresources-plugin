<?php

function cptui_register_my_cpts_resources_docs() {

	/**
	 * Post Type: Resources.
	 */

	$labels = [
		"name" => esc_html__( "Resources", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Resource", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Resources", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => "resources",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "resources", "with_front" => false ],
		"query_var" => false,
		"menu_icon" => "dashicons-media-text",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "author", "page-attributes", "post-formats" ],
		"taxonomies" => [ "resources" ],
		"show_in_graphql" => false,
	];

	register_post_type( "resources-docs", $args );
}

add_action( 'init', 'cptui_register_my_cpts_resources_docs' );


?>