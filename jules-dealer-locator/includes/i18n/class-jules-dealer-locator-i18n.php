<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_i18n {


    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
            'jules-dealer-locator',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );

    }



}
