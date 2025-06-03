<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AP_Settings {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function add_menu() {
        register_setting( 'ap_site_options', 'ap_font_color' );
        register_setting( 'ap_site_options', 'ap_button_color' );
        register_setting( 'ap_site_options', 'ap_button_text_color' );
        register_setting( 'ap_site_options', 'ap_header_color' );
        register_setting( 'ap_site_options', 'ap_header_text_color' );
        register_setting( 'ap_site_options', 'ap_footer_color' );
        register_setting( 'ap_site_options', 'ap_footer_text_color' );
        register_setting( 'ap_site_options', 'ap_footer_copy' );
        register_setting( 'ap_site_options', 'ap_header_pages', array( 'sanitize_callback' => array( $this, 'sanitize_array' ) ) );
        register_setting( 'ap_site_options', 'ap_footer_pages', array( 'sanitize_callback' => array( $this, 'sanitize_array' ) ) );
        register_setting( 'ap_site_options', 'ap_redirect_slug' );
        register_setting( 'ap_site_options', 'ap_redirect_target' );
    }

    public function enqueue_scripts() {
        wp_enqueue_media();
    }

    public function sanitize_array( $value ) {
        return array_map( 'absint', (array) $value );
        if ( isset( $_GET['ap_install_theme'] ) ) {
            AP_Theme_Installer::install_and_activate();
            echo '<div class="updated notice"><p>' . esc_html__( 'Automatise Theme installed and activated.', 'automatise-plugin' ) . '</p></div>';
        }
                    <tr>
                        <th scope="row"><?php _e( 'Font Color', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_font_color" id="ap_font_color" value="<?php echo esc_attr( get_option( 'ap_font_color', '#000000' ) ); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Button Color', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_button_color" id="ap_button_color" value="<?php echo esc_attr( get_option( 'ap_button_color', '#000000' ) ); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Button Text Color', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_button_text_color" id="ap_button_text_color" value="<?php echo esc_attr( get_option( 'ap_button_text_color', '#ffffff' ) ); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Header Background', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_header_color" id="ap_header_color" value="<?php echo esc_attr( get_option( 'ap_header_color', '#ffffff' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Header Text Color', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_header_text_color" id="ap_header_text_color" value="<?php echo esc_attr( get_option( 'ap_header_text_color', '#000000' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Footer Background', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_footer_color" id="ap_footer_color" value="<?php echo esc_attr( get_option( 'ap_footer_color', '#ffffff' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Footer Text Color', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_footer_text_color" id="ap_footer_text_color" value="<?php echo esc_attr( get_option( 'ap_footer_text_color', '#000000' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Footer Copyright', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_footer_copy" id="ap_footer_copy" value="<?php echo esc_attr( get_option( 'ap_footer_copy' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Header Pages', 'automatise-plugin' ); ?></th>
                        <td>
                            <select name="ap_header_pages[]" multiple style="height:100px;width: 250px;">
                                <?php echo walk_page_dropdown_tree( get_pages(), 0, array( 'selected' => get_option( 'ap_header_pages', array() ) ) ); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Footer Pages', 'automatise-plugin' ); ?></th>
                        <td>
                            <select name="ap_footer_pages[]" multiple style="height:100px;width: 250px;">
                                <?php echo walk_page_dropdown_tree( get_pages(), 0, array( 'selected' => get_option( 'ap_footer_pages', array() ) ) ); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Redirect Slug', 'automatise-plugin' ); ?></th>
                        <td><input type="text" name="ap_redirect_slug" id="ap_redirect_slug" value="<?php echo esc_attr( get_option( 'ap_redirect_slug', 'redirect' ) ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Redirect Target URL', 'automatise-plugin' ); ?></th>
                        <td><input type="url" name="ap_redirect_target" id="ap_redirect_target" value="<?php echo esc_attr( get_option( 'ap_redirect_target' ) ); ?>" class="regular-text" /></td>
                    </tr>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=ap-site-appearance&ap_install_theme=1' ) ); ?>" class="button button-secondary" style="margin-top:10px;"><?php _e( 'Install Automatise Theme', 'automatise-plugin' ); ?></a>
        // Top-level menu (видно в лівому меню WordPress)
        add_menu_page(
            __( 'Site Appearance', 'automatise-plugin' ),
            __( 'Site Appearance', 'automatise-plugin' ),
            'manage_options',
            'ap-site-appearance',
            array( $this, 'settings_page' ),
            'dashicons-admin-customizer',
            81
        );

        // Якщо хочеш як підпункт у Settings, використовуй це замість add_menu_page:
        /*
        add_options_page(
            __( 'Site Appearance', 'automatise-plugin' ),
            __( 'Site Appearance', 'automatise-plugin' ),
            'manage_options',
            'ap-site-appearance',
            array( $this, 'settings_page' )
        );
        */
    }

    public function register_settings() {
        register_setting( 'ap_site_options', 'ap_site_logo' );
        register_setting( 'ap_site_options', 'ap_site_favicon' );
        register_setting( 'ap_site_options', 'ap_primary_color' );
        register_setting( 'ap_site_options', 'ap_secondary_color' );
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e( 'Site Appearance Settings', 'automatise-plugin' ); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields( 'ap_site_options' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><?php _e( 'Logo', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_site_logo" id="ap_site_logo" value="<?php echo esc_attr( get_option( 'ap_site_logo' ) ); ?>" class="regular-text" />
                            <button class="button ap-upload" data-target="ap_site_logo"><?php _e( 'Upload', 'automatise-plugin' ); ?></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Favicon', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_site_favicon" id="ap_site_favicon" value="<?php echo esc_attr( get_option( 'ap_site_favicon' ) ); ?>" class="regular-text" />
                            <button class="button ap-upload" data-target="ap_site_favicon"><?php _e( 'Upload', 'automatise-plugin' ); ?></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Primary Color', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_primary_color" id="ap_primary_color" value="<?php echo esc_attr( get_option( 'ap_primary_color', '#000000' ) ); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e( 'Secondary Color', 'automatise-plugin' ); ?></th>
                        <td>
                            <input type="text" name="ap_secondary_color" id="ap_secondary_color" value="<?php echo esc_attr( get_option( 'ap_secondary_color', '#ffffff' ) ); ?>" class="regular-text" />
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($){
            function initUploader(button) {
                var file_frame;
                button.on('click', function(e){
                    e.preventDefault();
                    var target = $(this).data('target');
                    if ( file_frame ) {
                        file_frame.open();
                        return;
                    }
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: '<?php _e( 'Select Image', 'automatise-plugin' ); ?>',
                        button: {text: '<?php _e( 'Use Image', 'automatise-plugin' ); ?>'},
                        multiple: false
                    });
                    file_frame.on('select', function(){
                        var attachment = file_frame.state().get('selection').first().toJSON();
                        $('#'+target).val(attachment.url);
                    });
                    file_frame.open();
                });
            }
            initUploader($('.ap-upload'));
        });
        </script>
        <?php
    }
}

new AP_Settings();