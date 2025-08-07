<?php

/**
 * The tutorial page for the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/tutorial
 */

/**
 * The tutorial page for the plugin.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/tutorial
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Tutorial {

    /**
     * Add the tutorial page.
     *
     * @since    1.0.0
     */
    public function add_tutorial_page() {
        add_submenu_page(
            'edit.php?post_type=dealer',
            __( 'Tutorial', 'jules-dealer-locator' ),
            __( 'Tutorial', 'jules-dealer-locator' ),
            'manage_options',
            'jules-dealer-locator-tutorial',
            array( $this, 'render_tutorial_page' )
        );
    }

    /**
     * Render the tutorial page.
     *
     * @since    1.0.0
     */
    public function render_tutorial_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <style>
                <?php include plugin_dir_path( __FILE__ ) . '../../assets/tutorial/style.css'; ?>
            </style>
            <h2>Step 1: Find the "Dealers" menu</h2>
            <p>After activating the plugin, you will see a new "Dealers" menu item in the WordPress admin area.</p>
            <?php include plugin_dir_path( __FILE__ ) . '../../assets/tutorial/screenshot-1.html'; ?>

            <h2>Step 2: Add a new dealer</h2>
            <p>Click on "Dealers" -> "Add New" to create a new dealer. Fill in the title and description.</p>
            <?php include plugin_dir_path( __FILE__ ) . '../../assets/tutorial/screenshot-2.html'; ?>

            <h2>Step 3: Add dealer details</h2>
            <p>In the "Dealer Details" meta box, enter the dealer's address, phone number, and website. The latitude and longitude will be automatically fetched from the address.</p>
            <?php include plugin_dir_path( __FILE__ ) . '../../assets/tutorial/screenshot-3.html'; ?>

            <h2>Step 4: Set the dealer logo</h2>
            <p>Set a dealer logo by using the "Dealer Logo" meta box (which replaces the standard "Featured Image" meta box).</p>
            <?php include plugin_dir_path( __FILE__ ) . '../../assets/tutorial/screenshot-4.html'; ?>
        </div>
        <?php
    }

}
