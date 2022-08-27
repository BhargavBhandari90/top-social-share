<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://naveengiri.com
 * @since             1.0.0
 * @package           Top Social Share
 *
 * @wordpress-plugin
 * Plugin Name:     Top Social Share
 * Plugin URI:      http://naveengiri.com
 * Description:     This plugin is to create social share functionality.
 * Version:         1.0.0
 * Author:          Naveen Giri
 * Author URI:      http://naveengiri.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     top-social-share
 * Domain Path:     /languages
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit;

// Define plugin constants.
if ( ! defined( 'TSS_PLUGINS_URL' ) ) {
	define( 'TSS_PLUGINS_URL',  plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'TSS_PLUGINS_PATH' ) ) {
	define( 'TSS_PLUGINS_PATH',  plugin_dir_path( __FILE__ ) );
}

/**
 * Function to call required plugin files on activation.
 */
if( !function_exists( 'tss_plugin_activate' ) ){
	function tss_plugin_activate() {
		// include all required files here.
		require_once( TSS_PLUGINS_PATH . 'includes/functions.php' );
		require_once( TSS_PLUGINS_PATH . 'includes/class-tss-settings.php' );
		require_once( TSS_PLUGINS_PATH . 'includes/class-tss-social-share.php' );
	}
	// register_activation_hook( __FILE__, 'tss_plugin_activate' );
	add_action( 'plugins_loaded', 'tss_plugin_activate' );
}
