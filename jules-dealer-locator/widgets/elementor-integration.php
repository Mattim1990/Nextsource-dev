<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Check if Elementor is loaded, and then load the integration class.
 */
add_action( 'plugins_loaded', 'jules_dealer_locator_elementor_init' );

function jules_dealer_locator_elementor_init() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        return;
    }

    require_once __DIR__ . '/class-jules-dealer-locator-elementor-integration.php';
}
