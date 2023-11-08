<?php

// This function displays resources filtered by type, industry, and role.
function display_filtered_resources($resource_type = '', $industry = '', $role = '', $paged = 1)
{
    // Initialize the array for meta queries.
    $meta_query = array();

    // If an industry is specified, add it to the meta query.
    if ($industry !== '') {
        $meta_query[] = array(
            'key' => 'industry',
            'value' => $industry,
            'compare' => 'LIKE',
            'type' => 'CHAR',
        );
    }
    
    // If a role is specified, add it to the meta query.
    if ($role !== '') {
        $meta_query[] = array(
            'key' => 'role',
            'value' => $role,
            'compare' => 'LIKE',
            'type' => 'CHAR',
        );
    }
    
    // Set up the query arguments.
    $query_args = array(
        'post_type' => 'resources-docs',
        'posts_per_page' => 12, // Change to 12 to display a maximum of 12 posts per page.
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(),
        'meta_query' => $meta_query,
        'paged' => $paged, // Add the paged parameter.
    );

    // If a resource type is specified, add it to the tax query.
    if ($resource_type !== '') {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'resources',
            'field' => 'slug',
            'terms' => sanitize_text_field($resource_type),
        );
    }

    // Perform the query.
    $query = new WP_Query($query_args);

    // If posts are found...
    if ($query->have_posts()) :
 
        // ...iterate through each post...
        while ($query->have_posts()) :
            $query->the_post();
            // Original HTML code to display each post
            ?>
					<a class="blogitem" href="<?php the_permalink(); ?>">
							<div class="blogitem-imgwrap">
									<?php
									$image_url = get_field('bannerLg');
									if (!$image_url) {
											$post_id = get_the_ID();
											$image_url = get_the_post_thumbnail_url($post_id, 'full');
											if (!$image_url) {
													$image_url = get_template_directory_uri() . '/images/default-banner.jpg';
											}
									}
									?>
									<img class="blogitem-img" src="<?php echo $image_url; ?>" alt="<?php the_title();?>" />
							</div>
							<div class="blogitem-body">
							<div class="blogitem-meta">
									<?php
					$terms = get_the_terms(get_the_ID(), 'resources');
					if ($terms && !is_wp_error($terms)) {
							$term_names = array();
							foreach ($terms as $term) {
									$term_names[] = $term->name;
							}
							$term_list = join(', ', $term_names);
							echo '<div class="blogitem-category pb-2">' . esc_html($term_list) . '</div>';
					}
					?>
					</div>
									<div class="blogitem-title"><?php the_title();?></div>
									<div class="cbcard-more">
											READ MORE
											<img class="cbcard-arrow" src="/assets/images/arrowthick-blue.png" alt />
									</div>
							</div>
					</a>
					<?php
			endwhile;
			echo '</div>';

            // At the end of the loop, add the function to display pagination links.
            custom_pagination($query->max_num_pages, $paged);

            // Reset post data.
            wp_reset_postdata();
            
    // If no posts are found, display a message.
    else :
        echo '<p>' . esc_html__('No resources found.', 'text-domain') . '</p>';
    endif;
}

// This function adds custom pagination.
function custom_pagination($max_num_pages, $paged = 1, $range = 12)
{
    // Code for custom pagination
    $showitems = ($range * 2) + 1;

    if ($max_num_pages == '') {
        $max_num_pages = 1;
    }

    if (1 != $max_num_pages) {
        echo "<div class=\"blog-pagination\">";

        if ($paged > 1) echo "<a class=\"pagearrow newerposts\" href=\"#\" data-page-number=\"" . ($paged - 1) . "\"></a>";

        for ($i = 1; $i <= $max_num_pages; $i++) {
            if (1 != $max_num_pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $max_num_pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href=\"#\" class=\"inactive\" data-page-number=\"" . $i . "\">" . $i . "</a>";
            }
        }

        if ($paged < $max_num_pages) echo "<a class=\"pagearrow olderposts\" title=\"next\" href=\"#\" data-page-number=\"" . ($paged + 1) . "\"></a>";

        echo "</div>\n";
    }
}

// This function is a callback for an AJAX call to load filtered resources.
function load_filtered_resources_ajax_callback() {
    // Get the resource type, industry, role, and page number from the POST data.
    $resource_type = isset($_POST['resource_type']) ? sanitize_text_field($_POST['resource_type']) : '';
    $industry = isset($_POST['industry']) ? sanitize_text_field($_POST['industry']) : '';
    $role = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    // Display the filtered resources.
    display_filtered_resources($resource_type, $industry, $role, $paged);

    // Terminate the AJAX function correctly.
    wp_die();
}

// Add the AJAX action for logged-in and non-logged-in users.
add_action('wp_ajax_load_filtered_resources', 'load_filtered_resources_ajax_callback');
add_action('wp_ajax_nopriv_load_filtered_resources', 'load_filtered_resources_ajax_callback');



/*END FILTER AJAX RESOURCES */
?>