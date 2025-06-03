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

    // Flush rewrite rules for redirect slug.
    flush_rewrite_rules();

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


add_action( 'init', 'ap_register_redirect' );
function ap_register_redirect() {
    $slug = trim( get_option( 'ap_redirect_slug' ) );
    if ( $slug ) {
        add_rewrite_rule( '^' . preg_quote( $slug, '/' ) . '/?$', 'index.php?ap_redirect=1', 'top' );
    }
}

add_action( 'template_redirect', 'ap_handle_redirect' );
function ap_handle_redirect() {
    if ( get_query_var( 'ap_redirect' ) ) {
        $target = get_option( 'ap_redirect_target' );
        if ( $target ) {
            wp_redirect( esc_url_raw( $target ) );
            exit;
        }
    }
}

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'ap_redirect';
    return $vars;
} );

