<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/techjackpot
 * @since      1.0.0
 *
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sixaxis_Wp_Chatbot
 * @subpackage Sixaxis_Wp_Chatbot/includes
 * @author     Lancelot Gordon <lance032017@gmail.com>
 */
class Sixaxis_Wp_Chatbot_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sixaxis-wp-chatbot',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
