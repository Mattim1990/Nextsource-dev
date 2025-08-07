<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Dealer Locator Widget.
 *
 * Elementor widget that displays a dealer locator.
 *
 * @since 1.0.0
 */
class Jules_Dealer_Locator_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve dealer locator widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'jules_dealer_locator';
    }

    /**
     * Get widget title.
     *
     * Retrieve dealer locator widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Jules Dealer Locator', 'jules-dealer-locator' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve dealer locator widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-location-pin';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the dealer locator widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'jules-dealer-locator' ];
    }

    /**
     * Register dealer locator widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'jules-dealer-locator' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'jules-dealer-locator' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Our Dealers', 'jules-dealer-locator' ),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render dealer locator widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
        echo do_shortcode( '[jules_dealer_locator]' );
    }

}
