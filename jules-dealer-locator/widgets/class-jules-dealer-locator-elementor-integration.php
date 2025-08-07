<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Jules_Dealer_Locator_Elementor_Integration {

    /**
     * The single instance of the class.
     *
     * @var Jules_Dealer_Locator_Elementor_Integration
     * @since 1.0.0
     */
    private static $_instance = null;

    /**
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return Jules_Dealer_Locator_Elementor_Integration An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
    }

    /**
     * Register custom category.
     *
     * @since 1.0.0
     */
    public function register_category( $elements_manager ) {
        $elements_manager->add_category(
            'jules-dealer-locator',
            [
                'title' => __( 'Jules Dealer Locator', 'jules-dealer-locator' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register widgets.
     *
     * @since 1.0.0
     */
    public function register_widgets( $widgets_manager ) {
        require_once __DIR__ . '/class-jules-dealer-locator-widget.php';
        $widgets_manager->register_widget_type( new \Jules_Dealer_Locator_Widget() );
    }

}

Jules_Dealer_Locator_Elementor_Integration::instance();
