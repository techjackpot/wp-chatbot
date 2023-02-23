<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/techjackpot
 * @since      1.0.0
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/public
 * @author     Lancelot Gordon <lance032017@gmail.com>
 */
class Sixaxis_Wp_Chatbot_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		// wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sixaxis-wp-chatbot-public.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name . '-vue-app', plugin_dir_url( __FILE__ ) . 'vue/css/app.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		// wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sixaxis-wp-chatbot-public.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name . '-vue-vendors', plugin_dir_url( __FILE__ ) . 'vue/js/chunk-vendors.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name . '-vue-app', plugin_dir_url( __FILE__ ) . 'vue/js/app.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Adds the shortcodes: [chatbot]
	 * Hooked on init
	 */
	public function add_shortcodes() {
		add_shortcode( 'chatbot', array( $this, 'render_shortcode_chatbot' ));
	}

	/**
	 * Generates the content for [chatbot]
	 * @param  [type] $attr [description]
	 * @return [type]       [description]
	 */
	public function render_shortcode_chatbot( $attr ) {

		$defaults = array(
		);
		$options = shortcode_atts( $defaults, $attr );

		wp_enqueue_style( $this->plugin_name . '-vue-app' );
		wp_enqueue_script( $this->plugin_name . '-vue-vendors' );
		wp_enqueue_script( $this->plugin_name . '-vue-app' );

		ob_start();
		?>

		<div id="chatbot-widget">Chatbot</div>

		<?php
		$output = ob_get_clean();

		return $output;
		/* @todo */
	}

	/**
	 * Embed chatbot widget as shortcode
	 */
	public function embed_widget() {
		echo do_shortcode('[chatbot]');
	}
}
