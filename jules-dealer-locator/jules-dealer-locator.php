<?php
/**
 * Plugin Name:       Jules' Dealer Locator
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       A dealer locator plugin with Elementor integration.
 * Version:           1.0.0
 * Author:            Jules
 * Author URI:        https://example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jules-dealer-locator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'JULES_DEALER_LOCATOR_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jules-dealer-locator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jules_dealer_locator() {

    $plugin = new Jules_Dealer_Locator();
    $plugin->run();

}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jules-dealer-locator-activator.php
 */
function activate_jules_dealer_locator() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/user-roles/class-jules-dealer-locator-user-roles.php';
    Jules_Dealer_Locator_User_Roles::add_dealer_role();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jules-dealer-locator-deactivator.php
 */
function deactivate_jules_dealer_locator() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/user-roles/class-jules-dealer-locator-user-roles.php';
    Jules_Dealer_Locator_User_Roles::remove_dealer_role();
}

register_activation_hook( __FILE__, 'activate_jules_dealer_locator' );
register_deactivation_hook( __FILE__, 'deactivate_jules_dealer_locator' );

run_jules_dealer_locator();
