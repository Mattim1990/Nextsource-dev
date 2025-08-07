<?php

/**
 * Add meta boxes to the "dealer" custom post type.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/meta-boxes
 */

/**
 * Add meta boxes to the "dealer" custom post type.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/meta-boxes
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Meta_Boxes {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     */
    public function __construct( $plugin_name ) {
        $this->plugin_name = $plugin_name;
    }

    /**
     * Add the meta box.
     *
     * @since    1.0.0
     */
    public function add_meta_boxes() {
        add_meta_box(
            $this->plugin_name . '_dealer_details',
            __( 'Dealer Details', 'jules-dealer-locator' ),
            array( $this, 'render_meta_box' ),
            'dealer',
            'normal',
            'high'
        );
    }

    /**
     * Render the meta box.
     *
     * @since    1.0.0
     */
    public function render_meta_box( $post ) {
        // Add a nonce field so we can check for it later.
        wp_nonce_field( $this->plugin_name . '_dealer_details', $this->plugin_name . '_dealer_details_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
        $address = get_post_meta( $post->ID, '_dealer_address', true );
        $phone = get_post_meta( $post->ID, '_dealer_phone', true );
        $website = get_post_meta( $post->ID, '_dealer_website', true );
        // Display the form, using the current value.
        ?>
        <p>
            <label for="dealer_address"><?php _e( 'Address', 'jules-dealer-locator' ); ?></label>
            <input type="text" id="dealer_address" name="dealer_address" value="<?php echo esc_attr( $address ); ?>" class="widefat" />
        </p>
        <p>
            <label for="dealer_phone"><?php _e( 'Phone Number', 'jules-dealer-locator' ); ?></label>
            <input type="text" id="dealer_phone" name="dealer_phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
        </p>
        <p>
            <label for="dealer_website"><?php _e( 'Website', 'jules-dealer-locator' ); ?></label>
            <input type="text" id="dealer_website" name="dealer_website" value="<?php echo esc_attr( $website ); ?>" class="widefat" />
        </p>
        <?php
    }

    /**
     * Save the meta data.
     *
     * @since    1.0.0
     * @param    int    $post_id    The ID of the post being saved.
     */
    public function save_meta_data( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST[ $this->plugin_name . '_dealer_details_nonce' ] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST[ $this->plugin_name . '_dealer_details_nonce' ], $this->plugin_name . '_dealer_details' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'dealer' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        // Sanitize user input and update the meta fields.
        $fields = array( 'address', 'phone', 'website' );
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ 'dealer_' . $field ] ) ) {
                update_post_meta( $post_id, '_dealer_' . $field, sanitize_text_field( $_POST[ 'dealer_' . $field ] ) );
            }
        }

        // Geocode the address
        if ( isset( $_POST['dealer_address'] ) ) {
            $address = sanitize_text_field( $_POST['dealer_address'] );
            $old_address = get_post_meta( $post_id, '_dealer_address', true );

            if ( $address != $old_address ) {
                $this->geocode_address( $post_id, $address );
            }
        }
    }

    /**
     * Geocode the address and save the latitude and longitude.
     *
     * @since    1.0.0
     * @param    int      $post_id    The ID of the post.
     * @param    string   $address    The address to geocode.
     */
    private function geocode_address( $post_id, $address ) {
        $url = 'https://nominatim.openstreetmap.org/search?q=' . urlencode( $address ) . '&format=json&limit=1';
        $args = array(
            'headers' => array(
                'User-Agent' => 'Jules Dealer Locator WordPress Plugin',
            ),
        );
        $response = wp_remote_get( $url, $args );

        if ( is_wp_error( $response ) ) {
            return;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( ! empty( $data ) && isset( $data[0]['lat'] ) && isset( $data[0]['lon'] ) ) {
            update_post_meta( $post_id, '_dealer_latitude', $data[0]['lat'] );
            update_post_meta( $post_id, '_dealer_longitude', $data[0]['lon'] );
        }
    }

}
