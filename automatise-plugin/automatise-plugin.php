<?php
/**
 * Plugin Name: Automatise Plugin
 * Description: Adds site settings, custom page fields, and page creation with indexing.

 * Version: 1.1.0

 * Author: Codex
 * Text Domain: automatise-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include required files.
require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/acf-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/pages.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/theme-installer.php';


// Activation hook to create pages and enable indexing.
register_activation_hook( __FILE__, 'ap_activate_plugin' );
