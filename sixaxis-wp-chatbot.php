<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/techjackpot
 * @since             1.0.0
 * @package           SixAxis_WP_ChatBot
 *
 * @wordpress-plugin
 * Plugin Name:       SixAxis WP ChatBot
 * Plugin URI:        https://github.com/Red7Digital/sixaxis-wp-chatbot
 * Description:       WP ChatBot by SixAxis
 * Version:           1.0.0
 * Author:            Lancelot Gordon
 * Author URI:        https://github.com/techjackpot
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sixaxis-wp-chatbot
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SIXAXIS_WP_CHATBOT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sixaxis-wp-chatbot-activator.php
 */
function activate_sixaxis_wp_chatbot() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sixaxis-wp-chatbot-activator.php';
	Sixaxis_Wp_Chatbot_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sixaxis-wp-chatbot-deactivator.php
 */
function deactivate_sixaxis_wp_chatbot() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sixaxis-wp-chatbot-deactivator.php';
	Sixaxis_Wp_Chatbot_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sixaxis_wp_chatbot' );
register_deactivation_hook( __FILE__, 'deactivate_sixaxis_wp_chatbot' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sixaxis-wp-chatbot.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sixaxis_wp_chatbot() {

	$plugin = new Sixaxis_Wp_Chatbot();
	$plugin->run();

}
run_sixaxis_wp_chatbot();
