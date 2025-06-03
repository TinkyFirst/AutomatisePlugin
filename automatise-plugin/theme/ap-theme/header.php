<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header style="background: <?php echo esc_attr( get_option( 'ap_header_color', '#ffffff' ) ); ?>; color: <?php echo esc_attr( get_option( 'ap_header_text_color', '#000000' ) ); ?>;">
    <div class="site-branding">
        <?php if ( $logo = get_option( 'ap_site_logo' ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
        <?php else : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <?php endif; ?>
    </div>
    <nav class="header-menu">
        <ul>
            <?php
            $pages = get_option( 'ap_header_pages', array() );
            foreach ( (array) $pages as $page_id ) {
                $page = get_post( $page_id );
                if ( $page ) {
                    echo '<li><a href="' . esc_url( get_permalink( $page ) ) . '">' . esc_html( $page->post_title ) . '</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
    <div class="header-buttons">
        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="button login"><?php _e( 'Log in', 'ap-theme' ); ?></a>
        <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="button register"><?php _e( 'Register', 'ap-theme' ); ?></a>
    </div>
</header>
<main>
