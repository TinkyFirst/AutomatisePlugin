<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AP_Theme_Installer {

    public static function install_and_activate() {
        $theme_dir = plugin_dir_path( __DIR__ ) . 'theme/ap-theme';
        $dest_dir  = WP_CONTENT_DIR . '/themes/ap-theme';
        if ( ! file_exists( $dest_dir ) ) {
            self::recurse_copy( $theme_dir, $dest_dir );
        }
        if ( function_exists( 'switch_theme' ) ) {
            switch_theme( 'ap-theme' );
        }
    }

    private static function recurse_copy( $src, $dst ) {
        $dir = opendir( $src );
        if ( ! file_exists( $dst ) ) {
            mkdir( $dst, 0755, true );
        }
        while ( false !== ( $file = readdir( $dir ) ) ) {
            if ( ( $file !== '.' ) && ( $file !== '..' ) ) {
                if ( is_dir( "$src/$file" ) ) {
                    self::recurse_copy( "$src/$file", "$dst/$file" );
                } else {
                    copy( "$src/$file", "$dst/$file" );
                }
            }
        }
        closedir( $dir );
    }
}
