<?php
    
// Attempt to retrieve terms for the 'resources' taxonomy
$terms = get_terms(array(
    'taxonomy' => 'resources',
    'hide_empty' => true,
));

// Check if any terms are returned
if (!empty($terms)) :
    // Start form for resource filtering
    ?>
    <form id="resources-filter" method="get" class="basic container py-3">
        <div class="row"> 
            <span class="col pb-2 pt-3 catfilter-wrap">FILTER BY</span> 
        </div>
        <div class="row">
            <div id="resource-type-filter" class="col-12 col-md-4 py-2 py-md-0 align-items-r">
                <!-- Resource Type Filter Dropdown -->
                <select name="resource_type" id="resource_type">
                    <option value="" <?php selected('', $_GET['resource_type'] ?? ''); ?>>
                        <?php esc_html_e('All Types', 'text-domain'); ?>
                    </option>
                    <?php
                    // Iterate over each term and create an option element
                    foreach ($terms as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($term->slug, $_GET['resource_type'] ?? ''); ?>>
                            <?php echo esc_html($term->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <?php
            // Retrieve the 'industry' field object using Advanced Custom Fields (ACF) plugin
            $industries = get_field_object('industry');
            if (!empty($industries) && !empty($industries['choices'])) :
                // Sanitize and retrieve the 'industry' query parameter
                $selected_industry = sanitize_text_field($_GET['industry'] ?? '');
                ?>
                <div id="industry-type-filter" class="col-12 col-md-4 py-2 py-md-0">
                    <!-- Industry Type Filter Dropdown -->
                    <select name="industry" id="industry">
                        <option value="" <?php selected('', $selected_industry); ?>>
                            <?php esc_html_e('All Industries', 'text-domain'); ?>
                        </option>
                        <?php
                        // Iterate over each industry and create an option element
                        foreach ($industries['choices'] as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $selected_industry); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            
            <?php
            // Retrieve the 'role' field object using Advanced Custom Fields (ACF) plugin
            $roles = get_field_object('role');
            if (!empty($roles) && !empty($roles['choices'])) :
                // Sanitize and retrieve the 'role' query parameter
                $selected_role = sanitize_text_field($_GET['role'] ?? '');
                ?>
                <div id="role-type-filter" class="col-12 col-md-4 py-2 py-md-0">
                    <!-- Role Type Filter Dropdown -->
                    <select name="role" id="role">
                        <option value="" <?php selected('', $selected_role); ?>>
                            <?php esc_html_e('All Areas of Interest', 'text-domain'); ?>
                        </option>
                        <?php
                        // Iterate over each role and create an option element
                        foreach ($roles['choices'] as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $selected_role); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
    </form>
<?php
// End if terms are not empty
endif;
?>

<div id="primary" class="basic basic-blog">
    <div id="ajax-results-container">
        <?php
        // Get the current page number, default to 1 if not set
        $paged = get_query_var('paged') ?: 1;
        
        // Sanitize GET parameters to prevent XSS attacks
        $resource_type = sanitize_text_field($_GET['resource_type'] ?? '');
        $industry = sanitize_text_field($_GET['industry'] ?? '');
        $role = sanitize_text_field($_GET['role'] ?? '');
        
        // Display resources based on the provided filters
        display_filtered_resources($resource_type, $industry, $role, $paged);
        ?>
    </div>
</div>
