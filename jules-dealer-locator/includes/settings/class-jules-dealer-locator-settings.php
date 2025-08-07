<?php

/**
 * The settings page for the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/settings
 */

/**
 * The settings page for the plugin.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/settings
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Settings {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The options group name.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $option_group    The options group name.
     */
    private $option_group;

    /**
     * The options name.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $option_name    The options name.
     */
    private $option_name;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     */
    public function __construct( $plugin_name ) {
        $this->plugin_name = $plugin_name;
        $this->option_group = $this->plugin_name . '_options';
        $this->option_name = $this->plugin_name . '_options';
    }

    /**
     * Add the settings page.
     *
     * @since    1.0.0
     */
    public function add_settings_page() {
        add_options_page(
            __( 'Jules Dealer Locator Settings', 'jules-dealer-locator' ),
            __( 'Jules Dealer Locator', 'jules-dealer-locator' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'render_settings_page' )
        );
    }

    /**
     * Register the settings.
     *
     * @since    1.0.0
     */
    public function register_settings() {
        register_setting(
            $this->option_group,
            $this->option_name,
            array( $this, 'sanitize_options' )
        );

        add_settings_section(
            $this->plugin_name . '_general_section',
            __( 'General Settings', 'jules-dealer-locator' ),
            array( $this, 'render_general_section' ),
            $this->plugin_name
        );

        add_settings_field(
            'google_maps_api_key',
            __( 'Google Maps API Key', 'jules-dealer-locator' ),
            array( $this, 'render_api_key_field' ),
            $this->plugin_name,
            $this->plugin_name . '_general_section'
        );
    }

    /**
     * Sanitize the options.
     *
     * @since    1.0.0
     * @param    array    $input    The options to sanitize.
     * @return   array              The sanitized options.
     */
    public function sanitize_options( $input ) {
        $output = array();
        if ( isset( $input['google_maps_api_key'] ) ) {
            $output['google_maps_api_key'] = sanitize_text_field( $input['google_maps_api_key'] );
        }
        return $output;
    }

    /**
     * Render the general section.
     *
     * @since    1.0.0
     */
    public function render_general_section() {
        echo '<p>' . __( 'General settings for the Jules Dealer Locator plugin.', 'jules-dealer-locator' ) . '</p>';
    }

    /**
     * Render the API key field.
     *
     * @since    1.0.0
     */
    public function render_api_key_field() {
        $options = get_option( $this->option_name );
        $api_key = isset( $options['google_maps_api_key'] ) ? $options['google_maps_api_key'] : '';
        echo '<input type="text" id="google_maps_api_key" name="' . $this->option_name . '[google_maps_api_key]" value="' . esc_attr( $api_key ) . '" class="regular-text" />';
    }

    /**
     * Render the settings page.
     *
     * @since    1.0.0
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields( $this->option_group );
                do_settings_sections( $this->plugin_name );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

}
