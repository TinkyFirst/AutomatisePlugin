<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AP_Settings {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public function add_menu() {
        add_options_page(
            __( 'Site Appearance', 'automatise-plugin' ),
            __( 'Site Appearance', 'automatise-plugin' ),
            'manage_options',
            'ap-site-appearance',
            array( $this, 'settings_page' )
        );
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
