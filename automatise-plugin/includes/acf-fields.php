<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AP_ACF_Fields {

    public function __construct() {
        add_action( 'acf/init', array( $this, 'register_fields' ) );
    }

    public function register_fields() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_ap_page_fields',
            'title' => __( 'Page Custom Fields', 'automatise-plugin' ),
            'fields' => array(
                array(
                    'key' => 'field_ap_page_title',
                    'label' => __( 'Title', 'automatise-plugin' ),
                    'name' => 'ap_page_title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_ap_page_description',
                    'label' => __( 'Description', 'automatise-plugin' ),
                    'name' => 'ap_page_description',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_ap_page_content',
                    'label' => __( 'Content', 'automatise-plugin' ),
                    'name' => 'ap_page_content',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_ap_page_faq',
                    'label' => __( 'FAQ', 'automatise-plugin' ),
                    'name' => 'ap_page_faq',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key' => 'field_ap_page_game',
                    'label' => __( 'Game Block', 'automatise-plugin' ),
                    'name' => 'ap_page_game_block',
                    'type' => 'wysiwyg',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                ),
            ),
        ) );
    }
}

new AP_ACF_Fields();
