<?php

class Jules_Dealer_Locator {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Jules_Dealer_Locator_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'JULES_DEALER_LOCATOR_VERSION' ) ) {
            $this->version = JULES_DEALER_LOCATOR_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'jules-dealer-locator';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Jules_Dealer_Locator_Loader. Orchestrates the hooks of the plugin.
     * - Jules_Dealer_Locator_i18n. Defines internationalization functionality.
     * - Jules_Dealer_Locator_Admin. Defines all hooks for the admin area.
     * - Jules_Dealer_Locator_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jules-dealer-locator-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/i18n/class-jules-dealer-locator-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-jules-dealer-locator-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/public/class-jules-dealer-locator-public.php';

        // Elementor integration
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/elementor-integration.php';

        $this->loader = new Jules_Dealer_Locator_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Jules_Dealer_Locator_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Jules_Dealer_Locator_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Jules_Dealer_Locator_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        // Register CPT
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/cpt/class-jules-dealer-locator-cpt.php';
        $plugin_cpt = new Jules_Dealer_Locator_CPT();
        $this->loader->add_action( 'init', $plugin_cpt, 'register_cpt' );

        // Add Meta Boxes
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-boxes/class-jules-dealer-locator-meta-boxes.php';
        $plugin_meta_boxes = new Jules_Dealer_Locator_Meta_Boxes( $this->get_plugin_name() );
        $this->loader->add_action( 'add_meta_boxes', $plugin_meta_boxes, 'add_meta_boxes' );
        $this->loader->add_action( 'save_post', $plugin_meta_boxes, 'save_meta_data' );

        // Add User Roles
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/user-roles/class-jules-dealer-locator-user-roles.php';
        $this->loader->add_action( 'init', 'Jules_Dealer_Locator_User_Roles', 'add_dealer_role' );

        // Add Taxonomies
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/taxonomies/class-jules-dealer-locator-taxonomies.php';
        $plugin_taxonomies = new Jules_Dealer_Locator_Taxonomies();
        $this->loader->add_action( 'init', $plugin_taxonomies, 'register_services_taxonomy' );

        // Add Tutorial Page
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/tutorial/class-jules-dealer-locator-tutorial.php';
        $plugin_tutorial = new Jules_Dealer_Locator_Tutorial();
        $this->loader->add_action( 'admin_menu', $plugin_tutorial, 'add_tutorial_page' );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Jules_Dealer_Locator_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Jules_Dealer_Locator_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
