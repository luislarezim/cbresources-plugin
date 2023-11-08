<?php
        $terms = get_terms(array(
            'taxonomy' => 'resources',
            'hide_empty' => true,
        ));

        if ($terms) :
            ?>
            <form id="resources-filter" method="get" class="basic container py-3">
            <div class="row"> <span class="col pb-2 pt-3 catfilter-wrap">FILTER BY</span> </div>
            <div class="row">
                <div id="resource-type-filter" class="col-12 col-md-4 py-2 py-md-0 align-items-r">
                <select name="resource_type" id="resource_type">
                    <option value="" <?php selected('', $_GET['resource_type'] ?? ''); ?>><?php esc_html_e('All Types', 'text-domain'); ?></option>
                    <?php foreach ($terms as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($term->slug, $_GET['resource_type'] ?? ''); ?>><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div id="industry-type-filter" class="col-12 col-md-4 py-2 py-md-0">
                <?php
                $industries = get_field_object('industry');
                if ($industries) :
                    $selected_industry = isset($_GET['industry']) ? $_GET['industry'] : '';
                    ?>
                    <select name="industry" id="industry">
                        <option value="" <?php selected('', $selected_industry); ?>><?php esc_html_e('All Industries', 'text-domain'); ?></option>
                        <?php foreach ($industries['choices'] as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $selected_industry); ?>><?php echo esc_html($label); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div id="role-type-filter" class="col-12 col-md-4 py-2 py-md-0">
                    
                    <?php
                endif;
                $roles = get_field_object('role');
                if ($roles) :
                    $selected_role = isset($_GET['role']) ? $_GET['role'] : '';
                    ?>
                    <select name="role" id="role">
                        <option value="" <?php selected('', $selected_role); ?>><?php esc_html_e('All Areas of Interest', 'text-domain'); ?></option>
                        <?php foreach ($roles['choices'] as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $selected_role); ?>><?php echo esc_html($label); ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <?php
                endif;
                ?>
                </div>
            </form>
            <?php
        endif;
        ?>
        
        <div id="primary" class="basic basic-blog">

        <div id="ajax-results-container">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    display_filtered_resources($_GET['resource_type'] ?? '', $_GET['industry'] ?? '', $_GET['role'] ?? '', $paged);
    ?>
</div>
        
    </div>