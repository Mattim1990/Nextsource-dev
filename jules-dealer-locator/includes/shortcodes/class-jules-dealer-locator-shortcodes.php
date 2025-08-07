<?php

/**
 * Shortcodes for the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/shortcodes
 */

/**
 * Shortcodes for the plugin.
 *
 * @package    Jules_Dealer_Locator
 * @subpackage Jules_Dealer_Locator/includes/shortcodes
 * @author     Jules <jules@example.com>
 */
class Jules_Dealer_Locator_Shortcodes {

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
     * The dealer locator shortcode.
     *
     * @since    1.0.0
     * @param    array     $atts    Shortcode attributes.
     * @return   string             The shortcode output.
     */
    public function dealer_locator_shortcode( $atts ) {
        $atts = shortcode_atts( array(), $atts, 'jules_dealer_locator' );

        $args = array(
            'post_type'      => 'dealer',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        );

        $dealers = new WP_Query( $args );

        if ( ! $dealers->have_posts() ) {
            return '<p>' . __( 'No dealers found.', 'jules-dealer-locator' ) . '</p>';
        }

        ob_start();
        ?>
        <div class="jules-dealer-locator-wrapper">
            <div id="jules-dealer-map" style="height: 500px;"></div>
            <div class="jules-dealer-locator">
                <div class="dealer-filters">
                    <input type="text" id="dealer-search" placeholder="<?php _e( 'Search dealers...', 'jules-dealer-locator' ); ?>">
                </div>
                <div class="dealer-list">
                    <?php while ( $dealers->have_posts() ) : $dealers->the_post(); ?>
                        <div class="dealer-item" data-id="<?php echo get_the_ID(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <div class="dealer-content">
                                <?php the_content(); ?>
                            </div>
                            <div class="dealer-details">
                                <ul>
                                    <?php
                                    $address = get_post_meta( get_the_ID(), '_dealer_address', true );
                                    $phone = get_post_meta( get_the_ID(), '_dealer_phone', true );
                                    $website = get_post_meta( get_the_ID(), '_dealer_website', true );

                                    if ( ! empty( $address ) ) {
                                        echo '<li><strong>' . __( 'Address:', 'jules-dealer-locator' ) . '</strong> ' . esc_html( $address ) . '</li>';
                                    }
                                    if ( ! empty( $phone ) ) {
                                        echo '<li><strong>' . __( 'Phone:', 'jules-dealer-locator' ) . '</strong> ' . esc_html( $phone ) . '</li>';
                                    }
                                    if ( ! empty( $website ) ) {
                                        echo '<li><strong>' . __( 'Website:', 'jules-dealer-locator' ) . '</strong> <a href="' . esc_url( $website ) . '" target="_blank">' . esc_html( $website ) . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

    /**
     * The dealer login form shortcode.
     *
     * @since    1.0.0
     * @param    array     $atts    Shortcode attributes.
     * @return   string             The shortcode output.
     */
    public function dealer_login_form_shortcode( $atts ) {
        if ( is_user_logged_in() ) {
            return '<p>' . __( 'You are already logged in.', 'jules-dealer-locator' ) . '</p>';
        }

        return wp_login_form( array( 'echo' => false ) );
    }

}
