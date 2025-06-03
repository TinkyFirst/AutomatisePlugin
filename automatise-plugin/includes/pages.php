<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ap_activate_plugin() {
    $pages = array( 'home', 'about', 'contact' );
    foreach ( $pages as $slug ) {
        $existing = get_page_by_path( $slug );
        if ( ! $existing ) {
            wp_insert_post( array(
                'post_title'   => ucfirst( $slug ),
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
        }
    }

    // Ensure indexing is enabled
    update_option( 'blog_public', 1 );
}
add_action( 'wp_head', 'ap_add_index_meta' );
function ap_add_index_meta() {
    echo "\n<meta name='robots' content='index, follow'>\n";
}

add_action( 'save_post_page', 'ap_set_page_indexing', 10, 3 );
function ap_set_page_indexing( $post_ID, $post, $update ) {
    if ( 'publish' === $post->post_status ) {
        update_post_meta( $post_ID, '_ap_index', '1' );
    }
}
