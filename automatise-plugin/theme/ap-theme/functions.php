<?php
function ap_theme_setup() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'ap_theme_setup' );

function ap_theme_menus() {
    register_nav_menus( array(
        'header' => __( 'Header Menu', 'ap-theme' ),
        'footer' => __( 'Footer Menu', 'ap-theme' ),
    ) );
}
add_action( 'init', 'ap_theme_menus' );

function ap_theme_styles() {
    wp_enqueue_style( 'ap-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ap_theme_styles' );

function ap_theme_custom_styles() {
    ?>
    <style type="text/css">
        body {
            color: <?php echo esc_attr( get_option( 'ap_font_color', '#000000' ) ); ?>;
        }
        .button,
        button,
        input[type="submit"] {
            background: <?php echo esc_attr( get_option( 'ap_button_color', '#000000' ) ); ?>;
            color: <?php echo esc_attr( get_option( 'ap_button_text_color', '#ffffff' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ap_theme_custom_styles' );
