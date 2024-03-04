<?php

add_action('acf/init', 'cb_register_resources_filters_fields');

function cb_register_resources_filters_fields() {
    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_63ed7a0cbf962',
            'title' => 'Filters for Resources',
            'fields' => array(
                array(
                    'key' => 'field_63ed7c7952fc3',
                    'label' => 'Industry',
                    'name' => 'industry',
                    'type' => 'checkbox',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'choices' => array(
                        'DSPs' => 'DSPs',
                        'ISVs' => 'ISVs',
                        'IT Distributors' => 'IT Distributors',
                        'MSPs' => 'MSPs',
                        'OEMs' => 'OEMs',
                        'Tech Vendors' => 'Tech Vendors',
                        'Telcos' => 'Telcos',
                    ),
                    'allow_custom' => 0,
                    'default_value' => array(),
                    'layout' => 'vertical',
                    'toggle' => 0,
                    'return_format' => 'value',
                ),
                array(
                    'key' => 'field_63ed7e7052fc4',
                    'label' => 'Areas of Interest',
                    'name' => 'role',
                    'type' => 'checkbox',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'choices' => array(
                        'Technical & Product' => 'Technical & Product',
                        'Strategy & Business' => 'Strategy & Business',
                    ),
                    'allow_custom' => 0,
                    'default_value' => array(),
                    'layout' => 'vertical',
                    'toggle' => 0,
                    'return_format' => 'value',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'resources-docs',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 1,
        ));

    endif;
}


?>