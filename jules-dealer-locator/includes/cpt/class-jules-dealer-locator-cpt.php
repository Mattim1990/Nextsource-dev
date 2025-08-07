<?php

/**
 * Register the custom post type for dealers.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/cpt
 */

/**
 * Register the custom post type for dealers.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/cpt
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_CPT {

    /**
     * Register the "dealer" custom post type.
     *
     * @since    1.0.0
     */
    public function register_cpt() {
        $labels = array(
            'name'                  => _x( 'Dealers', 'Post type general name', 'jules-dealer-locator' ),
            'singular_name'         => _x( 'Dealer', 'Post type singular name', 'jules-dealer-locator' ),
            'menu_name'             => _x( 'Dealers', 'Admin Menu text', 'jules-dealer-locator' ),
            'name_admin_bar'        => _x( 'Dealer', 'Add New on Toolbar', 'jules-dealer-locator' ),
            'add_new'               => __( 'Add New', 'jules-dealer-locator' ),
            'add_new_item'          => __( 'Add New Dealer', 'jules-dealer-locator' ),
            'new_item'              => __( 'New Dealer', 'jules-dealer-locator' ),
            'edit_item'             => __( 'Edit Dealer', 'jules-dealer-locator' ),
            'view_item'             => __( 'View Dealer', 'jules-dealer-locator' ),
            'all_items'             => __( 'All Dealers', 'jules-dealer-locator' ),
            'search_items'          => __( 'Search Dealers', 'jules-dealer-locator' ),
            'parent_item_colon'     => __( 'Parent Dealers:', 'jules-dealer-locator' ),
            'not_found'             => __( 'No dealers found.', 'jules-dealer-locator' ),
            'not_found_in_trash'    => __( 'No dealers found in Trash.', 'jules-dealer-locator' ),
            'featured_image'        => _x( 'Dealer Logo', 'Overrides the “Featured Image” phrase for this post type.', 'jules-dealer-locator' ),
            'set_featured_image'    => _x( 'Set dealer logo', 'Overrides the “Set featured image” phrase for this post type.', 'jules-dealer-locator' ),
            'remove_featured_image' => _x( 'Remove dealer logo', 'Overrides the “Remove featured image” phrase for this post type.', 'jules-dealer-locator' ),
            'use_featured_image'    => _x( 'Use as dealer logo', 'Overrides the “Use as featured image” phrase for this post type.', 'jules-dealer-locator' ),
            'archives'              => _x( 'Dealer archives', 'The post type archive label used in nav menus.', 'jules-dealer-locator' ),
            'insert_into_item'      => _x( 'Insert into dealer', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post).', 'jules-dealer-locator' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this dealer', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post).', 'jules-dealer-locator' ),
            'filter_items_list'     => _x( 'Filter dealers list', 'Screen reader text for the filter links heading on the post type listing screen.', 'jules-dealer-locator' ),
            'items_list_navigation' => _x( 'Dealers list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'jules-dealer-locator' ),
            'items_list'            => _x( 'Dealers list', 'Screen reader text for the items list heading on the post type listing screen.', 'jules-dealer-locator' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'dealer' ),
            'capability_type'    => 'dealer',
            'capabilities' => array(
                'edit_post'          => 'edit_dealer',
                'read_post'          => 'read_dealer',
                'delete_post'        => 'delete_dealer',
                'edit_posts'         => 'edit_dealers',
                'edit_others_posts'  => 'edit_others_dealers',
                'publish_posts'      => 'publish_dealers',
                'read_private_posts' => 'read_private_dealers',
            ),
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon'          => 'dashicons-location-alt',
        );

        register_post_type( 'dealer', $args );
    }

}
