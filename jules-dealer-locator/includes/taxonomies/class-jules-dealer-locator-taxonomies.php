<?php

/**
 * Register taxonomies for the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/taxonomies
 */

/**
 * Register taxonomies for the plugin.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/taxonomies
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Taxonomies {

    /**
     * Register the "Services" taxonomy.
     *
     * @since    1.0.0
     */
    public function register_services_taxonomy() {
        $labels = array(
            'name'              => _x( 'Services', 'taxonomy general name', 'jules-dealer-locator' ),
            'singular_name'     => _x( 'Service', 'taxonomy singular name', 'jules-dealer-locator' ),
            'search_items'      => __( 'Search Services', 'jules-dealer-locator' ),
            'all_items'         => __( 'All Services', 'jules-dealer-locator' ),
            'parent_item'       => __( 'Parent Service', 'jules-dealer-locator' ),
            'parent_item_colon' => __( 'Parent Service:', 'jules-dealer-locator' ),
            'edit_item'         => __( 'Edit Service', 'jules-dealer-locator' ),
            'update_item'       => __( 'Update Service', 'jules-dealer-locator' ),
            'add_new_item'      => __( 'Add New Service', 'jules-dealer-locator' ),
            'new_item_name'     => __( 'New Service Name', 'jules-dealer-locator' ),
            'menu_name'         => __( 'Services', 'jules-dealer-locator' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'service' ),
        );

        register_taxonomy( 'service', array( 'dealer' ), $args );
    }

}
