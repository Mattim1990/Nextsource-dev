<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/public
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->load_dependencies();
        $this->register_shortcodes();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( __FILE__ ) . '../shortcodes/class-jules-dealer-locator-shortcodes.php';
    }

    private function register_shortcodes() {
        $shortcodes = new Jules_Dealer_Locator_Shortcodes( $this->plugin_name );
        add_shortcode( 'jules_dealer_locator', array( $shortcodes, 'dealer_locator_shortcode' ) );
        add_shortcode( 'jules_dealer_login_form', array( $shortcodes, 'dealer_login_form_shortcode' ) );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../../assets/css/jules-dealer-locator-public.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), '1.7.1', 'all' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../../assets/js/jules-dealer-locator-public.js', array( 'jquery', 'leaflet' ), $this->version, true );
        wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '1.7.1', true );

        $dealers_data = $this->get_dealers_data();
        wp_localize_script( $this->plugin_name, 'jules_dealer_locator_data', array(
            'dealers' => $dealers_data,
        ) );
    }

    private function get_dealers_data() {
        $dealers = array();
        $args = array(
            'post_type'      => 'dealer',
            'posts_per_page' => -1,
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $dealer_id = get_the_ID();
                $dealers[] = array(
                    'id'        => $dealer_id,
                    'title'     => get_the_title(),
                    'lat'       => get_post_meta( $dealer_id, '_dealer_latitude', true ),
                    'lon'       => get_post_meta( $dealer_id, '_dealer_longitude', true ),
                    'address'   => get_post_meta( $dealer_id, '_dealer_address', true ),
                    'phone'     => get_post_meta( $dealer_id, '_dealer_phone', true ),
                    'website'   => get_post_meta( $dealer_id, '_dealer_website', true ),
                    'services'  => wp_get_post_terms( $dealer_id, 'service', array( 'fields' => 'ids' ) ),
                );
            }
            wp_reset_postdata();
        }

        return $dealers;
    }

}
