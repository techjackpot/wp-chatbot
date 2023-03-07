<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/techjackpot
 * @since      1.0.0
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/admin
 * @author     Lancelot Gordon <lance032017@gmail.com>
 */
class Sixaxis_Wp_Chatbot_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sixaxis_Wp_Chatbot_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sixaxis_Wp_Chatbot_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (strpos($hook, 'sixaxis-wp-chatbot') === false) {
			return;
		}
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sixaxis-wp-chatbot-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sixaxis_Wp_Chatbot_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sixaxis_Wp_Chatbot_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if (strpos($hook, 'sixaxis-wp-chatbot') === false) {
			return;
		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sixaxis-wp-chatbot-admin.js', array( 'jquery' ), $this->version, false );

		if (strpos($hook, 'sixaxis-wp-chatbot-export') !== false) {
			wp_enqueue_script( $this->plugin_name . '-export', plugin_dir_url( __FILE__ ) . 'js/sixaxis-wp-chatbot-admin-sub-export.js', array( 'jquery' ), $this->version, false );
		}
		if (strpos($hook, 'sixaxis-wp-chatbot-embedding') !== false) {
			wp_enqueue_script( $this->plugin_name . '-embedding', plugin_dir_url( __FILE__ ) . 'js/sixaxis-wp-chatbot-admin-sub-embedding.js', array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Register admin page area
	 */
	public function setup_admin_page() {
		add_menu_page(
			'SixAxis WP ChatBot Menu',
			'ChatBot',
			'manage_options',
			'sixaxis-wp-chatbot-settings',
			[$this, 'show_admin_sub_settings_page'],
		);
		add_submenu_page(
			'sixaxis-wp-chatbot-settings',
			'SixAxis WP ChatBot - Settings',
			'Settings',
			'manage_options',
			'sixaxis-wp-chatbot-settings',
			[$this, 'show_admin_sub_settings_page'],
		);
		add_submenu_page(
			'sixaxis-wp-chatbot-settings',
			'SixAxis WP ChatBot - Embedding Data',
			'Embedding Data',
			'manage_options',
			'sixaxis-wp-chatbot-embedding',
			[$this, 'show_admin_sub_embedding_page'],
		);
		add_submenu_page(
			'sixaxis-wp-chatbot-settings',
			'SixAxis WP ChatBot - Export',
			'Export',
			'manage_options',
			'sixaxis-wp-chatbot-export',
			[$this, 'show_admin_sub_export_page'],
		);
	}
	public function show_admin_main_page() {
		include plugin_dir_path(__FILE__) . 'partials/sixaxis-wp-chatbot-admin-display.php';
	}
	public function show_admin_sub_settings_page() {
		include plugin_dir_path(__FILE__) . 'partials/sixaxis-wp-chatbot-admin-sub-settings.php';
	}
	public function show_admin_sub_embedding_page() {
		include plugin_dir_path(__FILE__) . 'partials/sixaxis-wp-chatbot-admin-sub-embedding.php';
	}
	public function show_admin_sub_export_page() {
		include plugin_dir_path(__FILE__) . 'partials/sixaxis-wp-chatbot-admin-sub-export.php';
	}

}
