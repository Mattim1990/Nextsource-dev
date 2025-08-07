<?php

/**
 * Manage user roles for the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/user-roles
 */

/**
 * Manage user roles for the plugin.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/user-roles
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_User_Roles {

    /**
     * The role for dealers.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $dealer_role    The role for dealers.
     */
    public static $dealer_role = 'dealer';

    /**
     * Add the dealer role.
     *
     * @since    1.0.0
     */
    public static function add_dealer_role() {
        $caps = array(
            'read' => true,
            'edit_dealer' => true,
            'read_dealer' => true,
            'delete_dealer' => true,
            'edit_dealers' => true,
            'edit_others_dealers' => true,
            'publish_dealers' => true,
            'read_private_dealers' => true,
            'upload_files' => true,
        );
        add_role( self::$dealer_role, __( 'Dealer', 'jules-dealer-locator' ), $caps );

        // Add capabilities to administrator role
        $admin_role = get_role( 'administrator' );
        foreach ( $caps as $cap => $grant ) {
            $admin_role->add_cap( $cap );
        }
    }

    /**
     * Remove the dealer role.
     *
     * @since    1.0.0
     */
    public static function remove_dealer_role() {
        remove_role( self::$dealer_role );
    }

}
